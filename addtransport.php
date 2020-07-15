<?php include("controller/addtransport.php");?>
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
                  <h4 class="card-title"> Add Transport</h4>
                  <form class="form form-horizontal" action="" method="post"  enctype="multipart/form-data" onsubmit="return editValidation(this);">
				  <input  type="hidden" name="transid" value="<?php echo $_GET['transid'];?>" />
				  <div class="form-group row">
                      <div class="col">
                        <label>Status</label>
                      <select class="form-control border-primary" name="status" id="status">
                        <option value="1">Active</option>
                        <option value="0">NonActive</option>
                    </select>
                      </div>
                      <div class="col">
                        <label>Featured</label>
                        <select class="form-control border-primary" name="featured" id="featured">
                        <option value="1">Active</option>
                        <option value="0">NonActive</option>
                    </select>
                      </div>
                    </div>
					
					<div class="form-group">
                      <label for="exampleInputName1">Name</label>
                     <input type="text" name="name" id="name" class="form-control">
                    </div>
					
					<div class="form-group">
                      <label for="exampleInputName1">User</label>
                      <select class="form-control border-primary" name="userid" id="userid">
                      <option>User</option>
					  <?php
                            while($user_row=mysqli_fetch_array($user_result))
                            {
                        ?>
                                               
                        <option value="<?php echo $user_row['userid'];?>">
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
                        <option value="<?php echo $cat_row['cid'];?>">
						<?php echo $cat_row['cname'];?>
						</option>                           
                        <?php
                          }
                        ?>
                    </select></div>
					
					<div class="form-group">
                      <label for="exampleInputName1">Select City</label>
                      <select class="form-control border-primary" name="cityid" id="cityid">
                      <option value="<?php echo $city_row['cityid'];?>">Select City</option>
					  <?php
                            while($city_row=mysqli_fetch_array($city_result))
                            {
                        ?> 
                                              
                        <option>
						<?php echo $city_row['cityname'];?></option>                           
                        <?php
                          }
                        ?>
                    </select></div>
					
					<div class="form-group">
                      <label for="exampleInputName1">Select Type</label>
                      <select class="form-control border-primary" name="purpose" id="purpose">
                        <option value="Sale">Sale</option>
                        <option value="Rent">Rent</option>
                    </select></div>
					
					<div class="form-group row">
                      <div class="col">
                        <label>Fuel Type</label>
                       <select class="form-control border-primary" name="fueltype" id="purpose">
                        <option value="Petrol">Petrol</option>
                        <option value="Diesel">Diesel</option>
                        <option value="CNG">CNG</option>
                    </select>
                      </div>
                      <div class="col">
                        <label>Color</label>
                        <input type="text" name="color" id="bath" class="form-control">
                      </div>
					  <div class="col">
                        <label>Vehicle</label>
                         <select class="form-control border-primary" name="vehicle" id="purpose">
                        <option value="Car">Car</option>
                        <option value="Bus">Bus</option>
                        <option value="Track">Track</option>
                        <option value="Bike">Bike</option>

                    </select>
                      </div>
                    </div>
					
					<div class="form-group">
                      <label for="exampleInputName1">Other features</label>
                     <input type="text" name="otherfeature" id="amenities" class="form-control">
                    </div>
					
					<div class="form-group">
                      <label for="exampleInputName1">Price</label>
                     <input type="text" name="price" id="price" class="form-control">
                    </div>
					
					<div class="form-group">
                      <label for="exampleInputName1">Phone</label>
                     <input type="text" name="phone" id="phone" class="form-control">
                    </div>
					
					<div class="form-group">
                
                  <label>Location</label>
                  <input type="text" class="form-control" name="address" id="us3-address" />
              
              </div>

              <div class="form-group">
                  <div id="us3" style="width: 100%; height: 400px;"></div>
              </div>
				
				<div class="form-group row">
                      <div class="col">
                        <label>Latitude</label>
                        <input type="text" name="latitude" id="us3-lat" class="form-control">
                      </div>
                      <div class="col">
                        <label>Longitude</label>
                        <input type="text" name="longitude" id="us3-lon" class="form-control">
                      </div>
                    </div>
					
			  <div class="form-group">
                      <label for="exampleInputName1">Description</label>
                      <textarea name="description" id="description" class="form-control"></textarea>

                      <script>CKEDITOR.replace( 'description' );</script>
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
                    latitude: -6.222320699570134,
                    longitude: 106.83289668750001
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
