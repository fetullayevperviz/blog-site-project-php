<?php 
define('security', true);
require_once 'inc/header.php'; ?>
<!-- Sidebar menu-->
<?php require_once 'inc/sidebar.php'; ?>

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> Yazı axtarışının nəticələri</h1>
      <p>Yazı axtarışının nəticələri</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item">Yazı axtarışının nəticələri</li>
      <li class="breadcrumb-item active"><a href="#">Yazı axtarışının nəticələri</a></li>
    </ul>
  </div>
  <div class="row">

   <div class="col-md-12">
       <form action="<?php echo $administrator;?>/textsearch.php" method="GET">
           <input type="search" name="search" class="form-control" placeholder="Yazı başlığı yazın">
       </form><br>
   </div>

    <div class="clearfix"></div>
    <div class="col-md-12">
      <div class="tile">
        <?php 
        $s=@intval(get('s'));
        if(!$s)
        {
          $s=1;
        }

        $search=get('search');
        if(!$search)
        {
           header("Location:".$administrator."/subjects.php");
        }
        $request=$db->prepare("SELECT * FROM articles INNER JOIN categories ON categories.id=articles.text_cat_id WHERE text_title LIKE :text_title ORDER BY text_id DESC");
        $request->execute([":text_title"=>"%".$search."%"]);

        $sum=$request->rowCount();
        $lim=10;
        $show=$s*$lim-$lim;

        $request=$db->prepare("SELECT * FROM articles INNER JOIN categories ON categories.id=articles.text_cat_id WHERE text_title LIKE :text_title ORDER BY text_id DESC LIMIT :show,:lim");

        $request->bindValue(":text_title","%".$search."%", PDO::PARAM_STR);
        $request->bindValue(":show",(int) $show, PDO::PARAM_INT);
        $request->bindValue(":lim",(int) $lim, PDO::PARAM_INT);
        $request->execute();
        if($s>ceil($sum/$lim))
        {
          $s=1;
        }
        if($request->rowCount()){
         ?>
         <h3 class="tile-title">Yazı axtarışının nəticələri (<?php echo $sum;?>)</h3>
         <div class="table-responsive table-hover">
          <table class="table">
            <thead>
              <tr>
                <th>İD</th>
                <th>ŞƏKİL</th>
                <th>BAŞLIQ</th>
                <th>KATEQORİYA</th>
                <th>TARİX</th>
                <th>STATUS</th>
                <th>ƏMƏLİYYATLAR</th>
              </tr>
            </thead>
            <tbody>
             <?php foreach($request as $row){ ?>
               <tr>
                <td><?php echo $row['text_id']; ?></td>
                <td><img src="../images/<?php echo $row['text_image'];?>" alt="" width="100px" height="100px" class="img-responsive"></td>
                <td><?php echo $row['text_title']; ?></td>
                <td><?php echo $row['cat_name'];?></td>
                <td><?php echo date('d.m.Y',strtotime($row['text_date']));?></td>
                <td>
                  <?php echo $row['text_status']==1 ? '<div style="color:green;font-weight:bold;">Aktiv</div>' : '<div style="color:red;font-weight:bold;">Passiv</div>' ?>
                </td>
                <td><a href="<?php echo $administrator."/operation.php?operation=subject_update&text_id=".$row['text_id'];?>"><i class="fa fa-edit"></i></a> | <a onclick="return confirm('Təsdiqləyirsiniz ?');" href="<?php echo $administrator."/operation.php?operation=subject_delete&text_id=".$row['text_id'];?>"><i class="fa fa-eraser"></i></a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <ul class="pagination">
         <?php 
              if($sum>$lim)
              {
                 pagination($s,ceil($sum/$lim),'textsearch.php?search='.$search.'&s=');
              }
          ?>
      </ul>
    <?php } else{
     echo '<div class="alert alert-danger">Axtarılan başlığa uyğun yazı tapılmadı</div>';
   } ?>
 </div>
</div>
</div>
</main>
<?php require_once 'inc/footer.php'; ?>