<?php 
define('security',true);
include("inc/header.php"); ?>
<?php include("inc/menu.php"); ?>

    <!-- Page title -->
    <section id="page-title" data-parallax-image="images/parallax/5.jpg">
        <div class="container">
            <div class="page-title">
                <h1>MƏNİMLƏ ƏLAQƏ</h1>
            </div>
            <div class="breadcrumb">
                <ul>
                    <li><a href="#">Ana Səhifə</a> </li>
                    <li class="active"><a href="#">Əlaqə</a> </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end: Page title -->

    <!-- CONTENT -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-<?php echo $a_row->site_location_status==1 ? '6' : '12';?>">
                    <h3 class="text-uppercase">BİZƏ YAZIN</h3>
                    <p>Əlaqə formunu əksiksiz doldurun. Digər problemlərlə bağlı <b><?php echo $a_row->site_mail;?></b> mail adresi üzərindən əlaqə yarada bilərsiniz</p>
                    <div class="m-t-30">
                        <form id="contact" onsubmit="return false" class="widget-contact-form" action="" role="form" method="post">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Ad Soyad</label>
                                    <input type="text" aria-required="true" name="fullname" class="form-control required name" placeholder="Ad Soyadınızı yazın">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">EMAİL</label>
                                    <input type="email" aria-required="true" name="email" class="form-control required email" placeholder="Emailinizi yazın">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="subject">Mövzu</label>
                                    <input type="text" name="subject" class="form-control required" placeholder="Mövzu">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message">Mesaj</label>
                                <textarea type="text" name="message" rows="5" class="form-control required" placeholder="Mesajınız"></textarea>
                            </div>

                            <button onclick="sendmessage();" class="btn" type="submit" id="form-submit"><i class="fa fa-paper-plane"></i>&nbsp;Mesaj göndər</button>
                        </form>

                    </div>
                </div>
                <?php if($a_row->site_location_status==1){ ?>
                <div class="col-lg-6">
                    <h3 class="text-uppercase">ÜNVAN</h3>
                    
                    <!-- Google map sensor -->
                    <iframe src="<?php echo $a_row->site_location;?>" width="600px" height="400px"></iframe>
                    <!-- Google map sensor -->

                </div>
            <?php } ?>
            </div>
        </div>
    </section>
    <!-- end: CONTENT -->

    <?php include("inc/footer.php"); ?>