var url="http://localhost/blog";

function sendmessage()
{
	var deyer=$("#contact").serialize();
	$.ajax({
            type:"POST",
            url:url+"/inc/sendmessage.php",
            data:deyer,
            success:function (result){
            	if($.trim(result)=="null")
            	{
            		swal("Xəta","Formu tam doldurun","error");
            	}
            	else if($.trim(result)=="format")
            	{
            		swal("Xəta","Email formatını doğru yazın","error");
            	}
            	else if($.trim(result)=="err")
            	{
            		swal("Xəta","Sistem xətası baş verdi","error");
            	}
            	else if($.trim(result)=="success")
            	{
            		swal("Göndərildi","Mesajınız alındı.Ən qısa zamanda mesajınız cavablandırılacaq","success");
            		$("input[name=fullname]").val('');
            		$("input[name=email]").val('');
            		$("input[name=subject]").val('');
            		$("textarea[name=message]").val('');
            	}
            }
      });
}


function site_comment()
{
   var deyer=$('#commentform').serialize();
   $.ajax({
       type:"POST",
       url:url+"/inc/comment.php",
       data:deyer,
       success:function (result){

            if($.trim(result)=="null")
            {
                  swal("Xəta","Formu tam doldurun","error");
            }
            else if($.trim(result)=="format")
            {
                  swal("Xəta","Email formatını doğru yazın","error");
            }
            else if($.trim(result)=="err")
            {
                  swal("Xəta","Sistem xətası baş verdi","error");
            }
            else if($.trim(result)=="success")
            {
            swal("Göndərildi",
              "Rəyiniz göndərildi.Administrator tərəfindən təsdiqləndikdən sonra paylaşılacaqdır","success");
                  $("input[name=com_name]").val('');
                  $("input[name=com_email]").val('');
                  $("input[name=com_website]").val('');
                  $("textarea[name=com_content]").val('');
            }
      }
});
}


function sub()
{
   var deyer=$('#subscribersform').serialize();
   $.ajax({
       type:"POST",
       url:url+"/inc/sub.php",
       data:deyer,
       success:function (result){

            if($.trim(result)=="null")
            {
                  swal("Xəta","Formu tam doldurun","error");
            }
            else if($.trim(result)=="format")
            {
                  swal("Xəta","Email formatını doğru yazın","error");
            }
            else if($.trim(result)=="err")
            {
                  swal("Xəta","Sistem xətası baş verdi","error");
            }
            else if($.trim(result)=="success")
            {
            swal("Abone oldunuz",
              "Abone olduğunuz üçün təşəkkürlər","success");
                  $("input[name=sub_mail]").val('');
            }
            else if($.trim(result)=="yes")
            {
                  swal("Xəta","Abone olmusunuz","error");
                  $("input[name=sub_mail]").val('');
            }
      }
});
}