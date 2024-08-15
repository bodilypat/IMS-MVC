<?php
    require_once('../../define/config/constant.php');
    require_once('../../define/config/dbConnect.php');

    $customerID = htmlentities($_POST['customerID']);

    if(isset($_POST['customerID'])) {

        /* check mandatory fields */
        if(!empty($customerID)) {
            
            /* Sanitize field */
            $customer = filter_var($customerID, FILTER_SANITIZE_STRING);

            /* check customerID is exist in DB */
            $qCust = "SELECT customerID FROME customer WHERE customerID ='$customerID ' ";
            $custStatement = $deal->prepare($qCust);
            $custStatement->execute(['customerID'=> $customerID ]);

            if($custStaement->rowCount() > 0) {

                /* customer exist in DB */
                $delCust = "DELETE FROM customer WHERE customerID = '$customerID' ";
                $delCustStatement = $deal->prepare($delCust);
                $delCustStatement->execute(['customer'=> $customerID ]);

                echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>
                           customer deleted.</div>';
                exit();
            } else {

                    /* customer does not exist */
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                           Customer does not exist in DB.</div>';
                exit();
            }
        } else {

            /* customerID is empty */
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                       Enter customer ID.</div>';
            exit();
        }
    }
?>
