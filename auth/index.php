<?php

  require_once($_SERVER['DOCUMENT_ROOT']. '/cnfio-demo/_/inc/controller.php');
  require_once($_SERVER['DOCUMENT_ROOT']. '/cnfio-demo/_/inc/vendor/autoload.php');

  use Kreait\Firebase\Factory;
  use Kreait\Firebase\ServiceAccount;

  // This assumes that you have placed the Firebase credentials in the same directory
  // as this PHP file.
  $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/conf-demo-8540f-firebase-adminsdk-ip9iw-11c984a07b.json');

  $firebase = (new Factory)
      ->withServiceAccount($serviceAccount)
      // The following line is optional if the project id in your credentials file
      // is identical to the subdomain of your Firebase project. If you need it,
      // make sure to replace the URL with the URL of your project.
      ->withDatabaseUri('https://conf-demo-8540f.firebaseio.com')
      ->create();

  $database = $firebase->getDatabase();

  if (empty($_COOKIE['u'])) {
    if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email'])) {
      // Using uniqueid() is not ideal, however it'll be fine for this demo.
      $uid = uniqid();
      $stmt = $db->prepare("INSERT INTO users (uid, firstName, lastName, email) VALUES (?, ?, ?, ?)");
      $stmt->bind_param('ssss', $uid, $_POST['firstName'], $_POST['lastName'], $_POST['email']);
      if ($stmt->execute()) {
        $customToken = $firebase->getAuth()->createCustomToken($uid);
        // Using false as domain for localhost
        setcookie('u', $uid, time() + (10 * 365 * 24 * 60 * 60), '/', false, false); // 10 year cookie
        die(json_encode(['success'=>'true', 'message'=>$customToken]));
      }
      $stmt->close();
    }
    else {
      die(json_encode(['success'=>'false', 'message'=>'All fields are required.']));
    }
  }
  else {
    //die('moo: '.$db->query("SELECT uid FROM users WHERE uid='5cc0963b2342c'")->num_rows);
    if ($stmt = $db->prepare("SELECT uid FROM users WHERE uid=?")) {
      $stmt->bind_param('s', $_COOKIE['u']);
      if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows) {
          if (!empty($_POST['question'])) {
            // Will override the 'by' if another user created the same question.
            die('moose:' . $database->getReference(FB_DB)->getChild(trim($_POST['question']))->set(['by'=>$_COOKIE['u']]));
          }
          else {
            $customToken = $firebase->getAuth()->createCustomToken($_COOKIE['u']);
            die(json_encode(['success'=>'true', 'message'=>$customToken]));
          }
        }
      }
      $stmt->close();
    }
  }
?>
