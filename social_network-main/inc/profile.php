<?php
error_reporting(E_ALL);

//Comment logic
if (isset($_POST['comment_text'])) {

    //Comment Upload
    $data = array();

    $data['comment_text'] = $_POST['comment_text'];
    //UserId from Session
    $data['user_id'] = $userId;
    $commentObj = new Comments();

    if (mempty($data['comment_text'], $data['user_id'])) {
        $message = "<div class=\"alert alert-danger\" role=\"alert\">Bitte alle Felder ausfüllen.</div>";
    } else if (!$commentObj->setCommenttext($data['comment_text'])) {
        $message = "<div class=\"alert alert-danger\" role=\"alert\">Fügen Sie einen Kommentar hinzu.</div>";
    } else if (!$commentObj->setUserId($data['user_id'])) {
        $message = "<div class=\"alert alert-danger\" role=\"alert\">Bitte loggen Sie sich wieder ein.</div>";
    } else {
        if ($conn->createComment($commentObj)) {
            $data = array();
            $message = '<div class="alert alert-success" role="alert">Kommentar erfolgreich hinzugefügt.</div>';
        } else {
            $message = '<div class="alert alert-danger" role="alert">Es ist ein Fehler aufgetreten: ' . $conn->error . '</div>';
        }
    }
}
//Likes and Dislikes logic
if (isset($_GET['likePostId'])) {
    $post = $conn->getPostById($_GET['likePostId']);
    $post->setLikes($post->getLikes() + 1);
    $conn->updatePost($post);
    header('Location: index.php?action=createPost');
}

if (isset($_GET['dislikePostId'])) {
    $post = $conn->getPostById($_GET['dislikePostId']);
    $post->setDislikes($post->getDislikes() + 1);
    $conn->updatePost($post);
    header('Location: index.php?action=createPost');
}

if (isset($_GET['deletePostId'])) {
    $conn->deletePost($_GET['deletePostId'], $userId);
    header('Location: index.php?action=profile');
}
?>

<div class="row mb-3 mt-3">
    <div class="col-8">
        <h1 class="mb-3">Your Posts</h1>

        <?php
        // Posts listing
        $posts = $conn->getPostListById($userId);
        foreach ($posts as $postObj) 
        {
    echo    '<div class="card mb-4">
                <a class="text-alert" href="index.php?action=profile&deletePostId='.$postObj->getId().'">Delete this post</a>
                <img class="card-img-top" src=' . $postObj->getImagePath() . ' alt="Picture Not Found">
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
                                    <a href="index.php?action=createPost&likePostId=' . $postObj->getId() . ' "></a>' . $postObj->getLikes() . ' 
                                    <a href="index.php?action=createPost&dislikePostId=' . $postObj->getId() . ' "></a> ' . $postObj->getDislikes() . '
                                    
                                </div>
                                <div class="col-3">
                                    <small>Public ' . $postObj->getPrivate() . ' </small>
                                </div>
                            </div>
                        </div>
                        <!--Post text display-->
                        <h4 class="card-title"></h4>
                        <p class="card-text">' . $postObj->getPostText() . '</p>
                        <!--Tag list display-->
                        <div class="card mb-3 noShadow">
                            <div class="card-body bg-light rounded">';
                                $tags = explode(',', $postObj->getTags());
                                foreach ($tags as $tag) 
                                {
                                    echo '<a href="index.php?action=createPost&tagFilter='.explode('#', $tag)[0].'">'.$tag.'</a>';
                                }
                echo        '</div>
                        </div>
                        <!--Comments Form-->
                        <h5 class="card-title">Comments</h5>
                            <form method="post">
                                <div class="card noShadow border border-light mb-3">
                                    <div class="card-body">
                                        <textarea class="form-control" id="message" rows="2" name="comment_text" maxlength="400"></textarea> <br />
                                        <!--Hidden field for fetching post id -->
                                        <input type="hidden" id="postId" name="post_id" value="'.$postObj->getId().'">
                                        <button class="form-control" type="submit" name="submit"> Add New Comment</button>
                                    </div>
                                </div>
                            </form>';
                        // Fetch and display comments
                        $comments = $conn->getCommentsByPostId($postObj->getId());
                        foreach ($comments as $comment) 
                        {
                    echo    '<div class="card mb-3 noShadow">
                                <div class="card-body bg-light rounded">
                                    <p><strong>'. $conn->getUserById($comment->getUserId())->getUsername() . '</strong></p>
                                    <p>' . $comment->getCommenttext() . '</p>
                                </div>
                            </div>';
                        }
            echo    '</div>
            </div>';
        }
        ?>
    </div>