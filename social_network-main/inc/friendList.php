<?php
$task = $_GET['task'] ?? '';
if ($task == 'accept') 
{
    $conn->setAccept($userId, $_GET['id']);
}
if ($task == 'remove')
{
    $conn->removeFriend($userId, $_GET['id']);
}
?>
<div class="row pt-3 pb-3">
    <div class="col-12">
        <h1>Friends List</h1>
    </div>
</div>
<div class="row mb-4">
    <?php
    $users = $conn->getFriendRequest($userId);
    $folder = "pics/";
    foreach ($users as $userObj) {
        //$filename = $userObj->getprofilePicture();

        ?>
        <div class="col-3 mb-3">
            <div class="card mb-3">
                <!--TO-DO: Anfragen in eine collapse feld geben. Weniger aufdringlich gestalten.-->

                <div class="row">
                    <div class="col-md-6">
                        <img class="myImgRound" src="<?= $folder . $userObj->getprofilePicture(); ?>"
                             alt="<?= $folder . $userObj->getprofilePicture(); ?>">
                    </div>
                    <div class="col-md-6">
                        <h5 class="card-title"><?= $userObj->getUsername() ?></h5>
                        <a href="index.php?action=friendList&task=accept&id=<?= $userObj->getId() ?>"
                           class="btn btn-primary p-2">Accept</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>

<div class="row">
    <?php
    $users = $conn->getFriends($userId);
    foreach ($users as $userObj) {
        $filename = $userObj->getprofilePicture();
        $active = $userObj->getActive();
        if ($active == 0) {
            continue;
        } else { ?>
            <div class="col-3 mb-3">
                <div class="card">
                    <img src="<?= $folder . $filename ?>" alt="<?= $folder . $filename ?>" class="card-img-top myImgSquare w-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= $userObj->getUsername(); ?><?= $userObj->getAdminRights() ? ' <i class="mdi mdi-crown"></i>' : '' ?></h5>
                        <p class="card-text">
                            <?= $userObj->getVorname(); ?>
                            <?= $userObj->getNachname(); ?>
                            <div>
                                <a class="btn btn-primary btn-sm p-1" href="#">Open Chat</a>
                                <a class="btn btn-secondary btn-sm p-1" href="#">Go To Profile</a>
                            </div>
                            <div>
                                <a class="text-danger" href="index.php?action=friendList&task=remove&id=<?= $userObj->getId(); ?>">Remove Friend</a>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        <?php }
    } ?>
</div>