<?php
use Jasny\SSO\NotAttachedException;
require_once __DIR__ . '/../../vendor/autoload.php';

$broker = new Jasny\SSO\Broker(getenv('SSO_SERVER'), getenv('SSO_BROKER_ID'), getenv('SSO_BROKER_SECRET'));
$broker->attach(true);

try {
    if (!empty($_GET['logout'])) {
        $broker->logout();
    } elseif ($broker->getUserInfo() || ($_SERVER['REQUEST_METHOD'] == 'POST' && $broker->login($_POST['username'], $_POST['password']))) {
        header("Location: index.php", true, 303);
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') $errmsg = "Login failed";
} catch (NotAttachedException $e) {
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
} catch (Jasny\SSO\Exception $e) {
    $errmsg = $e->getMessage();
}

?>
<!doctype html>
<html>
    <head>
        <title><?= $broker->broker ?> | Login (Single Sign-On demo)</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

        <style>
            h1 {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1><?= $broker->broker ?> <small>(Single Sign-On demo)</small></h1>

            <?php if (isset($errmsg)): ?><div class="alert alert-danger"><?= $errmsg ?></div><?php endif; ?>

            <form class="form-horizontal" action="login.php" method="post">
                <div class="form-group">
                    <label for="inputUsername" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" class="form-control" id="inputUsername">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="inputPassword">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Login</button>
                    </div>
                </div>

                <div class="form-group">
                  <a href="<?= 'https://accounts.google.com/o/oauth2/auth?scope=' .
                  urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email
                  https://www.googleapis.com/auth/plus.me') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) .
                  '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online' ?>">Login with Google</a>
                </div>

            </form>
        </div>
    </body>
</html>
