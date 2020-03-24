<?php

function welcome_word() {
        
    $return = '';
    /* This sets the $time variable to the current hour in the 24 hour clock format */
    $time = date("H");
    /* If the time is less than 1200 hours, show good morning */
    if ($time < "12") {
        $return =  "Selamat pagi";
    } else
    /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
    if ($time >= "12" && $time < "15") {
        $return =  "Selamat siang";
    } else
    /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
    if ($time >= "15" && $time < "19") {
        $return = "Selamat sore";
    } else
    /* Finally, show good night if the time is greater than or equal to 1900 hours */
    if ($time >= "19") {
        $return =  "Selamat malam";
    }

    return ($return);
}

function set_active($uri, $output = 'selected')
{
    if( is_array($uri) ) {
        foreach ($uri as $u) {
            if (Route::is($u)) {
            return $output;
            }
        }
    } else {
        if (Route::is($uri)){
            return $output;
        }
    }
}

function tree_active($uri, $output = 'active')
{
    if( is_array($uri) ) {
        foreach ($uri as $u) {
            if (Route::is($u)) {
            return $output;
            }
        }
    } else {
        if (Route::is($uri)){
            return $output;
        }
    }
}

function isValid($cek)
{
    $isValid = '';
    if($cek){
        $isValid = ' is-invalid';
    }
    return $isValid;
}

function convertNumber($number){
    return str_replace(",","",$number);
}