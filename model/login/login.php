<?php
     session_start();
     require_once('../../define/config/constants.php');
     require_once('../../define/config/dbconnect.php');

     $Username = '';
     $Password = '';
     $hasedPass = '';
     if(isset($_POST['username'])){
        $Username = $_POST['username'];
        $Password = $_POST['password'];

        if(!empty($Username) && !empty($Password)){
            $Username = filter_var($Username, FILTER_SANITIZE_STRING);

            /* check username is empty */
            if($Username == ''){
                echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&tiems</button>Eneter Username
                      </div>';
                exit();
            }
            if($Password == ''){
                echo '<div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>Enter Password
                      </div>';
                exit();
            }

            /* Encrypt password */
            /* check credentials  */
            $qUser = 'SELECT * FROM user WHERE username = :Username AND password = :Password';
            $userStatement = $dbcon->prepare($qUser);
            $userStatement->execute(['username' => $Username, 'password' => $hashedPass]);

            /* check user exit */
            if($userStatement->rowCount() > 0){
                /* valid , start the session */
                $result = $userStatement->fetch(PDO:FETCH_ASSOC);

                $_SESSION['loggedIn'] = '1';
                $_SESSION['fullName'] = $result['fullName'];

                echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Login success! Redirecting you to home page...</div>';
				exit();
			} else {
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Incorrect Username / Password</div>';
				exit();
			}
			
			
		} else {
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Username and Password</div>';
			exit();
        }
     }
?>
