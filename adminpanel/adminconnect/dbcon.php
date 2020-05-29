<?php 
     @session_start();
     @ob_start();
     @date_default_timezone_set('Asia/Baku');
     
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

     if(@$_SESSION['session']==sha1(md5(@$_SESSION['id'].IP())))
     {
        $admin=$db->prepare("SELECT * FROM admin WHERE id=:id");
        $admin->execute([":id"=>@$_SESSION['id']]);
        if($admin->rowCount())
        {
           $row=$admin->fetch(PDO::FETCH_OBJ);
           $admin_id=$row->id;
           $admin_name=$row->admin_name;
           $admin_mail=$row->admin_mail;
           $admin_image=$row->admin_image;
        }
     }

     $settings=$db->prepare("SELECT * FROM settings");
     $settings->execute();
     $a_row=$settings->fetch(PDO::FETCH_OBJ);
     $administrator=$a_row->site_url."/adminpanel";
     
 ?>