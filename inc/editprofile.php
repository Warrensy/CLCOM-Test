<?php
    if(!$userId) return;

    $data = array();

    if($_POST && $_POST['submit'] == 'profile') 
    {
        $data['anrede'] = $_POST['anrede'] ?? '';
        $data['vorname'] = $_POST['firstName'] ?? '';
        $data['nachname'] = $_POST['lastName'] ?? '';
        $data['username'] = $_POST['username'] ?? '';
        $data['email'] = $_POST['email'] ?? '';
        $data['newPassword'] = $_POST['newPassword'] ?? '';
        $data['repeatPassword'] = $_POST['repeatPassword'] ?? '';
        $data['oldPassword'] = $_POST['oldPassword'] ?? '';
        /*if(!mempty($_Post['password'], $_Post['repeatPassword'], $_Post['oldPassword']))
        {
            
        }*/
       
        
        if(mempty($data['anrede'], $data['vorname'], $data['nachname'], $data['username'], $data['email'])) 
        {
            $message = "<div class=\"alert alert-danger\" role=\"alert\">Please fill in the missing fileds.</div>";
        }
        else if(!$user->setAnrede($data['anrede'])) 
        {
            $message = "<div class=\"alert alert-danger\" role=\"alert\">Salutation can only be set to Mister or Miss.</div>";
        }
        else if(!$user->setVorname($data['vorname']) || !$user->setNachname($data['nachname'])) 
        {
            $message = "<div class=\"alert alert-danger\" role=\"alert\">First and last name must contain letters only.</div>";
        }
        else if(!mempty($data['oldPassword'],$data['newPassword']) && (!password_verify($data['oldPassword'], $user->getPassword())))
        {
            $message = "<div class=\"alert alert-danger\" role=\"alert\">Old password invalid.</div>";
        }
        else if(!empty($data['newPassword']) && !$user->setPassword($data['newPassword'], $data['repeatPassword'])) 
        {
            $message = "<div class=\"alert alert-danger\" role=\"alert\">Please repeat you new password.</div>";
        }
        else if(!$user->setEmail($data['email'])) 
        {
            $message = "<div class=\"alert alert-danger\" role=\"alert\">Email adress is to long.</div>";
        }
        else 
        {
            if($conn->updateUser($user)) 
            {
                $message = '<div class="alert alert-success" role="alert">Profile was updated successfully.</div>';
            } else {
                $message = '<div class="alert alert-danger" role="alert">Somthing went wrong: ' . $conn->error .'</div>';
            }
        }
    } else {
        $data['anrede'] = $user->getAnrede();
        $data['vorname'] = $user->getVorname();
        $data['nachname'] = $user->getNachname();
        $data['username'] = $user->getUsername();
        $data['email'] = $user->getEmail();

    }
?>

<div class="row pt-3 pb-3">
    <div class="col-12">
        <h1>Edit Profile</h1>
    </div>
</div>

<?php
    echo $message ?? '';
    include('updateProfileForm.php');
?>