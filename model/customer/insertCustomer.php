<?php
    require_once('../define/config/constant.php');
    require_once('../define/config/dbconnect.php');

    if(isset($_POST['customerFullName']))
    {
        $custFullName = htmlentities($_POST['customerFullName']);
        $custEmail = htmlenttiies($_POST['customerEmail']);
        $custMobile = htmlentities($_POST['customerMobile']);
        $custPhone = htmlentities($_POST['customerPhone']);
        $custAddress = htmlentities($_POST['customerAddress']);
        $custAddress2 = htmlentities($_POST['customerAddress2']);
        $custCity = htmlentities($_POST['customerCity']);
        $custDistrict = htmlentities($_POST['customerStatus']);

        if(isset($custFullName) && isset($custMobile) && isset($custAddress)){
            if(filter_var($custMobile, FILTER_VALIDATE_INT) === 0 || filter_var($custMobile, FILTER_VALIDATE_INT)){
                /* Valid mobile number */
            } else {
                echo '<div class="alert alert-danger">
                           <button type="close" data-dismiss="alert">&time;</button>
                                 enter mobile number
                     </div>';
                exit();
            }        
            /* validate phone number */
            if(!empty($custPhone)){
                if(filter_var($custPhone)){
                    /* phone number valid */
                    echo '<div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">&time;</button> 
                                    enter phone number
                        </div>';
                    exit();
                }
            }

            /* validate email  */
            if(!empty($custEmail)){
                if(filter_var($custEmail, FILTER_VALIDATE_EMAIL) === false ){
                    /* Email valid */
                    echo '<div class="alert alert-danger"><button type="button" class="close" data-dimiss="alert">&times;</button>
                            enter valid
                        </div>';
                    exit();
                }
            }
            /* validate address */
            if($custAddress == ''){
                echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        Enter Address
                    </div>';
                exit();
            }
            /* validate full name */
            if($custFullName == ''){
                echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dimiss="alert">&times</button>
                                Enter Full Name
                    </div>';
                exit();
            }

        /* insert data */
        $addCust = "INSERT INTO customer(fullName, email, mobile, phone, address, address2, city, district, status)
                    VALUES('$custFullName','$custEmail','$custMobile','$custAddress','$custAddress','$custAddress2','$custDistrict','$custStatus')";
        $custStatement = $deal->prepare($addCust);
        $custStatement->execute(['fullName' => $custFullName,
                                 'email' => $custEmail, 
                                 'mobile' => $custMobile, 
                                 'phone' => $custPhone,
                                 'address' => $custAddress,
                                 'address2' => $custAddress2,
                                 'city' => $custCity,
                                 'disstrict' => $custDistrict,
                                 'status' => $custStatus ]);
        echo '<div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">&tims;</button>add customer to database</div>';
        } else {
            /* empty field */
            echo '<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button> 
                            enter madatory field
                </div>';
            exit();
    }