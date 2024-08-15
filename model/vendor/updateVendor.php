<?php
    require_once('../../define/config/constants.php');
    require_once('../../define/config/dbConnect.php');

    /* check POST */
    if(isset($_POST['vendorID'])) {
        $vendorID = htmlentities($_POST['vendorID']);
        $vendorFullName = htmlentities($_POST['vendorFullName']);
        $vendorMobile = htmlentities($_POST['vendorMobile']);
        $vendorPhone = htmlentities($_POST['vendorPhone']);
        $vendorEmail = htmlentities($_POST['vendorEmail']);
        $vendorAddress = htmlentities($_POST['vendorAddress']);
        $vendorAddress2 = htmlentities($_POST['vendorAddress2']);
        $vendorCity = htmlentities($_POST['vendorCity']);
        $vendorDistrict = htmlentities($_POST['vendorDistrict']);
        $vendorStatus = htmlentities($_POST['vendorStatus']);

        /* check  vendorID  */
        if(!emtpy($vendorID)) {
            /* check mandatory fields are not empty */
            if(!empty($vendorFullName) && !empty($vendorMobile) && !empty($vendorAddress)) {

                /* validate mobile number */
                iif(filter_var($vendorMobile, FILTER_VALIDATE_INT) === 0 || filter_var($vendorMobile, FILTER_VALIDATE_INT)) {
                    /* valid mobile number */
                } else {
                    /* invalid mobile number */
                    echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                              Enter a valid mobile number.</div>';
                    exit();
                }

                /* check vendorID */
                if(empty($vendorID)) {
                    echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                              Enter vendorID to update.</div>';
                    exit();
                }

                /* validate email  */
                if(!empty($vendorPhone)) {
                    if(filter_var($vendorPhone, FILTER_VALIDATE_EMAIL) === 0 || filter_var($vendorPhone, FILTER_VALIDATE_INT)) {
                        /* valid phone number */
                    } else {
                        /*  invalid phone number */
                        echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                                  Enter  a valid number for phone number . </div>';
                        exit();
                    }
                }

                /* Get vendorID */
                $qVen = "SELECT vendorID FROM vendor WHERE vendorID = '$vendorID' ";
                $vendorStatement = $deal->prepare($qVen);
                $vendorStatement->execute(['vendorID'=> $vendorID]);

                if($vendorStatement->rowCount() > 0) {
                    /* vendorID is available in DB, Edit purchase */
                    $editVen = "UPDATE purchase SET vendorName = '$vendorName' WHERE vendorID = '$vendorID' ";
                    $updateVenStatement = $deal->prepare($editVen);
                    $updateVendorStatement->execute(['fullName'=> $vendorFullName,'vendorID'=> $vendorID]);

                    /* Update vendor */
                    $editVen = "UPDATE vendor SET fullName = '$vendorFullName', 
                                               email = '$vendorEmail',
                                               mobile = '$vendorMobile',
                                               phone = '$vendorPhone',
                                               address = '$vendorAddress',
                                               address2 = '$vendorAddress2',
                                               city = '$vendorCity',
                                               district = '$vendorDistrict',
                                               status = '$vendorStatus', 
                             WHERE vendorID = '$vendorID' ";
                    $updateVenStatement = $deal->prepare($editVen);
                    $updateVenStatement->execute(['fullName'=> $vendorFullName,
                                                  'email'=> $vendorEmail,
                                                  'mobile'=> $vendorMobile,
                                                  'phone'=> $vendorPhone,
                                                  'address'=> $vendorAddress,
                                                  'address2'=> $vendorAddress2,
                                                  'city' => $vendorCity,
                                                  'district'=> $vendorDistrict,
                                                  'vendorID'=> $vendorID,
                                                  'status'=> $vendorStatus]);

                    /* Edit purchase */
                    $editPurch = "UPDATE vendor SET vendorName = '$vendorName' WHERE vendorID = '$vendorID' ";
                    $updatePurchStatement = $deal->prepare($editPurch);
                    $updatePurchStatement->execute(['vendorName'=> $vendorFullName, 'vendorID'=> $vendorID]);

                    echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;
                               Vendor details updated.</div>';
                    exit();
                } else {
                    /* vendorID is not in DB */
                    echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                               Vendor ID does not exist in DB.</div>';
                    exit();
                }
            } else {
                /* mandatory fields are empty */
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                          Enter all fields marked with a(*)</div>';
                exit();
            }
        } else {
            /* vendorID is noot given by user */
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                      Enter vendorID to update that vendor.</div>';
            exit();
        }
    }
?> 
