<?php 
     include("../connect/function.php");

     if($_POST)
     {
     	$sub_mail=post('sub_mail');
     	if(!$sub_mail)
     	{
     		echo "null";
     	}
     	else
     	{
           if(!filter_var($sub_mail,FILTER_VALIDATE_EMAIL))
           {
           	  echo "format";
           }
           else
           {
           	   $varmi=$db->prepare("SELECT sub_mail FROM sub WHERE sub_mail=:sub_mail");
           	   $varmi->execute([':sub_mail'=>$sub_mail]);
           	   if($varmi->rowCount())
           	   {
           	   	  echo "yes";
           	   }
           	   else
           	   {
           	   $insert=$db->prepare("INSERT INTO sub SET 
        			             sub_mail=:sub_mail,sub_ip=:sub_ip");
                $insert->execute([
                    ':sub_mail'=>$sub_mail,
                    ':sub_ip'=>IP()
                ]);
           	   	 if($insert)
           	   	 {
           	   	 	echo "success";
           	   	 }
           	   	 else
           	   	 {
           	   	 	echo "err";
           	   	 }
           	   }
           }
     	}
     }
 ?>