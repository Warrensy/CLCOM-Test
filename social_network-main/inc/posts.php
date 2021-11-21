<!--Header-->
<?php

if($userId != false)
{
    $users = $conn->getFriends($userId);
    error_reporting(E_ALL);

    //Comment logic
    if (isset($_POST['submit']) && $_POST['submit'] == 'comment') {

        //Comment Upload
        $data = array();

        $data['comment_text'] = $_POST['comment_text'];
        //UserId from Session
        $data['user_id'] = $userId;
        $data['post_id'] = $_POST['post_id'];
        $commentObj = new Comments();

        if (mempty($data['comment_text'], $data['user_id'])) {
            $message = "<div class=\"alert alert-danger\" role=\"alert\">Bitte alle Felder ausfüllen.</div>";
        } else if (!$commentObj->setCommenttext($data['comment_text'])) {
            $message = "<div class=\"alert alert-danger\" role=\"alert\">Fügen Sie einen Kommentar hinzu.</div>";
        } else if (!$commentObj->setUserId($data['user_id'])) {
            $message = "<div class=\"alert alert-danger\" role=\"alert\">Bitte loggen Sie sich wieder ein.</div>";
        } else if (!$commentObj->setPostId($data['post_id'])) {
            $message = "<div class=\"alert alert-danger\" role=\"alert\">Etwas ist schiefgelaufen bitte versuchen sie es erneut.</div>";
        } else {
            if ($conn->createComment($commentObj)) 
            {
                $data = array();
                $message = '<div class="alert alert-success" role="alert">Kommentar erfolgreich hinzugefügt.</div>';
            } 
            else 
            {
                $message = '<div class="alert alert-danger" role="alert">Es ist ein Fehler aufgetreten: ' . $conn->error . '</div>';
            }
        }
    }
    //Likes and Dislikes logic
    if (isset($_GET['like_post_id'])) {
        $post = $conn->getPostById($_GET['like_post_id']);
        $post->setLikes($post->getLikes() + 1);
        $conn->updatePost($post);
        header('Location: index.php?action=createPost');
    }

    if (isset($_GET['dislike_post_id'])) {
        $post = $conn->getPostById($_GET['dislike_post_id']);
        $post->setDislikes($post->getDislikes() + 1);
        $conn->updatePost($post);
        header('Location: index.php?action=createPost');
    }

}

if (isset($_GET['search_term'])) 
{
    $search = $_GET['search_term'];

    //connect to DB
    $posts = $conn->search_posts($search);

    //Number of result in DB
    $found = sizeof($posts);

    if ($found==0)
    {
        echo "Search for '<strong>$search</strong>' was successfull.";
    }
}

if (isset($_GET['tagFilter'])) 
{
    $posts = $conn->searchPostsByTag($_GET['tagFilter']);
}
if(isset($_GET['search_term']))
            {
                $posts = $conn->search_posts($_GET['search_term']);
            } ?>            
    <div class="row mb-3 mt-3">
    <div class="col-8">
