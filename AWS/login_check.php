<?php
session_start();
if( isset( $_SESSION['userid'])){
    $login = TRUE;
}
?>