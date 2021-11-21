<?php
$folder = "pics/";
if (isset($_POST['pickedFile']))
{
    //Dateipfad für Profilbilder
    $filename = $_FILES["pickedFile"]["name"];
    $tempname = $_FILES["pickedFile"]["tmp_name"];

    if (move_uploaded_file($tempname, $folder . $filename))
    {
        $msg = "Image uploaded successfully";
        $sql = "UPDATE users SET profilePicture = ? WHERE id = ? ";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            'si',
            $filename,
            $userId
        );
        $stmt->execute();
    } else
    {
        $msg = "Failed to upload image";
    }
}
else
{
    $filename = $post->getImagePath();
}


?>

<div class="row mb-3 mt-3">
    <div class="col-8">
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
                                            <option>Public</option>
                                            <option>Privat</option>
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