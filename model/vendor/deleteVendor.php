<?php
    require_once('../../define/config/constant.php');
    require_once('../../define/config/dbConnect.php');

    $vendorID = htmlentities($_POST['vendorID']);

    if(isset($_POST['vendorID'])) {

        /* check mandatory field */
        if(!empty($vendorID)) {

            /* Sanitize vendor ID */
            $vendorID = filter_var($vendorID , FILTER_SANITIZE_STRING);

            /* check vendorID exist in DB */
            $qVen = "SELECT * FROM vendor WHERE vendorID = '$vendorID' ";
            $venStatement = $deal->prepare($qVen);
            $venStatement->execute(['vendorID'=> $vendorID]);

            if($venStatement->rowCount() > 0) {

                /* vendor exist in DB */
                $delVen = "DELETE FROM vendor WHERE vendorID = '$vendorID' " ;
                $delVenStatement = $deal->prepare($delVen);
                $delVenStatement->execute(['vendorID'=> $vendorID ]);

                echo '<div class="alert alert-succss"><button type="button" class="close" data-dismiss="alert">&times;</button> 
                          Vendor deleted.</div>';
                exit();
            } else {

                /* vendor does not exist */
                echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button> 
                           Vendor does not exist in DB.</div>';
                exit();
            }
        } else {
            /* Vendor is empty */
            echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>
                      Enter vendor.</div>';
            exit();
        }
    }
?>