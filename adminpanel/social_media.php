<?php 
define('security', true);
require_once 'inc/header.php'; ?>
<!-- Sidebar menu-->
<?php require_once 'inc/sidebar.php'; ?>

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Sosial Şəbəkələr</h1>
      <p>Sosial Şəbəkələr Listi</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Sosial Şəbəkələr</li>
      <li class="breadcrumb-item active"><a href="#">Sosial Şəbəkələr Listi</a></li>
    </ul>
  </div>
  <div class="row">

    <div class="clearfix"></div>
    <div class="col-md-12">
      <div class="tile">
        <?php 
        $s=@intval(get('s'));
        if(!$s)
        {
          $s=1;
        }
        $sum=num('social_media');
        $lim=10;
        $show=$s*$lim-$lim;

        $request=$db->prepare("SELECT * FROM social_media ORDER BY id DESC LIMIT :show,:lim");
        $request->bindValue(":show",(int) $show, PDO::PARAM_INT);
        $request->bindValue(":lim",(int) $lim, PDO::PARAM_INT);
        $request->execute();
        if($s>ceil($sum/$lim))
        {
          $s=1;
        }
        if($request->rowCount()){
         ?>
         <h3 class="tile-title">Sosial Şəbəkələr Listi (<?php echo $sum;?>)</h3>
         <div class="table-responsive table-hover">
          <table class="table">
            <thead>
              <tr>
                <th>İD</th>
                <th>İKON</th>
                <th>LİNK</th>
                <th>STATUS</th>
                <th>ƏMƏLİYYATLAR</th>
              </tr>
            </thead>
            <tbody>
             <?php foreach($request as $row){ ?>
               <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['icon']; ?></td>
                <td><?php echo $row['link']; ?></td>
                <td>
                  <?php echo $row['status']==1 ? '<div style="color:green;font-weight:bold;">Aktiv</div>' : '<div style="color:red;font-weight:bold;">Passiv</div>' ?>
                </td>
                <td>
                  <a href="<?php echo $administrator."/operation.php?operation=social_media_update&id=".$row['id'];?>"><i class="fa fa-edit"></i></a>
                  <a onclick="return confirm('Təsdiqləyirsiniz ?');" href="<?php echo $administrator."/operation.php?operation=social_media_delete&id=".$row['id'];?>"><i class="fa fa-eraser"></i></a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <ul class="pagination">
         <?php 
              if($sum>$lim)
              {
                 pagination($s,ceil($sum/$lim),'social_media.php?s=');
              }
          ?>
      </ul>
    <?php } else{
     echo '<div class="alert alert-danger">Sosial şəbəkə hesabı tapılmadı</div>';
   } ?>
 </div>
</div>
</div>
</main>
<?php require_once 'inc/footer.php'; ?>