<?php
if ($userId) {
    include('createPost.php');
    return;
}
?>

<?= $message ?? "" ?>
<div class="row justify-content-center mt-5">
    <div class="col-8">
        <div class="card">
            <div class="card-header text-center">
                <h3 class="mb-0">Login</h3>
            </div>
            <div class="card-body">
                <form method="post" action="index.php?action=login">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="form-group row">
                                <input type="text" name="username" id="username" class="form-control"
                                       placeholder="Username">
                            </div>
                            <div class="form-group row">
                                <input type="password" name="password" id="password" class="form-control"
                                       placeholder="Passwort">
                            </div>
                            <div class="form-group row">
                                <input type="submit" class="btn btn-primary btn-block" value="Login"/>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <a href="index.php?action=register">Registrierung</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>