<?php
    session_start();
    /* check if user is already logged in */
    if(isset($_SESSION['loggedIn'])) {
        header('Location: index.php');
        exit();
    }
    require_once('include/config/constants.php');
    require_once('include/config/db.php');
    require_once('include/config/html');
?>
<body>
    <?php
    <!-- Variable to store the action (login, register, passwordReset) -->
    $action = '';
        if(isset($_GET['action'])) {
            $action = $_GET['action'];
            if($action == 'register') {
    ?>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-5 col-lg-5">
                            <div class="card">
                                <div class="card-header">Register</div>
                                <div class="card-body">
                                    <form action="">
                                        <div id="registerMessage"></div>
                                        <div class="form-group">
                                            <label for="registerFullName">Full Name<span class="requiredIcon">*</span></label>
                                            <input type="text" class="form-control" id="registName" name="registName">
                                        </div>
                                        <div class="form-group">
                                            <label for="registerUserName">Username<span class="requiredIcon">*</span></label>
                                            <input type="email" class="form-control" id="registUserName" name="registUsername" autocomplete="on">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password<span class="requiredIcon">*</span></label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirmPassword">Confirm Password</label>
                                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" >
                                        </div>
                                        <a href="login.php" class="btn btn-primary">Login</a>
                                        <button type="button" id="register" class="btn btn-success">Register</button>
                                        <a href="login.php?action=resetPassword" class="btn btn-warning">Reset Password</a>
                                        <button type="reset" class="btn">Clear</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
                require 'include/footer.php';
                echo '</body></html>';
                exit();
            } elseif($action == 'resetPassword') {
        ?>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-5 col-lg-5">
                            <div class="card">
                                <div class="card-header">Reset Password</div>
                                <div class="card-body">
                                    <form action="">
                                        <div id="resetMessage"></div>
                                        <div class="form-group">
                                            <label></label>
                                            <input type="text" class="form-control" id="resetUsername" name="resetUsername">
                                        </div>
                                        <div class="form-group">
                                            <label for="resetNewPassword">New Password</label>
                                            <input type="password" class="form-control" id="resetPassword" name="resetPassword">
                                        </div>
                                        <div class="form-group">
                                            <label for="resetConfirmPassword">Confirm New Password</label>
                                            <input type="password" class="form-control" id="resetConfirmPassword" name="resetConfirmPassword">
                                        </div>
                                        <a href="login.php" class="btn btn-primary">Login</a>
                                        <a href="login.php?action=register" class="btn btn-success">Register</a>
                                        <button type="button" id="resetPassword" class="btn btn-warning">Reset Password</button>
                                        <button type="reset" class="btn">Clear</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php   
            require 'include/footer.php';
            echo '</body></html>';
            exit();
            }
        }
    ?>
        <!-- default page content (login form) -->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-5 col-lg-5">
                        <div class="card">
                            <div class="card-header">Login</div>
                            <div class="card-body">
                                <form action="">
                                    <div></div>
                                    <div></div>
                                    <button type="button" id="login" class="btn btn-primary">Login</button>
                                    <a href="login.php?action=register" class="btn btn-success">Register</a>
                                    <a href="login.php?action=resetPassword" class="btn btn-warning">Reset Password</a>
                                    <button button="reset" class="btn">Clear</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>         
            </div>
        <?php
            require "include/footer.php";
        ?>
</body>
</html>