<?php
include "connection.php";
if (isset($_REQUEST['submit'])) {
    $productid=$_REQUEST['productID'];
    $productID=$_REQUEST['productID'];
} 

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script > 
function changeImage(x) {
    switch (x) {
        case 2:
            document.getElementById('image0').src="<?php echo $productid ?>/2.jpeg";
            break;
        case 3:
            document.getElementById('image0').src="<?php echo $productid ?>/3.jpeg";
            break;
        case 4:
            document.getElementById('image0').src="<?php echo $productid ?>/4.jpeg";
            break;
        case 5:
            document.getElementById('image0').src="<?php echo $productid ?>/5.jpeg";
            break;
        default:
        document.getElementById('image0').src="<?php echo $productid ?>/1.jpeg";
            break;
    }
}
function changeShipping() {
    // shipping Rates are calculating in cart and aslo in checkout page as well

    // ***  Shipping Rates ***
    // First 2 kg 300 Lkr
    // Additional lkr 150 per 1 kg

    if ((weight*units)>2) {
        shipping = (300 + Math.ceil(weight*units - 2) * 150);
        shipping=(shipping / 100) * 100;
    }else {
        shipping=300;
    }

    document.getElementById('shippingCost').innerHTML=shipping;
}





function changeUnits(x) {

    if (x===1) {
        if (units>1) {
            units --;
        }
    }else if(x===2){
        if (units < max) {
            units += 1; 
        }
            
    }
    document.getElementById('units').innerHTML= "&nbsp;"+units ;
    changeShipping();
}


    </script>
    <style>
        body{
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        .product{
            size: 100%;
            margin-top: 0.7cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 0.7cm;
        }
        .images{
            float: left;
            width: 38%;
            border: 1px;
            border-style: solid;
            margin-right: 1cm;
        }
    
        .productDetails:after{
            border-right: 1cm;
            width: 62%;
            float: right;
            border-color: aliceblue;
            border-style: solid;
        }
        .mainimagediv{
            text-align: center;
        }
        .mainimage{
            text-align: center;
            width : 450px;
            height: 450px;
        }
        .secondaryimagediv{
            margin-top: 0.4cm;
            text-align: center;
        }
        .secondaryimage{
            width: 80px;
            height: 75px;
            border: 1px;
            border-style: inset;
        }
        .secondaryimage:hover{
            outline: 3px solid red; 
        }
        .productName{
            font-size: larger;
            font: bolder;
        }

    </style>
    <title>product</title>
</head>





<body>


    <br><br><br><br><br><br>
    <!--
        Header comes here

    -->

    <div class="product">

    <div class="images">
        <div class="mainimagediv">
            <span >
            <img  id="image0" class="mainimage" src="<?php echo $productid ?>/1.jpeg" alt="image1" >

            </span>

        </div>
        <div class="secondaryimagediv">
        <img onmouseenter="changeImage(1)" class="secondaryimage" id="image1" src="<?php echo $productid ?>/1.jpeg" alt="image1">
        <img onmouseenter="changeImage(2)" class="secondaryimage" id="image2" src="<?php echo $productid ?>/2.jpeg" alt="image2">
        <img onmouseenter="changeImage(3)" class="secondaryimage" id="image3" src="<?php echo $productid ?>/3.jpeg" alt="image3">
        <img onmouseenter="changeImage(4)" class="secondaryimage" id="image4" src="<?php echo $productid ?>/4.jpeg" alt="image4">
        <img onmouseenter="changeImage(5)" class="secondaryimage" id="image5" src="<?php echo $productid ?>/5.jpeg" alt="image5">
        </div>
    </div>
    <?php

    $sql = "SELECT * from product where productID=$productID";
    $result = $conn->query($sql);
    if ($result) {
       //echo ("Data retrived successfully ");
    }
    $row = $result->fetch_assoc();
    
    ?>
    <div class="productDetails">
        <p class="productName">
        <?php echo $row['name']?>
        </p>
        <p class="productSecondaryName">
        <?php echo $row['secondaryName']?>
        </p>

        <p class ="productDiscription">
        <?php echo $row['description']?>
        </p>

        <p class ="numberOfOrders">
        <?php echo $row['numberOfOrders']." orders "  ;?>
        </p>


        <!-- Item Price -->

        <p class ="price">
        <?php echo "LKR ".$row['price'] ;?>
        </p>




        <!-- Number of Items -->

        <p class="numberOfItems">
        <script>
            var units=1;
            var max = 0;
            max = <?php echo $row['availableUnits'] ; ?>;
        </script>

        Quantity: 
        <p style="color: cadetblue;"> 
           <img onclick="changeUnits(1)" id="-" src="-.jpeg" alt="Minus mark"  border-radius=50% width="18px">
           <span style="color: black;" id="units" >
            &nbsp; 1
           </span>
           <img onclick="changeUnits(2)" id="+" src="+.jpeg" alt="Plus mark"  border-radius=50% width="30px">
      
        
        
        
        <?php
           echo $row['availableUnits']." Avilable in store";
           
        
        ?>
        </p>

        </p>
        <?php

        $sql1 = "SELECT District,Province,Country from Customer where customerID='001'";
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch_assoc();
        ?>

        <script>
            var weight= <?php echo $row['weight'] ;?>
        </script>
        <p class="shipping">
            Ships to :  <?php echo $row1['District'].",", $row1['Province'].",",$row1['Country']; ?>
            
            <br>
            Shipping : LKR 
        <span id="shippingCost">
            &nbsp; 300
        </span>
    
        </p>
        

        <a href="cart.php?productID=<?php echo $productID;?>&numOfItems=">Add to cart</a>


    </div>
    </div>





    
    
</body>
</html>