<?php
if($userId != false)
{
?>

        <div id="accordion">
            <div class="card noShadow mb-4 border border-primary">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link text-dark" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                            <strong>Add new post</strong>
                        </button>
                    </h5>
                </div>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">What's happening?</label>
                                <textarea class="form-control" id="message" rows="3" name="message"
                                          maxlength="400"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <input type="file" accept="image/png, image/jpeg, image/jpg" name="pickedFile"
                                               class="btn btn-light" id="pickedFile"
                                               value="<?= $data['pickedFile'] ?? '' ?>">
                                    </div>
                                    <div class="col-3">
                                    </div>
                                    <div class="col-3">
                                        <select class="form-control" id="visibility" name="visibility">
                                            <option value="0">Public</option>
                                            <option value="1">Privat</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="hashtags">Tags</label>
                                    <input type="text" class="form-control" id="hashtags"
                                           placeholder="e.g.:#summer,#2021,..."
                                           name="tags">
                                </div>
                                <button class="form-control" type="submit" name="submit"> Add New Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
} ?>
        <h1 class="mb-3">Beiträge</h1>
        <?php
        // Posts listing
        if (!isset($_GET['tagFilter']) && !isset($_GET['search_term'])) 
        {
            $posts = $conn->getPostList();
        }
        foreach ($posts as $postObj) 
        {
            
            if ($postObj->getPrivate() == '0' || $postObj->getUserId() == $userId  ||($postObj->getPrivate() == '1' && $conn->getAccept($postObj->getUserId(), $userId) === 1)) 
            {
                echo '<div class="card mb-4">';
                        if($postObj->getImagePath() == 'public/posts/')
                        {
                            $imgPath = 'public/posts/defaultPostPicture.png';
                        }
                        else
                        {
                            $imgPath = $postObj->getImagePath();
                        }

                    echo    '<img class="card-img-top myImgPost" src="' . $imgPath . '" alt="Picture Not Found">
                                <div class="card-body">
                                    <div class="card-text">
                                        <div class="row mb-3">
                                            <div class="col-3 border-right">
                                                <small>Date: ' . $postObj->getDate() . '</small>
                                            </div>
                                            <div class="col-3 border-right">
                                                <small>Author: ' . $conn->getUserById($postObj->getUserId())->getUsername() . ' </small>
                                            </div>
                                            <div class="col-3 border-right">    
                                                <a href="index.php?action=createPost&like_post_id=' . $postObj->getId() . ' ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                                        <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                                                    </svg>
                                                </a>' . $postObj->getLikes() . ' 
                                                <a href="index.php?action=createPost&dislike_post_id=' . $postObj->getId() . ' ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-down" viewBox="0 0 16 16">
                                                        <path d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856 0 .289-.036.586-.113.856-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a9.877 9.877 0 0 1-.443-.05 9.364 9.364 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964l-.261.065zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a8.912 8.912 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581 0-.211-.027-.414-.075-.581-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.224 2.224 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.866.866 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1z"/>
                                                    </svg>
                                                </a> ' . $postObj->getDislikes() . '
                                                
                                            </div>
                                            <div class="col-3">
                                                <small>Privat  ' . $postObj->getPrivate() . ' </small>
                                            </div>
                                        </div>
                                    </div>
                                <!--Post text display-->
                                <h4 class="card-title"></h4>
                                <p class="card-text">
                                    ' . $postObj->getPostText() . '
                                </p>
                                <!--Tag list display-->
                                <div class="card mb-3 noShadow">
                                    <div class="card-body bg-light rounded">';
                                        $tags = explode(',', $postObj->getTags());
                                            foreach ($tags as $tag) 
                                            {
                                                $singleTag = explode('#', $tag);
                                                if(count($singleTag) >= 2)
                                                {
                                                    echo '<a href="index.php?action=createPost&tagFilter=' . $singleTag[1] . '">' . $tag . '</a>';
                                                } 
                                            }
                    echo            '</div>
                                </div>
                                   <!--Comments Form-->
                                    <h5 class="card-title">Comments</h5>
                                        <form method="post">
                                            <div class="card noShadow border border-light mb-3">
                                                <div class="card-body">
                                                    <textarea class="form-control" id="message" rows="2" name="comment_text" maxlength="400"></textarea> <br />
                                                    <!--Hidden field for fetching post id -->
                                                     <input type="hidden" id="postId" name="post_id" value="'.$postObj->getId().'">
                                                    <button class="form-control" type="submit" name="submit" value="comment"> Add New Comment</button>
                                                </div>
                                            </div>
                                        </form>';
                // Fetch and display comments
                $comments = $conn->getCommentsByPostId($postObj->getId());
                foreach ($comments as $comment) {
                    echo '<div class="card mb-3 noShadow">
                                <div class="card-body bg-light rounded">
                                    <p><strong>'. $conn->getUserById($comment->getUserId())->getUsername() . '</strong></p>
                                    <p>' . $comment->getCommenttext() . '</p>
                                </div>
                            </div>';
                }
                echo '</div>
                    </div>';
            }
        }
        ?>

    </div>
    <div class="col-4">
        <h1>Filters / Sorters</h1>

        <!-- Search Engine -->
        <form name="form1" method="get">
            <div class="form-group">
                <label for="search">Search</label>
                <input type="text" class="form-control" id="search" placeholder="Search term..." name="search_term">
                <input type="submit" value="Search">
            </div> 
        </form>
    </div>
</div>