<?php

require_once 'dbcon.php';

function post($parametr, $condition = false){
    if( $condition == false ){
        $result = strip_tags(trim($_POST[$parametr]));
    }elseif( $condition == true ){
        $result = strip_tags(trim(addslashes($_POST[$parametr])));
    }
    return $result;
}

function get($parametr, $condition = false){
    if( $condition == false ){
        $result = strip_tags(trim($_GET[$parametr]));
    }elseif( $condition == true ){
        $result = strip_tags(trim(addslashes($_GET[$parametr])));
    }
    return $result;
}

function IP(){

    if(getenv("HTTP_CLIENT_IP")){
        $ip = getenv("HTTP_CLIENT_IP");
    }elseif(getenv("HTTP_X_FORWARDED_FOR")){
        $ip = getenv("HTTP_X_FORWARDED_FOR");
        if (strstr($ip, ',')) {
            $tmp = explode (',', $ip);
            $ip = trim($tmp[0]);
        }
    }else{
        $ip = getenv("REMOTE_ADDR");
    }
    return $ip;
}

function pagination($s, $ptotal, $url){
    global $administrator;

    $forlimit = 3;
    if($ptotal < 2){
        null;
    }else{

        if($s > 4){
            $prev  = $s - 1;
            echo '<li class="page-item"><a class="page-link" href="'.$administrator.'/'.$url.'1" ><i class="fa fa-angle-left"></i></a></li>';
            echo '<li class="page-item"><a class="page-link" href="'.$administrator.'/'.$url.($s-1).'" ><</a></li>';
        }

        for($i = $s - $forlimit; $i < $s + $forlimit + 1; $i++){
            if($i > 0 && $i <= $ptotal){
                if($i == $s){
                    echo '<li class="page-item active"><a class="page-link"  href="#">'.$i.'</a></li>';
                }else{
                    echo '<li class="page-item"><a class="page-link" href="'.$administrator.'/'.$url.$i.'" >'.$i.'</a></li>';
                }
            }
        }

        if($s <= $ptotal - 4){
            $next  = $s + 1;
            echo '<li class="page-item"><a class="page-link" href="'.$administrator.'/'.$url.$next.'" > <i class="fa fa-angle-right"></i></a></li>';
            echo '<li class="page-item"><a class="page-link" href="'.$administrator.'/'.$url.$ptotal.'" >»</a></li>';
        }
    }

}


function chef_link($str){
    $preg = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#', '.');
    $match = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp', '');
    $perma = strtolower(str_replace($preg, $match, $str));
    $perma = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $perma);
    $perma = trim(preg_replace('/\s+/', ' ', $perma));
    $perma = str_replace(' ', '-', $perma);
    return $perma;
}





function num($table, $col = false, $val = false ,$iz = '='){
    global $db;
    $sql = "SELECT * FROM $table";
    
    if($col || $val){
        
        $sql .= " WHERE $col $iz :$col";
        $query = $db->prepare($sql);
        $query->execute([":$col" => $val]);
        return $query->rowCount();
        
    }else{
        
        $query = $db->prepare($sql);
        $query->execute();
        return $query->rowCount();
    }
    
}


function loc(){
    $loc = 'http';
    if (array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $loc .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $loc .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $loc .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $loc;
}

?>