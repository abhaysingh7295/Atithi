<?php include("controller/editcategory.php");?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
 
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
                  <h4 class="card-title"> Edit Category</h4>
                  <form class="form form-horizontal" action="" method="post"  enctype="multipart/form-data" onsubmit="return editValidation(this);">
				  <input  type="hidden" name="cid" value="<?php echo $_GET['cid'];?>" />
				 
					
					<div class="form-group">
                      <label for="exampleInputName1">Category Name</label>
                     <input type="text" name="cname" id="cname" value="<?php echo $row['cname'];?>" class="form-control">
                    </div>
					
					<div class="form-group">
                      <label>File upload</label>
					  
                      <div class="input-group col-xs-12">
                        <input type="file" name="cimage" id="fileupload">
                      </div>
                    </div>
					<div class="form-group">
                    <label class="col-xs-12 control-label">&nbsp; </label>
                    <div class="col-md-12">
                        <?php if($row['cimage']) {?>
                              <div class="cimage"><img src="images/<?php echo $row['cimage'];?>" width="100%" /></div>
                        <?php }else{ ?>
                        	<div class="cimage"> <img type="image" src="assets/images/add-image.png" width="100%" alt="category image" /> </div>
                        <?php }?>
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
        
<?php include("includes/footer.php");?>      
