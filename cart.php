<?php

if (isset($_REQUEST['productID'])) {

    $productID = $_REQUEST['productID'];
    $numberOfItems = $_REQUEST['numOfItems'];
    echo "ProductID : ".$productID." <Br>Number of Units :".$numberOfItems;
    
}


?>