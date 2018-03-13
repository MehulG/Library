<?php
session_start();
if($_SESSION['signed_in']==false)
header("Location:../login");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <link href="jsgrid-php-master/public/css/style.css" rel="stylesheet" />
    <link href="./jsgrid/dist/jsgrid.min.css" rel="stylesheet" />
    <link href="./jsgrid/dist/jsgrid-theme.min.css" rel="stylesheet" />
    <title>JSGrid and PHP </title>
    <link rel="stylesheet" href="./../home/vendor/bootstrap/css/bootstrap.css">
</head>
<body>
<header>
    <h1>JSGrid and PHP </h1>
</header>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
    <button style='float:right; border-width:2px;border-color:black; padding:0.3em; margin-bottom:0.5em;'> download </button>
</form>

<div id="jsGrid"></div>

<script src="../assets/jquery.min.js"></script>
<script src="./jsgrid/dist/jsgrid.min.js"></script>
<script src="jsgrid-php-master/public/js/sample.js"></script>
</body>
</html>