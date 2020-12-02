<?php
// Query to get file in POST table
$fileDB = "SELECT file_dir FROM post WHERE post_id = '$postID'";
$fileQuery = mysqli_query($db,$fileDB);
$fileRow = mysqli_fetch_assoc($fileQuery);