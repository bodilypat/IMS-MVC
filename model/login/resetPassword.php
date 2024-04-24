<?php
     require_once('../../assign/constants.php');
     require_once('../../assign/dbconnect.php');

    $username = '';
    $password = '';
    $confirmPassword = '';
    $hashedPassword = '';
    
    if(isset($_POST['username']))
    {
        $username = htmlentities($_POST['username']);
        $password = htmlentities($_POST['password']);
        $confirmPassword = htmlentities($_POST['confirmPassword']);

        if(!empty($username) && !empty($password) && !empty($confirmPassword)){

            /* check username  */
            if($username == ''){
				echo '<div class="alert alert-danger">
				          <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter your username.
					 </div>';
				exit();
			}
			
            /* check password, confirmPassword */
			if($password == '' || $confirmPassword == ''){
				echo '<div class="alert alert-danger">
				           <button type="button" class="close" data-dismiss="alert">&times;</button>Please enter both passwords.
					  </div>';
				exit();
			}

            /* check username available  */
            $qUser = 'SELECT * FROM user WHERE username = :username';
            $userStatement = $dbconn->prepare($qUser);
            $userStatement->execute(['username' => $username]);

            if($userStatement->rowCount() < 1){
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>username does not exist.
                      <div>';
                exit();
            } else {
                /* check password and equal confirmPassword */
                if($password !== $confirmPassword){
                    echo '<div class="alert alert-danger">
                               <button type="button class="close" data-dismiss="alert">&times;</button>Password do not match.
                          <div>';
                    exit();
                } else {
                    $hashedPass = md5($password);
                    $editPass = 'UPDATE user SET password = :password WHERE username = :username';
                    $userStatement->execute(['password'=> $hashedPass,' username'=> $username]);

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