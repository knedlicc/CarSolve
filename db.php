<?php
    /** 
     * db.php page
     * @author Andrey Bortnikov
     * @package files
     * 
     */
    /**
     * Connections to database
     * Using RedBean framework in file rb.php
     */
    require "rb.php";
    R::setup( 'mysql:host=localhost;dbname=bortnand','bortnand', '634863qQ' ); 
    /**
     * Starting session
     */
    session_start();
    
?>