<?php echo !defined('security') ? die() : null; ?>
 <footer id="footer">

  <div class="copyright-content">
    <div class="container">
      <div class="copyright-text pull-left">Copyright &copy; 2019</div>
      <div class="copyright-text pull-right">
          <?php 
               $social_media=$db->prepare("SELECT * FROM social_media WHERE status=:status");
               $social_media->execute([':status'=>1]);
               if($social_media->rowCount())
               {
                 foreach ($social_media as $item) 
                 {  ?>
                     <a href="<?php echo $item['link'] ?>" target="_blank">
                         <i class="fa fa-<?php echo $item['icon'] ?> fa-lg"></i>
                     </a>
                <?php }
               }
           ?>
      </div>
    </div>

  </div>
</footer>
<!-- end: Footer -->

</div>
<!-- end: Body Inner -->

<!-- Scroll top -->
<a id="scrollTop"><i class="icon-chevron-up1"></i><i class="icon-chevron-up1"></i></a>

<!--Plugins-->
<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>
<script src="js/ajax.js"></script>
<script src="js/sweetalert/sweetalert.min.js"></script>
<!--Template functions-->
<script src="js/functions.js"></script> 
<script src="https://use.fontawesome.com/24eacb6277.js"></script>
<?php echo $a_row->analytics_code; ?>
</body>

</html>
