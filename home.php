<?php include("controller/home.php");?>
        <div class="content-wrapper">
          <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-account text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Users</p>
                      <div class="fluid-container">
                        <h1 class="font-weight-medium text-right mb-0"><?php echo $total_users;?></h1>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-home text-google icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Property</p>
                      <div class="fluid-container">
                        <h1 class="font-weight-medium text-right mb-0"><?php echo $total_prop;?></h1>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-home text-google icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Transport</p>
                      <div class="fluid-container">
                        <h1 class="font-weight-medium text-right mb-0"><?php echo $total_trans;?></h1>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-image text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Gallery</p>
                      <div class="fluid-container">
                        <h1 class="font-weight-medium text-right mb-0"><?php echo $total_gallery;?></h1>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-home text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">City</p>
                      <div class="fluid-container">
                        <h1 class="font-weight-medium text-right mb-0"><?php echo $total_city;?></h1>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
		  </div>
		 <div class="grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class=" text-center table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
				  <th>Image</th>
                  <th>Name</th>						 
				  <th>Bed</th>
				  <th>Bath</th>
				  <th>Area</th>
				  <th>Address</th>
				  <th>City</th>
				  <th>Category</th>
				  <th>Type</th>
				  <th>Price</th>
				  <th>Featured</th>	
				  <th>Status</th>				  
                  <th>Action</th>
                </tr>
                      </thead>
                      <tbody>
                        <?php
						$i=0;
						while($users_row=mysqli_fetch_array($users_result))
						{
						 
				?>
                <tr>
				   <td><img class="card-img-top" src="images/<?php echo $users_row['image'];?>" onerror="this.onerror=null;this.src='<?php echo BASE_URL; ?>asset/images/users.png';" alt="Card image cap"></td>
                   <td><?php echo $users_row['name'];?></td>
				   <td><?php echo $users_row['bed'];?></td>
				   <td><?php echo $users_row['bath'];?></td>
				   <td><?php echo $users_row['area'];?></td>
		           <td><?php echo $users_row['address'];?></td>   
		           <td><?php echo $users_row['cityname'];?></td>
				   <td><?php echo $users_row['cname'];?></td>
				   <td><?php echo $users_row['purpose'];?></td>
				   <td>$<?php echo $users_row['price'];?></td>
				   <td>
				   <?php if($users_row['featured']!="0"){?>
                      <a href="home.php?featurednonactive=<?php echo $users_row['propid'];?>" data-toggle="tooltip" data-tooltip="ENABLE"><button type="button" class="badge badge-outline-success">Active</button></a></a>

                      <?php }else{?>
                      
                      <a href="home.php?featuredactive=<?php echo $users_row['propid'];?>" data-toggle="tooltip" data-tooltip="ENABLE"><button type="button" class="badge badge-outline-danger">nonActive</button></a></a>

                      <?php }?>
				   </td>
				   <td>
				   <?php if($users_row['status']!="0"){?>
                      <a href="home.php?nonactive=<?php echo $users_row['propid'];?>" data-toggle="tooltip" data-tooltip="ENABLE"><button type="button" class="badge badge-outline-success">Active</button></a></a>

                      <?php }else{?>
                      
                      <a href="home.php?active=<?php echo $users_row['propid'];?>" data-toggle="tooltip" data-tooltip="ENABLE"><button type="button" class="badge badge-outline-danger">nonActive</button></a></a>

                      <?php }?>
				   </td>
					<td>
					<a href="editproperty.php?propid=<?php echo $users_row['propid'];?>" class="btn btn-primary">Edit</a>
					<a href="home.php?propid=<?php echo $users_row['propid'];?>" onclick="return confirm('Are you sure you want to delete this user?');" class="btn btn-google">Delete</a></td>
                </tr>
               <?php
						
						$i++;
						}
			   ?>
                      </tbody>
					  
                    </table>
								
                  </div>
				  <div class="d-flex align-items-center justify-content-between flex-column flex-sm-row mt-4">
                    <nav>
                <?php if(!isset($_POST["data_search"])){ include("pagination.php");}?>
            
                    </nav>
                  </div>
                </div>
              </div>
		 
 </div> 
		  
	  </div>
        <?php include("includes/footer.php");?> 




        
      
