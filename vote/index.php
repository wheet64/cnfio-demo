<?php

  if ((empty($_POST['q']) && empty($_POST['d'])) || empty($_COOKIE['u']))
    die();

  require_once($_SERVER['DOCUMENT_ROOT'].'/cnfio-demo/_/inc/controller.php');
  require_once($_SERVER['DOCUMENT_ROOT'].'/cnfio-demo/_/inc/vendor/autoload.php');

  use Kreait\Firebase\Factory;
  use Kreait\Firebase\ServiceAccount;

  // This assumes that you have placed the Firebase credentials in the same directory
  // as this PHP file.
  $serviceAccount = ServiceAccount::fromJsonFile($_SERVER['DOCUMENT_ROOT'].'/cnfio-demo/auth/conf-demo-8540f-firebase-adminsdk-ip9iw-11c984a07b.json');

  $firebase = (new Factory)
      ->withServiceAccount($serviceAccount)
      // The following line is optional if the project id in your credentials file
      // is identical to the subdomain of your Firebase project. If you need it,
      // make sure to replace the URL with the URL of your project.
      ->withDatabaseUri('https://conf-demo-8540f.firebaseio.com')
      ->create();

  $database = $firebase->getDatabase();

  if (!empty($_POST['q'])) {
    if ($database->getReference(FB_DB)->getSnapshot()->hasChild(trim($_POST['q']))) {
      // TODO: verify that the uid from the cookie exists in the MySQL DB
      if (!$database->getReference(FB_DB)->getSnapshot()->getChild(trim($_POST['q']))->getChild('votes')->hasChild($_COOKIE['u'])) {
        $votecnt = $database->getReference(FB_DB)->getSnapshot()->getChild(trim($_POST['q']))->getChild('vote_count')->getValue();
        $votecnt = is_numeric($votecnt) ? $votecnt+1 : 1;
        $database->getReference(FB_DB)->getChild(trim($_POST['q']))->getChild('vote_count')->set($votecnt);
        $database->getReference(FB_DB)->getChild(trim($_POST['q']))->getChild('votes')->getChild($_COOKIE['u'])->set(1);
      }
    }
  }
  if (!empty($_POST['d'])) {
    if ($database->getReference(FB_DB)->getSnapshot()->hasChild(trim($_POST['d']))) {
      // TODO: verify that the uid from the cookie exists in the MySQL DB
      if ($_SESSION['mod_access'] == 'mod') {
        $database->getReference(FB_DB)->getChild(trim($_POST['d']))->remove();
      }
    }
  }


?>
