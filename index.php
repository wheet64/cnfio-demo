<?php
  require_once($_SERVER['DOCUMENT_ROOT']. '/cnfio-demo/_/inc/controller.php');
  controller::header(['nav'=>'home']);
?>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Social Q&amp;A</h5>
    <h6 class="card-subtitle text-muted">Vote by clicking / tapping the number.</h6>
    <ul id="questions" class="list-group mt-3">
    </ul>
  </div>
</div>
<p class="mt-5">
  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#askQuestion" aria-expanded="false" aria-controls="askQuestion">
    Ask Question
  </button>
</p>
<form method="POST" action="auth/" id="auth">
  <div class="collapse" id="askQuestion">
    <div id="identification" style="display:none;">
      <div class="form-group">
        <label for="firstName">First name</label>
        <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" />
      </div>
      <div class="form-group">
        <label for="lastName">Last name</label>
        <input type="text" class="form-control" name="lastName" id="lastName" placeholder="" />
      </div>
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="" />
      </div>
    </div>
    <div id="question_grp" style="display:none;">
      <div class="form-group">
        <label for="question">Question</label>
        <input type="text" class="form-control" name="question" id="question" placeholder="" />
      </div>
    </div>
    <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
  </div>
</form>
<?php
  controller::footer();
?>
