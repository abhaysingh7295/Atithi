<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

 
  $cat_qry="SELECT * FROM category where type=2 ORDER BY cname";
  $cat_result=mysqli_query($conn,$cat_qry);

	$user_qry="SELECT * FROM users ORDER BY fullname";
  $user_result=mysqli_query($conn,$user_qry);  

  $city_qry="SELECT * FROM city ORDER BY cityname";
  $city_result=mysqli_query($conn,$city_qry); 

  if(isset($_GET['transid']))
  {
       
      $qry="SELECT * FROM transport where transid='".$_GET['transid']."'";
      $result=mysqli_query($conn,$qry);
      $row=mysqli_fetch_assoc($result);

     
      $qry1="SELECT * FROM gallery where type=2 and propid='".$_GET['transid']."'";
      $result1=mysqli_query($conn,$qry1);
       
  }
	
	if(isset($_POST['submit']))
	{
	   if($_FILES['floorplan']['name']!="")
     {
         $file_floor_plan= str_replace(" ","-",$_FILES['floorplan']['name']);

         $place_floor_plan_image=rand(0,99999)."_".$file_floor_plan;
           
         $tpath1='images/floorplan/'.$place_floor_plan_image;       
         $pic1=compress_image($_FILES["floorplan"]["tmp_name"], $tpath1, 80);
     }
     else
     {
         $place_floor_plan_image=$_POST['floor_plan_file_name'];
     }
      
     if($_FILES['image']['name']!="")
     {
        
          $file_name= str_replace(" ","-",$_FILES['image']['name']);

         $place_image=rand(0,99999)."_".$file_name;
           
         //Main Image
         $tpath1='images/'.$place_image;       
         $pic1=compress_image($_FILES["image"]["tmp_name"], $tpath1, 60);
         
          
              
           $data = array( 
				'userid'  =>  $_POST['userid'],
				'cid'  =>  $_POST['cid'],
				'cityid'  =>  $_POST['cityid'],
				'purpose'  =>  $_POST['purpose'],
				'name'  =>  addslashes($_POST['name']),
				'description'  =>  addslashes($_POST['description']),
				'fueltype'  =>  $_POST['fueltype'],
				'color'  =>  $_POST['color'],
				'vehicle'  =>  $_POST['vehicle'],
				'amenities'  =>  $_POST['otherfeature'],
				'price'  =>  $_POST['price'],
				'phone'  =>  $_POST['phone'],
				'address'  =>  addslashes($_POST['address']),
				'latitude'  =>  $_POST['latitude'],
				'longitude'  =>  $_POST['longitude'],
				'status'  =>  $_POST['status'],
				'featured'  =>  $_POST['featured'],
				'image'  =>  $place_image
              );    
    

     }
	 else if($_FILES['floorplan']['name']!="")
     {
            $data = array( 
				'userid'  =>  $_POST['userid'],
				'cid'  =>  $_POST['cid'],
				'cityid'  =>  $_POST['cityid'],
				'purpose'  =>  $_POST['purpose'],
				'name'  =>  addslashes($_POST['name']),
				'description'  =>  addslashes($_POST['description']),
				'fueltype'  =>  $_POST['fueltype'],
				'color'  =>  $_POST['color'],
				'vehicle'  =>  $_POST['vehicle'],
				'amenities'  =>  $_POST['otherfeature'],
				'price'  =>  $_POST['price'],
				'phone'  =>  $_POST['phone'],
				'address'  =>  addslashes($_POST['address']),
				'status'  =>  $_POST['status'],
				'featured'  =>  $_POST['featured'],
				'latitude'  =>  $_POST['latitude'],
				'longitude'  =>  $_POST['longitude'],
				'floorplan'  =>  $place_floor_plan_image
               );  
     }
     else
     {
            $data = array( 
				'userid'  =>  $_POST['userid'],
				'cid'  =>  $_POST['cid'],
				'cityid'  =>  $_POST['cityid'],
				'purpose'  =>  $_POST['purpose'],
				'name'  =>  addslashes($_POST['name']),
				'description'  =>  addslashes($_POST['description']),
				'fueltype'  =>  $_POST['fueltype'],
				'color'  =>  $_POST['color'],
				'vehicle'  =>  $_POST['vehicle'],
				'amenities'  =>  $_POST['otherfeature'],
				'price'  =>  $_POST['price'],
				'phone'  =>  $_POST['phone'],
				'address'  =>  addslashes($_POST['address']),
				'status'  =>  $_POST['status'],
				'featured'  =>  $_POST['featured'],
				'latitude'  =>  $_POST['latitude'],
				'longitude'  =>  $_POST['longitude']
               );  
     }

 
    $news_edit=Update('transport', $data, "WHERE transid = '".$_POST['transid']."'");

    $place_id=$_POST['transid'];

     

   $size_sum = array_sum($_FILES['galleryimage']['size']);
     
  if($size_sum > 0)
   { 
      for ($i = 0; $i < count($_FILES['galleryimage']['name']); $i++) 
      {
   
           $place_gallery_image=rand(0,99999)."_".$_FILES['galleryimage']['name'][$i];
           //Main Image
           $tpath1='images/gallery/'.$place_gallery_image;       
           $pic1=compress_image($_FILES["galleryimage"]["tmp_name"][$i], $tpath1, 80);
            $data1 = array(
                'propid'=>$place_id,
                'imagename'  => $place_gallery_image,
                'type'=>2
                );      

            $qry1 = Insert('gallery',$data1); 

      }
    }

 	    
		$_SESSION['msg']="11";
 
		header( "Location:edittransport.php?transid=".$_POST['transid']);
		exit;	

		
	}

  //Delete gallery image
  if(isset($_GET['image_id']))
  {
        $img_rss=mysqli_query($conn,'SELECT * FROM gallery WHERE type=2 and id=\''.$_GET['image_id'].'\'');
        $img_rss_row=mysqli_fetch_assoc($img_rss);
      
      if($img_rss_row['imagename']!="")
        {
          unlink('images/gallery/'.$img_rss_row['imagename']);
           
      }
  
    Delete('gallery','id='.$_GET['image_id'].'');
    
    
    header( "Location:edittransport.php?transid=".$_GET['transid']);
    exit;
  }
	 

?>