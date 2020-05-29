<?php 
define('security', true);
require_once 'inc/header.php'; ?>
<?php require_once 'inc/sidebar.php'; ?>
<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Əməliyyatlar</h1>
      <p>Əməliyyatlar Listi</p>
  </div>
  <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Əməliyyatlar</li>
      <li class="breadcrumb-item active"><a href="#">Əməliyyatlar Listi</a></li>
  </ul>
</div>
<div class="row">
    <div class="clearfix"></div>
    <div class="col-md-12">
      <div class="tile">
         <h3 class="tile-title">Əməliyyatlar</h3>
         <?php 

         if(@$_SESSION['session']==sha1(md5(@$admin_id.IP())))
         {
           $operation=@get('operation');
           if(!$operation)
           {
             header("Location:".$administrator);
         }
         switch ($operation) {

            ##ADMIN PROFILE OPERATION START

            case 'subject_update':
            $id=get('text_id');
            if(!$id)
            {
                header("Location:".$administrator."/subjects.php");
            }
            $subject=$db->prepare("SELECT * FROM articles WHERE text_id=:text_id");
            $subject->execute([":text_id"=>$id]);
            if($subject->rowCount())
            {
                $subject_row=$subject->fetch(PDO::FETCH_OBJ);

                if(isset($_POST['updatetext']))
                {


                    if($_FILES['text_image']['tmp_name']=="")
                    {
                        $text_title    = post('text_title');
                        $chef_title    = chef_link($text_title);
                        $category      = post('category');
                        $text_content  = post('text_content');
                        $text_tags     = post('text_tags');
                        $text_status   = post('text_status');

                        if(!$text_title || !$category || !$text_content || !$text_tags || !$text_status)
                        {
                            echo '<div class="alert alert-danger">Boş xana buraxmayın</div>';
                        }
                        $chef=explode(',', $text_tags);
                        $arr=array();
                        foreach ($chef as $par) 
                        {
                            $arr[]=chef_link($par);
                        }
                        $val=implode(',', $arr); 

                        $updatetext=$db->prepare("UPDATE articles SET text_title=:text_title,text_chef=:text_chef,text_cat_id=:text_cat_id,text_content=:text_content,text_tags=:text_tags,text_chef_tag=:text_chef_tag,text_status=:text_status WHERE text_id=:text_id");
                        $updatetext->execute([":text_title"=>$text_title,":text_chef"=>$chef_title,":text_cat_id"=>$category,"text_content"=>$text_content,":text_tags"=>$text_tags,":text_chef_tag"=>$val,":text_status"=>$text_status,":text_id"=>$id]);

                        if($updatetext->rowCount())
                        {
                            echo '<div class="alert alert-success">Mövzu yeniləndi</div>';
                            header('Refresh:2;url='.$_SERVER['HTTP_REFERER']);
                        }
                        else
                        {
                            echo '<div class="alert alert-danger">Xəta baş verdi</div>';
                        }

                    }
                    else
                    {
                        $text_image=$_FILES['text_image']['name'];
                        $text_image_tmp=$_FILES['text_image']['tmp_name'];
                        move_uploaded_file($text_image_tmp, "../images/$text_image");
                        $text_title    = post('text_title');
                        $chef_title    = chef_link($text_title);
                        $category      = post('category');
                        $text_content  = post('text_content');
                        $text_tags     = post('text_tags');
                        $text_status   = post('text_status');

                        if(!$text_title || !$category || !$text_content || !$text_tags || !$text_status)
                        {
                            echo '<div class="alert alert-danger">Boş xana buraxmayın</div>';
                        }
                        $chef=explode(',', $text_tags);
                        $arr=array();
                        foreach ($chef as $par) 
                        {
                            $arr[]=chef_link($par);
                        }
                        $val=implode(',', $arr); 

                        $updatetext=$db->prepare("UPDATE articles SET text_title=:text_title,text_chef=:text_chef,text_image=:text_image,text_cat_id=:text_cat_id,text_content=:text_content,text_tags=:text_tags,text_chef_tag=:text_chef_tag,text_status=:text_status WHERE text_id=:text_id");
                        $updatetext->execute([":text_title"=>$text_title,":text_chef"=>$chef_title,":text_image"=>$text_image,":text_cat_id"=>$category,"text_content"=>$text_content,":text_tags"=>$text_tags,":text_chef_tag"=>$val,":text_status"=>$text_status,":text_id"=>$id]);

                        if($updatetext->rowCount())
                        {
                            echo '<div class="alert alert-success">Mövzu yeniləndi</div>';
                            header('Refresh:2;url='.$_SERVER['HTTP_REFERER']);
                        }
                        else
                        {
                            echo '<div class="alert alert-danger">Xəta baş verdi</div>';
                        }


                    }



                }

                ?>

                <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                    <div class="tile-body">
                        <div class="form-group row">
                          <label class="control-label col-md-3">Yazı başlığı</label>
                          <div class="col-md-8">
                            <input name="text_title" value="<?php echo $subject_row->text_title;?>" class="form-control" type="text" placeholder="Yazı başlığı">
                        </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-md-3">Yazı kateqoriyası</label>
                      <div class="col-md-8">
                        <select name="category" class="form-control">
                            <?php 
                            $categories=$db->prepare("SELECT * FROM categories");
                            $categories->execute();
                            if($categories->rowCount())
                            {
                                foreach ($categories as $row) 
                                {
                                    echo '<option value="'.$row['id'].'"';
                                    echo $subject_row->text_cat_id==$row['id'] ? 'selected' : null;
                                    echo '>'.$row['cat_name'].'</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Yazı şəkili</label>
                  <div class="col-md-8">
                    <img src="<?php echo $a_row->site_url;?>/images/<?php echo $subject_row->text_image;?>" style="width:100px; height:100px; object-fit: contain;">
                    <input name="text_image" class="form-control" type="file">
                </div>
            </div>
            <div class="form-group row">
              <label class="control-label col-md-3">Yazı mətni</label>
              <div class="col-md-8">
                <textarea name="text_content" class="ckeditor">
                    <?php echo $subject_row->text_content;?>
                </textarea>
            </div>
        </div>
        <div class="form-group row">
          <label class="control-label col-md-3">Yazı etiketləri</label>
          <div class="col-md-8">
            <input name="text_tags" value="<?php echo $subject_row->text_tags;?>" class="form-control" type="text" placeholder="Yazı etiketləri, vergül qoyaraq yazın">
        </div>
    </div>
    <div class="form-group row">
        <label class="control-label col-md-3">Mətnin statusu</label>
        <div class="col-md-8">
            <select name="text_status" class="form-control">
                <option value="1" <?php echo $subject_row->text_status==1 ? 'selected' : null ;?>>Aktiv</option>
                <option value="2" <?php echo $subject_row->text_status==2 ? 'selected' : null ;?>>Passiv</option>
            </select>
        </div>
    </div>

</div>
<div class="tile-footer">
  <div class="row">
    <div class="col-md-8 col-md-offset-3">
        <button name="updatetext" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-plus-square"></i>Mətni yenilə</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="<?php echo $administrator;?>subjects.php"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Yazılar listinə qayıt</a>
    </div>
</div>
</div>
</form>

<?php
}
else
{
    header("Location:".$administrator."/subjects.php");
}
break;

case 'logout':
session_destroy();
header("Location:login.php");
break;

case 'profile':
if(isset($_POST['updateadminprofile']))
{
    if($_FILES['admin_image']['tmp_name']=="")
    {
       $admin_name=post('admin_name');
       $admin_mail=post('admin_mail');

    if(!$admin_name || !$admin_mail)
    {
        echo '<div class="alert alert-danger">Boş xana buraxmayın</div>';
    }
    else
    {
        if(!filter_var($admin_mail,FILTER_VALIDATE_EMAIL))
        {
            echo '<div class="alert alert-danger">Email formatını @gamil.com ile birlikde yazın</div>';
        }
        else
        {
            $update_profile=$db->prepare("UPDATE admin SET admin_name=:admin_name,admin_mail=:admin_mail WHERE id=:id");
            $update_profile->execute([":admin_name"=>$admin_name,":admin_mail"=>$admin_mail,":id"=>$admin_id]);
            if($update_profile)
            {
               echo '<div class="alert alert-success">Hesabınız yeniləndi</div>';
               header('Refresh:2;url='.$_SERVER['HTTP_REFERER']);
           }
           else
           {
            echo '<div class="alert alert-danger">Xəta baş verdi</div>';
           
           }
        }

   }

}

                else
                    {
                        $admin_image=$_FILES['admin_image']['name'];
                        $admin_image_tmp=$_FILES['admin_image']['tmp_name'];
                        move_uploaded_file($admin_image_tmp, "images/$admin_image");
                        $admin_name=post('admin_name');
                        $admin_mail=post('admin_mail');

                        if(!$admin_name || !$admin_mail)
                        {
                            echo '<div class="alert alert-danger">Boş xana buraxmayın</div>';
                        }

                        $updateadminprofile=$db->prepare("UPDATE admin SET admin_name=:admin_name,admin_mail=:admin_mail,admin_image=:admin_image WHERE id=:id");
                        $updateadminprofile->execute([":admin_name"=>$admin_name,":admin_mail"=>$admin_mail,":admin_image"=>$admin_image,":id"=>$admin_id]);

                        if($updateadminprofile->rowCount())
                        {
                            echo '<div class="alert alert-success">Hesab yeniləndi</div>';
                            header('Refresh:2;url='.$_SERVER['HTTP_REFERER']);
                        }
                        else
                        {
                            echo '<div class="alert alert-danger">Xəta baş verdi</div>';
                        }


                    }


}
?>
<?php 
     $admin_image=$db->prepare("SELECT * FROM admin");
     $admin_image->execute();
     $admin=$admin_image->fetch(PDO::FETCH_OBJ);
 ?>
<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div class="tile-body">
        <div class="form-group row">
          <label class="control-label col-md-3">Administrator şəkili</label>
          <div class="col-md-8">
            <img src="images/<?php echo $admin->admin_image;?>" style="width: 200px;height: 200px;object-fit: contain;margin-bottom: 20px;">
            <input name="admin_image" class="form-control" type="file">
        </div>
    </div>
        <div class="form-group row">
          <label class="control-label col-md-3">Administrator adı</label>
          <div class="col-md-8">
            <input name="admin_name" value="<?php echo $admin_name;?>" class="form-control" type="text" placeholder="Administrator adını yazın">
        </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-3">Administrator email</label>
      <div class="col-md-8">
        <input name="admin_mail" value="<?php echo $admin_mail;?>" class="form-control" type="email" placeholder="Administrator emailini yazın">
    </div>
</div>
</div>
<div class="tile-footer">
  <div class="row">
    <div class="col-md-8 col-md-offset-3">
        <button name="updateadminprofile" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-plus-square"></i>Profili yenilə</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="<?php echo $administrator;?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Geri qayıt</a>
    </div>
</div>
</div>
</form>
<?php
break;

case 'change_password':
if(isset($_POST['updateadminpassword']))
{
    $pass1=post('pass1');
    $pass2=post('pass2');
    $password=sha1(md5($pass1));

    if(!$pass1 || !$pass2)
    {
        echo '<div class="alert alert-danger">Boş xana buraxmayın</div>';
    }
    else
    {
        if($pass1!==$pass2)
        {
            echo '<div class="alert alert-danger">Şifrələr düzgün yazılmayıb</div>';
        }
        else
        {
            $update_password=$db->prepare("UPDATE admin SET admin_pass=:admin_pass WHERE id=:id");
            $update_password->execute([":admin_pass"=>$password,":id"=>$admin_id]);
            if($update_password)
            {
               echo '<div class="alert alert-success">Şifrəniz yeniləndi</div>';
               header('Refresh:2;url='.$_SERVER['HTTP_REFERER']);
           }
           else
           {
            echo '<div class="alert alert-danger">Xəta baş verdi</div>';
        }
    }
}
}
?>
<form class="form-horizontal" action="" method="POST">
    <div class="tile-body">
        <div class="form-group row">
          <label class="control-label col-md-3">Yeni şifrə</label>
          <div class="col-md-8">
            <input name="pass1" class="form-control" type="password" placeholder="Yeni şifrəni yazın">
        </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-3">Yeni şifrə təkrar</label>
      <div class="col-md-8">
        <input name="pass2" class="form-control" type="password" placeholder="Yeni şifrəni təkrar yazın">
    </div>
</div>
</div>
<div class="tile-footer">
  <div class="row">
    <div class="col-md-8 col-md-offset-3">
        <button name="updateadminpassword" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-plus-square"></i>Şifrəni yenilə</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="<?php echo $administrator;?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Geri qayıt</a>
    </div>
</div>
</div>
</form>
<?php
break;



            ##ADMIN PROFILE OPERATION END


             ##DELETE OPERATION START
case 'categories_delete':
$id=get('id');
if(!$id)
{
    header('Location:'.$administrator."/categories.php");
}
$categories_delete=$db->prepare("DELETE FROM categories WHERE id=:id");
$categories_delete->execute([":id"=>$id]);
if($categories_delete)
{
    $text_passive=$db->prepare("UPDATE articles SET text_status=:text_status WHERE text_cat_id=:text_cat_id");
    $text_passive->execute([":text_status"=>2,":text_cat_id"=>$id]);

    echo '<div class="alert alert-success">Kateqoriya silindi və bu kateqoriyaya aid mövzular passiv vəziyyətə gəldi</div>';
    header('Refresh:2;url='.$administrator."/categories.php");
}
else
{
    echo '<div class="alert alert-danger">Xəta baş verdi</div>';
}
break;

case 'message_delete':
$id=get('id');
if(!$id)
{
    header('Location:'.$administrator."/readmessages.php");
}
$message_delete=$db->prepare("DELETE FROM messages WHERE id=:id");
$message_delete->execute([":id"=>$id]);
if($message_delete)
{
    echo '<div class="alert alert-success">Mesaj silindi</div>';
    header('Refresh:2;url='.$_SERVER['HTTP_REFERER']);
}
else
{
    echo '<div class="alert alert-danger">Xəta baş verdi</div>';
}
break;

case 'comment_delete':
$id=get('id');
if(!$id)
{
    header('Location:'.$administrator."/approvalcomments.php");
}
$comment_delete=$db->prepare("DELETE FROM comments WHERE id=:id");
$comment_delete->execute([":id"=>$id]);
if($comment_delete)
{
    echo '<div class="alert alert-success">Rəy silindi</div>';
    header('Refresh:2;url='.$_SERVER['HTTP_REFERER']);
}
else
{
    echo '<div class="alert alert-danger">Xəta baş verdi</div>';
}
break;

case 'social_media_delete':
$id=get('id');
if(!$id)
{
    header('Location:'.$administrator."/social_media.php");
}
$social_media_delete=$db->prepare("DELETE FROM social_media WHERE id=:id");
$social_media_delete->execute([":id"=>$id]);
if($social_media_delete)
{
    echo '<div class="alert alert-success">Sosial şəbəkə hesabı silindi</div>';
    header('Refresh:2;url='.$_SERVER['HTTP_REFERER']);
}
else
{
    echo '<div class="alert alert-danger">Xəta baş verdi</div>';
}
break;

case 'subject_delete':
$id=get('text_id');
if(!$id)
{
    header('Location:'.$administrator."/subjects.php");
}
$text=$db->prepare("SELECT * FROM articles WHERE text_id=:text_id");
$text->execute([':text_id'=>$id]);
if($text->rowCount())
{
    $text_row=$text->fetch(PDO::FETCH_OBJ);
    $subject_delete=$db->prepare("DELETE FROM articles WHERE text_id=:id");
    $subject_delete->execute([":id"=>$id]);
    if($subject_delete)
    {
       $comment_delete=$db->prepare("DELETE FROM comments WHERE com_text_id=:com_text_id");
       $comment_delete->execute([":com_text_id"=>$id]);
       unlink("../images/".$text_row->text_image);

       echo '<div class="alert alert-success">Mövzu silindi</div>';
       header('Refresh:2;url='.$_SERVER['HTTP_REFERER']);
   }
   else
   {
       echo '<div class="alert alert-danger">Xəta baş verdi</div>';
   }
}
break;

case 'subscriber_delete':
$id=get('id');
if(!$id)
{
    header('Location:'.$administrator."/subscribers.php");
}
$subscriber_delete=$db->prepare("DELETE FROM sub WHERE id=:id");
$subscriber_delete->execute([":id"=>$id]);
if($subscriber_delete)
{
    echo '<div class="alert alert-success">Abunə silindi</div>';
    header('Refresh:2;url='.$_SERVER['HTTP_REFERER']);
}
else
{
    echo '<div class="alert alert-danger">Xəta baş verdi</div>';
}
break;
             ##DELETE OPERATION END

             ##INSERT OPERATION START
case 'new_category':
if(isset($_POST['addcategory']))
{
    $cat_name=post('cat_name');
    $cat_chef=chef_link($cat_name);
    $cat_keyword=post('cat_keyword');
    $cat_desc=post('cat_desc');

    if(!$cat_name || !$cat_keyword || !$cat_desc)
    {
        echo '<div class="alert alert-danger">Boş xana buraxmayın</div>';
    }
    else
    {
        $varmi=$db->prepare("SELECT * FROM categories WHERE cat_chef=:cat_chef");
        $varmi->execute([":cat_chef"=>$cat_chef]);
        if($varmi->rowCount())
        {
            echo '<div class="alert alert-danger">Bu kateqoriya mövcuddur</div>';
        }
        else
        {
            $addcategory=$db->prepare("INSERT INTO categories SET cat_name=:cat_name,cat_chef=:cat_chef,cat_keyword=:cat_keyword,cat_desc=:cat_desc");
            $addcategory->execute([":cat_name"=>$cat_name,":cat_chef"=>$cat_chef,":cat_keyword"=>$cat_keyword,":cat_desc"=>$cat_desc]);
            if($addcategory->rowCount())
            {
                echo '<div class="alert alert-success">Kateqoriya əlavə edildi</div>';
                header('Refresh:2;url='.$administrator."/categories.php");
            }
            else
            {
                echo '<div class="alert alert-danger">Xəta baş verdi</div>';
            }
        }
    }
}
?>
<form class="form-horizontal" action="" method="POST">
    <div class="tile-body">
        <div class="form-group row">
          <label class="control-label col-md-3">Kateqoriya adı</label>
          <div class="col-md-8">
            <input name="cat_name" class="form-control" type="text" placeholder="Kateqoriya adını yazın">
        </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-3">Kateqoriya açar sözlər</label>
      <div class="col-md-8">
        <input name="cat_keyword" class="form-control" type="text" placeholder="Kateqoriya açar sözləri yazın">
    </div>
</div>
<div class="form-group row">
  <label class="control-label col-md-3">Kateqoriya açığlaması</label>
  <div class="col-md-8">
    <input name="cat_desc" class="form-control" type="text" placeholder="Kateqoriya açığlamasını yazın">
</div>
</div>
</div>
<div class="tile-footer">
  <div class="row">
    <div class="col-md-8 col-md-offset-3">
        <button name="addcategory" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-plus-square"></i>Kateqoriya əlavə et</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="<?php echo $administrator;?>/categories.php"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Kateqoriya listinə qayıt</a>
    </div>
</div>
</div>
</form>
<?php
break;

case 'new_social_media':
if(isset($_POST['addsocialmedia']))
{
    $icon=post('icon');
    $link=post('link');

    if(!$icon || !$link)
    {
        echo '<div class="alert alert-danger">Boş xana buraxmayın</div>';
    }
    else
    {
        $addsocialmedia=$db->prepare("INSERT INTO social_media SET icon=:icon,link=:link");
        $addsocialmedia->execute([":icon"=>$icon,":link"=>$link]);
        if($addsocialmedia->rowCount())
        {
            echo '<div class="alert alert-success">Sosial şəbəkə hesabı əlavə edildi</div>';
            header('Refresh:2;url='.$administrator."/social_media.php");
        }
        else
        {
            echo '<div class="alert alert-danger">Xəta baş verdi</div>';
        }

    }
}
?>
<form class="form-horizontal" action="" method="POST">
    <div class="tile-body">
        <div class="form-group row">
          <label class="control-label col-md-3">Sosial şəbəkə ikonu</label>
          <div class="col-md-8">
            <input name="icon" class="form-control" type="text" placeholder="Sosial şəbəkə ikonu">
        </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-3">Sosial şəbəkə linki</label>
      <div class="col-md-8">
        <input name="link" class="form-control" type="text" placeholder="Sosial şəbəkə linki">
    </div>
</div>
</div>
<div class="tile-footer">
  <div class="row">
    <div class="col-md-8 col-md-offset-3">
        <button name="addsocialmedia" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-plus-square"></i>Sosial şəbəkə hesabı əlavə et</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="<?php echo $administrator;?>/social_media.php"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Sosial şəbəkə listinə qayıt</a>
    </div>
</div>
</div>
</form>
<?php
break;


case 'new_text':
if(isset($_POST['addtext']))
{

    $text_title=post('text_title');
    $chef_title=chef_link($text_title);
    $category=post('category');
    $text_content=post('text_content');
    $text_tags=post('text_tags');

    $text_image=$_FILES['text_image']['name'];
    $text_image_tmp=$_FILES['text_image']['tmp_name'];
    move_uploaded_file($text_image_tmp, "../images/$text_image");

    if(!$text_title || !$category || !$text_content || !$text_tags || !$text_image)
    {
        echo '<div class="alert alert-danger">Boş xana buraxmayın</div>';
    }
    else
    {

        $chef=explode(',', $text_tags);
        $arr=array();
        foreach ($chef as $par) 
        {
            $arr[]=chef_link($par);
        }
        $val=implode(',', $arr);

        $addtext=$db->prepare("INSERT INTO articles SET text_title=:text_title,text_chef=:text_chef,text_cat_id=:text_cat_id,text_image=:text_image,text_content=:text_content,text_tags=:text_tags,text_chef_tag=:text_chef_tag");
        $addtext->execute([":text_title"=>$text_title,":text_chef"=>$chef_title,":text_cat_id"=>$category,":text_image"=>$text_image,"text_content"=>$text_content,":text_tags"=>$text_tags,":text_chef_tag"=>$val]);

        if($addtext->rowCount())
        {
            echo '<div class="alert alert-success">Mövzu əlavə edildi</div>';
            header('Refresh:2;url='.$administrator."/subjects.php");
        }
        else
        {
            echo '<div class="alert alert-danger">Xəta baş verdi</div>';
        }

    }

}

?>
<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div class="tile-body">
        <div class="form-group row">
          <label class="control-label col-md-3">Yazı başlığı</label>
          <div class="col-md-8">
            <input name="text_title" class="form-control" type="text" placeholder="Yazı başlığı">
        </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-3">Yazı kateqoriyası</label>
      <div class="col-md-8">
        <select name="category" class="form-control">
            <?php 
            $categories=$db->prepare("SELECT * FROM categories");
            $categories->execute();
            if($categories->rowCount())
            {
                foreach ($categories as $row) 
                {
                    echo '<option value="'.$row['id'].'">'.$row['cat_name'].'</option>';
                }
            }
            ?>
        </select>
    </div>
</div>
<div class="form-group row">
  <label class="control-label col-md-3">Yazı şəkili</label>
  <div class="col-md-8">
    <input name="text_image" class="form-control" type="file">
</div>
</div>
<div class="form-group row">
  <label class="control-label col-md-3">Yazı mətni</label>
  <div class="col-md-8">
    <textarea name="text_content" class="ckeditor"></textarea>
</div>
</div>
<div class="form-group row">
  <label class="control-label col-md-3">Yazı etiketləri</label>
  <div class="col-md-8">
    <input name="text_tags" class="form-control" type="text" placeholder="Yazı etiketləri, vergül qoyaraq yazın">
</div>
</div>

</div>
<div class="tile-footer">
  <div class="row">
    <div class="col-md-8 col-md-offset-3">
        <button name="addtext" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-plus-square"></i>Yeni yazı əlavə et</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="<?php echo $administrator;?>/subjects.php"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Yazılar listinə qayıt</a>
    </div>
</div>
</div>
</form>
<?php
break;

             ##INSERT OPERATION END 

             ## UPDATE AND READ OPERATION START

case 'categories_update':
$id=get('id');
if(!$id)
{
 header('Refresh:2;url='.$administrator."/categories.php");
}

$category=$db->prepare("SELECT * FROM categories WHERE id=:id");
$category->execute([":id"=>$id]);
if($category->rowCount())
{
 $row=$category->fetch(PDO::FETCH_OBJ);

 if(isset($_POST['updatecategory']))
 {
    $cat_name=post('cat_name');
    $cat_chef=chef_link($cat_name);
    $cat_keyword=post('cat_keyword');
    $cat_desc=post('cat_desc');

    if(!$cat_name || !$cat_keyword || !$cat_desc)
    {
        echo '<div class="alert alert-danger">Boş xana buraxmayın</div>';
    }
    else
    {
        $varmi=$db->prepare("SELECT * FROM categories WHERE cat_chef=:cat_chef AND id=:id");
        $varmi->execute([":cat_chef"=>$cat_chef,":id"=>$id]);
        if($varmi->rowCount())
        {
            echo '<div class="alert alert-danger">Bu kateqoriya mövcuddur</div>';
        }
        else
        {
            $updatecategory=$db->prepare("UPDATE categories SET cat_name=:cat_name,cat_chef=:cat_chef,cat_keyword=:cat_keyword,cat_desc=:cat_desc WHERE id=:id");
            $updatecategory->execute([":cat_name"=>$cat_name,":cat_chef"=>$cat_chef,":cat_keyword"=>$cat_keyword,":cat_desc"=>$cat_desc,":id"=>$id]);
            if($updatecategory->rowCount())
            {
                echo '<div class="alert alert-success">Kateqoriya yeniləndi</div>';
                header('Refresh:2;url='.$administrator."/categories.php");
            }
            else
            {
                echo '<div class="alert alert-danger">Xəta baş verdi</div>';
            }
        }
    }
}

?>
<form class="form-horizontal" action="" method="POST">
    <div class="tile-body">
        <div class="form-group row">
          <label class="control-label col-md-3">Kateqoriya adı</label>
          <div class="col-md-8">
            <input name="cat_name" value="<?php echo $row->cat_name;?>" class="form-control" type="text" placeholder="Kateqoriya adını yazın">
        </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-3">Kateqoriya açar sözlər</label>
      <div class="col-md-8">
        <input name="cat_keyword" value="<?php echo $row->cat_keyword;?>"  class="form-control" type="text" placeholder="Kateqoriya açar sözləri yazın">
    </div>
</div>
<div class="form-group row">
  <label class="control-label col-md-3">Kateqoriya açığlaması</label>
  <div class="col-md-8">
    <input name="cat_desc" value="<?php echo $row->cat_desc;?>"  class="form-control" type="text" placeholder="Kateqoriya açığlamasını yazın">
</div>
</div>
</div>
<div class="tile-footer">
  <div class="row">
    <div class="col-md-8 col-md-offset-3">
        <button name="updatecategory" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-plus-square"></i>Kateqoriyanı yenilə</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="<?php echo $administrator;?>/categories.php"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Kateqoriya listinə qayıt</a>
    </div>
</div>
</div>
</form> 
<?php
}
else
{
 header('Refresh:2;url='.$administrator."/categories.php");
}
break;


case 'message_read':
$id=get('id');
if(!$id)
{
 header('Refresh:2;url='.$administrator."/pendingmessages.php");
}
$message=$db->prepare("SELECT * FROM messages WHERE id=:id");
$message->execute([":id"=>$id]);
if($message->rowCount())
{
    $row=$message->fetch(PDO::FETCH_OBJ);
    $update=$db->prepare("UPDATE messages SET status=:status WHERE id=:id");
    $update->execute([":status"=>1,":id"=>$id]);

    echo "<b>AD : </b>".$row->name."<br>";
    echo "<b>EMAİL : </b>".$row->email."<br>";
    echo "<b>MÖVZU : </b>".$row->subject."<br>";
    echo "<b>MƏTN : </b>".$row->message."<br>";
    echo "<hr/>";
    echo '<div class="alert alert-info">Bu mesaj <b>'.$row->m_date.'</b> tarixində <b>'.$row->ip.'</b> adresindən göndərilib</div>';
    echo '<a class="btn btn-secondary" href="'.$administrator.'/pendingmessages.php"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Yeni mesajlar listinə qayıt</a>';
}
else
{
    header('Refresh:2;url='.$administrator."/pendingmessages.php");
}
break;

case 'comment_read':
$id=get('id');
if(!$id)
{
 header('Refresh:2;url='.$administrator."/approvalcomments.php");
}
$message=$db->prepare("SELECT * FROM comments INNER JOIN articles ON articles.text_id=comments.com_text_id WHERE id=:id");
$message->execute([":id"=>$id]);
if($message->rowCount())
{
    $row=$message->fetch(PDO::FETCH_OBJ);
    echo "<b>AD : </b>".$row->com_name."<br>";
    echo "<b>HANSI MÖVZUYA YAZILIB : </b><a href='".$a_row->site_url."/textdetails.php?text_chef=".$row->text_chef."&text_id=".$row->text_id."' target='_blank'>".$row->text_title."</a> <br>";
    echo "<b>EMAİL : </b>".$row->com_email."<br>";
    echo "<b>WEB SAYT : </b>".$row->com_website."<br>";
    echo "<b>MƏTN : </b>".$row->com_content."<br>";
    echo "<hr/>";
    echo '<div class="alert alert-info">Bu rəy <b>'.$row->com_date.'</b> tarixində <b>'.$row->com_ip.'</b> adresindən yazılıb</div>';
    if($row->com_status==1)
    {
        ?>
        <a class="btn btn-danger" onclick="return confirm('Təsdiqləyirsiniz ?');" href="<?php echo $administrator."/operation.php?operation=comment_delete&id=".$row->id;?>"><i class="fa fa-eraser"></i>Rəyi sil</a>
        <?php
    }
    else
        {  ?>
            <a class="btn btn-success" onclick="return confirm('Təsdiqləyirsiniz ?');" href="<?php echo $administrator."/operation.php?operation=comment_confirm&id=".$row->id;?>"><i class="fa fa-check"></i>Rəyi təsdiqlə</a>
        <?php }
        echo '<a class="btn btn-secondary" href="'.$administrator.'/approvalcomments.php"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Təsdiq gözləyən rəylər listinə qayıt</a>';
    }
    else
    {
        header('Refresh:2;url='.$administrator."/pendingmessages.php");
    }
    break;

    case 'comment_confirm':
    $id=get('id');
    if(!$id)
    {
     header('Refresh:2;url='.$administrator."/approvalcomments.php");
 }

 $confirm=$db->prepare("UPDATE comments SET com_status=:com_status WHERE id=:id");
 $confirm->execute([":com_status"=>1,":id"=>$id]);
 if($confirm)
 {
    echo '<div class="alert alert-success">Rəy təsdiqləndi</div>';
    header('Refresh:2;url='.$_SERVER['HTTP_REFERER']);
}
else
{
    echo '<div class="alert alert-danger">Xəta baş verdi</div>';
}
break;

case 'social_media_update':
$id=get('id');
if(!$id)
{
 header('Refresh:2;url='.$administrator."/social_media.php");
}

$social_media=$db->prepare("SELECT * FROM social_media WHERE id=:id");
$social_media->execute([":id"=>$id]);
if($social_media->rowCount())
{
 $row=$social_media->fetch(PDO::FETCH_OBJ);
 if(isset($_POST['updatesocialmedia']))
 {
    $icon=post('icon');
    $link=post('link');
    $status=post('status');

    if(!$icon || !$link || !$status)
    {
        echo '<div class="alert alert-danger">Boş xana buraxmayın</div>';
    }
    else
    {
        $updatesocialmedia=$db->prepare("UPDATE social_media SET icon=:icon,link=:link,status=:status WHERE id=:id");
        $updatesocialmedia->execute([":icon"=>$icon,":link"=>$link,":status"=>$status,":id"=>$id]);
        if($updatesocialmedia->rowCount())
        {
            echo '<div class="alert alert-success">Sosial şəbəkə hesabı əlavə yeniləndi</div>';
            header('Refresh:2;url='.$administrator."/social_media.php");
        }
        else
        {
            echo '<div class="alert alert-danger">Xəta baş verdi</div>';
        }

    }
}

?>
<form class="form-horizontal" action="" method="POST">
    <div class="tile-body">
        <div class="form-group row">
          <label class="control-label col-md-3">Sosial şəbəkə ikonu</label>
          <div class="col-md-8">
            <input name="icon" value="<?php echo $row->icon;?>" class="form-control" type="text" placeholder="Sosial şəbəkə ikonu">
        </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-3">Sosial şəbəkə linki</label>
      <div class="col-md-8">
        <input name="link" value="<?php echo $row->link;?>" class="form-control" type="text" placeholder="Sosial şəbəkə linki">
    </div>
</div>
<div class="form-group row">
  <label class="control-label col-md-3">Sosial şəbəkə statusu</label>
  <div class="col-md-8">
    <select name="status" class="form-control">
        <option value="1" <?php echo $row->status==1 ? 'selected' : null ;?>>Aktiv</option>
        <option value="2" <?php echo $row->status==2 ? 'selected' : null ;?>>Passiv</option>
    </select>
</div>
</div>
</div>
<div class="tile-footer">
  <div class="row">
    <div class="col-md-8 col-md-offset-3">
        <button name="updatesocialmedia" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-plus-square"></i>Sosial şəbəkə hesabını yenilə</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="<?php echo $administrator;?>/social_media.php"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Sosial şəbəkə listinə qayıt</a>
    </div>
</div>
</div>
</form>
<?php
}
break;

case 'general':
if(isset($_POST['updategeneralsettings']))
{
   $site_url    = post('site_url');
   $site_title  = post('site_title');
   $site_keyword= post('site_keyword');
   $site_desc   = post('site_desc');
   $site_status = post('site_status');

   if(!$site_url || !$site_title || !$site_keyword || !$site_desc || !$site_status)
   {
       echo '<div class="alert alert-danger">Boş xana buraxmayın</div>';
   }
   else
   {
      $generalupdate=$db->prepare("UPDATE settings SET site_url=:site_url,site_title=:site_title,site_keyword=:site_keyword,site_desc=:site_desc,site_status=:site_status WHERE id=:id");
      $generalupdate->execute([":site_url"=>$site_url,":site_title"=>$site_title,":site_keyword"=>$site_keyword,":site_desc"=>$site_desc,":site_status"=>$site_status,":id"=>1]);
      if($generalupdate)
      {
         echo '<div class="alert alert-success">Ümumi parametrlər yeniləndi</div>';
         header('Refresh:2;url='.$_SERVER['HTTP_REFERER']);
     }
     else
     {
         echo '<div class="alert alert-danger">Xəta baş verdi</div>';
     }
 }
}
?>
<form class="form-horizontal" action="" method="POST">
    <div class="tile-body">
        <div class="form-group row">
          <label class="control-label col-md-3">Site url</label>
          <div class="col-md-8">
            <input name="site_url" value="<?php echo $a_row->site_url;?>" class="form-control" type="text" placeholder="Site url-ni yazın">
        </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-3">Site başlıq</label>
      <div class="col-md-8">
        <input name="site_title" value="<?php echo $a_row->site_title;?>" class="form-control" type="text" placeholder="Site başlığını yazın">
    </div>
</div>
<div class="form-group row">
  <label class="control-label col-md-3">Site açar sözləri</label>
  <div class="col-md-8">
    <input name="site_keyword" value="<?php echo $a_row->site_keyword;?>" class="form-control" type="text" placeholder="Site açar sözlərini yazın">
</div>
</div>
<div class="form-group row">
  <label class="control-label col-md-3">Site açığlaması</label>
  <div class="col-md-8">
    <input name="site_desc" value="<?php echo $a_row->site_desc;?>" class="form-control" type="text" placeholder="Site açığlamasını yazın">
</div>
</div>
<div class="form-group row">
  <label class="control-label col-md-3">Site status</label>
  <div class="col-md-8">
    <select name="site_status" class="form-control">
     <option value="1" <?php echo $a_row->site_status==1 ? 'selected' : null ;?>>Aktiv</option>
     <option value="2" <?php echo $a_row->site_status==2 ? 'selected' : null ;?>>Passiv</option>
 </select>
</div>
</div>  
</div>
<div class="tile-footer">
  <div class="row">
    <div class="col-md-8 col-md-offset-3">
        <button name="updategeneralsettings" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-plus-square"></i>Ümumi parametrləri yenilə</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="<?php echo $administrator;?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Geri qayıt</a>
    </div>
</div>
</div>
</form>   
<?php
break;

case 'contact':
if(isset($_POST['updatecontactsettings']))
{
   $site_mail    = post('site_mail');
   $site_location  = post('site_location');
   $site_location_status= post('site_location_status');


   if(!$site_mail || !$site_location || !$site_location_status)
   {
       echo '<div class="alert alert-danger">Boş xana buraxmayın</div>';
   }
   else
   {
      $contactupdate=$db->prepare("UPDATE settings SET site_mail=:site_mail,site_location=:site_location,site_location_status=:site_location_status WHERE id=:id");
      $contactupdate->execute([":site_mail"=>$site_mail,":site_location"=>$site_location,":site_location_status"=>$site_location_status,":id"=>1]);
      if($contactupdate)
      {
         echo '<div class="alert alert-success">Əlaqə parametrləri yeniləndi</div>';
         header('Refresh:2;url='.$_SERVER['HTTP_REFERER']);
     }
     else
     {
         echo '<div class="alert alert-danger">Xəta baş verdi</div>';
     }
 }
}
?>
<form class="form-horizontal" action="" method="POST">
    <div class="tile-body">
        <div class="form-group row">
          <label class="control-label col-md-3">Site mail</label>
          <div class="col-md-8">
            <input name="site_mail" value="<?php echo $a_row->site_mail;?>" class="form-control" type="text" placeholder="Site emailini yazın">
        </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-3">Site location</label>
      <div class="col-md-8">
        <input name="site_location" value="<?php echo $a_row->site_location;?>" class="form-control" type="text" placeholder="Site location-ni yazın">
    </div>
</div>
<div class="form-group row">
  <label class="control-label col-md-3">Site location status</label>
  <div class="col-md-8">
    <select name="site_location_status" class="form-control">
     <option value="1" <?php echo $a_row->site_location_status==1 ? 'selected' : null ;?>>Aktiv</option>
     <option value="2" <?php echo $a_row->site_location_status==2 ? 'selected' : null ;?>>Passiv</option>
 </select>
</div>
</div>  
</div>
<div class="tile-footer">
  <div class="row">
    <div class="col-md-8 col-md-offset-3">
        <button name="updatecontactsettings" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-plus-square"></i>Əlaqə parametrlərini yenilə</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="<?php echo $administrator;?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Geri qayıt</a>
    </div>
</div>
</div>
</form>   
<?php
break;

case 'logo':
if(isset($_POST['updatelogo']))
{
    if($_FILES['site_logo']['tmp_name']=="")
    {

    }
    else{

        $site_logo=$_FILES['site_logo']['name'];
        $site_logo_tmp=$_FILES['site_logo']['tmp_name'];
        move_uploaded_file($site_logo_tmp, "../images/$site_logo");
        $update_site_logo=$db->prepare("UPDATE settings SET site_logo=:site_logo 
            where id=:id");
        $update_site_logo->execute([":site_logo"=>$site_logo,":id"=>1]);
        if($update_site_logo)
        {
         echo '<div class="alert alert-success">Loqo yeniləndi</div>';
         header('Refresh:2;url='.$_SERVER['HTTP_REFERER']); 
     }
     else
     {
        echo '<div class="alert alert-success">Xəta baş verdi</div>';
    }
}
}
?>
<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div class="tile-body">
        <div class="form-group row">
          <label class="control-label col-md-3">Loqo</label>
          <div class="col-md-8">
             <img src="<?php echo $a_row->site_url;?>/images/<?php echo $a_row->site_logo;?>" style="width: 300px;height: 200px;object-fit: contain;">
             <input name="site_logo" class="form-control" type="file">
         </div>
     </div>
 </div>
 <div class="tile-footer">
  <div class="row">
    <div class="col-md-8 col-md-offset-3">
        <button name="updatelogo" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-plus-square"></i>Loqonu yenilə</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="<?php echo $administrator;?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Geri qayıt</a>
    </div>
</div>
</div>
</form> 
<?php
break;

case 'favicon':
if(isset($_POST['updatefavicon']))
{
    if($_FILES['site_favicon']['tmp_name']=="")
    {

    }
    else{

        $site_favicon=$_FILES['site_favicon']['name'];
        $site_favicon_tmp=$_FILES['site_favicon']['tmp_name'];
        move_uploaded_file($site_favicon_tmp, "../images/$site_favicon");
        $update_site_favicon=$db->prepare("UPDATE settings SET site_favicon=:site_favicon 
            where id=:id");
        $update_site_favicon->execute([":site_favicon"=>$site_favicon,":id"=>1]);
        if($update_site_favicon)
        {
         echo '<div class="alert alert-success">Favicon yeniləndi</div>';
         header('Refresh:2;url='.$_SERVER['HTTP_REFERER']); 
     }
     else
     {
        echo '<div class="alert alert-success">Xəta baş verdi</div>';
    }
}
}
?>
<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div class="tile-body">
        <div class="form-group row">
          <label class="control-label col-md-3">Site favicon</label>
          <div class="col-md-8">
             <img src="<?php echo $a_row->site_url;?>/images/<?php echo $a_row->site_favicon;?>" style="width: 64px;height: 64px;object-fit: contain;">
             <input name="site_favicon" class="form-control" type="file">
         </div>
     </div>
 </div>
 <div class="tile-footer">
  <div class="row">
    <div class="col-md-8 col-md-offset-3">
        <button name="updatefavicon" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-plus-square"></i>Faviconu yenilə</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="<?php echo $administrator;?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Geri qayıt</a>
    </div>
</div>
</div>
</form> 
<?php
break;

case 'confirmation':
if(isset($_POST['updateconfirmsettings']))
{
   $google_code    = post('google_code');
   $yandex_code    = post('yandex_code');
   $bing_code      = post('bing_code');
   $analytics_code = post('analytics_code');

   if(!$google_code || !$yandex_code || !$bing_code || !$analytics_code)
   {
       echo '<div class="alert alert-danger">Boş xana buraxmayın</div>';
   }
   else
   {
      $confirmationupdate=$db->prepare("UPDATE settings SET google_code=:google_code,yandex_code=:yandex_code,bing_code=:bing_code,analytics_code=:analytics_code WHERE id=:id");
      $confirmationupdate->execute([":google_code"=>$google_code,":yandex_code"=>$yandex_code,":bing_code"=>$bing_code,":analytics_code"=>$analytics_code,":id"=>1]);
      if($confirmationupdate)
      {
         echo '<div class="alert alert-success">Təsdiqləmə parametrləri yeniləndi</div>';
         header('Refresh:2;url='.$_SERVER['HTTP_REFERER']);
     }
     else
     {
         echo '<div class="alert alert-danger">Xəta baş verdi</div>';
     }
 }
}
?>
<form class="form-horizontal" action="" method="POST">
    <div class="tile-body">
        <div class="form-group row">
          <label class="control-label col-md-3">Google təsdiqləmə şifrəsi</label>
          <div class="col-md-8">
            <input name="google_code" value="<?php echo $a_row->google_code;?>" class="form-control" type="text">
        </div>
    </div>
    <div class="form-group row">
      <label class="control-label col-md-3">Yandex təsdiqləmə şifrəsi</label>
      <div class="col-md-8">
        <input name="yandex_code" value="<?php echo $a_row->yandex_code;?>" class="form-control" type="text">
    </div>
</div>
<div class="form-group row">
  <label class="control-label col-md-3">Bing təsdiqləmə şifrəsi</label>
  <div class="col-md-8">
    <input name="bing_code" value="<?php echo $a_row->bing_code;?>" class="form-control" type="text">
</div>
</div>
<div class="form-group row">
  <label class="control-label col-md-3">Google Analytics təsdiqləmə şifrəsi</label>
  <div class="col-md-8">
    <input name="analytics_code" value="<?php echo $a_row->analytics_code;?>" class="form-control" type="text">
</div>
</div>
</div>
<div class="tile-footer">
  <div class="row">
    <div class="col-md-8 col-md-offset-3">
        <button name="updateconfirmsettings" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-plus-square"></i>Təsdiqləmə parametrlərini yenilə</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="<?php echo $administrator;?>"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Geri qayıt</a>
    </div>
</div>
</div>
</form>   
<?php
break;
             ## UPDATE AND READ OPERATION END
}
}



?>
</div>
</div>
</div>
</main>
<?php require_once 'inc/footer.php'; ?>