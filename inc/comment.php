<?php 
include("../connect/function.php");

if($_POST)
{
	$com_name   = post('com_name');
	$com_email  = post('com_email');
	$com_website= post('com_website');
	$com_content= post('com_content');
	$text_id    = post('text_id');

	if(!$com_name || !$com_email || !$com_content)
	{
		echo "null";
	}
	else
	{
		if(!filter_var($com_email, FILTER_VALIDATE_EMAIL))
		{
			echo "format";
		}
		else
		{
            $insert=$db->prepare("INSERT INTO comments SET 
        			             com_text_id=:com_text_id,com_name=:com_name,com_email=:com_email,com_content=:com_content,com_website=:com_website,com_ip=:com_ip");
                $insert->execute([
                    ':com_text_id'=>$text_id,
                    ':com_name'=>$com_name,
                    ':com_email'=>$com_email,
                    ':com_content'=>$com_content,
                    ':com_website'=>$com_website,
                    ':com_ip'=>IP()
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