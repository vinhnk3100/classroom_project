
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
                                echo "<a href=\"#modal-edit-classroom\" data-toggle='modal' class=\"edit-class-btn dropdown-item \">Edit Classroom</a>";
                                echo "<a href=\"#modal-delete-classroom\" data-toggle='modal' class=\"delete-class-btn dropdown-item \">Delete Classroom</a>";
                            }elseif ($_SESSION['role'] == 'tea'){
                                echo "<a href=\"#modal-edit-classroom\" data-toggle='modal' class=\"edit-class-btn dropdown-item \">Edit Classroom</a>";
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
                            <form action="./actions/remove_class.php?class_id=<?php echo $classid?>" method="post">
                                <input type= "submit" class="class-delete-btn-yes" name = "btn_create_class" id="btn_create_class" value="Yes">
                            </form>

                            <input type= "button" class="class-delete-btn-no" data-dismiss="modal" value="No">

                        </div>
                    </div>
                </div>
            </div>

            <!--=================================================================================================================-->
            <!--=================================================================================================================-->

            <!-- Modal FOR CREATE CLASSROOM -->
            <div id="modal-edit-classroom" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit classroom</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <!--./actions/class_create.php-->
                            <form action="./actions/edit_classroom.php?class_id=<?php echo $classid?>" method="post">
                                <div class="form-group">
                                    <label for="edit_classname">Classroom Name</label>
                                    <input type="text" class="form-control" name="edit_classname" id="" value="<?php echo $rowsClass['className']?>" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="edit_class_subject">Subject</label>
                                    <input type="text" class="form-control" name="edit_class_subject" id="" value="<?php echo $rowsClass['subject']?>" required="required">
                                </div>
                                <div class="form-group">
                                    <label for="edit_class_room">Class room</label>
                                    <input type="text" class="form-control" name="edit_class_room" id="" value="<?php echo $rowsClass['classRoom']?>" required="required">
                                </div>
                                <div class="form-group">
                                    <!-- <input type="hidden" name="btn_create_class"> -->
                                    <!-- <button class="btn btn-primary btn-block btn-lg">Create</button>-->
                                    <input type= "submit" class="btn btn-primary btn-block btn-lg" name = "btn_edit_class" id="btn_edit_class" value="Confirm Update">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for CREATE CLASSROOM  -->

            <!--=================================================================================================================-->
            <!--=================================================================================================================-->

            <!-- Modal FOR INVITE CLASSROOM -->
            <div id="modal-invite-classroom" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Invite Student to Join Classroom</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="false">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div></div>
                            <form action="./actions/add_student_request.php?class_id=<?php echo $classid?>" method="post">
                                <div class="form-group">
                                    <label for="student_email_invite">Student email</label>
                                    <input type="email" class="form-control" name="student_email_invite" id="" placeholder="Enter student email" required="required">
                                </div>
                                <input type= "submit" class="btn color-green-btn" name = "btn_invite_class" id="btn_invite_class" value="Invite">
                            </form>
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