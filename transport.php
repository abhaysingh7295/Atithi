<?php include("controller/transport.php"); ?>
<div class="content-wrapper">
    <div class="row">

        <div class="col-md-12 col-sm-12">
            <?php if (isset($_SESSION['msg'])) { ?> 
                <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <?php echo $client_lang[$_SESSION['msg']]; ?></a> </div>
                <?php unset($_SESSION['msg']);
            } ?> 
        </div>
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body avatar">
                    <h4 class="card-title">Add Transport</h4>

                    <a href="addtransport.php?add=yes"><button type="button" class="btn btn-success col-md-12"><strong>Add Transport</strong></button></a>

                </div>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Transport</h4>					  
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
                                    <th>Fuel Type</th>
                                    <th>Color<th>
                                    <th>Vehicle Type</th>
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
                                $i = 0;
                                while ($users_row = mysqli_fetch_array($users_result)) {
                                    ?>
                                    <tr>
                                        <td><img class="card-img-top" src="images/<?php echo $users_row['image']; ?>" onerror="this.onerror=null;this.src='<?php echo BASE_URL; ?>asset/images/users.png';" alt="Card image cap"></td>
                                        <td><?php echo $users_row['name']; ?></td>
                                        <td><?php echo $users_row['fueltype']; ?></td>
                                        <td><?php echo $users_row['color']; ?></td>
                                        <td><?php echo $users_row['vehicle']; ?></td>
                                        <td><?php echo $users_row['address']; ?></td>   
                                        <td><?php echo $users_row['cityname']; ?></td>
                                        <td><?php echo $users_row['cname']; ?></td>
                                        <td><?php echo $users_row['purpose']; ?></td>
                                        <td>$<?php echo $users_row['price']; ?></td>
                                        <td>
                                            <?php if ($users_row['featured'] != "0") { ?>
                                                <a href="transport.php?featurednonactive=<?php echo $users_row['transid']; ?>" data-toggle="tooltip" data-tooltip="ENABLE"><button type="button" class="badge badge-outline-success">Active</button></a></a>

                                            <?php } else { ?>

                                                <a href="transport.php?featuredactive=<?php echo $users_row['transid']; ?>" data-toggle="tooltip" data-tooltip="ENABLE"><button type="button" class="badge badge-outline-danger">nonActive</button></a></a>

                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($users_row['status'] != "0") { ?>
                                                <a href="transport.php?nonactive=<?php echo $users_row['transid']; ?>" data-toggle="tooltip" data-tooltip="ENABLE"><button type="button" class="badge badge-outline-success">Active</button></a></a>

                                            <?php } else { ?>

                                                <a href="transport.php?active=<?php echo $users_row['transid']; ?>" data-toggle="tooltip" data-tooltip="ENABLE"><button type="button" class="badge badge-outline-danger">nonActive</button></a></a>

                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="edittransport.php?transid=<?php echo $users_row['transid']; ?>" class="btn btn-primary">Edit</a>
                                            <a href="transport.php?transid=<?php echo $users_row['transid']; ?>" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-google">Delete</a>
</td>
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
<?php if (!isset($_POST["data_search"])) {
    include("pagination.php");
} ?>

                        </nav>
                    </div>
                </div>
            </div>

        </div> 

    </div>
    <?php include("includes/footer.php"); ?> 
