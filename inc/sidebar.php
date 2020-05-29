<?php echo !defined('security') ? die() : null; ?>
  <!-- Sidebar-->
  <div class="sidebar sticky-sidebar col-lg-3">
    <!--widget newsletter-->
    <div class="widget  widget-newsletter">
        <form id="widget-search-form-sidebar" action="search.php" method="GET" class="form-inline">
            <div class="input-group">
            <input type="search" aria-required="true" name="search" class="form-control widget-search-form" placeholder="Mövzu axtarın...">
                <div class="input-group-append">
                    <span class="input-group-btn">
                      <button type="submit" id="widget-widget-search-form-button" class="btn"><i class="fa fa-search"></i></button>
                  </span>
              </div> </div>
          </form>
      </div>
      <!--end: widget newsletter-->

      <!--Tabs with Posts-->
      <div class="widget">                         
        <div class="tabs">
            <ul class="nav nav-tabs" id="tabs-posts" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab">Ən çox oxunanlar</a>
                </li>
            </ul>
            <div class="tab-content" id="tabs-posts-content">
                <div class="tab-pane fade show active" id="popular" role="tabpanel" aria-labelledby="popular-tab">
                    <div class="post-thumbnail-list">
                        <?php 
                        $popular=$db->prepare("SELECT * FROM articles INNER JOIN categories ON categories.id=articles.text_cat_id WHERE text_status=:text_status ORDER BY text_show DESC LIMIT :lim");
                        $popular->bindValue(':text_status',(int) 1, PDO::PARAM_INT);
                        $popular->bindValue(':lim',(int) 10, PDO::PARAM_INT);
                        $popular->execute();
                        if($popular->rowCount())
                        {
                            foreach ($popular as $item) 
                                { ?>
                                 <div class="post-thumbnail-entry">
                                    <img alt="<?php echo $item['text_title'];?>" src="<?php echo $a_row->site_url;?>/images/<?php echo $item['text_image'];?>">
                                    <div class="post-thumbnail-content">
                                        <a href="<?php echo $a_row->site_url;?>/textdetails.php?text_chef=<?php echo $item['text_chef'];?>&text_id=<?php echo $item['text_id'];?>"><?php echo $item['text_title'];?> (<?php echo $item['text_show'];?>)</a>
                                        <span class="post-date"><i class="far fa-clock"></i><?php echo date('d.m.Y',strtotime($item['text_date']));?></span>
                                        <span class="post-category"><i class="fa fa-list"></i><?php echo $item['cat_name'];?></span>
                                    </div>
                                </div>
                            <?php }
                        }
                        ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="featured" role="tabpanel" aria-labelledby="featured-tab">
                    <div class="post-thumbnail-list">
                        <div class="post-thumbnail-entry">
                            <img alt="" src="images/blog/thumbnail/6.jpg">
                            <div class="post-thumbnail-content">
                                <a href="#">Beautiful nature, and rare feathers!</a>
                                <span class="post-date"><i class="far fa-clock"></i> 24h ago</span>
                                <span class="post-category"><i class="fa fa-tag"></i> Lifestyle</span>
                            </div>
                        </div>
                        <div class="post-thumbnail-entry">
                            <img alt="" src="images/blog/thumbnail/7.jpg">
                            <div class="post-thumbnail-content">
                                <a href="#">The most happiest time of the day!</a>
                                <span class="post-date"><i class="far fa-clock"></i> 11h ago</span>
                                <span class="post-category"><i class="fa fa-tag"></i> Lifestyle</span>
                            </div>
                        </div>
                        <div class="post-thumbnail-entry">
                            <img alt="" src="images/blog/thumbnail/8.jpg">
                            <div class="post-thumbnail-content">
                                <a href="#">New costs and rise of the economy!</a>
                                <span class="post-date"><i class="far fa-clock"></i> 11h ago</span>
                                <span class="post-category"><i class="fa fa-tag"></i> Lifestyle</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="recent" role="tabpanel" aria-labelledby="recent-tab">
                    <div class="post-thumbnail-list">
                        <div class="post-thumbnail-entry">
                            <img alt="" src="images/blog/thumbnail/7.jpg">
                            <div class="post-thumbnail-content">
                                <a href="#">The most happiest time of the day!</a>
                                <span class="post-date"><i class="far fa-clock"></i> 11h ago</span>
                                <span class="post-category"><i class="fa fa-tag"></i> Lifestyle</span>
                            </div>
                        </div>
                        <div class="post-thumbnail-entry">
                            <img alt="" src="images/blog/thumbnail/8.jpg">
                            <div class="post-thumbnail-content">
                                <a href="#">New costs and rise of the economy!</a>
                                <span class="post-date"><i class="far fa-clock"></i> 11h ago</span>
                                <span class="post-category"><i class="fa fa-tag"></i> Lifestyle</span>
                            </div>
                        </div>
                        <div class="post-thumbnail-entry">
                            <img alt="" src="images/blog/thumbnail/6.jpg">
                            <div class="post-thumbnail-content">
                                <a href="#">Beautiful nature, and rare feathers!</a>
                                <span class="post-date"><i class="far fa-clock"></i> 24h ago</span>
                                <span class="post-category"><i class="fa fa-tag"></i> Lifestyle</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End: Tabs with Posts-->

     <div class="widget  widget-newsletter">
        <h4 class="widget-title">ABUNƏLİK</h4>
        <form id="subscribersform" action="" method="POST" class="form-inline" onsubmit="return false">
            <div class="input-group">
            <input type="text" aria-required="true" name="sub_mail" class="form-control widget-search-form" placeholder="Email yazın...">
                <div class="input-group-append">
                    <span class="input-group-btn">
                      <button onclick="sub()" type="submit"  class="btn"><i class="fa fa-send"></i></button>
                  </span>
              </div> </div>
          </form>
      </div>

    <!--widget tags -->
    <div class="widget  widget-tags">
        <h4 class="widget-title">Etiketlər</h4>
        <div class="tags">
            <?php echo tags(); ?>
        </div>
    </div>
    <!--end: widget tags -->
</div>
                    <!-- end: Sidebar-->