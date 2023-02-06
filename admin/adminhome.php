<!DOCTYPE html>	
<html lang="en">
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<head> 
	<title> Admin Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
	<body>
	<header>
		<?php include 'adminheader.php';?>
	</header>
	<div class="about-us">
        <a>
            <h1>ABOUT US</h1>
            <p>
                One Paradise Massage was created with the understanding that for those with busy lives, going to the spa is sometimes about physical and mental maintenance not necessarily lounging for hours. We are one stop for your regular maintenance regimen in an upscale, relaxing, modern chic environment. Our services include a full range of treatments including massages, facials, body treatments, waxing, and nail care. We strive to provide a personalized experience every time you walk through our doors with a goal of leaving you feeling recuperated and well taken care of.
            </p>
            <img src="https://img.freepik.com/free-photo/attractive-african-woman-enjoying-face-massage-spa-salon_176420-13955.jpg">
            <p>
               Due to the pandemic, One Paradise Massage will be running their business on an appointment basis. This is to prevent the massage centre from being overcrowded, which can put the customers and the staff at higher risk.
            </p>
            <hr>
        </a>
    </div>
     <!--locate us-->
    <div class="location">
        <div class="location">
            <h1>WHERE TO FIND US</h1>
        </div>
        <div class="locate-us-row">
            <div class="locate-us-column">
                <h2>Kota Damansara</h2>
                <h3>3, Jalan Nuri 7/6, Kota Damansara, 47810 Petaling Jaya, Selangor.</h3>
                <h4>Contact Info: +607-323 1542</h4>
                <h4>Customer Service: oneparadise@gmail.com</h4>
            </div>
            <div class="location-column">
            <iframe src="https://maps.google.com/maps?q=3,%20Jalan%20Nuri%207/6,%20Kota%20Damansara,%2047810%20Petaling%20Jaya,%20Selangor&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
                <p></p><br>
                <hr>
            </div>
        </div>
     </div>
    <!--hour-->
    <div class="hour">
        <a>
            <h1>WORKING HOURS</h1>
            <p>MONDAY 8AM-5PM</p> 
            <p>TUESDAY 8AM-5PM</p>   
            <p>WEDNESDAY 8AM-5PM</p>   
            <p>THURSDAY 8AM-5PM</p>   
            <p>FRIDAY 8AM-5PM</p>   
            <p>SATURDAY 9AM-7PM</p>   
            <p>SUNDAY 9AM-7PM</p>   
            <hr>
        </a>
    </div>
	</body>
	<footer> 
		<?php include 'footer.php';?>
	</footer>
</html>