<?php 
define('security', true);
include("inc/header.php"); ?>
<?php include("inc/menu.php"); ?>

<section id="page-content" class="sidebar-right">
    <div class="container">
        <div class="row">
            <div class="content col-lg-9">
               <?php 
               $text_chef=strip_tags(trim($_GET['text_chef']));
               $text_id=strip_tags(trim($_GET['text_id']));
               if(!$text_chef || !$text_id)
               {
                header('location:'.$a_row->site_url);
            }

                     ##Sonraki ve evvelki movzulari tapmaq ucun sorgular baslangic
            $next_id=(double)$text_id+1;
            $previus_id=(double)$text_id-1;

            $next_text=$db->prepare("SELECT text_id,text_title,text_chef FROM articles WHERE text_id=:text_id AND text_status=:text_status");
            $next_text->execute([':text_id'=>$next_id,':text_status'=>1]);
            $next_text_row=$next_text->fetch(PDO::FETCH_OBJ);

            $previus_text=$db->prepare("SELECT text_id,text_title,text_chef FROM articles WHERE text_id=:text_id AND text_status=:text_status");
            $previus_text->execute([':text_id'=>$previus_id,':text_status'=>1]);
            $previus_text_row=$previus_text->fetch(PDO::FETCH_OBJ);
                     ##Sonraki ve evvelki movzulari tapmaq ucun sorgular bitis

            $text=$db->prepare("SELECT * FROM articles INNER JOIN categories ON categories.id=articles.text_cat_id WHERE text_chef=:text_chef AND text_id=:text_id AND text_status=:text_status");
            $text->execute([':text_chef'=>$text_chef, ':text_id'=>$text_id, ':text_status'=>1]);
            if($text->rowCount())
            {
                $row=$text->fetch(PDO::FETCH_OBJ);

                $show=@$_COOKIE[$row->text_id];
                if(!$show)
                {
                    $read_count=$db->prepare("UPDATE articles SET text_show=:text_show WHERE text_id=:text_id");
                    $read_count->execute([':text_show'=>$row->text_show+1,':text_id'=>$text_id]);
                    setcookie($row->text_id,'1',time()+3600);

                }

                ?>
                <div id="blog" class="single-post">
                    <!-- Post single item-->
                    <div class="post-item">
                        <div class="post-item-wrap">
                            <div class="post-image">
                                <a href="#">
                                    <img alt="<?php echo $row->text_title;?>" src="<?php echo $a_row->site_url;?>/images/<?php echo $row->text_image;?>">
                                </a>
                            </div>
                            <div class="post-item-description">
                                <h2><?php echo $row->text_title;?></h2>
                                <div class="post-meta">

                                    <span class="post-meta-date"><i class="fa fa-calendar-o"></i>
                                     <?php echo date('d.m.Y',strtotime($row->text_date));?>
                                 </span>
                                 <span class="post-meta-comments"><a href=""><i class="fa fa-eye"></i><?php echo $row->text_show;?> Baxış</a></span>
                                 <span class="post-meta-category"><a href=""><i class="fa fa-list"></i><?php echo $row->cat_name;?></a></span>
                                 <div class="post-meta-share">
                                    <a target="_blank" class="btn btn-xs btn-slide btn-facebook" href="https://www.facebook.com/sharer.php?u=<?php echo $a_row->site_url;?>/textdetails.php?text_chef=<?php echo $row->text_chef;?>&text_id=<?php echo $row->text_id;?>">
                                        <i class="fab fa-facebook-f"></i>
                                        <span>Facebook</span>
                                    </a>
                                    <a target="_blank" class="btn btn-xs btn-slide btn-twitter" href="https://twitter.com/intent/tweet?text=<?php echo $row->text_title;?>&url=<?php echo $a_row->site_url;?>/textdetails.php?text_chef=<?php echo $row->text_chef;?>&text_id=<?php echo $row->text_id;?>&via=FetullayevBlog" data-width="100">
                                        <i class="fab fa-twitter"></i>
                                        <span>Twitter</span>
                                    </a>
                                    <a target="_blank" class="btn btn-xs btn-slide btn-googleplus" href="mailto:parviz.fetullayev.project@gmail.com?subject=<?php echo $row->text_title;?>&body=<?php echo $a_row->site_url;?>/textdetails.php?text_chef=<?php echo $row->text_chef;?>&text_id=<?php echo $row->text_id;?>" data-width="80">
                                        <i class="far fa-envelope"></i>
                                        <span>Mail</span>
                                    </a>
                                </div>
                            </div>

                            <div style="word-wrap: break-word;"><?php echo $row->text_content;?></div>

                        </div>
                        <div class="post-tags">
                            <?php 
                            $tags=explode(",",$row->text_tags);
                            $arr=array();
                            foreach ($tags as $tag) 
                            {
                               $arr[]='<a title="'.$tag.'" href="tagdetails.php?tag='.chef_link($tag).'">'.$tag.'</a>';
                           }
                           $result=implode(' ', $arr);
                           echo $result;
                           ?>
                       </div>
                       <div class="post-navigation">
                        <?php if($previus_text->rowCount()){ ?>
                            <a href="<?php echo $a_row->site_url;?>/textdetails.php?text_chef=<?php echo $previus_text_row->text_chef;?>&text_id=<?php echo $previus_text_row->text_id;?>" 
                                class="post-prev">
                                <div class="post-prev-title"><span>Öncəki mövzu</span><?php echo $previus_text_row->text_title;?>
                            </div>
                        </a>

                    <?php } else{ ?>
                        <a href="#" class="post-prev">
                         <div class="post-prev-title"><span>Əvvəlki mövzu</span>Öncəki mövzu tapılmadı</div>
                     </a>
                 <?php } ?>

                 <a href="#" class="post-all">
                    <i class="icon-grid"></i>
                </a>

                <?php if($next_text->rowCount()){ ?>
                    <a href="<?php echo $a_row->site_url;?>/textdetails.php?text_chef=<?php echo $next_text_row->text_chef;?>&text_id=<?php echo $next_text_row->text_id;?>" 
                        class="post-next"> 
                        <div class="post-next-title"><span>Sonrakı mövzu</span><?php echo $next_text_row->text_title; ?></div>
                    </a>
                <?php } else{ ?>
                  <a href="#" class="post-next">
                   <div class="post-next-title"><span>Sonrakı mövzu</span>Sonrakı mövzu tapılmadı</div>
               </a> 
           <?php } ?>
       </div>

       <?php 
       $comments=$db->prepare("SELECT * FROM comments WHERE com_text_id=:com_text_id AND com_status=:com_status");
       $comments->execute([':com_text_id'=>$row->text_id,':com_status'=>1]);
       if($comments->rowCount())
        {  ?>

           <div class="comments" id="comments">
            <div class="comment_number">
                Rəylər <span>(<?php echo $comments->rowCount();?>)</span>
            </div>
            <div class="comment-list">
                <?php foreach($comments as $comment){ ?>
                  <div class="comment" id="comment-2">
                    <div class="image"><img alt="<?php echo $row->text_title;?>" src="<?php echo $a_row->site_url;?>/images/comment.png" class="avatar"></div>
                    <div class="text">
                        <h5 class="name"><a href="<?php echo $comment['com_website'];?>" target="_blank"><?php echo $comment['com_name'];?></a></h5>
                        <span class="comment_date"><?php echo date('d.m.Y',strtotime($comment['com_date']));?></span>
                        <div class="text_holder">
                            <p><?php echo $comment['com_content'];?></p>
                        </div>
                    </div>
                </div><hr>
            <?php } ?>
        </div>
    </div>

<?php }
else
{
    echo '<div class="alert alert-danger">Bu mövzuya rəy bildirilməyib</div>';
}
?>

<div class="respond-form" id="respond">
    <div class="respond-comment">
        Rəy <span>bildirin</span></div>
        <form id="commentform" class="form-gray-fields" action="" method="POST" onsubmit="return false">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="upper" for="name">Ad Soyad</label>
                        <input class="form-control required" name="com_name" placeholder="Ad Soyad" id="name" aria-required="true" type="text">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="upper" for="email">EMAİL (Paylaşılmayacaq)</label>
                        <input class="form-control required email" name="com_email" placeholder="Email" id="email" aria-required="true" type="email">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="upper" for="website">WEBSİTE</label>
                        <input class="form-control website" name="com_website" placeholder="http:// ilə birlikdə yazın" id="website" aria-required="false" type="text">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="upper" for="comment">RƏY BİLDİR</label>
                        <textarea class="form-control required" name="com_content" rows="9" placeholder="Rəy bildir" id="comment" aria-required="true"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group text-center">
                        <input type="hidden" name="text_id" value="<?php echo $row->text_id;?>">
                        <button class="btn" type="submit" onclick="site_comment();">RƏY BİLDİR</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
<!-- end: Post single item-->
</div>
<?php
}
else
{
    header('location:'.$a_row->site_url);
}
?>
</div>
<?php include("inc/sidebar.php"); ?>
</div>
</div>
</section>

<?php include("inc/footer.php"); ?>