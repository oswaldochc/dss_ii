<?php
session_start();
function initSession() {
    $session =& getSessionApp();
    if(!isset( $session['username'])) {
        $session[ 'username' ] = '';
        $session[ 'role' ] = '';
    }
    $session[ 'username' ] = 'oswaldo';
    $session[ 'role' ] = 'public';
}
function initSessionAdmin() {
    $session =& getSessionApp();
    if(!isset( $session['username'])) {
        $session[ 'username' ] = '';
        $session[ 'role' ] = '';
    }
    $session[ 'username' ] = 'oswaldo';
    $session[ 'role' ] = 'admin';
}

function checkRole($role, $returnURL ) {
    $session =& getSessionApp();
    if($role !== $session['role'] || !isset( $role)) {
        addFlashMessage("You do not have access rights");
        redirect($returnURL);
    }
}

function getUserNameFromSession() {
    $session =& getSessionApp();
    return $session['username'];
}
function checkToken( $user_token, $session_token, $returnURL ) {  # Validate the given (CSRF) token
    if( $user_token !== $session_token || !isset( $session_token ) ) {
        addFlashMessage('CSRF token is incorrect');
        redirect($returnURL);
    }
}

function generateSessionToken() {  # Generate a brand new (CSRF) token
    if( isset( $_SESSION[ 'session_token' ] ) ) {
        destroySessionToken();
    }
    $_SESSION['session_token'] = md5( uniqid() );
    return $_SESSION['session_token'];
}

function destroySessionToken() {  # Destroy any session with the name 'session_token'
    unset( $_SESSION['session_token'] );
}

function redirect($pLocation) {
    session_commit();
    header( "Location: {$pLocation}" );
    exit;
}

function &getSessionApp() {
    if( !isset( $_SESSION['app_session'])) {
        $_SESSION[ 'app_session' ] = array();
    }
    return $_SESSION['app_session'];
}

function addFlashMessage($message, $type = 'i') {
    $session =& getSessionApp();
    if(!isset( $session['flash_messages'])) {
        $session[ 'flash_messages' ] = array();
    }
    $session[ 'flash_messages' ][] = array('msg' => $message, 'type' => $type);
}
function getFlashMessage() {
    $session =& getSessionApp();
    if( !isset( $session['flash_messages'] ) || count($session['flash_messages'] ) == 0 ) {
        return false;
    }
    return array_shift( $session['flash_messages'] );
}

function getFlashMessageToHtml() {
    $messagesHtml = '';
    $cls = '';
    while($message = getFlashMessage()) {
        if($message['type'] == 's') {
            $cls = 'success';
        } elseif($message['type'] == 'e') {
            $cls = 'error';
        } elseif($message['type'] == 'w') {
            $cls = 'warning';
        }
        $messagesHtml .= "<div class=\"message {$cls}\">{$message['msg']}</div>";
    }

    return $messagesHtml;
}