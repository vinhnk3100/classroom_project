<?php

//=========================================== PREVENTING CROSS-SITE ATTACK =============================================

if($_SESSION['fullname'] == null){
    header("Location: /myownclassroom");
}elseif ($_SESSION['role'] != "adm"){
    header("Location: /myownclassroom");
}elseif ($_SESSION['role'] != "tea"){
    header("Location: /myownclassroom");
}

// =====================================================================================================================

?>
