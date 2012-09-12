 <?php

/* Template Name: ajax */
?>

<?php

session_start(); //start PHP Session

$_SESSION['emailTypeValue'] = $_POST['emailType']; //store type of application - Mentor or Project
$_SESSION['emailTypeNameValue'] = $_POST['emailTypeName']; //store name of applicatoin. - Name of Mentor or Name of Project

echo '<script>alert("'.$_SESSION['emailTypeNameValue'].'")</script>'; 

?>