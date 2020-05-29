<?php 
     include("../connect/function.php");

     if($_POST)
     {
     	$fullname=post('fullname');
        $email=post('email');
        $subject=post('subject');
        $message=post('message');

        if(!$fullname || !$email || !$subject || !$message)
        {
        	echo "null";
        }
        else
        {
        	if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        	{
        		echo "format";
        	}
        	else
        	{
        		$insert=$db->prepare("INSERT INTO messages SET 
        			             name=:name,subject=:subject,email=:email,message=:message,ip=:ip");
                $insert->execute([
                    ':name'=>$fullname,
                    ':subject'=>$subject,
                    ':email'=>$email,
                    ':message'=>$message,
                    ':ip'=>IP()
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
  
 ?>