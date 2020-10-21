<?php
     /** 
     * logout.php page
     * @author Andrey Bortnikov
     * @package files
     * 
     */
    /**
     * Connections to database
     */
    require 'db.php';
    /**
     * Unsets logged in user's session
     */
    unset($_SESSION['logged_user']);

    header('Location: index.php');
    
