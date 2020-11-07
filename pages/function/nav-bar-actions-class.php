
<div>
    <!--====== NAVBAR TOP =======================-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="./css/images/icons8-classroom-80.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="text-nav-bar" href="./home.php">Home <span class="sr-only">(current)</span></a>
                    <a class="text-nav-bar dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Classroom
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                        // =================================================== ROLE ACTION ===============================================
                        if (isset($_SESSION['role'])){
                            if($_SESSION['role'] == 'adm'){
                                echo "<a href=\"#modal-delete-classroom\" data-toggle='modal' class=\"delete-class-btn dropdown-item \">Delete Classroom</a>";
                            }elseif ($_SESSION['role'] == 'tea'){
                                echo "<a href=\"#modal-delete-classroom\" data-toggle='modal' class=\"delete-class-btn dropdown-item \">Delete Classroom</a>";
                            }
                        }?>
                    </div>
                </li>
            </ul>
            <!--=================================================================================================================-->
            <!--=================================================================================================================-->


            <!-- Modal FOR DELETE CLASSROOM -->
            <div id="modal-delete-classroom" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Classroom</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="false">&times;</button>
                        </div>
                        <div class="modal-body">
                            <!--./actions/class_create.php-->
                            <div>Are you sure you want to delete <strong class="alertLogin"><?php echo $rowsClass["className"]?></strong> ?</div>
                            <br>
                            <form action="./actions/remove_class.php?id=<?php echo $classid?>" method="post">
                                <input type= "submit" class="class-delete-btn-yes" name = "btn_create_class" id="btn_create_class" value="Yes">
                            </form>

                            <input type= "button" class="class-delete-btn-no" data-dismiss="modal" value="No">

                        </div>
                    </div>
                </div>
            </div>

            <!--=================================================================================================================-->
            <!--=================================================================================================================-->

            <!-- BUTTON LOGOUT - AVATAR ACCOUNT INFORMATION -->

            <ul class="navbar-nav margin-dropdown">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                        $initials = new Initials();
                        $generateName = $initials->generate($_SESSION['fullname']);
                        echo "<div class='circle'><div class='initials'>$generateName</div></div>"
                        ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-3" aria-labelledby="navbarDropdown">
                        <?php
                        echo "<div class=\"circle m-l-r-auto\"><a href=\"#\" class=\"initials text-align-profile\" >".$generateName."</a></div><br>";
                        echo "<div class=\"text-center\"><a href=\"#\" class=\"text-align-profile\" >".$_SESSION['fullname']."</a></div>";
                        ?>
                        <?php
                        echo "<div class=\"text-center\"><a href=\"#\" class=\"btn btn-outline-success my-2 my-sm-0 nav-link\" >".$_SESSION['useremail']."</a></div>";
                        ?>
                        <div class="dropdown-divider"></div>
                        <div class="text-center margin-dropdown"><a href="./actions/logout.php" class="btn btn-outline-success my-2 my-sm-0" >Logout</a></div>
                    </div>
                </li>
            </ul>
        </div>
</div>