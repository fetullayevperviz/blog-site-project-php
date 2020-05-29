<?php echo !defined('security') ? die() : null; ?>
<header id="header">
    <div class="header-inner" style="border-bottom: 1px solid #cccccc;">
        <div class="container">
            <div id="logo" style="margin-top: 3px;">
                <a href="<?php echo $a_row->site_url; ?>" class="logo" data-src-dark="images/<?php echo $a_row->site_logo; ?>"> <img style="width: 200px; height:74px;object-fit: contain;" src="<?php echo $a_row->site_url;?>/images/<?php echo $a_row->site_logo; ?>" alt="<?php echo $a_row->site_title;?>"> </a>
            </div>
            <div id="search">
                <div id="search-logo"><img src="images/logo.png" alt="Polo Logo"></div>
                <button id="btn-search-close" class="btn-search-close" aria-label="Close search form"><i
                    class="icon-x"></i></button>
                    <form class="search-form" action="search.php" method="GET">
                        <input class="form-control" name="search" type="search" placeholder="Axtarın..."
                        autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
                        <span class="text-muted">Başlıq yazaraq axtarış edə və yaxud ESC ilə çıxış edə bilərsiniz</span>
                    </form>
                    <div class="search-suggestion-wrapper">

                        <?php 
                        $popular=$db->prepare("SELECT * FROM articles WHERE text_status=:text_status ORDER BY text_show DESC LIMIT :lim");
                        $popular->bindValue(':text_status',(int) 1, PDO::PARAM_INT);
                        $popular->bindValue(':lim',(int) 3, PDO::PARAM_INT);
                        $popular->execute();
                        if($popular->rowCount())
                        {
                            foreach ($popular as $item) 
                            { ?>
                                  <div class="search-suggestion">
                                     <h3><?php echo $item['text_title'];?></h3>
                                     <p><?php echo mb_substr($item['text_content'],0,150);?></p>
                                     <p><a href="<?php echo $a_row->site_url;?>/textdetails.php?text_chef=<?php echo $item['text_chef'];?>&text_id=<?php echo $item['text_id'];?>">Davamını oxu</a></p>
                                  </div>
                            <?php } 
                            }
                        ?>

                                   

                            </div>
                        </div>
                        <div class="header-extras">
                            <ul>
                               <li>
                                <a id="btn-search" href="#"> <i class="icon-search1"></i></a>
                            </li> 
                        </ul>
                    </div>
                    <div id="mainMenu-trigger">
                        <button class="lines-button x"> <span class="lines"></span> </button>
                    </div>
                    <div id="mainMenu">
                        <div class="container">
                            <nav>
                                <ul>
                                    <li><a href="<?php echo $a_row->site_url; ?>"><i class="fa fa-home"></i>ANA SƏHİFƏ</a></li>
                                    <li class="dropdown"> <a href="#"><i class="fa fa-list"></i>KATEQORİYALAR</a>
                                        <ul class="dropdown-menu">     
                                            <?php 
                                            $categories=$db->prepare("SELECT * FROM categories");
                                            $categories->execute();
                                            if($categories->rowCount())
                                            {
                                               foreach ($categories as $row) 
                                               {
                                                $text=$db->prepare("SELECT text_cat_id,text_status FROM articles WHERE text_cat_id=:text_cat_id");
                                                $text->execute([':text_cat_id'=>$row['id']]);

                                                echo '<li>
                                                <a href="'.$a_row->site_url.'categories.php?cat_chef='.$row['cat_chef'].'">'.$row['cat_name'].' ('.$text->rowCount().')</a>
                                                </li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li><a href="contact.php"><i class="fa fa-envelope"></i>ƏLAQƏ</a></li>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
</div>
</div>
</div>
</header>