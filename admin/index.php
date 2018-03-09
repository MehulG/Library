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
    <title>JSGrid and PHP Sample</title>
</head>
<body>
<header>
    <h1>JSGrid and PHP Sample</h1>
</header>

<div id="jsGrid"></div>

<script src="../assets/jquery.min.js"></script>
<script src="./jsgrid/dist/jsgrid.min.js"></script>
<script src="jsgrid-php-master/public/js/sample.js"></script>
</body>
</html>