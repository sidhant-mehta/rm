 <?php

/* Template Name: ajax */
?>

<?php

session_start(); //start PHP Session

$_SESSION['emailValues'] = $_POST['str']; //store the posted value in a php session variable

echo '<script>alert("'.$_SESSION['emailValues'].'")</script>'; 

?>