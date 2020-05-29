<?php 
define('security', true);
require_once 'inc/header.php'; ?>
<!-- Sidebar menu-->
<?php require_once 'inc/sidebar.php'; ?>

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Təsdiq Gözləyən Rəylər</h1>
      <p>Təsdiq Gözləyən Rəy Listi</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Təsdiq Gözləyən Rəylər</li>
      <li class="breadcrumb-item active"><a href="#">Təsdiq Gözləyən Rəy Listi</a></li>
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
        $sum=num('comments','com_status',2);
        $lim=10;
        $show=$s*$lim-$lim;

        $request=$db->prepare("SELECT * FROM comments INNER JOIN articles ON articles.text_id=comments.com_text_id WHERE com_status=:com_status ORDER BY id DESC LIMIT :show,:lim");
        $request->bindValue(":show",(int) $show, PDO::PARAM_INT);
        $request->bindValue(":lim",(int) $lim, PDO::PARAM_INT);
        $request->bindValue(":com_status",(int) 2, PDO::PARAM_INT);
        $request->execute();
        if($s>ceil($sum/$lim))
        {
          $s=1;
        }
        if($request->rowCount()){
         ?>
         <h3 class="tile-title">Təsdiq Gözləyən Rəy Listi (<?php echo $sum;?>)</h3>
         <div class="table-responsive table-hover">
          <table class="table">
            <thead>
              <tr>
                <th>İD</th>
                <th>AD</th>
                <th>YAZI</th>
                <th>E-MAİL</th>
                <th>TARİX</th>
                <th>ƏMƏLİYYATLAR</th>
              </tr>
            </thead>
            <tbody>
             <?php foreach($request as $row){ ?>
               <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['com_name']; ?></td>
                <td><?php echo $row['text_title'];?></td>
                <td><?php echo $row['com_email']; ?></td>
                <td><?php echo date('d.m.Y',strtotime($row['com_date']));?></td>
                <td><a href="<?php echo $administrator."/operation.php?operation=comment_read&id=".$row['id'];?>"><i class="fa fa-eye"></i></a> | <a onclick="return confirm('Təsdiqləyirsiniz ?');" href="<?php echo $administrator."/operation.php?operation=comment_delete&id=".$row['id'];?>"><i class="fa fa-eraser"></i></a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <ul class="pagination">
         <?php 
              if($sum>$lim)
              {
                 pagination($s,ceil($sum/$lim),'approvalcomments.php?s=');
              }
          ?>
      </ul>
    <?php } else{
     echo '<div class="alert alert-danger">Təsdiq Gözləyən Rəy tapılmadı</div>';
   } ?>
 </div>
</div>
</div>
</main>
<?php require_once 'inc/footer.php'; ?>