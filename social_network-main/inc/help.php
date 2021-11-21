<?php
?>
<h1>Hilfe-Seite</h1>
<p>Her you can find a selection of common questions for new users. Simply click a card for more information regarding the topic of intrest.</p>
<p>
  <a class="btn btn-outline-light" data-toggle="collapse" data-target="#registration" role="button" aria-expanded="false" aria-controls="registration">Registration</a>
  <a class="btn btn-outline-light" data-toggle="collapse" data-target="#userList" role="button" aria-expanded="false" aria-controls="userList">User List</a>
  <a class="btn btn-outline-light" data-toggle="collapse" data-target="#friendsList" role="button" aria-expanded="false" aria-controls="friendsList">Friend List</a>
  <a class="btn btn-outline-light" data-toggle="collapse" data-target="#login" role="button" data-target="#login"  aria-expanded="false" aria-controls="login">Login</a>
  <a class="btn btn-outline-light" data-toggle="collapse" data-target="#personalInformation" role="button" aria-expanded="false" aria-controls="personalInformation">Personal Information</a>
  <a class="btn btn-outline-light" data-toggle="collapse" data-target="#otherQuestions" role="button" aria-expanded="false" aria-controls="otherQuestions">Other Questions?</a>
  <button class="btn btn-outline-light" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" 
    aria-controls=
    "registration 
    userList 
    friendsList  
    login 
    personalInformation
    otherQuestions"
  >Toggle all Cards</button>
</p>
<div class="col">
    <div class="collapse multi-collapse" id="registration">
        <div class="card card-body">
        <p>Registration</p>
        <p>By registering you are able to use all available functionality on SocialNetwork.com. The registration from can be accessed by either clicking here: <a href="index.php?action=register">go to Registration</a> or by clicking on Registration in the top-navigation-bar.<br>
        During registraion you will be able to choose a Username. This can <u>not</u> be changed at a later point. Once registered you'll be able to login to your own profile for the very first time. We hope you enjoy your time here.</p>
        </div>
    </div>
</div>
<div class="col">
    <div class="collapse multi-collapse" id="userList">
    <div class="card card-body">
        <p>User List</p>
        <p>Only visable while logged in! <br>
            Here you will find a list of all users registered on 'SocialNetwork.com' You can send friend requests Once accepted, additional feature like chat and accessing privat posts are available.</p>
    </div>
</div>
</div>
<div class="col">
    <div class="collapse multi-collapse" id="friendsList">
        <div class="card card-body">
            <p>Friends List</p>
            <p>Only visable while logged in! <br>
                Here you're able to see friend requests from other users as well as a list of users allready accepted. If requiered you can remove users from your friend list.</p>
        </div>
    </div>
</div>
<div class="col">
    <div class="collapse multi-collapse" id="login">
        <div class="card card-body">
            <p>Login</p>
            <p>Feel free to spell your username how ever you wish when registering. Uper case letters will still be represented true to your choosing, but are not requiered to be entered as upper case when logging in.</p>
            <img src="pics/login.JPG">
            <p>Here you can see the login site. To successfully log into your account, you'll be required to fill in your username and passwort chosen during registration and press the 'Login' button.</p>
        </div>
    </div>
</div>
<div class="col">
    <div class="collapse multi-collapse" id="personalInformation">
        <div class="card card-body">
        <p>Personal Information</p>
        <p>Only available while being logged in! <br>
            When registering some information about you will be saved
            <table>
                <ul>
                <li>First Name</li>
                <li>Last Name</li>
                <li>E-Mail Adress</li>
                </ul>
            </table> 
            All information can be accessed later on an can be changed at any time. You will find a menu point named 'Edit Profile'. </p>
            <img src="pics/editprofilepicture.png">
            <p>The button 'Browse...' will open your file explorer, where you can choose your own profile picture.</p>
            <img src="pics/editporfileinfo.png">
            <p>By filling in your new information and clicking the 'Update my Profile' you can change your personal information.</p> 
        </div>
    </div>
</div>
<div class="col">
<div class="collapse multi-collapse" id="otherQuestions">
    <div class="card card-body">
        <p>Other Questions?</p>
        <p>If you have any further questions please feel free to get in contact with one of our admins.</p>
        <p><img src="pics/admin1.JPG"></p>
        <p><img src="pics/admin2.JPG"><p>
        <p>Or contact us directly <br>Tel.: 01234/56789 <br>Fax: 01234/56789-0 <br> E-Mail: office@musterfirma.com</p> 
    </div>
</div>
</div>
</p>

<?php

?>