<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Csv_Reader{

    var $fields;            /** columns names retrieved after parsing */ 
    var $separator = ';';    /** separator used to explode each line */
    var $enclosure = '"';    /** enclosure used to decorate each field */

    var $max_row_size = 4096;    /** maximum row size to be used for decoding */

    function parse_file($p_Filepath){

        $file = fopen($p_Filepath, 'r');
        $this->fields = fgetcsv($file, $this->max_row_size, $this->separator, $this->enclosure);
        
        $keys_values = array('gradeLevel', 'name', 'email', 'numStudents');
        //$keys_values = explode(',',$this->fields[0]);
        $first_line = explode(',',$this->fields[0]);
        
        // Take out enclosing quotes
        foreach($first_line as &$field){
            if($field[0] == "'" || $field[0] == '"'){
                $field = substr($field, 1);
            }

            
            if($field[strlen($field) -1] == "'" || $field[strlen($field) -1] == '"'){
                $field = substr($field, 0, -1);
            }
        }

        $content    =   array();
        $keys   =   $this->escape_string($keys_values);

        $i = ($keys_values == $first_line)? 1: 0;
        while( ($row = fgetcsv($file, $this->max_row_size, $this->separator, $this->enclosure)) != false ){            
            if( $row != null ) { // skip empty lines
                $values =   explode(',',$row[0]);
                if(count($keys) == count($values)){
                    $arr    =   array();
                    $new_values =   array();
                    $new_values =   $this->escape_string($values);
                    for($j=0;$j<count($keys);$j++){
                        if($keys[$j] != ""){
                            $arr[$keys[$j]] =   $new_values[$j];
                        }
                    }

                    $content[$i]=   $arr;
                    $i++;
                }
            }
        }
        fclose($file);
        return $content;
    }

    function escape_string($data){
        $result =   array();
        foreach($data as $row){
            $result[]   =   str_replace('"', '',$row);
        }
        return $result;
    }   
}
