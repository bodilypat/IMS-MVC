<?php
    require_once('../../define/constants.php');
    require_once('../../define/dbConnect.php');

    /* check POST */
    if(isset($_POST['customerID'])) {
        $custID = htmlentities($_POST['customerID']);
        $custFullName = htmlentities($_POST['customerFullName']);
        $custMobile = htmlentities($_POST['customerMobile']);
        $custPhone = htmlentities($_POST['customerPhone']);
        $custAddress = htmlentities($_POST['customerAddress']);
        $custAddress2 = htmlentities($_POST['customerAddress2']);
        $custCity = htmlentities($_POST['customerCity']);
        $custDistrict = htmlentities($_POST['customerDistrict']);
        $custStatus = htmlentities($_POST['customerDistrict']);

        /* check mandatory fields */
        if(isset($custFullName) && ($custMobile) && isset($custAddress)) {

            /* validate mobile number */
            if(filter_var($custMobile, FILTER_VALIDATE_INT) === 0 || filter_var($custMobile, FILER_VALIDATE_INT)) { 
                /* valid mobile number */
            } else {
                /* invalid mobile number  */
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                           Enter a  valid mobile number</div>';
                exit();
            }

            /* validate second phone number  */
            if(!empty($custPhone)) {
                if(filter_var($custPhone, FILER_VALIDATE_INT) === 0 || filter_var($custPhone, FILTER_VALIDATE_INT)) {
                    /* valid phone number */
                } else {
                    /* invalid phone number */
                    echo '<div class="alert alert-danger"><button type="button" class="close" daata-dismiss="alert">&times;</button>
                               Enter a valid phone number.</div>';
                    exit();
                }

                /* check customerID field is empty */
                if(empty($custID)) {
                        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button>
                                   Enter the custoemrID to update.</div>';
                        exit();
                }
            }
            
            /* validate email */
            if(!empty($custEmail)) {
                if(filter_var($custEmail, FILTER_VALIDATE_EMAIL) === false) {
                    /* valid email */
                    echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                               Enter a valid email</div>';
                    exit();
                }
            }

            /* check customerID  is in DB*/
            $qCust = "SELECT customerID FROM customer WHERE customerID = '$custID' ";
            $custStatement = $deal->prepare($qCust);
            $custStatement->execute(['customerID'=> $custID]);

            if($custStatement->rowCount() > 0) {
                /* customerID is available in DB. */
                $editCust = "UPDATE customer SET fullName = '$custFullName', 
                                                 email = '$custEmail', 
                                                 mobile = '$custMobile' 
                                                 phone = '$custPhone' 
                                                 address = '$custAddress' 
                                                 address2 = '$custAddress' 
                                                 city = '$custCity' 
                                                 district = '$custDistrict',
                                                 status = '$custStatus'
                             WHERE customerID = '$custrID' ";
                $updateCustStatement = $deal->prepare($editCust);
                $updateCustStatement->execute(['fullName' => $custFullName,
                                                'email' => $custEmail,
                                                'mobile' => $custMobile,
                                                'phone' => $custPhone,
                                                'address' => $custAddress,
                                                'address2' => $custAddress2,
                                                'city' => $custCity,
                                                'district' => $custDistrict,
                                                'status' => $custStatus,
                                                'customerID' => $custID ]);

                /* update customer name in sale table too */
                $editSale = "UPDATE sale SET customerName = '$custName' WHERE customerID = '$custID' ";
                $updateSaleStatement = $deal->prepare($editSale);
                $updateSaleStatememt->execute(['customerName' => $custFullName,'customerID' => $custID]);

                echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>
                          Customer objects updated.</div>';
                exit();
            } else {
                /* customerID does not in DB */
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                           customerID does not exist in DB.</div>';
                exit();
            }
        } else {
            /* mandatory fields empty  */
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                       Enter all fields marked with a (*).</div>';
            exit();
        }
    }
?>
