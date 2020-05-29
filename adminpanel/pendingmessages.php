<?php 
define('security', true);
require_once 'inc/header.php'; ?>
<!-- Sidebar menu-->
<?php require_once 'inc/sidebar.php'; ?>

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Oxunmamış Mesajlar</h1>
      <p>Oxunmamış Mesajlar Listi</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Oxunmamış Mesajlar</li>
      <li class="breadcrumb-item active"><a href="#">Oxunmamış Mesajlar Listi</a></li>
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
        $sum=num('messages','status',2);
        $lim=10;
        $show=$s*$lim-$lim;

        $request=$db->prepare("SELECT * FROM messages WHERE status=:status ORDER BY id DESC LIMIT :show,:lim");
        $request->bindValue(":show",(int) $show, PDO::PARAM_INT);
        $request->bindValue(":lim",(int) $lim, PDO::PARAM_INT);
        $request->bindValue(":status",(int) 2, PDO::PARAM_INT);
        $request->execute();
        if($s>ceil($sum/$lim))
        {
          $s=1;
        }
        if($request->rowCount()){
         ?>
         <h3 class="tile-title">Oxunmamış Mesajlar Listi (<?php echo $sum;?>)</h3>
         <div class="table-responsive table-hover">
          <table class="table">
            <thead>
              <tr>
                <th>İD</th>
                <th>AD</th>
                <th>MÖVZU</th>
                <th>E-MAİL</th>
                <th>TARİX</th>
                <th>ƏMƏLİYYATLAR</th>
              </tr>
            </thead>
            <tbody>
             <?php foreach($request as $row){ ?>
               <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['subject'];?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo date('d.m.Y',strtotime($row['m_date']));?></td>
                <td><a href="<?php echo $administrator."/operation.php?operation=message_read&id=".$row['id'];?>"><i class="fa fa-eye"></i></a> | <a onclick="return confirm('Təsdiqləyirsiniz ?');" href="<?php echo $administrator."/operation.php?operation=message_delete&id=".$row['id'];?>"><i class="fa fa-eraser"></i></a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <ul class="pagination">
         <?php 
              if($sum>$lim)
              {
                 pagination($s,ceil($sum/$lim),'pendingmessages.php?s=');
              }
          ?>
      </ul>
    <?php } else{
     echo '<div class="alert alert-danger">Mesaj tapılmadı</div>';
   } ?>
 </div>
</div>
</div>
</main>
<?php require_once 'inc/footer.php'; ?>