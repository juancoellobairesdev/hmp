<div id="notifications">
    <ul>
    </ul>
</div>
<div id="school_form">
    <form action="<?= $baseUrl ?>school/save" method="post" accept-charset="utf-8" id="form" enctype="multipart/form-data">
        <fieldset>
            <legend>Basic Data</legend>
            <?php if($school->id): ?>
                <label for="schoolId">Id:</label>
                <input type="text" id="schoolId" name="schoolId" maxlength="3" size="3" disabled value="<?= intval($school->id) ?>"/><br/>
            <?php endif; ?>

            <label for="districtId">School District:</label>
            <select id="districtId" name="districtId">
                <?php foreach($districts as $district): ?>
                    <option value="<?= $district->id ?>" <?= ($district->id == $school->districtId)? 'selected': '' ?>><?= $district->name ?></option>
                <?php endforeach; ?>
            </select><br>

            <label for="name">School Name:</label>
            <input type="text" id="name" name="name" maxlength="100" size="50" value="<?= $school->name ?>"/><br/>

            <?php if($school->id): ?>
                <label for="startingSchoolYear">Starting School Year:</label>
                <input type="number" id="startingSchoolYear" name="startingSchoolYear" min="2000" max="<?= date('Y') ?>" maxlength="4" size="4" value="<?= $school->startingSchoolYear ?>"/><br/>
            <?php endif ?>

            <!--label for="classesStartDate">Start Classes Date:</label>
            <input type="date" id="classesStartDate" name="classesStartDate" maxlength="100" size="50" value="<?= $school->classesStartDate ?>"/><br/--->

            <label for="startTimeOfClasses">Start Time of Classes:</label>
            <input type="time" id="startTimeOfClasses" name="startTimeOfClasses" maxlength="100" size="50" value="<?= date('H:i', strtotime($school->startTimeOfClasses)) ?>"/><br/>

            <label for="endTimeOfClasses">End Time of Classes:</label>
            <input type="time" id="endTimeOfClasses" name="endTimeOfClasses" maxlength="100" size="50" value="<?= date('H:i', strtotime($school->endTimeOfClasses)) ?>"/><br/>

            <!--label for="address">Address:</label>
            <input type="text" id="address" name="address" maxlength="100" size="50" value="<?= $school->address ?>"/><br/-->

            <label for="phone">Main Phone #:</label>
            <input type="tel" id="phone" name="phone" maxlength="100" size="50" value="<?= $school->phone ?>"/><br/>

            <label for="fax">Fax #:</label>
            <input type="tel" id="fax" name="fax" maxlength="100" size="50" value="<?= $school->fax ?>"/><br/>

            <!--label for="email">Email:</label>
            <input type="email" id="email" name="email" maxlength="100" size="50" value="<?= $school->email ?>"/><br/-->

            <label for="shippingContactInfo">Shipping Contact name:</label>
            <input type="text" id="shippingContactInfo" name="shippingContactInfo" maxlength="100" size="50" value="<?= $school->shippingContactInfo ?>"/><br/>

            <label for="spanishMaterials">Number materials needed in Spanish:</label>
            <input type="number" id="spanishMaterials" name="spanishMaterials" min="0" max="9999" value="<?= $school->spanishMaterials ?>"/><br/>
        </fieldset>

        <fieldset>
            <legend>Principal Contact Information</legend>

            <label for="principal">Principal:</label>
            <input type="text" id="principal" name="principal" maxlength="100" size="50" value="<?= $school->principal ?>"/><br/>

            <label for="principalEmailAddress">Email:</label>
            <input type="email" id="principalEmailAddress" name="principalEmailAddress" maxlength="100" size="50" value="<?= $school->principalEmailAddress ?>"/><br/>

            As principal, do you want to be cc’d on all communication to the local school contact(s)?  This would include e-mails for scheduling, electronic newsletters and reminders:<br/>
            <label for="principalCarbonCopied">Allow beeing cc'd:</label>
            <input type="radio" id="principalCarbonCopied" name="principalCarbonCopied" <?= $school->principalCarbonCopied? 'checked': '' ?> value="1">Yes
            <input type="radio" id="principalCarbonCopied" name="principalCarbonCopied" <?= $school->principalCarbonCopied? '': 'checked' ?> value="0">No</br>
        </fieldset>

        <fieldset>
            <legend>School Representatives Contact Information</legend>
            <label for="adm">Administrator:</label>
            <input type="text" id="adm" name="adm" maxlength="100" class="input_email" value="<?= $adm->name ?>" onKeyUp="hmp.school.form.same_as_administrator()"/>
            <span class="right_email">Email:</span>
            <input type="email" id="admsEmail" name="admsEmail" maxlength="100" class="input_email" value="<?= $adm->email ?>" onKeyUp="hmp.school.form.same_as_administrator()"/>
            <!--span class="right_email">Same for all:</span>
            <input type="checkbox" id="same_for_all" name="same_for_all" value="1" onclick="hmp.school.form.same_for_all()"-->
            </br>

            <p>
            To comply with federal funding guidelines, we need all local school principals (OR a local school contact designated by the principal) to verify the use of resources and time for nutrition and physical activity education each month. Please indicate who will be verifying time/use of resources for your school:
            </p>
            <label for="ver">Verifier:</label>
            <input type="text" id="ver" name="ver" maxlength="100" class="input_name" value="<?= $ver->name ?>"/>
            <span class="right_email">Email:</span>
            <input type="email" id="versEmail" name="versEmail" maxlength="100" class="input_email" value="<?= $ver->email ?>"/>
            <!--span class="right_email">Same as Administrator:</span>
            <input type="checkbox" id="chk_ver" name="chk_staff" value="ver" onClick="hmp.school.form.copy_administrator('ver')"-->
            <br/>
            <p>
            As outlined in the Memorandum of Understanding, 
            Please provide three - four school representatives who will serve as your local school health team for this program.  Members should be representative of all individuals from your school and can include media specialist, counselors, administrators, parent representatives, classroom teachers, H/PE teachers, school nutrition director or others.  Note one person cannot be assigned to more than one role.
            </p>

            <table id="staff" style="border: 1px solid gray; border-radius: 5px; width:100%; text-align:left;">
                <tr>
                    <th>Name</th>
                    <th>School Role / Responsability</th>
                    <th>Email Address</th>
                </tr>
                <?php foreach($employees as $employee): ?>
                    <tr>
                        <input type="hidden" value="<?= $employee->id ?>" class="employee_id">
                        <td><input type="text" value="<?= $employee->name ?>" class="employee_name"></td>
                        <td><input type="text" value="<?= $employee->role ?>" class="employee_role"></td>
                        <td><input type="email" value="<?= $employee->email ?>" class="employee_email"></td>
                    </tr>
                <?php endforeach ?>
            </table>

            <p>
                <input type="button" value="Add Representative" onClick="hmp.school.form.add_representative()"/>
            </p>
            <!--label for="lsc">Local School Coordinator:</label>
            <input type="text" id="lsc" name="lsc" maxlength="100" class="input_name" value="<?= $lsc->name ?>"/>
            <span class="right_email">Email:</span>
            <input type="email" id="lscsEmail" name="lscsEmail" maxlength="100" class="input_email" value="<?= $lsc->email ?>"/>
            <span class="right_email">Same as Administrator:</span>
            <input type="checkbox" id="chk_lsc" name="chk_staff" value="lsc" onClick="hmp.school.form.copy_administrator('lsc')">
            <br/>
            <label for="fco">Family Coordinator:</label>
            <input type="text" id="fco" name="fco" maxlength="100" class="input_name" value="<?= $fco->name ?>"/>
            <span class="right_email">Email:</span>
            <input type="email" id="fcosEmail" name="fcosEmail" maxlength="100" class="input_email" value="<?= $fco->email ?>"/>
            <span class="right_email">Same as Administrator:</span>
            <input type="checkbox" id="chk_fco" name="chk_staff" value="fco" onClick="hmp.school.form.copy_administrator('fco')">
            <br/>
            <label for="pet">Physical Education Teacher:</label>
            <input type="text" id="pet" name="pet" maxlength="100" class="input_name" value="<?= $pet->name ?>"/>
            <span class="right_email">Email:</span>
            <input type="email" id="petsEmail" name="petsEmail" maxlength="100" class="input_email" value="<?= $pet->email ?>"/>
            <span class="right_email">Same as Administrator:</span>
            <input type="checkbox" id="chk_pet" name="chk_staff" value="pet" onClick="hmp.school.form.copy_administrator('pet')">
            <br/>
            <label for="sha">Optional: Student Health Advocate Facilitator (if applicable to your school):</label>
            <input type="text" id="sha" name="sha" maxlength="100" class="input_name" value="<?= $sha->name ?>"/>
            <span class="right_email">Email:</span>
            <input type="email" id="shasEmail" name="shasEmail" maxlength="100" class="input_email" value="<?= $sha->email ?>"/>
            <span class="right_email">Same as Administrator:</span>
            <input type="checkbox" id="chk_sha" name="chk_staff" value="sha" onClick="hmp.school.form.copy_administrator('sha')">
            <br/-->

        </fieldset>

        <fieldset>
            <legend>Communications</legend>
            <p>
                Does HealthMPowers have your permission to electronically communicate with your staff twice a month for the following reasons:
            </p>

            <p>1)   Monthly newsletters sent to classroom teachers to enhance nutrition education and physical activity opportunities for students, with the Empowering Healthy Classrooms and Schools Monthly Electronic Newsletter and the Kid2Kid newsletter.  It is through these communication pieces that innovative projects implemented at various local schools, success stories are shared</p>
            <label for="approveNewsletterCommunication">Allow:</label>
            <input type="radio" id="approveNewsletterCommunication" name="approveNewsletterCommunication" <?= $school->approveNewsletterCommunication? 'checked': '' ?> value="1">Yes
            <input type="radio" id="approveNewsletterCommunication" name="approveNewsletterCommunication" <?= $school->approveNewsletterCommunication? '': 'checked' ?> value="0">No</br>

            <p>2)   A quick monthly prompt sent from the HealthMPowers webmaster to remind all teachers to submit their documentation (via our website) of nutrition and physical activity instruction provided</p>
            <label for="approveReminderPrompts">Allow:</label>
            <input type="radio" id="approveReminderPrompts" name="approveReminderPrompts" <?= $school->approveReminderPrompts? 'checked': '' ?> value="1">Yes
            <input type="radio" id="approveReminderPrompts" name="approveReminderPrompts" <?= $school->approveReminderPrompts? '': 'checked' ?> value="0">No</br>
        </fieldset>

        <fieldset>
            <legend>School Staff Upload</legend>

            <p>In order to assign log-in names and passwords for your school staff to submit their required time implementing the program/using resources through the HealthMPowers website, we need the following information completed in a CSV template format for all K-5 classroom teachers, counselors, H/PE teachers and art/music teachers.  Once this step is complete, click the save button at the bottom of the screen</p>

            <p>CSV format example:</p>
            <table style="width: 100%; border: 1px solid black; margin: 10px 0px">
                <tr>
                    <td style="border: 1px solid black">Grade Level</td>
                    <td style="border: 1px solid black">First and Last Name</td>
                    <td style="border: 1px solid black">Email Address</td>
                    <td style="border: 1px solid black"># of Stundents in their Class</td>
                </tr>
            </table>

            <p>Please use the following codes for your grade levels when entering your school information</p>
            <table style="width: 100%; border: 1px solid black; margin: 10px 0px; text-align: left">
                <tr>
                    <th style="border: 1px solid black">Code</th>
                    <th style="border: 1px solid black">Grade Level</th>
                </tr>
                <tr>
                    <td style="border: 1px solid black">-2</td>
                    <td style="border: 1px solid black">Special Area Teachers (Art, Music, Health, PE)</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black">0</td>
                    <td style="border: 1px solid black">Kindergarten Teachers</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black">1</td>
                    <td style="border: 1px solid black">1st. Grade Teachers</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black">2</td>
                    <td style="border: 1px solid black">2nd. Grade Teachers</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black">3</td>
                    <td style="border: 1px solid black">3rd. Grade Teachers</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black">4</td>
                    <td style="border: 1px solid black">4th. Grade Teachers</td>
                </tr>
                <tr>
                    <td style="border: 1px solid black">5</td>
                    <td style="border: 1px solid black">5th. Grade Teachers</td>
                </tr>
            </table>

            <label for="userfile">Upload CSV:</label>
            <input type="file" size="60" name="userfile" onChange="hmp.school.form.check_upload()">
            <div id="check_upload">
            </div>
            <div id="progress" style="margin-left: 150px;">
                <div id="bar"></div>
                <div id="percent">0%</div >
            </div>
        </fieldset>

        <p style="font-weight: bold; font-size: 15px; text-align: justify">If you are having any difficulty filling out this form or uploading the template please contact us at:
        <br/>
        Email:  admin@healthmpowers.org
        <br/>
        or Call: (770) 817.1733
        </p>


        <div id="form_buttons">
            <input type="submit" value="Save" onClick="hmp.school.form.fill_data()">
            <?php if(!$school->id): ?>
                <input type="reset" value="Reset"/>
            <?php endif ?>
        </div>
    </form>
</div>

<script>
    $(document).ready(function(){
        var options = hmp.school.form.options;
        hmp.school.form.options.data.schoolId = $('#schoolId').val();
        $("#form").ajaxForm(options);
    });
</script>