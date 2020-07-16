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

function convertDate($date)
{
    return date('Y-m-d', strtotime($date));
}

function reverseDate($date)
{
    return date('d-m-Y', strtotime($date));
}

function statusDT($flag_id, $flag)
{
    if($flag_id){
        if($flag->level == '1'){
            return '<label class="badge badge-warning"><i class="fas fa-check-circle"></i> '. $flag->description .'</label>';
        }elseif($flag->level < '50'){ //APPROVE
            return '<label class="badge badge-success"><i class="fas fa-check-circle"></i> '. $flag->description .'</label>';
        }elseif($flag->level >= '50'){ //REJECT
            return '<label class="badge badge-danger"><i class="fas fa-times-circle"></i> '. $flag->description .'</label>';
        }
    }else{
        return '<label class="badge badge-primary"><i class="fas fa-save"></i> Save As Draft</label>';
    }
}

function statusView($flag_id, $flag){

    if($flag_id){
        if($flag->level == '1'){
            return '<span class="badge  badge-pill badge-warning" style="font-size: 14px"><i class="fas fa-check-circle"></i> ' . $flag->description .'</span>';
        }elseif($flag->level < '50'){ //APPROVE
            return '<span class="badge  badge-pill badge-success" style="font-size: 14px"><i class="fas fa-check-circle"></i> '. $flag->description .'</span>';
        }elseif($flag->level >= '50'){ //REJECT
            return '<span class="badge  badge-pill badge-danger" style="font-size: 14px"><i class="fas fa-times-circle"></i> '. $flag->description .'</span>';
        }
    }else{
        return '<span class="badge  badge-pill badge-primary" style="font-size: 14px"><i class="fas fa-save"></i> Save As Draft</span>';
    }

}

function konversi($x){

    $x = abs($x);
    $angka = array ("","satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";

    if($x < 12){
     $temp = " ".$angka[$x];
    }else if($x<20){
     $temp = konversi($x - 10)." belas";
    }else if ($x<100){
     $temp = konversi($x/10)." puluh". konversi($x%10);
    }else if($x<200){
     $temp = " seratus".konversi($x-100);
    }else if($x<1000){
     $temp = konversi($x/100)." ratus".konversi($x%100);
    }else if($x<2000){
     $temp = " seribu".konversi($x-1000);
    }else if($x<1000000){
     $temp = konversi($x/1000)." ribu".konversi($x%1000);
    }else if($x<1000000000){
     $temp = konversi($x/1000000)." juta".konversi($x%1000000);
    }else if($x<1000000000000){
     $temp = konversi($x/1000000000)." milyar".konversi($x%1000000000);
    }

    return $temp;
}

function tkoma($x){
    $str = stristr($x,".");
    $ex = explode('.',$x);

    if(($ex[1]/10) >= 1){
     $a = abs($ex[1]);
    }
    $string = array("nol", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan",   "sembilan","sepuluh", "sebelas");
    $temp = "";

    $a2 = $ex[1]/10;
    $pjg = strlen($str);
    $i =1;


    if($a>=1 && $a< 12){
     $temp .= " ".$string[$a];
    }else if($a>12 && $a < 20){
     $temp .= konversi($a - 10)." belas";
    }else if ($a>20 && $a<100){
     $temp .= konversi($a / 10)." puluh". konversi($a % 10);
    }else{
     if($a2<1){

      while ($i<$pjg){
       $char = substr($str,$i,1);
       $i++;
       $temp .= " ".$string[$char];
      }
     }
    }
    return $temp;
}

function terbilang($x){
    if($x<0){
     $hasil = "minus ".trim(konversi($x));
    }else{
     $poin = trim(tkoma($x));
     $hasil = trim(konversi($x));
    }

  if($poin){
     $hasil = $hasil." koma ".$poin;
    }else{
     $hasil = $hasil;
    }
    return $hasil;
}
