<?php
// initiate the session in order to validate sessions
session_start();

if (! session_is_registered("username")) {
    echo "invalid session detected!";
    header('Location: index.php');
    exit;
}

update_profile();

function update_profile() {
    if (isset($_POST["csrf"]) && $_POST["csrf"] == $_SESSION["token"]){
        echo "Your profile has been successfully updated.";
    } else {
        echo "Please reload page";
    }
}

function session_is_registered() {
    return (isset($_SESSION["username"]) || !empty($_SESSION["username"])) ;
}
?>