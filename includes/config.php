<?php
error_reporting(0);
ob_start();
session_start();
header("Content-Type: text/html;charset=UTF-8");
	
	//firebase database link
	$firebaseDb_URL="https://goestate-a907d.firebaseio.com/Match";
	$firebaseDb_URL_MainDb="https://goestate-a907d.firebaseio.com/";
//	define('BASE_URL', 'https://bhanushaapps.com/atithi/');
//        DEFINE ('DB_HOST', 'localhost');
//        DEFINE ('DB_USER', 'bhanush1_atithi');
//	DEFINE ('DB_PASSWORD', 'hM29fXcwDtAy'); 
//	DEFINE ('DB_NAME', 'bhanush1_atithi');
        
	DEFINE('BASE_URL', 'http://localhost/atithia/goestateadmin/');
        DEFINE ('DB_HOST', 'localhost');
        DEFINE ('DB_USER', 'root');
	DEFINE ('DB_PASSWORD', ''); 
	DEFINE ('DB_NAME', 'cityapp');

    $conn =mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

    if (!$conn) {
        die ("connection failed: " . mysqli_connect_error());
    } else {
        $conn->set_charset('UTF-8');
    }
	
	$GLOBALS['config'] = $conn;


    $ENABLE_RTL_MODE = 'false';


    //Profile
    if(isset($_SESSION['id']))
    {
    	$profile_qry="SELECT * FROM admin where id='".$_SESSION['id']."'";
	    $profile_result=mysqli_query($conn,$profile_qry);
	    $profile_details=mysqli_fetch_assoc($profile_result);

	    define("PROFILE_IMG",$profile_details['image']);
    }
    
	 
?> 
	 
 