<?php include("controller/category.php");?>
<div class="content-wrapper">
          <div class="row">
		  
		  <div class="col-md-12 col-sm-12">
                <?php if(isset($_SESSION['msg'])){?> 
                 <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <?php echo $client_lang[$_SESSION['msg']] ; ?></a> </div>
                <?php unset($_SESSION['msg']);}?> 
              </div>
			  
<div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
				<h4 class="card-title">Category</h4>
                  <div class=" text-center table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
						<th>Id</th>
						<th>Image</th>
						<th>Name</th>
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
					<td><?php echo $users_row['cid'];?></td>
				   <td><img class="card-img-top" src="images/<?php echo $users_row['cimage'];?>" onerror="this.onerror=null;this.src='<?php echo BASE_URL; ?>asset/images/users.png';" alt="Card image cap"></td>
                   <td><?php echo $users_row['cname'];?></td>
					<td>
					<a href="editcategory.php?cid=<?php echo $users_row['cid'];?>" class="btn btn-primary">Edit</a></td>
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