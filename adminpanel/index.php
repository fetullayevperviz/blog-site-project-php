<?php 
define('security', true);
require_once 'inc/header.php'; ?>

<!-- Sidebar menu-->
<?php require_once 'inc/sidebar.php'; ?>


<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i> Admin Panel</h1>
      <p>Blog Site | Admin Panel</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Ana Səhifə</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-6 col-lg-3">
      <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
        <div class="info">
          <h4>Abunələr</h4>
          <p><b><?php echo num('sub');?></b></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="widget-small info coloured-icon"><i class="icon fa fa-comment fa-3x"></i>
        <div class="info">
          <h4>Rəylər</h4>
          <p><b><?php echo num('comments');?></b></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
        <div class="info">
          <h4>Yazılar</h4>
          <p><b><?php echo num('articles');?></b></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="widget-small danger coloured-icon"><i class="icon fa fa-envelope fa-3x"></i>
        <div class="info">
          <h4>Mesajlar</h4>
          <p><b><?php echo num('messages');?></b></p>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="tile">
        <h3 class="tile-title">Son 10 Mesaj</h3>
        <?php 
        $last_messages=$db->prepare("SELECT * FROM messages WHERE status=:status ORDER BY id DESC LIMIT :lim");
        $last_messages->bindValue(":status",(int) 2, PDO::PARAM_INT);
        $last_messages->bindValue(":lim",(int) 10, PDO::PARAM_INT);
        $last_messages->execute();
        if($last_messages->rowCount())
        {
          ?>
          <div class="table-responsive table-hover">
            <table class="table">
              <thead>
                <tr>
                  <th>İD</th>
                  <th>AD</th>
                  <th>MÖVZU</th>
                  <th>TARİX</th>
                  <th>ƏMƏLİYYATLAR</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($last_messages as $last){ ?>
                      <tr>
                        <td><?php echo $last['id']; ?></td>
                        <td><?php echo $last['name']; ?></td>
                        <td><?php echo $last['subject']; ?></td>
                        <td><?php echo date('d.m.Y',strtotime($last['m_date']));?></td>
                        <td><a href="<?php echo $administrator;?>/operation.php?operation=mesagge_read&id=<?php echo $last['id'];?>"><i class="fa fa-eye"></i></a></td>
                      </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <?php
        }
        else
        {
          echo '<div class="alert alert-danger">Mesaj yoxdur</div>';
        }
        ?>
      </div>
    </div>
      <div class="col-md-6">
      <div class="tile">
        <h3 class="tile-title">Son 10 Rəy</h3>
        <?php 
        $last_comments=$db->prepare("SELECT * FROM comments INNER JOIN articles ON articles.text_id=comments.com_text_id WHERE com_status=:com_status ORDER BY id DESC LIMIT :lim");
        $last_comments->bindValue(":com_status",(int) 2, PDO::PARAM_INT);
        $last_comments->bindValue(":lim",(int) 10, PDO::PARAM_INT);
        $last_comments->execute();
        if($last_comments->rowCount())
        {
          ?>
          <div class="table-responsive table-hover">
            <table class="table">
              <thead>
                <tr>
                  <th>İD</th>
                  <th>AD</th>
                  <th>YAZI</th>
                  <th>TARİX</th>
                  <th>ƏMƏLİYYATLAR</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($last_comments as $last){ ?>
                      <tr>
                        <td><?php echo $last['id']; ?></td>
                        <td><?php echo $last['com_name']; ?></td>
                        <td><?php echo $last['text_title']; ?></td>
                        <td><?php echo date('d.m.Y',strtotime($last['com_date']));?></td>
                        <td><a href="<?php echo $administrator;?>/operation.php?operation=comment_read&id=<?php echo $last['id'];?>"><i class="fa fa-eye"></i></a></td>
                      </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <?php
        }
        else
        {
          echo '<div class="alert alert-danger">Rəy yoxdur</div>';
        }
        ?>
      </div>
    </div>
  </div>
</main>


<?php require_once 'inc/footer.php'; ?>