<?php 
     ob_start();
     try 
     {
     	$db=new PDO("mysql:host=localhost;port=3308;dbname=blogsite;charset=utf8","root","");
     	$db->query("SET CHARACTER SET UTF8");
     	$db->query("SET NAMES UTF8");
     } 
     catch (Exception $e) 
     {
     	echo $e->getMessage();
     	die();
     }


     //settings table connection
     $settings=$db->prepare("SELECT * FROM settings");
     $settings->execute();
     $a_row=$settings->fetch(PDO::FETCH_OBJ);
     $site=$a_row->site_url;
     $site_title=$a_row->site_title;
     $logo = $a_row->site_logo;
     $site_keyword=$a_row->site_keyword;
     $site_desc=$a_row->site_desc;

     if($a_row->site_status!=1)
     {
          header("location:mode.php");
     }
 ?>