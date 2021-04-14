<!-- get program name from link  -->



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- Order_value and price value are fixed, also we can fetch data from DATABASE  -->

    <div class="wrapper">
        <!-- <div class="contact-form"> -->
        <!-- <div class="input-fields"> -->
        <form action="payment.php?checkout=manual" method="POST">
            <h1 class="form_heading">Fill details for <?php echo $program_name ?> program </h1>
            <input type="hidden" class="input" name="orderid" value="2546" placeholder="">  
            <input type="hidden" class="input" name="price" placeholder="" value="1">
            <input type="text" class="input" name="name" placeholder="First_name">
            <input type="text" class="input" name="last_name" placeholder="Last_name">
            <input type="email" class="input" name="email" placeholder="Email_id">
            <input type="text" class="input" name="mobile" placeholder="Mobile_no">
            <!-- <input type="text" class="input address" name="address1" placeholder="Address 1"> -->
            <!-- <input type="text" class="input" name="pincode" placeholder="Pincode"> -->
            <button type="submit">Submit</button>
            <!-- <button>  </button> -->
        </form>
        <!-- </div> -->
        <!-- </div> -->
    </div>
</body>

</html>