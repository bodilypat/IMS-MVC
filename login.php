<?php
    session_start();
    /* check user */
    if(isset($_SESSION['loggedIN']))
    {
        header('Location: index.php');
        exit();
    }
    require_once('define/config/constants.php');
    require_once('define/config/dbConnect.php');
    require_once('define/header.php');
?>
<body>
<?php
     <!-- store action login, register, passwordResent -->
    $action = '';
    if(isset($_GET['action']))
    {
        $action = $_GET['action'];
        if($action == 'register'){
?>
            <div class="container">
                 <div class="row">
                      <div class="col-sm-12">
                            <div class="card">
                                  <div class="card-header">Register</div>
                                  <div class="card-body">
                                       <form action="">
                                            <div id="registerMessage"></div>
                                            <div class="form-group">
                                                <label for="RegisterFullName">Name</label>
                                                <input type="text" id="rgFullName" name="rgFullname" class="form-control" >
                                            </div>
                                            <div class="form-group">
                                                <labe for="RegisterUsername"></label>
                                                <input type="email" id="rgUsername" name="rgUsername" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="RegisterPassword"><label>
                                                <input type="password"id="rgPassword" name="rgPassword" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="RegisterConfirmPassword"></label>
                                                <input type="password" id="rgConfirmPassword" name="rgConfirmPassword" class="form-control" >
                                            </div>
                                            <a href="login.php" class="btn btn-primary">Login</a>
                                            <button type="button" id="register" class="btn btn-success">Register</button>
                                            <a href="login.php?action=registerPassword" class="btn btn-warning">Register Password</a>
                                            <button type="reset" class="btn">Clear</button>
                                       </form>
                                  </div>
                            </div>
                      </div>
                 </div>
            </div>
<?php   
        require 'define/footer.php';
        echo '</body></html>';
        exit();
        } elseif($action == 'resetPassword'){
?>
            <div class="container">
                 <div class="row">
                       <div class="col-sm-12">
                             <div class="card">
                                   <div class="card-hader">Reset Password</div>
                                   <div class="card-body">
                                         <form action="">
                                               <div id="resetPasswordMessage"></div>
                                               <div class="form-group">
                                                     <label for="ResetUsername">User name</label>
                                                     <input id="rsUsername" name="rsUsername" type="text" class="form-control">
                                               </div>
                                               <div class="form-group">
                                                     <label for="ResetPassword">New Password</label>
                                                     <input id="rsPassword" name="rsPassword" type="password" class="form-control">
                                               </div>
                                               <div class="form-group">
                                                     <label for="ResetConfirmPassword">Confirm Password</label>
                                                     <input id="rsConfrimPassword" name="rsConfirmPassword" type="password" class="form-control">
                                               </div>
                                               <a href="login.php" class="btn btn-primary">Login</a>
                                               <a href="login.php?action=register" class="btn-btn warning">Register</a>
                                               <button type="button" id="resetPassword" class="btn btn-warning">Reset password</button>
                                               <button type="reset" class="btn">Clear</button>
                                         </form>
                                   </div>
                             </div>
                       </div>
                 </div>
            </div>
<?php
        require 'define/footer.php';
        echo '</body></html>';
        exit();
        }
    }
?>
            <div class="container">
                  <div class="row"></div>
                  <div class="col-sm-12">
                       <div class="card">
                            <div class="card-body">
                                  <form action="">
                                         <div id="loginMessage"></div>
                                         <div class="form-group">
                                               <label for="LoginUsername">Username</label>
                                               <input id="loginUsername" name="loginUsername" type="text" class="form-control">
                                         </div>
                                         <div class="form-group">
                                               <label></label>
                                               <input id="loginPassword" name="loginPassword" type="password" class="form-control">
                                         </div>
                                        <button type="button" id="login" class="btn btn-primary">Login</button>
                                        <a href="login.php?action=register" class="btn btn-success">Register</a>
                                        <a href="login.php?action=resetPassword" class="btn btn-warning">Reset Password</a>
                                        <button type="reset" class="btn">Clear<button>
                                  </form>
                            </div>
                       </div>
                  </div>
            </div>
<?php
    require 'define/footer.php';
?>

</body>
