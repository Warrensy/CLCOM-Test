<?php
$folder = "pics/";
if (isset($_POST['submit']) && $_POST['submit'] == 'upload') 
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
    $filename = $user->getprofilePicture();
}


?>

<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Profile Picture</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-xs-12 mb-2">
                        <img class="img-fluid rounded myImgSquare" src="<?= $folder . $filename ?>"
                             alt="Profile Picture">
                    </div>
                    <div class="col-md-9 col-xs-12">
                        <div class="card noShadow border border-light">
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="row mb-5">
                                        <div class="col-12 bg-light p-2 rounded">
                                            <input type="file" accept="image/png, image/jpeg, image/jpg" name="pickedFile" id="pickedFile">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button name="submit" value="upload" type="submit" class="btn btn-primary">
                                                Update Profile Picture
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Profile Information</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST">
                            <div class="form-group row">
                                <label for="anrede" class="col-4 col-form-label">Salutation</label>
                                <div class="col-8">
                                    <select id="anrede" name="anrede" class="form-control here">
                                        <option value="m" <?= ($data['anrede'] == 'm' ? 'selected' : '') ?> >Mister
                                        </option>
                                        <option value="f" <?= ($data['anrede'] == 'f' ? 'selected' : '') ?> >Miss
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-4 col-form-label">User Name*</label>
                                <div class="col-8">
                                    <input disabled="disabled" id="username" name="username" placeholder="Username"
                                           class="form-control here" required="required" type="text"
                                           value="<?= $user->getUsername() ?? '' ?>"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="firstName" class="col-4 col-form-label">First Name</label>
                                <div class="col-8">
                                    <input id="firstName" name="firstName" placeholder="First Name"
                                           class="form-control here" type="text" value="<?= $user->getVorname() ?? '' ?>"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lastname" class="col-4 col-form-label">Last Name</label>
                                <div class="col-8">
                                    <input id="lastname" name="lastName" placeholder="Last Name"
                                           class="form-control here" type="text"
                                           value="<?= $user->getNachname() ?? '' ?>"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-4 col-form-label">Email</label>
                                <div class="col-8">
                                    <input id="email" name="email" placeholder="Email" class="form-control here"
                                           required="required" type="email" value="<?= $user->getEmail() ?? '' ?>"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="oldPassword" class="col-4 col-form-label">Old Password</label>
                                <div class="col-8">
                                    <input id="oldPassword" name="oldPassword" placeholder="oldPassword"
                                           class="form-control here" type="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="newPassword" class="col-4 col-form-label">New Password</label>
                                <div class="col-8">
                                    <input id="newPassword" name="newPassword" placeholder="*****"
                                           class="form-control here" type="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="repeatPassword" class="col-4 col-form-label">Repeat New Password</label>
                                <div class="col-8">
                                    <input id="newpass" name="repeatPassword" placeholder="repeatPassword"
                                           class="form-control here" type="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-4 col-8">
                                    <button name="submit" value="profile" type="submit" class="btn btn-primary">Update My Profile
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>