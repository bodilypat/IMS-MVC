<?php
    session_start();
    if(isset($_SESSION['loggedIn']))
    {
        header('Location:index.php');
        exit();
    }
    require_once('define/config/constants.php');
    require_once('define/config/dbconnect.php');
    require_once('define/header.html');
?>
<body>
<?php
    $action='';
    if(isset($_GET['action']))
    {
        $action = $_GET['action'];
        if($action == 'register'){
?>
            <div class="container">
                  <div class="row justify-content-center">
                       <div class="col-sm-12 col-md-5 col-lg-5">
                             <div class="card">
                                  <div class="card-header">Register</div>
                                  <div class="card-body">
                                        <form action="">
                                              <div id="registerMessage"></div>
                                              <div class="form-group">
                                                    <label for="FullName">FullName<span class="requireIcon">*</span></label>
                                                    <input id="fullname" name="fullname" type="text" class="form-control" autocomplete="on">
                                              </div>
                                              <div class="form-group">
                                                    <label for="Username">Username<span class="requireIcon">*</span></label>
                                                    <input id="username" name="username" type="email" class="form-control" autocomplete="on">
                                              </div>
                                              <div class="form-group">
                                                    <label for="Password">Password<span class="requireIcon">*</span><label>
                                                    <input id="password" name="password" type="password" class="form-control">
                                              </div>
                                              <div class="form-group">
                                                    <label for="ConfirmPassword">Confirm Password<span class="reguireIcon">*</span></label>
                                                    <input id="confirmPassword" name="confirmPassword" type="password" class="form-control">
                                              </div>
                                              <a href="login.php" class="btn btn-primary">Login</a>
                                              <button id="register" type="button" class="btn btn-success">Register</button>
                                              <a href="login.php?action=registerPassword" class="btn btn-warning">Reset Password</a>
                                              <button type="reset" class="btn">Clear</button>
                                        </form>
                                  </div>
                             </div>
                       </div>
                  </div>
            </div>
<?php
    require 'include/footer.php';
    echo '<body></html>';
    exit();
            } elseif($action == 'resetPassword'){
?>
            <div class="container">
                  <div class="row justify-content-conter">
                        <div class="col-sm-12 col-md-5 col-lg-5">
                              <div class="card">
                                    <div class="card-header">Reset Password</div>
                                    <div class="card-body">
                                          <form action="">
                                                <div id="resetPasswordMessage"></div>
                                                <div class="form-group">
                                                     <label for="ResetUsername">Username</label>
                                                     <input id="resetUsername" name="resetUsername">
                                                </div>
                                                <div class="form-group">
                                                     <label for="ResetPassword">New Password</label>
                                                     <input id="resetPassword" name="resetPassword">
                                                </div>
                                                <div class="form-group">
                                                      <label for="ResetConfirmPassword">Confirm Password</label>
                                                      <input id="resetConfirmPassword" name="resetConfirmPassword" type="password" class="form-control">
                                                </div>
                                                <a href="login.php" class="btn btn-primary">Login</a>
                                                <a href="login.php?action=register" class="btn btn-success">Register</a>
                                                <button id="resetPassword" type="button" class="btn btn-warning">Reset Password</button>
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
            <div class="container">
                 <div class="row justify-content-center">
                      <div class="col-sm-12 col-md-5 col-lg-5">
                            <div class="card">
                                  <div class="card-header">Login</div>
                                  <div id="card-body">
                                        <form action="">
                                              <div id="loginMessage"><div>
                                                <div class="form-group">
                                                     <label for="loginUsername">Username</label>
                                                     <input id="username" name="username" type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                      <label for="LoginPassword">Password</label>
                                                      <input id="password" name="password" type="password" class="form-control">
                                                </div>
                                                <button id="login" type="button" class="btn btn-primary">Login</button>
                                                <a href="login.php?action=register" class="btn btn-success">Register</a>
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
?>
