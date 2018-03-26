<?php
require("../db_connect.php");
if($_SESSION['signed_in']==false)
header("Location:../login");
$filename="exported_data.csv";
$file = fopen($filename,"w");
$sql = "SELECT * FROM books";
        $q = $con->prepare($sql);
        $q->execute();
        $result=$q->get_result();
        $rows=array();
        while($row=$result->fetch_array(MYSQLI_ASSOC))
        fputcsv($file,$row);

        header('Content-Description: File Transfer');
        header('Content-Type: application/force-download');
        header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\";");
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filename));
        ob_clean();
        flush();
        readfile($filename);
        exit;
?>