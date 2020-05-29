<?php 
define('security', true);
include("inc/header.php"); ?>
<?php include("inc/menu.php"); ?>                              

<section id="page-content">
    <div class="container">
        <div class="page-title">
            <h1>Xəbərlər Səhifəsi</h1>
            <div class="breadcrumb float-left">
                <ul>
                    <li><a href="#">Ana Səhifə</a></li>
                </ul>
            </div>
        </div>
        <div id="blog" class="grid-layout post-3-columns m-b-30" data-item="post-item">
           <?php 
           $s=@intval($_GET['s']);
           if(!$s)
           {
             $s=1;
         }
         $request=$db->prepare("SELECT text_cat_id,text_status FROM articles INNER JOIN categories ON categories.id=articles.text_cat_id WHERE text_status=:text_status");
         $request->execute([':text_status'=>1]);

         $sum=$request->rowCount();
         $lim=15;
         $show=$s*$lim-$lim;

         $request=$db->prepare("SELECT * FROM articles INNER JOIN categories ON categories.id=articles.text_cat_id WHERE text_status=:text_status ORDER BY text_date DESC LIMIT :show,:lim");
         $request->bindValue(":text_status",(int) 1, PDO::PARAM_INT);
         $request->bindValue(":show",(int) $show, PDO::PARAM_INT);
         $request->bindValue(":lim",(int) $lim, PDO::PARAM_INT);
         $request->execute();
         if($s>ceil($sum/$lim))
         {
            $s=1;
        }

        if($request->rowCount()){
            foreach ($request as $row) {    
                ?>
                <div class="post-item border">
                    <div class="post-item-wrap">
                        <div class="post-image" style="height: 300px;">
                            <a href="<?php echo $a_row->site_url;?>/textdetails.php?text_chef=<?php echo $row['text_chef'];?>&text_id=<?php echo $row['text_id']?>">
                                <img style="width:350px;height:300px;" alt="<?php echo $row['text_title'];?>" src="images/<?php echo $row['text_image'];?>">
                            </a>
                            <span class="post-meta-category"><a href="<?php echo $a_row->site_url.'categories.php?cat_chef='.$row['cat_chef'];
                                ?>"><?php echo $row['cat_name'];?></a></span>
                        </div>
                        <div class="post-item-description">
                            <span class="post-meta-date">
                                <i class="fa fa-calendar-o"></i>
                                <?php echo date('d.m.Y',strtotime($row['text_date']));?>
                            </span>
                            <span class="post-meta-comments">
                                <a href=""><i class="fa fa-eye"></i><?php echo $row['text_show'];?> Baxış</a>
                            </span>
                            <h2>
                                <a href="<?php echo $a_row->site_url;?>/textdetails.php?text_chef=<?php echo $row['text_chef'];?>&text_id=<?php echo $row['text_id']?>"><?php echo $row['text_title'];?></a>
                            </h2>
                            <p style="word-wrap: break-word;"><?php echo mb_substr($row['text_content'],0,150,'utf8').'...';?></p>
                            <a href="<?php echo $a_row->site_url;?>/textdetails.php?text_chef=<?php echo $row['text_chef'];?>&text_id=<?php echo $row['text_id']?>" class="item-link">Davamını oxu<i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <?php 
            } 
            ?>
        </div>
            <ul class="pagination">
               <?php 
                    if($sum>$lim)
                    {
                        pagination($s,ceil($sum/$lim),'index.php?s=');
                    }
                ?>
            </ul>
         <?php
     } 
     else 
     {
        echo "<div class='alert alert-danger'>Mövzu daxil edilməyib</div>";
    } 
    ?>

</div>
</section>                          
<?php include("inc/footer.php"); ?>