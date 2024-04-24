<?php
     require_once('../../define/constants.php');
     require_once('../../defin/dbconnect.php');

    $Username = '';
    $Password = '';
    $ConfirmPassword = '';
    $hashedPassword = '';
    
    if(isset($_POST['username']))
    {
        $Username = htmlentities($_POST['username']);
        $Password = htmlentities($_POST['password']);
        $ConfirmPassword = htmlentities($_POST['confirmPassword']);

        if(!empty($Username) && !empty($Password) && !empty($ConfirmPassword)){

            /* check username  */
            if($Username == ''){
				echo '<div class="alert alert-danger">
				          <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter your username.
					 </div>';
				exit();
			}
			
            /* check password, confirmPassword */
			if($Password == '' || $ConfirmPassword == ''){
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter both passwords.
					  </div>';
				exit();
			}

            /* check username available  */
            $qUser = 'SELECT * FROM user WHERE username = :Username';
            $userStatement = $dbconn->prepare($qUser);
            $userStatement->execute(['username' => $Username]);

            if($userStatement->rowCount() < 1){
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>username does not exist.
                      <div>';
                exit();
            } else {
                /* check password and equal confirmPassword */
                if($Password !== $ConfirmPassword){
                    echo '<div class="alert alert-danger">
                               <button type="button class="close" data-dismiss="alert">&times;</button>Password do not match.
                          <div>';
                    exit();
                } else {
                    $hashedPass = md5($password);
                    $editPass = 'UPDATE user SET password = :password WHERE username = :Username';
                    $userStatement->execute(['password'=> $hashedPass,' username'=> $Username]);

                    echo '<div class="alert alert-success">
                              <button type="button class="close" data-dismiss="alert"&times;</button>Password reset complete.
                              Please login using your new password.
                          </div>';
                    exit()
                }
            }
        } else {
            echo '<div class="alert alert-danger">
                       <button type="button" class="close" data-dismiss="alert">&times;</button>please enter all fileds marked with a(*)
                  </div>';
            exit();
        }
    }
?>
