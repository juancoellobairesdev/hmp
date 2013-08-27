<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Misc_helper{
    static function pagination($page, $model){
        $ci = &get_instance();
        $count = $ci->$model->count();
        $pages = ((int) ($count/PAGE_SIZE_DEFAULT)) + 1;

        $page = ($page < 1)? 1: $page;
        $page = ($page > $pages)? $pages: $page;

        $pagination = new stdClass();
        $pagination->first = 1;
        $pagination->prev = ($page > 1)? $page -1: $pagination->first;
        $pagination->current = $page;
        $pagination->next = ($page < $pages)? $page +1: $pages;
        $pagination->last = $pages;

        return $pagination;
    }
    
    /**
    * PBKDF2 key derivation function as defined by RSA's PKCS #5: https://www.ietf.org/rfc/rfc2898.txt
    * $algorithm - The hash algorithm to use. Recommended: SHA256
    * $password - The password.
    * $salt - A salt that is unique to the password.
    * $count - Iteration count. Higher is better, but slower. Recommended: At least 1024.
    * $key_length - The length of the derived key in bytes.
    * $raw_output - If true, the key is returned in raw binary format. Hex encoded otherwise.
    * Returns: A $key_length-byte key derived from the password and salt.
    *
    * Test vectors can be found here: https://www.ietf.org/rfc/rfc6070.txt
    *
    * This implementation of PBKDF2 was originally created by defuse.ca
    * With improvements by variations-of-shadow.com
    */
    static function pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output = FALSE){
        $result = FALSE;
        $algorithm = strtolower($algorithm);
        
        if(in_array($algorithm, hash_algos(), TRUE)){
            if($count > 0 && $key_length > 0){
                $hash_length = strlen(hash($algorithm, "", TRUE));
                $block_count = ceil($key_length / $hash_length);
            
                $output = "";
                for($i = 1; $i <= $block_count; $i++) {
                    // $i encoded as 4 bytes, big endian.
                    $last = $salt . pack("N", $i);
                    // first iteration
                    $last = $xorsum = hash_hmac($algorithm, $last, $password, TRUE);
                    // perform the other $count - 1 iterations
                    for ($j = 1; $j < $count; $j++){
                        $xorsum ^= ($last = hash_hmac($algorithm, $last, $password, TRUE));
                    }
                    $output .= $xorsum;
                }
            
                if($raw_output){
                    $result = substr($output, 0, $key_length); 
                }
                else{
                    $result = bin2hex(substr($output, 0, $key_length));
                }
            }
        }
        
        return $result;
    }

    static function encrypt_password($raw, $salt){
        return self::pbkdf2('sha512', $raw, $salt, '1024', '64');;
    }

    static function random_password(){
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for($i = 0; $i < 8; $i++){
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }

        return implode($pass); //turn the array into a string
    }

    static function time_to_db($str){
        try{
            $date = new dateTime($str);

            return $date->format('H:i');
        }
        catch(exception $e){
            return FALSE;
        }
    }

    static function time_to_user($str){
        try{
            $date = new dateTime($str);

            return $date->format('g:i A');
        }
        catch(exception $e){
            return FALSE;
        }
    }

    static function is_valid_email($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    static function date_to_db($str = FALSE){
        try{
            $date = new dateTime($str);

            return $date->format('Y-m-d');
        }
        catch(exception $e){
            return FALSE;
        }
    }

    static function str_month($int){
        return date("F", mktime(0, 0, 0, ($int + 1)));
    }

    static function str_months(){
        for($i = 0; $i<12;$i++){
            $months[$i] = date("F", mktime(0, 0, 0, ($i + 1)));
        }
        
        return $months;
    }
}