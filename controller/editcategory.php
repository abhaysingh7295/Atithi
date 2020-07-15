<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");
 

  if(isset($_GET['cid']))
  {
       
      $qry="SELECT * FROM category where cid='".$_GET['cid']."'";
      $result=mysqli_query($conn,$qry);
      $row=mysqli_fetch_assoc($result);
       
  }
	
	if(isset($_POST['submit']))
	{
      
     if($_FILES['cimage']['name']!="")
     {
        
          $file_name= str_replace(" ","-",$_FILES['cimage']['name']);

         $place_image=rand(0,99999)."_".$file_name;
           
         //Main Image
         $tpath1='images/'.$place_image;       
         $pic1=compress_image($_FILES["cimage"]["tmp_name"], $tpath1, 60);
         
          
              
           $data = array( 
				'cid'  =>  $_POST['cid'],
				'cname'  =>  $_POST['cname'],
				'cimage'  =>  $place_image
              );    
    

     }
     else
     {
            $data = array( 
				'cid'  =>  $_POST['cid'],
				'cname'  =>  $_POST['cname']
              );  
     }

 
    $news_edit=Update('category', $data, "WHERE cid = '".$_POST['cid']."'");

 	    
		$_SESSION['msg']="11";
 
		header( "Location:editcategory.php?cid=".$_POST['cid']);
		exit;	

		
	}
	
	 

?>