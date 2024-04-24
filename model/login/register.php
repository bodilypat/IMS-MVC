<?php
     require_once('../assign/config/constants.php');
     require_once('../assign/config/dbconnect.php');

     $FullName = '';
     $Username = '';
     $Password = '';
     $ConfirmPassword = '';
     $hashedPass = '';

     if(isset($_POST['username']))
     {
        $FullName = htmentities($_POST['fullName']);
        $Username = htmlentities($_POST['username']);
        $Password = htmlentities($_POST['password']);
        $ConfirmPassword = htmlentities($_POST['confirmPassword']);

        if(!empty($FullName) && !empty($Username) && !empty($Password) && !empty($ConfirmPassword))
        {
            $FullName == filter_var($FullName, FILTER_SANITIZE_STRING);
            if($FullName == '')
            {
                echo '<div class="alert-danger">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter your name.
                      </div>';
                      exit();
            }
            if($Username == '')
            {
                echo '<div class="alert alert-danger">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter your username.
                      </div>';
                exit();
            }
            if($Password == '' || $ConfirmPassword == '')
            {
                echo '<div class="alert alert-danger">
                          <button type="button" class="close" data-dimiss="alert">&times;<button>Please enter your username.</div>';
                exit();
            }
            /* check if username is available  */
            $qUser = 'SELECT * FROM user WHERE username = :Username';
            $userStatement = $dbcon->prepare($qUser);
            $userStatement->execute(['username' => $Username]);

            if($userStatement->rowCount() > 0){
                echo '<div class="alert alert-danger">
                          <button type="button" class="close" data-dismiss="alear">&times;</button>/Username not available.select different username.
                      </div>';
                exit();
            } else {
                if($Password !== $ConfirmPassword){
                    echo '<div class="alert alert-danger">
                               <button typ=e"button" class="close" data-dismiss="alert">&times;</button>Password do not match.
                          </div>';
                    exit();
                } else {
                    $hashedPassword = md5($Password);
                    $addUser = 'INSERT INTO user(fullname, username, password) VALUES(:FullName, :Username, :Password)';
                    $userStatement = $dbcon->prepare($addUser);
                    $userStatement->execute(['fullname'=> $FullName, 'username' => $Username, 'password' => $hashedPass]);
                    echo '<div class="alert alert-success">
                              <button type="button" class="close data-dismiss="alert">&times;<button>Registration complete.
                          </div>';
                    exit();
                }
            }
        } else {
            echo '<div class="close"alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert">&times;<button>Please enter field marked with a(*)
                  </div>';
            exit();
        }
     }
?>