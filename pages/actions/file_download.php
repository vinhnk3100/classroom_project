<?php

include ("database.php");
// Downloads files
if (isset($_GET['file_id'])) {

    $fileID = $_GET['file_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM post WHERE post_id='$fileID'";
    $result = mysqli_query($db, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = './pages/uploads/' . $file['file_dir'];
    echo $filepath;
    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['file_dir']));
        readfile('./pages/uploads/'.$file['file_dir']);
    }

}