<?php
include 'dbcon.php';
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$contact_number = $_POST['contact_number'];
$address = $_POST['address'];
$city = $_POST['city'];
$gender = $_POST['gender'];
$room_id = $_POST['room_id'];
$room_rate = $_POST['room_rate'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$number_of_person = $_POST['number_of_person'];
$date = date("Y-m-d");


	$string="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	$code="";
	$limit=10;
	$i=0;
	while($i<=$limit)
	{
		$rand=rand(0,61);
		$code.=$string[$rand];
		$i++;
	}
	
	mysqli_query($con,"INSERT INTO reservation(firstname,lastname,email,contact_number,address,city,gender,room_id,check_in,check_out,room_rate,number_of_person,r_code,date_reserved,reservation_status)VALUES('$firstname','$lastname','$email', '$contact_number', '$address', '$city','$gender','$room_id','$check_in','$check_out','$room_rate','$number_of_person','$code','$date','Pending')")or die(mysqli_error($con));  

	echo "<script>window.location = '../index.php'</script>";

?>


