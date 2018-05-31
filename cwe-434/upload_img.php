<?php
require "../include/util.php";
$error = 0;
$msg = '';
try {
    if(!isset($_POST['upload'])) {
        throw new Exception("Please upload a file");
    }
    checkToken( $_POST['csrf'], $_SESSION['session_token'], 'index.php' );
    $uploaded_name = $_FILES[ 'uploadedfile' ][ 'name' ];
    $uploaded_ext  = substr( $uploaded_name, strrpos( $uploaded_name, '.' ) + 1);
    $uploaded_size = $_FILES[ 'uploadedfile' ][ 'size' ];
    $uploaded_type = $_FILES[ 'uploadedfile' ][ 'type' ];
    $uploaded_tmp  = $_FILES[ 'uploadedfile' ][ 'tmp_name' ];

    $target_path = 'pictures'.DIRECTORY_SEPARATOR;
    $target_file   =  md5( uniqid() . $uploaded_name ) . '.' . $uploaded_ext;
    $temp_file     = ((ini_get( 'upload_tmp_dir') == '' ) ? (sys_get_temp_dir()) : (ini_get( 'upload_tmp_dir' )));
    $temp_file    .= DIRECTORY_SEPARATOR . md5( uniqid() . $uploaded_name ) . '.' . $uploaded_ext;

    if(!in_array(strtolower($uploaded_ext), array('jpg', 'jpeg', 'png')) ||
        ( $uploaded_type != 'image/jpeg' && $uploaded_type != 'image/png' )
    ) {
        throw new Exception("We only accept PNG or JPG images");
    }
    if($uploaded_size >= 100000) {
        throw new Exception("File size is not acceptable");
    }
    if(!getimagesize($uploaded_tmp)) {
        throw new Exception("The file uploaded is not a valid image");
    }

    if( $uploaded_type == 'image/jpeg' ) {
        $img = imagecreatefromjpeg( $uploaded_tmp );
        imagejpeg( $img, $temp_file, 100);
    }
    else {
        $img = imagecreatefrompng( $uploaded_tmp );
        imagepng( $img, $temp_file, 9);
    }
    imagedestroy( $img );
} catch(Exception $e) {
    $error = 1;
    $msg = $e->getMessage();
    addFlashMessage($msg, 'e');
    redirect("index.php");
}
if($error == 0) {
    if(rename($temp_file, (getcwd() . DIRECTORY_SEPARATOR . $target_path . $target_file ) ) ) {
        addFlashMessage("The file has been uploaded.", 's');
    } else {
        addFlashMessage("There was an error uploading your file.", 'e');
    }
    if(file_exists($temp_file)) {
        unlink( $temp_file );
    }
    redirect("index.php");
}