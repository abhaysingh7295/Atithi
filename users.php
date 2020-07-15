<?php include("controller/users.php");?>
<div class="content-wrapper">
          <div class="row">
		  
		  <div class="col-md-12 col-sm-12">
                <?php if(isset($_SESSION['msg'])){?> 
                 <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <?php echo $client_lang[$_SESSION['msg']] ; ?></a> </div>
                <?php unset($_SESSION['msg']);}?> 
              </div>
			  
			  <div class="col-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body avatar">
                      <h4 class="card-title">Add User</h4>
					  
					<a href="adduser.php?add=yes"><button type="button" class="btn btn-success col-md-12"><strong>Add User</strong></button></a>
				
                  </div>
                </div>
		 </div>
			  
<div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
				<h4 class="card-title">User</h4>
				<form  method="post" action="">
                      <div class="input-group col-xs-12">
                        <input class="form-control input-sm" placeholder="Search..." aria-controls="DataTables_Table_0" type="search" name="search_value" required>
                        
                        <div class="input-group-append">
                          <button class="file-upload-browse btn btn-info" type="submit" name="user_search">Search</button>                          
                        </div>
                      </div>
					  </form>
				
                  <div class=" text-center table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
						<th>Image</th>
						<th>Name</th>
						<th>Created</th>
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
				   <td><img class="card-img-top" src="<?php echo $users_row['imageprofile'];?>" onerror="this.onerror=null;this.src='<?php echo BASE_URL; ?>asset/images/users.png';" alt="Card image cap"></td>
                   <td><?php echo $users_row['fullname'];?></td>
				   <td><?php echo $users_row['created'];?></td>
					<td>
					<a href="edituser.php?userid=<?php echo $users_row['userid'];?>" class="btn btn-primary">Edit</a>
					<a href="users.php?userid=<?php echo $users_row['userid'];?>" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-google">Delete</a></td>
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
			  </div>
              </div>
		 
 </div> 
		  
	  </div>
        <?php include("includes/footer.php");?> 