<?php
    if($userId == true) return;
    
    if($_POST) {
        $data = array();
        $data['anrede'] = $_POST['anrede'] ?? '';
        $data['firstName'] = $_POST['firstName'] ?? '';
        $data['lastName'] = $_POST['lastName'] ?? '';
        $data['username'] = $_POST['username'] ?? '';
        $data['email'] = $_POST['email'] ?? '';
        $data['password'] = $_POST['password'] ?? '';
        $data['repeatPassword'] = $_POST['repeatPassword'] ?? '';
        $userObj = new User();

        if(mempty($data['anrede'], $data['firstName'], $data['lastName'], $data['username'], $data['email'], $data['password'], $data['repeatPassword'])) {
            $message = "<div class=\"alert alert-danger\" role=\"alert\">Bitte alle Felder ausfüllen.</div>";
        }
        else if(!$userObj->setAnrede($data['anrede'])) {
            $message = "<div class=\"alert alert-danger\" role=\"alert\">Anrede darf nur Herr, Frau oder keine Angabe sein.</div>";
        }
        else if(!$userObj->setVorname($data['firstName']) || !$userObj->setNachname($data['lastName'])) {
            $message = "<div class=\"alert alert-danger\" role=\"alert\">Vor- und lastName dürfen nur Buchstaben enthalen.</div>";
        }
        else if(!$userObj->setUsername($data['username'])) {
            $message = "<div class=\"alert alert-danger\" role=\"alert\">Der Username muss mind. 3 und max. 25 Zeichen enthalten. Keine Sonderzeichen.</div>";
        }
        else if(!$userObj->setPassword($data['password'], $data['repeatPassword'])) {
            $message = "<div class=\"alert alert-danger\" role=\"alert\">Passwort entweder zu kurz oder falsch wiederholt.</div>";
        }
        else if(!$userObj->setEmail($data['email'])) {
            $message = "<div class=\"alert alert-danger\" role=\"alert\">Eine zu lange E-Mail Adresse wurde übergeben.</div>";
        }
        else if($conn->getUserByUsername($data['username']) != false) {
            $message = '<div class="alert alert-danger" role="alert">Benutzer bereits registriert! ' . $conn->error .'</div>';
        }
        else if($conn->getUserByEmail($data['email']) != false) {
            $message = '<div class="alert alert-danger" role="alert">E-Mail Adresse ist bereits in Benutzung! ' . $conn->error .'</div>';
        }
        else {
            if($conn->registerUser($userObj)) {
                $data = array();
                $message = '<div class="alert alert-success" role="alert">Daten erfolgreich gespeichert.</div>';
            } else {
                $message = '<div class="alert alert-danger" role="alert">Es ist ein Fehler aufgetreten: ' . $conn->error .'</div>';
            }
        }
    }
?>

<?php 
echo $message ?? '';
include('form.php'); 
?>