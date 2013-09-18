<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends MY_Controller {
    private $access;

    public function __construct(){
        parent::__construct();
        $this->_set_access();
        $this->load->model('report_model');
    }

    public function by_teacher(){
        $role = $this->session->userdata('role');

        $years = $this->report_model->get_years();
        $months = Misc_helper::get_months(FALSE, TRUE);

        // Only A and H can choose schools
        $schools = array();
        if($this->_can_access($role, 'by_teacher_schools')){
            $schools = $this->school_model->getAll();
        }
        else{
            if($school = $this->session->userdata('school')){
                $schools[] = $school;
            }
        }
        if(count($schools) > 1){
            $any = new stdClass();
            $any->id = 0;
            $any->name = 'Any';
            $temp = array($any);
            $schools = array_merge($temp, $schools);
        }

        // Only A, H, S, V and C can choose teachers
        $teacher = new stdClass();
        $teacher->id = 0;
        $teacher->name = 'Any';
        $teachers = array($teacher);

        // Only A, H, S, V and C can choose grades
        $grades = array();
        if($this->_can_access($role, 'by_teacher_grades')){
            $grades = $this->report_model->get_grades(TRUE);
        }
        else{
            if($teacher = $this->session->userdata('teacher')){
                $all_grades = $this->teacher_model->grades();
                $grades[$teacher->gradeLevel] = $all_grades[$teacher->gradeLevel];
            }
            else{
                $grades[''] = 'Any';
            }
        }

        $params = array();
        $params['schools'] = $schools;
        $params['years'] = $years;
        $params['months'] = $months;
        $params['grades'] = $grades;
        $params['teachers'] = $teachers;

        $this->template('report/by_teacher', $params);
    }

    public function get_teachers_by_school(){
        $teachers = array();
        if($this->_can_access($this->session->userdata('role'), 'by_teacher_teachers')){
            $schoolId = $this->input->post('schoolId');

            $any = new stdClass();
            $any->id = 0;
            $any->name = 'Any';
            $teachers[] = $any;
            $teachers = array_merge($teachers, $this->teacher_model->get_full_by_school($schoolId));
        }
        else{
            $teacher = $this->session->userdata('teacher');
            $user = $this->session->userdata('user');
            $teacher->name = $user->name;
            $teachers[] = $teacher;
        }

        echo json_encode($teachers);
    }

    public function search_by_teacher(){
        $params = $this->_search_by_teacher();
        $this->load->view('report/get_by_teacher', $params);
    }

    private function _search_by_teacher(){
        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $grade = $this->input->post('grade');
        $schoolId = $this->input->post('schoolId');
        $teacherId = $this->input->post('teacherId');

        $params = new stdClass();
        $params->month = $month? $month: NULL;
        $params->grade = $grade!=''? $grade: NULL;
        $params->schoolId = $schoolId? $schoolId: NULL;
        $params->teacherId = $teacherId? $teacherId: NULL;

        $result = $this->tracking_model->report_by_teacher($year, $params);

        $temp = array();
        $totals = array();
        foreach($result as $row){
            $temp[$row->year][$row->month][$row->district][$row->school][$row->gradeLevel][$row->teacher][] = $row;
        }
        $result = $temp;

        foreach($result as $year => $year_data){

            $year_total = $this->report_model->init_report_object_by_teacher();
            foreach($year_data as $month => $month_data){

                $month_total = $this->report_model->init_report_object_by_teacher();
                foreach($month_data as $district => $district_data){

                    $district_total = $this->report_model->init_report_object_by_teacher();
                    foreach($district_data as $school => $school_data){

                        $school_total = $this->report_model->init_report_object_by_teacher();
                        foreach($school_data as $grade => $grade_data){

                            $grade_total = $this->report_model->init_report_object_by_teacher();
                            foreach($grade_data as $teacher => $teacher_data){

                                $teacher_total = $this->report_model->init_report_object_by_teacher();
                                foreach($teacher_data as $row){
                                    $teacher_total = $this->report_model->sum_report_objects_by_teacher($row, $teacher_total);
                                }

                                $totals[$year][$month][$district][$school][$grade][$teacher]['total'] = $teacher_total;
                                $grade_total = $this->report_model->sum_report_objects_by_teacher($teacher_total, $grade_total);
                            }

                            $totals[$year][$month][$district][$school][$grade]['total'] = $grade_total;
                            $school_total = $this->report_model->sum_report_objects_by_teacher($grade_total, $school_total);
                        }

                        $totals[$year][$month][$district][$school]['total'] = $school_total;
                        $district_total = $this->report_model->sum_report_objects_by_teacher($school_total, $district_total);
                    }

                    $totals[$year][$month][$district]['total'] = $district_total;
                    $month_total = $this->report_model->sum_report_objects_by_teacher($district_total, $month_total);
                }

                $totals[$year][$month]['total'] = $month_total;
                $year_total = $this->report_model->sum_report_objects_by_teacher($month_total, $year_total);
            }

            $totals[$year]['total'] = $year_total;
        }

        $params->result = $result;
        $params->totals = $totals;
        $params->grades = $this->teacher_model->grades();

        return $params;
    }

    /*public function download_by_teacher(){
        $errors = array();
        $url = FALSE;

        if($result = $this->_search_by_teacher()){
            $line = '"Month","District","School","Grade Level","Teacher","Category","Resource","Minutes Per Use","Times Used","Maximum Uses Per Month","Minutes Used","Total Possible Use"' . PHP_EOL;
            $response = $this->_download($result, $line);
            $errors = $response->errors;
            $url = $response->url;
        }
        else{
            $errors[] = 'Nothing to download.';
        }

        $data = new stdClass();
        $data->errors = $errors;
        $data->url = $url;

        echo json_encode($data);
    }*/

    public function download_by_teacher(){
        $errors = array();
        $url = FALSE;
        $report = '';

        $params = $this->_search_by_teacher();
        if($params->result){
            $result = $params->result;
            $totals = $params->totals;
            $grades = $params->grades;
            foreach($result as $year => $year_data){
                $year_total = $totals[$year]['total'];
                $report .= '"' . $year . '","';
                $report .= implode('","',(array) $year_total);
                $report .= "\"\r\n";
                foreach($year_data as $month => $month_data){
                    $month_total = $totals[$year][$month]['total'];
                    $report .= "\t\"" . $month . '","';
                    $report .= implode('","',(array) $month_total);
                    $report .= "\"\r\n";
                    foreach($month_data as $district => $district_data){
                        $district_total = $totals[$year][$month][$district]['total'];
                        $report .= "\t\t\"" . $district . '","';
                        $report .= implode('","',(array) $district_total);
                        $report .= "\"\r\n";
                        foreach($district_data as $school => $school_data){
                            $school_total = $totals[$year][$month][$district][$school]['total'];
                            $report .= "\t\t\t\"" . $school . '","';
                            $report .= implode('","',(array) $school_total);
                            $report .= "\"\r\n";
                            foreach($school_data as $grade => $grade_data){
                                $grade_total = $totals[$year][$month][$district][$school][$grade]['total'];
                                $report .= "\t\t\t\t\"" . $grades[$grade] . '","';
                                $report .= implode('","',(array) $grade_total);
                                $report .= "\"\r\n";
                                foreach($grade_data as $teacher => $teacher_data){
                                    $teacher_total = $totals[$year][$month][$district][$school][$grade][$teacher]['total'];
                                    $report .= "\t\t\t\t\t\"" . $teacher . '","';
                                    $report .= implode('","',(array) $teacher_total);
                                    $report .= "\"\r\n";
                                    foreach($teacher_data as $row){
                                        $temp = new stdClass();
                                        $temp->category = $row->category;
                                        $temp->resource = $row->resource;
                                        $temp->minutesPerUse = $row->minutesPerUse;
                                        $temp->timesUsed = $row->timesUsed;
                                        $temp->maximumUsesPerMonth = $row->maximumUsesPerMonth;
                                        $temp->minutesUsed = $row->minutesUsed;
                                        $temp->totalPossibleTime = $row->totalPossibleTime;

                                        $report .= "\t\t\t\t\t\t\"";
                                        $report .= implode('","', (array)$temp);
                                        $report .= "\"\r\n";
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if($report){
                $download = $this->_download($report);
                $errors = $download->errors;
                $url = $download->url;
            }
            else{
                $errors[] = 'Error filling report.';
            }
        }
        else{
            $errors[] = 'Nothing to download.';
        }

        $data = new stdClass();
        $data->errors = $errors;
        $data->url = $url;

        echo json_encode($data);
    }

    public function by_school(){
        $role = $this->session->userdata('role');

        $years = $this->report_model->get_years();
        $months = Misc_helper::get_months(FALSE, TRUE);
        $schools = array();

        // Only A and H can choose districts
        $districts = array();
        if($this->_can_access($role, 'by_school_districts')){
            $districts = $this->district_model->getAll();
        }
        else{
            if($school = $this->session->userdata('school')){
                $district = $this->district_model->get_by_school($school->id);
                $districts[] = $district;
                $schools[] = $school;
            }
        }
        if(count($districts) > 1){
            $any = new stdClass();
            $any->id = 0;
            $any->name = 'Any';
            $temp = array($any);
            $districts = array_merge($temp, $districts);
        }
        if(count($schools) != 1){
            $any = new stdClass();
            $any->id = 0;
            $any->name = 'Any';
            $temp = array($any);
            $schools = array_merge($temp, $schools);
        }

        $cohorts = $this->report_model->get_cohorts(TRUE);
        // Only A, H, S, V and C can choose teachers

        $lates = array();
        $lates[0] = 'Both';
        $lates[-1] = 'Only late';
        $lates[1] = 'Only on time';

        $group_by_school = array();
        $group_by_school['month'] = 'Month';
        $group_by_teacher['teacher'] = 'Teacher';
        $group_by_school['school'] = 'School';
        $group_by_school['nutrition'] = 'Resource Type';
        $group_by_school['verified'] = 'Tracking Verified';

        $params = array();
        $params['districts'] = $districts;
        $params['years'] = $years;
        $params['months'] = $months;
        $params['cohorts'] = $cohorts;
        $params['schools'] = $schools;
        $params['lates'] = $lates;
        $params['group_by'] = $group_by_school;

        $this->template('report/by_school', $params);
    }

    public function get_schools_by_district(){
        $schools = array();
        if($this->_can_access($this->session->userdata('role'), 'by_school_schools')){
            $districtId = $this->input->post('districtId');
            $schools = $this->school_model->get_by_district($districtId);

        }
        else{
            $school = $this->session->userdata('school');
            $schools[] = $school;
        }

        if(count($schools) != 1){
            $any = new stdClass();
            $any->id = 0;
            $any->name = 'Any';
            $temp = array($any);
            $schools = array_merge($temp, $schools);
        }

        echo json_encode($schools);
    }

    public function search_by_school(){
        $params = $this->_search_by_school();
        $params->view = $params->errors? FALSE: $this->load->view('report/get_by_school', $params, TRUE);

        echo json_encode($params);
    }

    public function _search_by_school(){
        $errors = array();
        $result = FALSE;
        $totals = array();

        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $date = $this->input->post('date');
        $andMonth = $this->input->post('andMonth');
        $late = $this->input->post('late');
        $cohort = $this->input->post('cohort');
        $districtId = $this->input->post('districtId');
        $schoolId = $this->input->post('schoolId');
        $verified = $this->input->post('verified');
        $afterDate = $this->input->post('afterDate');

        $params = new stdClass();
        $params->date = $date;
        $params->year = $year;
        $params->month = $month? $month: NULL;
        $params->andMonth = $andMonth;
        $params->late = $late? $late: NULL;
        $params->cohort = $cohort? $cohort: NULL;
        $params->districtId = $districtId? $districtId: NULL;
        $params->schoolId = $schoolId? $schoolId: NULL;
        $params->verified = $verified == 'true';
        $params->afterDate = $afterDate? Misc_helper::date_to_db($afterDate): FALSE;

        if(!($errors = $this->_has_errors_by_school($params))){
            $result = $this->tracking_model->report_by_school($year, $params);

            $temp = array();
            foreach($result as $row){
                $verified = $row->verified? 'Verified': 'Not Verified';
                $temp[$row->year][$row->month][$verified][$row->district][$row->school][$row->nutrition][] = $row;
            }
            $result = $temp;

            foreach($result as $year => $year_data){

                $year_total = $this->report_model->init_report_object_by_school();
                foreach($year_data as $month => $month_data){

                    $month_total = $this->report_model->init_report_object_by_school();
                    foreach($month_data as $verified => $verified_data){

                        $verified_total = $this->report_model->init_report_object_by_school();
                        foreach($verified_data as $district => $district_data){

                            $district_total = $this->report_model->init_report_object_by_school();
                            foreach($district_data as $school => $school_data){

                                $school_total = $this->report_model->init_report_object_by_school();
                                foreach($school_data as $nutrition => $nutrition_data){

                                    $nutrition_total = $this->report_model->init_report_object_by_school();
                                    foreach($nutrition_data as $row){
                                        $nutrition_total = $this->report_model->sum_report_objects_by_school($row, $nutrition_total);
                                    }

                                    $totals[$year][$month][$verified][$district][$school][$nutrition]['total'] = $nutrition_total;
                                    $school_total = $this->report_model->sum_report_objects_by_school($nutrition_total, $school_total);
                                }

                                $totals[$year][$month][$verified][$district][$school]['total'] = $school_total;
                                $district_total = $this->report_model->sum_report_objects_by_school($school_total, $district_total);
                            }

                            $totals[$year][$month][$verified][$district]['total'] = $district_total;
                            $verified_total = $this->report_model->sum_report_objects_by_school($district_total, $verified_total);
                        }

                        $totals[$year][$month][$verified]['total'] = $verified_total;
                        $month_total = $this->report_model->sum_report_objects_by_school($verified_total, $month_total);
                    }

                    $totals[$year][$month]['total'] = $month_total;
                    $year_total = $this->report_model->sum_report_objects_by_school($month_total, $year_total);
                }

                $totals[$year]['total'] = $year_total;
            }

        }

        $data = new stdClass();
        $data->errors = $errors;
        $data->result = $result;
        $data->totals = $totals;

        return $data;
    }

    private function _has_errors_by_school($params){
        $errors = array();

        if($params->date){ // Date between
            if(($params->month < 8 && $params->andMonth < 8 ) || ($params->month >=8 && $params->andMonth >= 8)){
                if($params->month > $params->andMonth){
                    $errors[] = 'Invalid months selected. Please, select a valid range.';
                }
            }
            else{
                if($params->month < 8 && $params->andMonth >= 8){
                    $errors[] = 'Invalid months selected. Please, select a valid range.';
                }
            }
        }

        if($params->verified && $params->afterDate && !strtotime($params->afterDate)){
            $errors[] = 'Invalid date for "Verified After Date".';
        }

        return $errors;
    }

    /*public function download_by_school(){
        $errors = array();
        $url = FALSE;

        $result = $this->_search_by_school();

        if(!$result->errors){
            if($result->result){
                $line = '"Month","District","School","Verified","Type","Cohort","Students","Total Minutes Used"' . PHP_EOL;
                $response = $this->_download($result->result, $line);
                $errors = $response->errors;
                $url = $response->url;
            }
            else{
                $errors[] = 'Nothing to download.';
            }
        }
        else{
            $errors = $result->errors;
        }

        $data = new stdClass();
        $data->errors = $errors;
        $data->url = $url;

        echo json_encode($data);
    }*/

    public function download_by_school(){
        $errors = array();
        $url = FALSE;
        $report = '';

        $params = $this->_search_by_school();
        if($params->result){
            $result = $params->result;
            $totals = $params->totals;
            foreach($result as $year => $year_data){
                $year_total = $totals[$year]['total'];
                $report .= '"' . $year . '","';
                $report .= implode('","',(array) $year_total);
                $report .= "\"\r\n";
                foreach($year_data as $month => $month_data){
                    $month_total = $totals[$year][$month]['total'];
                    $report .= "\t\"" . $month . '","';
                    $report .= implode('","',(array) $month_total);
                    $report .= "\"\r\n";
                    foreach($month_data as $verified => $verified_data){
                        $verified_total = $totals[$year][$month][$verified]['total'];
                        $report .= "\t\t\"" . $verified . '","';
                        $report .= implode('","',(array) $verified_total);
                        $report .= "\"\r\n";
                        foreach($verified_data as $district => $district_data){
                            $district_total = $totals[$year][$month][$verified][$district]['total'];
                            $report .= "\t\t\t\"" . $district . '","';
                            $report .= implode('","',(array) $district_total);
                            $report .= "\"\r\n";
                            foreach($district_data as $school => $school_data){
                                $school_total = $totals[$year][$month][$verified][$district][$school]['total'];
                                $report .= "\t\t\t\t\"" . $school . '","';
                                $report .= implode('","',(array) $school_total);
                                $report .= "\"\r\n";
                                foreach($school_data as $nutrition => $nutrition_data){
                                    $nutrition_total = $totals[$year][$month][$verified][$district][$school][$nutrition]['total'];
                                    $nutrition = $nutrition? 'Nutrition': 'Physical Activity';
                                    $report .= "\t\t\t\t\t\"" . $nutrition . '","';
                                    $report .= implode('","',(array) $nutrition_total);
                                    $report .= "\"\r\n";
                                    foreach($nutrition_data as $row){
                                        $temp = new stdClass();
                                        $temp->cohort = $row->cohort;
                                        $temp->teacherUsage = $row->teacherUsage;
                                        $temp->totalTimeMinutes = $row->totalTimeMinutes;
                                        $temp->actualTime = $row->actualTime;
                                        $temp->studentUsage = $row->studentUsage;
                                        
                                        $report .= "\t\t\t\t\t\t\"";
                                        $report .= implode('","', (array)$temp);
                                        $report .= "\"\r\n";
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if($report){
                $download = $this->_download($report);
                $errors = $download->errors;
                $url = $download->url;
            }
            else{
                $errors[] = 'Error filling report.';
            }
        }
        else{
            $errors[] = 'Nothing to download.';
        }

        $data = new stdClass();
        $data->errors = $errors;
        $data->url = $url;

        echo json_encode($data);
    }

    public function by_resource(){
        $role = $this->session->userdata('role');

        $years = $this->report_model->get_years();

        // Only A and H can choose schools
        $schools = array();
        if($this->_can_access($role, 'by_resource_schools')){
            $schools = $this->school_model->getAll();
        }
        else{
            if($school = $this->session->userdata('school')){
                $schools[] = $school;
            }
        }
        if(count($schools) > 1){
            $any = new stdClass();
            $any->id = 0;
            $any->name = 'Any';
            $temp = array($any);
            $schools = array_merge($temp, $schools);
        }

        $cohorts = $this->report_model->get_cohorts(TRUE);

        // Only A, H, S, V and C can choose grades
        $grades = array();
        if($this->_can_access($role, 'by_resource_grades')){
            $grades = $this->report_model->get_grades(TRUE);
        }
        else{
            if($teacher = $this->session->userdata('teacher')){
                $all_grades = $this->teacher_model->grades();
                $grades[$teacher->gradeLevel] = $all_grades[$teacher->gradeLevel];
            }
            else{
                $grades[''] = 'Any';
            }
        }

        $params = array();
        $params['schools'] = $schools;
        $params['years'] = $years;
        $params['cohorts'] = $cohorts;
        $params['grades'] = $grades;

        $this->template('report/by_resource', $params);
    }

    public function search_by_resource(){
        $params = $this->_search_by_resource();

        $this->load->view('report/get_by_resource', $params);
    }

    public function _search_by_resource(){
        $year = $this->input->post('year');
        $schoolId = $this->input->post('schoolId');
        $cohort = $this->input->post('cohort');
        $grade = $this->input->post('grade');

        $params = new stdClass();
        $params->schoolId = $schoolId? $schoolId: NULL;
        $params->cohort = $cohort? $cohort: NULL;
        $params->grade = $grade!=''? $grade: NULL;

        $result = $this->tracking_model->report_by_resource($year, $params);

        $temp = array();
        $totals = array();
        foreach($result as $row){
            $temp[$row->category][$row->resource][$row->gradeLevel][] = $row;
        }
        $result = $temp;

        foreach($result as $category => $category_data){

            $category_total = $this->report_model->init_report_object_by_resource();
            foreach($category_data as $resource => $resource_data){

                $resource_total = $this->report_model->init_report_object_by_resource();
                foreach($resource_data as $grade => $grade_data){

                    $grade_total = $this->report_model->init_report_object_by_resource();
                    foreach($grade_data as $row){
                        $grade_total = $this->report_model->sum_report_objects_by_resource($row, $grade_total);
                    }

                    $totals[$category][$resource][$grade]['total'] = $grade_total;
                    $resource_total = $this->report_model->sum_report_objects_by_resource($grade_total, $resource_total);
                }

                $totals[$category][$resource]['total'] = $resource_total;
                $category_total = $this->report_model->sum_report_objects_by_resource($resource_total, $category_total);
            }

            $totals[$category]['total'] = $category_total;
        }

        $params = new stdClass();
        $params->result = $result;
        $params->totals = $totals;
        $params->grades = $this->teacher_model->grades();

        return $params;
    }

    
    /*public function download_by_resource(){
        $errors = array();
        $url = FALSE;

        $result = $this->_search_by_resource();

        if($result){
            $line = '"Category","Resource","Grade Level","Teachers","Contacts","Student Usage","Minutes of Instruction"' . PHP_EOL;
            $response = $this->_download($result, $line);
            $errors = $response->errors;
            $url = $response->url;
        }
        else{
            $errors[] = 'Nothing to download.';
        }

        $data = new stdClass();
        $data->errors = $errors;
        $data->url = $url;

        echo json_encode($data);
    }*/
    

    public function download_by_resource(){
        $errors = array();
        $url = FALSE;
        $report = '';

        $params = $this->_search_by_resource();
        if($params->result){
            $result = $params->result;
            $totals = $params->totals;
            $grades = $params->grades;
            foreach($result as $category => $category_data){
                $category_total = $totals[$category]['total'];
                $report .= '"' . $category . '","';
                $report .= implode('","',(array) $category_total);
                $report .= "\"\r\n";
                foreach($category_data as $resource => $resource_data){
                    $resource_total = $totals[$category][$resource]['total'];
                    $report .= "\t\"" . $resource . '","';
                    $report .= implode('","',(array) $resource_total);
                    $report .= "\"\r\n";
                    foreach($resource_data as $grade => $grade_data){
                        $grade_total = $totals[$category][$resource][$grade]['total'];
                        $report .= "\t\t\"" . $grades[$grade] . '","';
                        $report .= implode('","',(array) $grade_total);
                        $report .= "\"\r\n";
                        foreach($grade_data as $row){
                            $temp = new stdClass();
                            $temp->teacher = $row->teacher;
                            $temp->students = $row->students;
                            $temp->teacherUsage = $row->teacherUsage;
                            $temp->studentUsage = $row->studentUsage;
                            $temp->minutesOfInstruction = $row->minutesOfInstruction;

                            $report .= "\t\t\t\"";
                            $report .= implode('","', (array)$temp);
                            $report .= "\"\r\n";
                        }
                    }
                }
            }

            if($report){
                $download = $this->_download($report);
                $errors = $download->errors;
                $url = $download->url;
            }
            else{
                $errors[] = 'Error filling report.';
            }
        }
        else{
            $errors[] = 'Nothing to download.';
        }

        $data = new stdClass();
        $data->errors = $errors;
        $data->url = $url;

        echo json_encode($data);
    }

    private function _set_access(){
        $access = array(
            'by_teacher_schools' => array(
                User_model::$ROLE_A,
                User_model::$ROLE_H
            ),

            'by_teacher_grades' => array(
                User_model::$ROLE_A,
                User_model::$ROLE_H,
                User_model::$ROLE_S,
                User_model::$ROLE_V,
                User_model::$ROLE_C,
            ),

            'by_teacher_teachers' => array(
                User_model::$ROLE_A,
                User_model::$ROLE_H,
                User_model::$ROLE_S,
                User_model::$ROLE_V,
                User_model::$ROLE_C,
            ),

            'by_school_schools' => array(
                User_model::$ROLE_A,
                User_model::$ROLE_H
            ),

            'by_school_districts' => array(
                User_model::$ROLE_A,
                User_model::$ROLE_H
            ),

            'by_teacher_cohort' => array(
                User_model::$ROLE_A,
                User_model::$ROLE_H
            ),

            'by_resource_schools' => array(
                User_model::$ROLE_A,
                User_model::$ROLE_H
            ),

            'by_resource_grades' => array(
                User_model::$ROLE_A,
                User_model::$ROLE_H,
                User_model::$ROLE_S,
                User_model::$ROLE_V,
                User_model::$ROLE_C,
            ),

        );

        $this->access = $access;
    }

    private function _can_access($role, $function){
        if(array_key_exists($function, $this->access) && in_array($role, $this->access[$function])){
            return TRUE;
        }

        return FALSE;
    }

    private function _download($report){
        $userId = $this->session->userdata('userId');
        $full_path = '';
        $url = '';
        $errors = array();

        $reports_path = config_item('uploads_path') . 'reports/' . $userId . '/';

        if(is_dir($reports_path)){
            @chmod($reports_path, 0755);
        }
        else{
            @mkdir($reports_path, 0755);
        }

        if(is_dir($reports_path)){
            $file_name = date('Y-m-dH:i:s').'.csv';
            $full_path = $reports_path . $file_name;

            $uploads_url = config_item('uploads_url');
            $url = $uploads_url . 'reports/' . $userId . '/' . $file_name;

            if($file = fopen($full_path, 'wt')){
                fwrite($file, $report);
                fclose($file);
            }
            else{
                $errors[] = 'Unable to create csv file.';
            }
        }
        else{
            $errors[] = 'Unable to create csv file.';
        }

        $response = new stdClass();
        $response->url = $url;
        $response->errors = $errors;

        return $response;
    }


    /*private function _download($result, $line){
        $userId = $this->session->userdata('userId');
        $full_path = '';
        $url = '';
        $errors = array();

        $reports_path = config_item('uploads_path') . 'reports/' . $userId . '/';

        if(is_dir($reports_path)){
            @chmod($reports_path, 0755);
        }
        else{
            @mkdir($reports_path, 0755);
        }

        if(is_dir($reports_path)){
            $file_name = date('Y-m-dH:i:s').'.csv';
            $full_path = $reports_path . $file_name;

            $uploads_url = config_item('uploads_url');
            $url = $uploads_url . 'reports/' . $userId . '/' . $file_name;

            if($file = fopen($full_path, 'wt')){
                fwrite($file, $line);

                foreach($result as $row){
                    $line = implode('","',(array) $row);
                    $line = '"' . $line . '"' . PHP_EOL;
                    fwrite($file, $line);
                }

                fclose($file);
            }
            else{
                $errors[] = 'Unable to create csv file.';
            }
        }
        else{
            $errors[] = 'Unable to create csv file.';
        }

        $response = new stdClass();
        $response->url = $url;
        $response->errors = $errors;

        return $response;
    }*/
}

/* End of file report.php */
/* Location: ./application/controllers/report.php */