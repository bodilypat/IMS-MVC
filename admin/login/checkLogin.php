<?php
    session_start();
    require_once('../../include/config/constans.php');
    require_once('../../include/config/db.php');

    $loginUsername = '';
    $loginPassword = '';
    $hasedPassword = '';

    if(isset($_POST['loginUsername']) && isset($_POST['loginPassword'])) {
        $loginUsername = $_POST['loginUsername'];
        $loginPassword = $_POST['loginPassword'];

        /* Sanitize the Username to avoid injection attacks */
        $loginUsername = filter_var($loginUsername, FILTER_SANTIZE_STRING);

        /* Check if username and password are provided */
        if(empty($loginUsername) || empty($loginPassword)) {
            echo '<div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      Please enter both Username and Password.
                  </div>';
                exit();
        }

        /* prepare the SQL query to fetch the user from the database */
        $qUser = 'SELECT user WHERE username = : username';
        $checkUserStatement = $conn->prepare($qUser);
        $checkUserStatement -> execute(['username' => $loginUsername]);

        /* Check if user exist */
        if($checkUserStatement->rowCount() > 0) {
        
            /* Fetch user data from database */
            $result  = $checkUserStatement->fetch(PDO::FETCH_ASSOC);

            /* Verify the password using password_verify() */
            if(password_verify($loginPassword, $result['password'])) {
                /* Password is correct, start the session */
                $_SESSION['loggedIn'] = '1';
                $_SESSION['fullName'] = $result['fullName'];

                /* Regenerate the session ID for security */
                session_regenerate_id(true);

                echo '<div class="alert alert-success">
                          <button type="button" class="close" data-dismiss="alert">&times</button>
                                Login succes! redirecting you to the home page...
                      </div>';
                exit();
            } else {
                /* Password does not match */
                echo '<div class="alert alert-danger">
                           <button type="button" class="close" data-dismiss="alert">&time;</button>
                                Incorrect Username / Password
                      </div>';
                exit();
            }
        } else {
            /* User does not exist */
            echo '<div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                  </div>';
            exit();
        }
    }
