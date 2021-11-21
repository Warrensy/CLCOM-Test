<?php
$search = $_POST['search'] ?? '';
if (isset($_GET['id'])) {
    $conn->friendRequest($userId, $_GET['id']);
}
$users = $conn->getUserList($search.'%');
$folder = "pics/"
?>
<form method="POST" action="index.php?action=userList">
<div class="row pt-3 pb-3">
    <div class="col-12">
        <h1>User List</h1>
    </div>
    <div class="col-10">
        <input id="search" name="search" placeholder="Search by Username" class="form-control here" type="text" />
    </div>
    <div class="col-2">
        <button for="search" type="submit" class="btn btn-outline-primary btn-block">Search</button>
    </div>
</div>
</form>
<div class="row mb-4">
        <?php
        foreach ($users as $userObj) 
        {
            $filename = $userObj->getprofilePicture();
            $active = $userObj->getActive();
            $friends = $conn->getFriends($userId);
            if ($active == 0) {
                continue;
            } 
            else if($userObj->getId() == $userId)
            {
                continue;
            }
            else 
            { ?>
                <div class="col-3 mb-3" id="<?= $userObj->getId() ?>">
                    <div class="card">
                        <img src="<?= $folder . $filename ?>" alt="<?= $folder . $filename ?>" class="card-img-top myImgSquare w-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= $userObj->getUsername(); ?><?= $userObj->getAdminRights() ? ' <i class="mdi mdi-crown"></i>' : '' ?></h5>
                            <p class="card-text">
                                <?= $userObj->getVorname(); ?><br/>
                                <?= $userObj->getNachname(); ?>
                            </p>
                            <?php
                            if(in_array($userObj,$friends) == false)
                            { ?>
                                <a href="index.php?action=userList&id=<?= $userObj->getId() ?>#<?= $userObj->getId() ?>" class="btn btn-outline-primary btn-block">Send Friend Request</a>
<?php                       }
                            else
                            { ?>
                            <div>
                                <a class="btn btn-primary btn-sm" href="#">Open Chat</a>
                                <a class="btn btn-secondary btn-sm" href="index.php?action=profile&id=<?= $userObj->getId() ?>">Go To Profile</a>
                            </div>
<?php                       } ?>
                        </div>
                    </div>
                </div>
            <?php }
        } ?>
</div>
        