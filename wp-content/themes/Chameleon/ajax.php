 <?php

/* Template Name: ajax */
?>

<?php

session_start(); //start PHP Session

$_SESSION['emailTypeValue'] = $_POST['emailType']; //store type of application - Mentor or Project
$_SESSION['emailTypeNameValue'] = $_POST['emailTypeName']; //store name of applicatoin. - Name of Mentor or Name of Project

?>

<html>
<head>
<title> You are being redirected</title>
</head>
<body>
    You are being redirected
      <script type="text/javascript">
  
  window.onload = function(){
	window.location = "<?php echo get_bloginfo('url'); ?>";
  }
  </script>
</body>
</html>