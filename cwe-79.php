<?php
    require __DIR__ . '/vendor/autoload.php';
    $escaper = new Zend\Escaper\Escaper('utf-8');
    $username = $_GET['username'];
    echo '<div class="header"> Welcome, ' . $escaper->escapeHtml($username) . '</div>';
?>