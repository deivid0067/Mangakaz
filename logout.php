<?php

    header('Location: index.php');
    session_start();
    unset($_SESSION['login-session']);
    unset($_SESSION['senha-session']);
    session_destroy();
    
?>