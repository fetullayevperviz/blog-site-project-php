<?php 
define('security', true);
require_once 'inc/header.php'; ?>
<!-- Sidebar menu-->
<?php require_once 'inc/sidebar.php'; ?>

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Abunələr</h1>
      <p>Abunələr Listi</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Abunələr</li>
      <li class="breadcrumb-item active"><a href="#">Abunələr Listi</a></li>
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
        $sum=num('sub');
        $lim=10;
        $show=$s*$lim-$lim;

        $request=$db->prepare("SELECT * FROM sub ORDER BY id DESC LIMIT :show,:lim");
        $request->bindValue(":show",(int) $show, PDO::PARAM_INT);
        $request->bindValue(":lim",(int) $lim, PDO::PARAM_INT);
        $request->execute();
        if($s>ceil($sum/$lim))
        {
          $s=1;
        }
        if($request->rowCount()){
         ?>
         <h3 class="tile-title">Abunələr Listi (<?php echo $sum;?>)</h3>
         <div class="table-responsive table-hover">
          <table class="table">
            <thead>
              <tr>
                <th>İD</th>
                <th>E-MAİL</th>
                <th>TARİX</th>
                <th>ƏMƏLİYYATLAR</th>
              </tr>
            </thead>
            <tbody>
             <?php foreach($request as $row){ ?>
               <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['sub_mail']; ?></td>
                <td><?php echo date('d.m.Y',strtotime($row['sub_date']));?></td>
                <td><a onclick="return confirm('Təsdiqləyirsiniz ?');" href="<?php echo $administrator."/operation.php?operation=subscriber_delete&id=".$row['id'];?>"><i class="fa fa-eraser"></i></a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <ul class="pagination">
         <?php 
              if($sum>$lim)
              {
                 pagination($s,ceil($sum/$lim),'subscribers.php?s=');
              }
          ?>
      </ul>
    <?php } else{
     echo '<div class="alert alert-danger">Abunə tapılmadı</div>';
   } ?>
 </div>
</div>
</div>
</main>
<?php require_once 'inc/footer.php'; ?>