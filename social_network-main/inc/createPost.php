<?php
if(isset($_POST['message'])) {
    error_reporting(E_ALL);

    //Picture Upload
    $destination_path = getcwd().DIRECTORY_SEPARATOR.'public/posts/';
    $folder = "public/posts/";
    $filename = $_FILES["pickedFile"]["name"];
    $tempname = $_FILES["pickedFile"]["tmp_name"];
    $target_path = $destination_path . basename($_FILES['pickedFile']['name']);

    // Returns integer, has to be checked as integer
    if (!empty($tempname)) {
        $fileType = exif_imagetype($tempname);
    }

    $data = array();

    $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);

    //Save data from post into data array
    $data['image_path'] = $folder . $filename;
    $data['post_text'] = $_POST['message'] ?? '';
    $data['private'] = $_POST['visibility'] ?? '';
    $data['user_id'] = $userId ?? '';
    $data['tags'] = $_POST['tags'] ?? '';
    
    $postObj = new Post();
    
    if(mempty($data['post_text'], $data['private'], $data['user_id'], $data['tags'], $data['image_path'])) {
        $message = "<div class=\"alert alert-danger\" role=\"alert\">Bitte alle Felder ausfüllen.</div>";
    }
    else if(!$postObj->setPostText($data['post_text'])) {
        $message = "<div class=\"alert alert-danger\" role=\"alert\">Fügen Sie eine Beschreibung hinzu.</div>";
    }
    else if(!$postObj->setPrivate($data['private'])) {
        $message = "<div class=\"alert alert-danger\" role=\"alert\">Wählen Sie Privat oder Öffentlich.</div>";
    }
    else if(!$postObj->setUserId($data['user_id'])) {
        $message = "<div class=\"alert alert-danger\" role=\"alert\">Sie müssen eingeloggt sein, um eine Post zu erstellen.</div>";
    } else if (!$postObj->setTags($data['tags'])) {
        $message = "<div class=\"alert alert-danger\" role=\"alert\">Sie müssen eingeloggt sein, um eine Post zu erstellen.</div>";
    } else if (!$postObj->setImagePath($data['image_path'])) {
        $message = "<div class=\"alert alert-danger\" role=\"alert\">Das Bild konnte nicht hochgeladen werden.</div>";
    } else {
        if (isset($fileType) && !in_array($fileType, $allowed_types)) {
            $message = "<div class=\"alert alert-danger\" role=\"alert\">Format des Bildes ist unzulässig!</div>";
        }
        //Check if Image Uploaded
        if($conn->createPost($postObj)) {
            $data = array();
            $message = '<div class="alert alert-success" role="alert">Beitrag erfolgreich hinzugefügt.</div>';
        } else {
            $message = '<div class="alert alert-danger" role="alert">Es ist ein Fehler aufgetreten: ' . $conn->error .'</div>';
        }

        if (!empty($tempname)) {
            move_uploaded_file($tempname, $target_path);
        }
    }
}

?>

<?php
echo $message ?? '';
include('posts.php');
?>
