<?php
require "../include/util.php";
if($_GET['role'] == 'admin') {
    initSessionAdmin();
} else {
    initSession();
}
redirect('admin.php');