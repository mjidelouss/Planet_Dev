<?php
/* 
    instead of including multiple files on each page
    spl_autoload_register will include appropriate 
    path of your class sequentially when an 
    object is is instantiated(new Class). 
*/

spl_autoload_register('myAutoLoader');

function myAutoLoader($className) {
    $path = "/../classes/";
    $extension = ".class.php";
    $fullPath = $path . $className . $extension;

    include_once  __DIR__.$fullPath;
}
