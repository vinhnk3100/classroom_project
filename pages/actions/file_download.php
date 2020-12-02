<?php

include ("database.php");
// Downloads files
if (isset($_GET['post_id'])) {

    $postID = $_GET['post_id'];
    // fetch file to download from database
    $sql = "SELECT * FROM post WHERE post_id='$postID'";
    $result = mysqli_query($db, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = '../uploads/'.$file['post_id'];

    $zip = new ZipArchive;
    $tmp_file = '../uploads/'.$file['post_id'].'.zip';

    if (file_exists($filepath)) {
        if ($zip->open($tmp_file,  ZipArchive::CREATE)) {
            $zip->addFile('folder/bootstrap.js', 'bootstrap.js');
            $zip->addFile('folder/bootstrap.min.js', 'bootstrap.min.js');
            $zip->close();
            header('Content-Description: File Transfer');
            header('Content-disposition: attachment; filename='.$file['post_id'].'.zip');
            header('Content-type: application/zip');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            ob_clean();
            flush();
            readfile($tmp_file);
            exit();
        }
    }else{
        echo "file is not existed!";
    }

}