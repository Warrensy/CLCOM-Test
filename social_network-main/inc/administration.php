<?php 
$task = $_GET['task'] ?? '';

if(!$user->getAdminRights()) return;
if($task == 'activate')
{
    $conn->changeStatus($_GET['id'], 1);
}
if($task == 'disable')
{
    $conn->changeStatus($_GET['id'], 0);
}
 
$users = $conn->getUserList();
$folder = "pics/"
?>
<div class="row pt-3 pb-3">
    <div class="col-12">
        <h1>Administration</h1>
    </div>
</div>
<div class="row mb-4">
    <?php
    foreach($users as $userObj) 
    {
        $posts = $conn->getPostListById($userObj->getId());
        $filename = $userObj->getprofilePicture();
        $active = $userObj->getActive();
        if($active == 0)
        { ?>
            <div class="col-3 mb-3">
                <div class="card" style="opacity: 0.3">
                    <img src="<?=$folder.$filename?>" alt="<?=$folder.$filename?>" class="card-img-top myImgSquare w-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= $userObj->getUsername(); ?><?= $userObj->getAdminRights() ? ' <i class="mdi mdi-crown"></i>' : '' ?></h5>
                        <p class="card-text">
                            <?= $userObj->getAnrede(); ?> <br />
                            <?= $userObj->getVorname(); ?> <br />
                            <?= $userObj->getNachname(); ?>
                        </p>
                        <div><a href="index.php?action=administration&task=activate&id=<?= $userObj->getId() ?>"  class="btn btn-outline-primary btn-block">Activate Account</a></div>
                        <div><a class="btn btn-outline-light" data-toggle="collapse" data-target="#post<?= $userObj->getId()?>" role="button" aria-expanded="false" aria-controls="post<?=$userObj->getId()?>">Post List</a></div>
                    </div>
                </div>
            </div>
            <div class="collapse multi-collapse" id="post<?=$userObj->getId()?>">
                <div class="card card-body">
                    <?php
                    if(count($posts) != 0)
                    {
                        echo '<table>
                            <tr>
                                <th>#</th>
                                <th class="text-center">User ID</th>
                                <th class="text-center">Tags</th>
                                <th class="text-center">Image Path</th>
                                <th class="text-center">Private</th>
                                <th class="text-center">Date</th>
                            </tr>';
                            foreach ($posts as $postObj) 
                            { ?>
                                <tr>
                                    <th><?= $postObj->getId() ?></th>
                                    <td class="text-center"><?= $postObj->getUserId(); ?></td>
                                    <td class="text-center"><?= $postObj->getTags(); ?></td>
                                    <td class="text-center"><?= $postObj->getImagePath(); ?></td>
                                    <td class="text-center"><?= $postObj->getPrivate(); ?></td>
                                    <td class="text-center"><?= $postObj->getDate(); ?></td>
                                </tr>
                    <?php   }
                        echo '</table>';
                    }
                    else
                    {
                        echo 'NO POSTS';
                    } ?>
                </div>
            </div>
<?php   }
        else
        { ?>
            <div class="col-3 mb-3">
                <div class="card">
                    <img src="<?=$folder.$filename?>" alt="<?=$folder.$filename?>" class="card-img-top myImgSquare w-100">
                    <div class="card-body">
                        <h5 class="card-title"><?=$userObj->getUsername(); ?><?=$userObj->getAdminRights() ? ' <i class="mdi mdi-crown"></i>' : '' ?></h5>
                        <p class="card-text">
                            <?= $userObj->getAnrede(); ?> <br />
                            <?= $userObj->getVorname(); ?> <br />
                            <?= $userObj->getNachname(); ?>
                        </p>
                        <div><a href="index.php?action=administration&task=disable&id=<?=$userObj->getId()?>"  class="btn btn-outline-primary btn-block">Disable Account</a></div>
                        <div><a class="btn btn-outline-light" data-toggle="collapse" data-target="#post<?=$userObj->getId()?>" role="button" aria-expanded="false" aria-controls="post<?= $userObj->getId() ?>">Post List</a></div>
                    </div>
                </div>
            </div>
            <div class="collapse multi-collapse" id="post<?=$userObj->getId()?>">
                <div class="card card-body">
                <?php
                    if(count($posts) != 0)
                    {
                        echo '<table>
                            <tr>
                                <th>#</th>
                                <th class="text-center">User ID</th>
                                <th class="text-center">Tags</th>
                                <th class="text-center">Image Path</th>
                                <th class="text-center">Private</th>
                                <th class="text-center">Date</th>
                            </tr>';
                            foreach ($posts as $postObj) 
                            { ?>
                                <tr>
                                    <th><?= $postObj->getId() ?></th>
                                    <td class="text-center"><?= $postObj->getUserId(); ?></td>
                                    <td class="text-center"><?= $postObj->getTags(); ?></td>
                                    <td class="text-center"><?= $postObj->getImagePath(); ?></td>
                                    <td class="text-center"><?= $postObj->getPrivate(); ?></td>
                                    <td class="text-center"><?= $postObj->getDate(); ?></td>
                                </tr>
                                <?php
                            } 
                        echo '</table>';
                    }
                    else
                    {
                        echo 'NO POSTS';
                    } ?>
                </div>
            </div>
<?php   }
    } ?>
</div>