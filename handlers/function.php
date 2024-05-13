<?php
function clearString($str)
{
    $str = trim($str);
    $str = strip_tags($str);
    $str = stripslashes($str);
    return $str;
}
?>