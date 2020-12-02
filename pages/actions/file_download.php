<?php

include ("database.php");
// Downloads files
if (isset($_GET['file_name'])) {

    $fileName = $_GET['file_name'];
    // fetch file to download from database
    $sql = "SELECT * FROM post WHERE file_dir='$fileName'";
    $result = mysqli_query($db, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = '../uploads/'.$file['file_dir'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($fileName));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        ob_clean();
        flush();
        readfile($filepath);
        exit();
    }else{
        echo "file is not existed!";
    }

}