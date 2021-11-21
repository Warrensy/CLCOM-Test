<?php
session_start();

require_once('config/dbaccess.php');
require_once('model/user.class.php');
require_once('utility/db.class.php');
require_once('utility/mempty.func.php');
require_once('model/post.class.php');
require_once('model/comments.class.php');



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$action = $_GET['action'] ?? 'registerForm';
$task = $_GET['task'] ?? '';

if ($action == 'login' && isset($_POST["username"], $_POST["password"])) {
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    if ($conn->loginUser($username, $password)) {
        $message = "<div class=\"alert alert-success\" role=\"alert\">Erfolgreich angemeldet!</div>";
        $folder = "pics/";
    } else {
        $message = "<div class=\"alert alert-danger\" role=\"alert\">Anmeldung fehlgeschlagen!</div>";
    }
} else if ($action == "logout") {
    unset($_SESSION["userId"]);
    $message = "<div class=\"alert alert-success\" role=\"alert\">Erfolgreich abgemeldet!</div>";
}
$userId = $_SESSION["userId"] ?? false;
if ($userId != false) {
    $user = $conn->getUserById($userId);
    if (!$user) $userId = false;
}
$folder = "pics/";
?>
<!DOCTYPE html>
<html lang="de">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Social Network - FH Technikum Wien</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@5.8.55/css/materialdesignicons.min.css"/>
    <link rel="stylesheet" href="res/css/imageForm.css"/>
    <link rel="stylesheet" href="res/shards/css/shards.css">
    <link rel="stylesheet" href="res/shards/css/shards-extras.css">
    <link rel="stylesheet" href="res/css/stickyFooter.css">


</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
        <a class="navbar-brand" href="index.php?action=posts">Social Network</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <?php if ($userId == false) { ?>
                    <li class="nav-item <?= ($action == 'login' ? 'active' : '') ?>">
                        <a class="nav-link" href="index.php?action=login">Login</a>
                    </li>
                    <li class="nav-item <?= ($action == 'register' ? 'active' : '') ?>">
                        <a class="nav-link" href="index.php?action=register">Register</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item <?= ($action == 'friendList' ? 'active' : '') ?>">
                        <a class="nav-link" href="index.php?action=friendList">Friend List</a>
                    </li>
                    <li class="nav-item <?= ($action == 'userList' ? 'active' : '') ?>">
                        <a class="nav-link" href="index.php?action=userList">User List</a>
                    </li>
                    <li class="nav-item <?= ($action == 'editprofile' ? 'active' : '') ?>">
                        <a class="nav-link" href="index.php?action=editprofile">Edit Profile</a>
                    </li>
                    <?php if ($user->getAdminRights() == true) { ?>
                        <li class="nav-item <?= ($action == 'administration' ? 'active' : '') ?>">
                            <a class="nav-link" href="index.php?action=administration">Administration</a>
                        </li>
                    <?php } ?>
                    <!--dont forget to fix the action destination-->
                    <li class="nav-item mt-0 <?= ($action == 'profile' ? 'active' : '') ?>">
                        <a href="index.php?action=profile" class="nav-link" href="#"><img class="myImgSmall"
                                                          src="<?= $folder . $user->getprofilePicture(); ?>"
                                                          alt="<?= $folder . $user->getprofilePicture(); ?>"> <?= $user->getUsername(); ?>
                        </a>
                    </li>
                    <li class="nav-item mt-1 <?= ($action == 'logout' ? 'active' : '') ?>">
                        <a class="nav-link btn btn-outline-primary" href="index.php?action=logout">Logout</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
</nav>

<main class="pb-2">
    <div class="container">
        <?php
        switch ($action) {
            default:
            case 'login':
                include('inc/login.php');
                break;
            case 'register':
                include('inc/register.php');
                break;
            case 'profile':
                include('inc/profile.php');
                break;
            case 'editprofile':
                include('inc/editprofile.php');
                break;
            case 'administration':
                include('inc/administration.php');
                break;
            case 'friendList':
                include('inc/friendList.php');
                break;
            case 'help':
                include('inc/help.php');
                break;
            case 'impressum':
                include('inc/impressum.php');
                break;
            case 'userList':
                include('inc/userList.php');
                break;
            case 'posts':
                include('inc/createPost.php');
                break;
            case 'editpost.php':
                include('inc/editpost.php');
                break;
        }
        ?>
    </div>
</main>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-6">
                © 2020 Copyright:
            </div>
            <div class="col-6 text-right">
                <a class="text-dark p-4" href="index.php?action=help">Help</a>
                <a class="text-dark" href="index.php?action=impressum">Impressum</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="res/shards/js/shards.js"></script>

</body>
</html>