<?php include("includes/header.php");
include("includes/function.php");

$qry_users="SELECT COUNT(*) as num FROM users";
$total_users= mysqli_fetch_array(mysqli_query($conn,$qry_users));
$total_users = $total_users['num'];

$qry_prop="SELECT COUNT(*) as num FROM property";
$total_prop = mysqli_fetch_array(mysqli_query($conn,$qry_prop));
$total_prop = $total_prop['num'];

$qry_gallery="SELECT COUNT(*) as num FROM gallery";
$total_gallery = mysqli_fetch_array(mysqli_query($conn,$qry_gallery));
$total_gallery = $total_gallery['num'];

$qry_city="SELECT COUNT(*) as num FROM city";
$total_city = mysqli_fetch_array(mysqli_query($conn,$qry_city));
$total_city = $total_city['num'];

$table_name="users";		
$target_page = "home.php"; 	
$limit = 6; 
							
$query = "SELECT COUNT(*) as num FROM $table_name";
$total_pages = mysqli_fetch_array(mysqli_query($conn,$query));
$total_pages = $total_pages['num'];
if(isset($_POST['user_search']))
	 {
		 
		
		$user_qry="SELECT * FROM property WHERE property.name like '%".addslashes($_POST['search_value'])."%' ORDER BY property.propid DESC";  
							 
		$users_result=mysqli_query($conn,$user_qry);
		
		 
	 }
	 else
	 {	
$table_name="property";		
$target_page = "home.php"; 	
$limit = 6; 
							
$query = "SELECT COUNT(*) as num FROM $table_name";
$total_pages = mysqli_fetch_array(mysqli_query($conn,$query));
$total_pages = $total_pages['num']; 

$stages = 8;
$page=0;
if(isset($_GET['page'])){
$page = mysqli_real_escape_string($conn,$_GET['page']);
}
if($page){
$start = ($page - 1) * $limit; 
}else{
$start = 0;	
}	
$user_qry="SELECT * FROM property
LEFT JOIN category ON property.cid= category.cid
LEFT JOIN city ON property.cityid= city.cityid
ORDER BY propid DESC LIMIT $start, $limit";  
$users_result=mysqli_query($conn,$user_qry);
	 }

if(isset($_GET['featurednonactive']))
{
  $data = array('featured'  =>  '0');
  
  $edit_status=Update('property', $data, "WHERE propid = '".$_GET['featurednonactive']."'");
  
   $_SESSION['msg']="16";
   header( "Location:home.php");
   exit;
}
if(isset($_GET['featuredactive']))
{
  $data = array('featured'  =>  '1');
  
  $edit_status=Update('property', $data, "WHERE propid = '".$_GET['featuredactive']."'");
  
  $_SESSION['msg']="15";
   header( "Location:home.php");
   exit;
}

if(isset($_GET['nonactive']))
{
  $data = array('status'  =>  '0');
  
  $edit_status=Update('property', $data, "WHERE propid = '".$_GET['nonactive']."'");
  
   $_SESSION['msg']="16";
   header( "Location:home.php");
   exit;
}
if(isset($_GET['active']))
{
  $data = array('status'  =>  '1');
  
  $edit_status=Update('property', $data, "WHERE propid = '".$_GET['active']."'");
  
  $_SESSION['msg']="15";
   header( "Location:home.php");
   exit;
}

if(isset($_GET['propid']))
	{
		
		Delete('property','propid='.$_GET['propid'].'');
		
		$_SESSION['msg']="12";
		header( "Location:home.php");
		exit;
	}

?>       

