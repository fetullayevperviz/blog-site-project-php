<?php echo !defined('security') ? die() : null; ?>
<?php 
     $admin_image=$db->prepare("SELECT * FROM admin");
     $admin_image->execute();
     $admin=$admin_image->fetch(PDO::FETCH_OBJ);

 ?>
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div>
        <div>
            <a href="index.php"><img style="width: 100px;height: 100px;object-fit: contain;border-radius: 50%;margin-left: 60px;" class="app-sidebar__user-avatar" src="./images/<?php echo $admin->admin_image;?>" alt="User Image"></a>
        </div>
        <div>
            <p style="color: white;margin-left: 45px;margin-top: 10px;" class="app-sidebar__user-name"><?php echo $admin_name; ?></p>
            <p style="color: white;margin-left: 60px;margin-bottom: 10px;" class="app-sidebar__user-designation">Administrator</p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item active" href="index.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Ana Səhifə</span></a></li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Kateqoriyalar (<?php echo num('categories');?>)</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo $administrator;?>/categories.php"><i class="icon fa fa-circle-o"></i> Kateqoriya Listi</a></li>
                <li><a class="treeview-item" href="<?php echo $administrator;?>/operation.php?operation=new_category"><i class="icon fa fa-circle-o"></i> Yeni Kateqoriya Əlavə Et</a></li>
            </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Yazılar (<?php echo num('articles');?>)</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo $administrator;?>/subjects.php"><i class="icon fa fa-circle-o"></i> Yazı Listi</a></li>
                <li><a class="treeview-item" href="<?php echo $administrator;?>/operation.php?operation=new_text"><i class="icon fa fa-circle-o"></i> Yeni Yazı Əlavə Et</a></li>

            </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-comment"></i><span class="app-menu__label">Rəylər (<?php echo num('comments');?>)</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo $administrator;?>/approvedcomments.php"><i class="icon fa fa-circle-o"></i> Təsdiqlənmiş Rəylər (<?php echo num('comments','com_status',1);?>)</a></li>
                <li><a class="treeview-item" href="<?php echo $administrator;?>/approvalcomments.php"><i class="icon fa fa-circle-o"></i> Təsdiq Gözləyən Rəylər (<?php echo num('comments','com_status',2);?>)</a></li>

            </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-envelope"></i><span class="app-menu__label">Mesajlar (<?php echo num('messages');?>)</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo $administrator;?>/readmessages.php"><i class="icon fa fa-circle-o"></i> Oxunmuş Mesajlar (<?php echo num('messages','status',1);?>)</a></li>
                <li><a class="treeview-item" href="<?php echo $administrator;?>/pendingmessages.php"><i class="icon fa fa-circle-o"></i> Yeni Mesajlar (<?php echo num('messages','status',2);?>)</a></li>

            </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-facebook-square"></i><span class="app-menu__label">Sosial Şəbəkələr (<?php echo num('social_media');?>)</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo $administrator;?>/social_media.php"><i class="icon fa fa-circle-o"></i> Sosial Media Listi</a></li>
                <li><a class="treeview-item" href="<?php echo $administrator;?>/operation.php?operation=new_social_media"><i class="icon fa fa-circle-o"></i> Yeni Sosial Media Əlavə Et</a></li>

            </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Abunələr (<?php echo num('sub');?></span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo $administrator;?>/subscribers.php"><i class="icon fa fa-circle-o"></i> Abunə Listi)</a></li>
            </ul>
        </li>

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">Parametlər</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="<?php echo $administrator;?>/operation.php?operation=general"><i class="icon fa fa-circle-o"></i> Ümumi Parametrlər</a></li>
                <li><a class="treeview-item" href="<?php echo $administrator;?>/operation.php?operation=contact"><i class="icon fa fa-circle-o"></i> Əlaqə Parametrləri</a></li>
                <li><a class="treeview-item" href="<?php echo $administrator;?>/operation.php?operation=logo"><i class="icon fa fa-circle-o"></i> Logo Parametrləri</a></li>
                <li><a class="treeview-item" href="<?php echo $administrator;?>/operation.php?operation=favicon"><i class="icon fa fa-circle-o"></i> Favicon Parametrləri</a></li>
                <li><a class="treeview-item" href="<?php echo $administrator;?>/operation.php?operation=confirmation"><i class="icon fa fa-circle-o"></i> Təsdiqləmə Parametrləri</a></li>

            </ul>
        </li>


    </ul>
</aside>