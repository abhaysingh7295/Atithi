<?php include("controller/editproperty.php");?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places">
    </script>
	
	<script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyCc6f-P5mqAhjKsca2KZefZRucUdq2xNgY&sensor=false&libraries=places'></script>
	<script src="asset/js/locationpicker.jquery.js"></script>
 
<div class="content-wrapper">
          <div class="row">
		  <div class="card-body">
          <div class="row">
            <div class="col-md-12">
               
              <div class="col-md-12 col-sm-12">
                <?php if(isset($_SESSION['msg'])){?> 
               	 <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                	<?php echo $client_lang[$_SESSION['msg']] ; ?></a> </div>
                <?php unset($_SESSION['msg']);}?>	
              </div>
            </div>
          </div>
            <div class="col-md-12 grid-margin stretch-card">
		
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> Edit Property</h4>
                  <form class="form form-horizontal" action="" method="post"  enctype="multipart/form-data" onsubmit="return editValidation(this);">
				  <input  type="hidden" name="propid" value="<?php echo $_GET['propid'];?>" />
				  <div class="form-group row">
                      <div class="col">
                        <label>Status</label>
                      <select class="form-control border-primary" name="status" id="status">
                        <option value="1" <?php if($row['status']=='1'){?>selected<?php }?>>Active</option>
                        <option value="0" <?php if($row['status']=='0'){?>selected<?php }?>>NonActive</option>
                    </select>
                      </div>
                      <div class="col">
                        <label>Featured</label>
                        <select class="form-control border-primary" name="featured" id="featured">
                        <option value="1" <?php if($row['featured']=='1'){?>selected<?php }?>>Active</option>
                        <option value="0" <?php if($row['featured']=='0'){?>selected<?php }?>>NonActive</option>
                    </select>
                      </div>
                    </div>
					
					<div class="form-group">
                      <label for="exampleInputName1">Property Name</label>
                     <input type="text" name="name" id="name" value="<?php echo $row['name'];?>" class="form-control">
                    </div>
					
					<div class="form-group">
                      <label for="exampleInputName1">User</label>
                      <select class="form-control border-primary" name="userid" id="userid">
                      <option value="">User</option>
                        <?php
                            while($user_row=mysqli_fetch_array($user_result))
                            {
                        ?>                       
                        <option value="<?php echo $user_row['userid'];?>" <?php if($user_row['userid']==$row['userid']){?>selected<?php }?>>
						<?php echo $user_row['fullname'];?>
						</option>                           
                        <?php
                          }
                        ?>
                    </select></div>
					
					<div class="form-group">
                      <label for="exampleInputName1">Select Category</label>
                      <select class="form-control border-primary" name="cid" id="cid">
                      <option value="">Select Category</option>
                        <?php
                            while($cat_row=mysqli_fetch_array($cat_result))
                            {
                        ?>                       
                        <option value="<?php echo $cat_row['cid'];?>" <?php if($cat_row['cid']==$row['cid']){?>selected<?php }?>>
						<?php echo $cat_row['cname'];?>
						</option>                           
                        <?php
                          }
                        ?>
                    </select></div>
					
					<div class="form-group">
                      <label for="exampleInputName1">Select City</label>
                      <select class="form-control border-primary" name="cityid" id="cityid">
                      <option value="">Select City</option>
                        <?php
                            while($city_row=mysqli_fetch_array($city_result))
                            {
                        ?>                       
                        <option value="<?php echo $city_row['cityid'];?>" <?php if($city_row['cityid']==$row['cityid']){?>selected<?php }?>>
						<?php echo $city_row['cityname'];?></option>                           
                        <?php
                          }
                        ?>
                    </select></div>
					
					<div class="form-group">
                      <label for="exampleInputName1">Select Type</label>
                      <select class="form-control border-primary" name="purpose" id="purpose">
                        <option value="Sale" <?php if($row['purpose']=='Sale'){?>selected<?php }?>>Sale</option>
                        <option value="Rent" <?php if($row['purpose']=='Rent'){?>selected<?php }?>>Rent</option>
                    </select></div>
					
					<div class="form-group row">
                      <div class="col">
                        <label>Bed</label>
                        <input type="text" name="bed" id="bed" value="<?php echo $row['bed'];?>" class="form-control">
                      </div>
                      <div class="col">
                        <label>Bath</label>
                        <input type="text" name="bath" id="bath" value="<?php echo $row['bath'];?>" class="form-control">
                      </div>
					  <div class="col">
                        <label>Area</label>
                        <input type="text" name="area" id="area" value="<?php echo $row['area'];?>" class="form-control">
                      </div>
                    </div>
					
					<div class="form-group">
                      <label for="exampleInputName1">Amenities</label>
                     <input type="text" name="amenities" id="amenities" value="<?php echo $row['amenities'];?>" class="form-control">
                    </div>
					
					<div class="form-group">
                      <label for="exampleInputName1">Price</label>
                     <input type="text" name="price" id="price" value="<?php echo $row['price'];?>" class="form-control">
                    </div>
					
					<div class="form-group">
                      <label for="exampleInputName1">Phone</label>
                     <input type="text" name="phone" id="phone" value="<?php echo $row['phone'];?>" class="form-control">
                    </div>
					
					<div class="form-group">
                
                  <label>Location</label>
                  <input type="text" class="form-control" name="address" id="us3-address" value="<?php echo $row['address'];?>" />
              
              </div>

              <div class="form-group">
                  <div id="us3" style="width: 100%; height: 400px;"></div>
              </div>
				
				<div class="form-group row">
                      <div class="col">
                        <label>Latitude</label>
                        <input type="text" name="latitude" id="us3-lat"  value="<?php echo $row['latitude'];?>" class="form-control">
                      </div>
                      <div class="col">
                        <label>Longitude</label>
                        <input type="text" name="longitude" id="us3-lon" value="<?php echo $row['longitude'];?>" class="form-control">
                      </div>
                    </div>
					
			  <div class="form-group">
                      <label for="exampleInputName1">Description</label>
                      <textarea name="description" id="description" class="form-control"><?php echo $row['description'];?></textarea>

                      <script>CKEDITOR.replace( 'description' );</script>
					  </div>
				
                  <div id="lightgallery-without-thumb" class="row lightGallery">
				  <?php
                            while ($row_img=mysqli_fetch_array($result1)) {?>
                    <a href="editproperty.php?image_id=<?php echo $row_img['id'];?>&propid=<?php echo $_GET['propid'];?>" class="image-tile">
					<img src="images/gallery/<?php echo $row_img['imagename'];?>" alt="image small">
					<div class="demo-gallery-poster">
                          <img src="asset/images/lightbox/ic_delete.png" alt="play">
                      </div>
					</a>
                  <?php
                          }
                          ?>
				    <a href="images/<?php echo $row['image'];?>" class="image-tile">
					<img src="images/<?php echo $row['image'];?>" alt="image small">
					
					</a>
					<a href="images/<?php echo $row['floorplan'];?>" class="image-tile">
					<img src="images/floorplan/<?php echo $row['floorplan'];?>" alt="image small">
					
					</a>
				  </div>
				  
				  <div class="form-group row">
                      <div class="col">
                      <label>Image</label>
					  
                      <div class="input-group col-xs-12">
                        <input type="file" name="image" id="fileupload">
                      </div>
                    </div>
                    <div class="col">
                      <label>Gallery</label>
					  
                      <div class="input-group col-xs-12">
                        <input type="file" name="galleryimage[]" id="fileupload" multiple>
                      </div>
                    </div>
					<div class="col">
                      <label>Floorplan</label>
					  
                      <div class="input-group col-xs-12">
                        <input type="file" name="floorplan" id="fileupload">
                      </div>
                    </div>
					</div>
					
				  <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-success col-md-12">Submit</button>
					</div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div> 

  </div>
      </div>
    </div>            
        <script>
            $('#us3').locationpicker({
                location: {
                    latitude: <?php echo $row['latitude'];?>,
                    longitude: <?php echo $row['longitude'];?>
                },
                radius: 300,
                inputBinding: {
                    latitudeInput: $('#us3-lat'),
                    longitudeInput: $('#us3-lon'),
                    radiusInput: $('#us3-radius'),
                    locationNameInput: $('#us3-address')
                },
                enableAutocomplete: true,
                onchanged: function (currentLocation, radius, isMarkerDropped) {
					}
            });
        </script>       
        
<?php include("includes/footer.php");?>      
