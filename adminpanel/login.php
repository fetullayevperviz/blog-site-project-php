<?php 

include("adminconnect/function.php"); 
if(@$_SESSION['session']==sha1(md5(@$admin_id.IP())))
{
   header('Location:'.$administrator);
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Admin Panel</title>
</head>
<body>
  <section class="material-half-bg">
    <div class="cover"></div>
  </section>
  <section class="login-content">
    <div class="logo">
      <h1>Admin Panel</h1>
    </div>

    <?php 
    if($_POST)
    {
      $admin_mail=post('admin_mail');
      $admin_pass=post('admin_pass');
      $password=sha1(md5($admin_pass));

      if(!$admin_mail || !$admin_pass)
      {
        echo '<div class="alert alert-danger">Boş xana buraxmayın</div>';
      }
      else
      {
        if(!filter_var($admin_mail,FILTER_VALIDATE_EMAIL))
        {
          echo '<div class="alert alert-danger">Email formatını doğru yazın</div>';
        }
        else
        {
         $login=$db->prepare("SELECT * FROM admin WHERE admin_mail=:admin_mail AND admin_pass=:admin_pass LIMIT :lim");
         $login->bindValue(":admin_mail",$admin_mail,PDO::PARAM_STR);
         $login->bindValue(":admin_pass",$password,PDO::PARAM_STR);
         $login->bindValue(":lim",(int) 1,PDO::PARAM_INT);
         $login->execute();
         if($login->rowCount())
         {
           $row=$login->fetch(PDO::FETCH_OBJ);
           $last_login=$db->prepare("UPDATE admin SET last_ip=:last_ip,last_date=:last_date WHERE id=:id");
           $last_login->execute([':last_ip'=>IP(),':last_date'=>date('Y-m-d H:i:s'),':id'=>$row->id]);


           $admin_id=$row->id.IP();
           $kripto=sha1(md5($admin_id));
           $_SESSION['session'] =$kripto;
           $_SESSION['id']=$row->id;
           echo '<div class="alert alert-success">Giriş tamamlandı.Gözləyin</div>';
           header("refresh:2;url=index.php");
         }
         else
         {
           echo '<div class="alert alert-danger">Girilən email və şifrəyə uyğun istifadəçi tapılmadı</div>';
         }
       }
     }
   }
   ?>

   <div class="login-box">
    <form class="login-form" action="" method="POST">
      <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Admin Panel Giriş Səhifəsi</h3>
      <div class="form-group">
        <label class="control-label">E-mail</label>
        <input class="form-control" name="admin_mail" type="text" placeholder="E-mail" autofocus>
      </div>
      <div class="form-group">
        <label class="control-label">Şifrə</label>
        <input class="form-control" name="admin_pass" type="password" placeholder="Şifrə">
      </div>

      <div class="form-group btn-container">
        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Giriş</button>
      </div>
    </form>

  </div>
</section>

</body>
</html>