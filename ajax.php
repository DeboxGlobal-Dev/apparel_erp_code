<?php 
include('adminpanel/includes/config.php');
//require("class.phpmailer.php");
//require("class.smtp.php");
 
$name=isset($_POST['name']) ? $_POST['name'] : "";
$email=isset($_POST['email']) ? $_POST['email'] : "";
$phone=isset($_POST['phone']) ? $_POST['phone'] : "";
$query="INSERT INTO `home_contact`(`name`, `email`,    `phone`, `datetime`)
 VALUES (:name, :email,   :phone,  NOW())";
$sql=$dbcon->prepare($query);
$sql->execute(array(':name' => $name, ':email' => $email,  ':phone' => $phone));

echo "<div id='msg'>Thank you for your Enquiry. Our team will contact you shortly.</div>";

/****Admin mail start here******/
$to = "marigold.aster.hair@gmail.com";
$subject = "Welcome to MARIGOLD + ASTER " .$name;
$message = "<table cellspacing='0' style='width: 300px; height: 250px;'>
    <thead>
        <tr></tr>
    </thead>
    <tbody>
        <tr style='background-color:#e0e0e0;'>
            <td>Name :</td>
            <td>".$name."</td>
        </tr>
        <tr style='background-color: #a09e9e;'>
            <td>Email :</td>
            <td>".$email."</td>
        </tr>
        
        </tr>
        <tr style='background-color: #a09e9e;'>
            <td>Mobile no. :</td>
            <td>".$phone."</td>
        </tr>
    </tbody>
</table>";
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <'.$email.'>' . "\r\n";
//$headers .= 'Cc: upendra@webzent.in' . "\r\n";
mail($to,$subject,$message,$headers);
/****Admin mail end here******/

/****User mail start here******/
/*$to1 = $email;
$subject1 = "Thank you for contact with us. Our team will contact you shortly";
$message1 = "Thanks for getting in touch. Your message has been received and will be processed as soon as possible.";
// Always set content-type when sending HTML email
$headers1 = "MIME-Version: 1.0" . "\r\n";
$headers1 .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers1 .= 'From: <marigold.aster.hair@gmail.com>' . "\r\n";
$headers1 .= 'Cc: upendra@webzent.in' . "\r\n";
mail($to1,$subject1,$message1,$headers1);*/
/****User mail end here******/
?>