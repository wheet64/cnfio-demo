<?php
  require_once($_SERVER['DOCUMENT_ROOT']. '/cnfio-demo/_/inc/controller.php');
  if (empty($_COOKIE['u']))
    die(header('Location: '.APP_BASE.'/'));
  controller::header(['nav'=>'mod', 'title'=>'Login']);
?>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Enter Moderation Password</h5>
    <form method="POST" id="mod">
      <div class="form-group">
        <label for="firstName">Moderator Password</label>
        <input type="password" class="form-control" name="mod_password" id="mod_password" placeholder="" />
      </div>
      <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
      <button type="button" class="btn btn-lg btn-block" style="background-color:gray;color:#fff;" onclick="document.location.href='<?=htmlspecialchars(APP_BASE).'/'?>';">Cancel and go back</button>
    </form>
  </div>
</div>
<?php
  controller::footer();
?>
