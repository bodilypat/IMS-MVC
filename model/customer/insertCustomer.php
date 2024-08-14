<?php
    require_once('../../define/config/constants.php');
    require_once('../../define/config/dbConnect.php');

    if(isset($_POST['customerFullName'])) {
        $custFullName = htmlentities($_POST['customerFullName']);
        $custEmail = htmlentities($_POST['customerEmail']);
        $custMobile = htmlentities($_POST['customerMobile']);
        $custPhone = htmlentities($_POST['customerPhone']);
        $custAddress = htmlentities($_POST['customerAddress']);
        $custAddress2 = htmlentities($_POST['customerAddress2']);
        $custCity = htmlentities($_POST['customerCity']);
        $custDistrict = htmlentities($_POST['customerDistrict']);
        $custStatus = htmlentities($_POST['customerStatus']);

        if(isset($custFullName) && isset($custMobile) && isset($custAddress)) {
            /* validate mobile number */
            if(filter_var($custMobile, FILTER_VALIDATE_INT) === 0 || filter_var($custMobile, FILTER_VALIDATE_INT)) {
                /* valid mobile */
            } else {
                /* invalid mobile */
                echo '<div class="alert alert-danger"<button type="button" class="close" data-dismiss="alert">&times;</button>
                           valid mobile phone number
                     </div>';
                exit();                     
            }

            /* validate second phone number  */
            if(!empty($custPhone)) {
                if(filter_var($custPhone, FILTER_VALIDATE_INT) === false ) {
                    /* invalid phone number */
                    echo '<div class="alert alert-danger"<button type="button" class="close" data-dismiss="alert">&times;</button>
                               Enter valid phone number 
                         </div>';
                }
            }

            /* validate email */
            if(!empty($custEmail)) {
                if(filter_var($custEmail, FILTER_VALIDATE_EMAIL) === false) {
                    /* invalid Email */
                    echo '<div class="alert alert-danger"<button type="button" class="close" data-dismiss="alert">&times;</button>
                              Enter valid email 
                          </div>';
                    exit();
                }
            }

            /* validate address */
            if($custAddress == ''){
                /* address is empty */
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                           Enter address 
                      </div>';
                exit();
            }

            /* check full name is empty */
            if($custFullName == '') {
                /* full name is empty */
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                           Enter Full Name.
                     </div>';
                exit();
            }

            /* add customer record */
            $addCust = "INSERT INTO customer(fullname, email, mobile, phone, address, address2, city, district, status)
                        VALUES('$custFullName','$custEmail','$custMobile','$custPhone','$custAddress','$custAddress2','$custCity'$custDistrict','$custStatus')";
            $custStatement = $deal->prepare($addCust);
            $custStatement->execute(['fullName'=> $fullName, 'email'=> $custEmail,'mobile'=> $custMobile,'phone'=> $custPhone,'address'=> $custAddress,'address2'=>$custAddress,'city'=> $custCity,'district'=> $custDistrict, 'status'=> $custStatus]);

            echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>
                       Customer add to DB.
                 </div>';
            exit();
        } else {
            /* mandatory fields */
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                       Enter all fields marked with a(*)
                  </div>';
            exit();
        }
    }
?>
