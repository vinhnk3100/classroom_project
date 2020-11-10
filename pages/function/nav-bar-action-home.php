
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
                            // Check if admin, teacher, student
                            if (isset($_SESSION['role'])){
                                if($_SESSION['role'] == 'adm'){
                                    echo "<a href=\"#modal-create-classroom\" class=\"edit-class-btn dropdown-item btn btn-default btn-rounded trigger-btn\" data-toggle=\"modal\">Create classroom</a>";
                                    echo "<a href=\"#modal-join-classroom\" class=\"edit-class-btn dropdown-item btn btn-default btn-rounded trigger-btn\" data-toggle=\"modal\">Join classroom</a>";
                                    echo "<div class=\"dropdown-divider\"></div>
                                        <a class=\"dropdown-item\" href=\"manage.php\">Manage users</a>";
                                }elseif ($_SESSION['role'] == 'tea'){
                                    echo "<a href=\"#modal-create-classroom\" class=\"dropdown-item btn btn-default btn-rounded trigger-btn\" data-toggle=\"modal\">Create classroom</a>";
                                }elseif ($_SESSION['role'] == 'stu'){
                                    echo "<a href=\"#modal-join-classroom\" class=\"dropdown-item btn btn-default btn-rounded trigger-btn\" data-toggle=\"modal\">Join classroom</a>";
                                }
                            }?>
                        </div>
                    </li>
                </ul>

                <!--=================================================================================================================-->
                <!--=================================================================================================================-->

                <!-- Modal FOR CREATE CLASSROOM -->
                <div id="modal-create-classroom" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Create classroom</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <!--./actions/class_create.php-->
                                <form action="./actions/class_create.php" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="create-classroom-name" id="create-classroom-name" placeholder="Class name" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="create-classroom-subject" id="create-classroom-subject" placeholder="Subject" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="create-classroom-room" id="create-classroom-room" placeholder="Room" required="required">
                                    </div>
                                    <div class="form-group">
                                        <!-- <input type="hidden" name="btn_create_class"> -->
                                        <!-- <button class="btn btn-primary btn-block btn-lg">Create</button>-->
                                        <input type= "submit" class="btn btn-primary btn-block btn-lg" name = "btn_create_class" id="btn_create_class" value="Create">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for CREATE CLASSROOM  -->

                <!--=================================================================================================================-->
                <!--=================================================================================================================-->

                <!-- Modal for JOIN CLASSROOM  -->
                <div id="modal-join-classroom" class="modal fade">
                    <div class="modal-dialog modal-join-classroom">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">You're Login as <?php echo $_SESSION['fullname'];?></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form action="./actions/request_join_classroom.php" method="post">
                                    <label>Enter classroom code : </label>
                                    <div class="form-group">
                                        <i class="fa fa-book"></i>
                                        <input type="text" class="form-control" name="classroom-code" placeholder="Classroom Code" required="required">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="btn_join_class" class="btn btn-primary btn-block btn-lg" value="Join">
                                    </div>
                                </form>

                            </div>
                            <div class="modal-footer">
                                <p>Ask your teacher for the class code and enter it here.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Modal for JOIN CLASSROOM  -->

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
                        <div class="dropdown-menu dropdown-menu-right p-3 dropdown-profile" aria-labelledby="navbarDropdown">
                            <?php
                            echo "<div class=\"circle m-l-r-auto\"><a href=\"users_infomation.php?id=".$_SESSION['uid']."\" class=\"initials text-align-profile\" >".$generateName."</a></div><br>";
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
    </nav>