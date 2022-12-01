<?php

$file = $_GET['file'];  
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="'.$file.'"');
?>
