<?php
session_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function logout()
{
    session_destroy();
}
logout();
header('Location: index.html');
?>
