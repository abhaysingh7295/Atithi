<?php

$file_path = 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']) . '/';
if (isset($_GET['signup'])) {
    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);
    //print_r($event_json);

    if (isset($event_json['userid']) && isset($event_json['fullname'])) {
        $userid = htmlspecialchars(strip_tags($event_json['userid'], ENT_QUOTES));
        $fullname = htmlspecialchars(strip_tags($event_json['fullname'], ENT_QUOTES));
        $imageprofile = htmlspecialchars_decode(stripslashes($event_json['imageprofile']));


        $log_in = "select * from users where userid='" . $userid . "'";
        $log_in_rs = mysqli_query($conn, $log_in);

        if (mysqli_num_rows($log_in_rs)) {
            $rd = mysqli_fetch_object($log_in_rs);

            $array_out = array();
            $array_out[] = //array("code" => "200");
                    array(
                        "userid" => $userid,
                        "action" => "login",
                        "imageprofile" => $imageprofile,
                        "fullname" => $fullname
            );

            $output = array("code" => "200", "msg" => $array_out);
            print_r(json_encode($output, true));
        } else {
            $qrry_1 = "insert into users(userid,fullname,imageprofile)values(";
            $qrry_1 .= "'" . $userid . "',";
            $qrry_1 .= "'" . $fullname . "',";
            $qrry_1 .= "'" . $imageprofile . "'";
            $qrry_1 .= ")";
            if (mysqli_query($conn, $qrry_1)) {
                $array_out = array();
                $array_out[] = //array("code" => "200");
                        array(
                            "userid" => $userid,
                            "action" => "signup",
                            "fullname" => $fullname,
                            "imageprofile" => $imageprofile
                );

                $output = array("code" => "200", "msg" => $array_out);
                print_r(json_encode($output, true));
            } else {
                //echo mysqli_error();
                $array_out = array();

                $array_out[] = array(
                    "response" => "problem in signup");

                $output = array("code" => "201", "msg" => $array_out);
                print_r(json_encode($output, true));
            }
        }
    } else {
        $array_out = array();

        $array_out[] = array(
            "response" => "Json Parem are missing");

        $output = array("code" => "201", "msg" => $array_out);
        print_r(json_encode($output, true));
    }
} else
if (isset($_GET['settingapp'])) {
    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);
    $array_out = array();

    $query = "SELECT * FROM settings WHERE id='1'";
    $sql = mysqli_query($conn, $query)or die(mysqli_error());
    if (mysqli_num_rows($sql)) {


        $rd = mysqli_fetch_object($sql);

        $array_out = array();

        $array_out[] = array(
            "app_author" => $rd->app_author,
            "app_contact" => $rd->app_contact,
            "app_email" => $rd->app_email,
            "app_website" => $rd->app_website,
            "app_description" => $rd->app_description,
            "app_version" => $rd->app_version,
            "ghipy_api" => $rd->ghipy_api,
            "app_privacy_policy" => $rd->app_privacy_policy
        );

        $output = array("code" => "200", "msg" => $array_out);
        print_r(json_encode($output, true));
    } else {
        $array_out = array();

        $array_out[] = array(
            "response" => "problem in updating");

        $output = array("code" => "201", "msg" => $array_out);
        print_r(json_encode($output, true));
    }
} else
if (isset($_GET['editprofile'])) {

    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);
    //print_r($event_json);
    //0= owner  1= company 2= ind mechanic

    if (isset($event_json['userid'])) {
        $userid = htmlspecialchars(strip_tags($event_json['userid'], ENT_QUOTES));
        $fullname = htmlspecialchars(strip_tags($event_json['fullname'], ENT_QUOTES));


        $qrry_1 = "update users SET fullname ='" . $fullname . "' WHERE userid ='" . $userid . "'";
        if (mysqli_query($conn, $qrry_1)) {
            $array_out = array();

            $qrry_1 = "select * from users WHERE userid ='" . $userid . "'";
            $log_in_rs = mysqli_query($conn, $qrry_1);

            if (mysqli_num_rows($log_in_rs)) {


                $rd = mysqli_fetch_object($log_in_rs);

                $array_out = array();

                $array_out[] = array(
                    "fullname" => $rd->fullname,
                    "imageprofile" => htmlspecialchars_decode(stripslashes($rd->imageprofile)),
                );

                $output = array("code" => "200", "msg" => $array_out);
                print_r(json_encode($output, true));
            }
        } else {
            $array_out = array();

            $array_out[] = array(
                "response" => "problem in updating");

            $output = array("code" => "201", "msg" => $array_out);
            print_r(json_encode($output, true));
        }
    } else {
        $array_out = array();

        $array_out[] = array(
            "response" => "Json Parem are missing");

        $output = array("code" => "201", "msg" => $array_out);
        print_r(json_encode($output, true));
    }
} else
if (isset($_GET['userdata'])) {

    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);

    if (isset($event_json['userid'])) {
        $userid = htmlspecialchars(strip_tags($event_json['userid'], ENT_QUOTES));


        $qrry_1 = "select * from users WHERE userid ='" . $userid . "' ";
        $log_in_rs = mysqli_query($conn, $qrry_1);

        if (mysqli_num_rows($log_in_rs)) {


            $rd = mysqli_fetch_object($log_in_rs);


            $array_out = array();

            $array_out[] = array(
                "block" => $rd->block,
                "fullname" => $rd->fullname,
                "imageprofile" => htmlspecialchars_decode(stripslashes($rd->imageprofile)),
            );

            $output = array("code" => "200", "msg" => $array_out);
            print_r(json_encode($output, true));
        } else {
            $array_out = array();

            $array_out[] = array(
                "response" => "problem in updating");

            $output = array("code" => "201", "msg" => $array_out);
            print_r(json_encode($output, true));
        }
    } else {
        $array_out = array();

        $array_out[] = array(
            "response" => "Json Parem are missing");

        $output = array("code" => "201", "msg" => $array_out);
        print_r(json_encode($output, true));
    }
} else
if (isset($_GET['uploadImages'])) {
    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);
    //print_r($event_json);
    //0= owner  1= company 2= ind mechanic

    if (isset($event_json['userid']) && isset($event_json['image_link'])) {
        $userid = htmlspecialchars(strip_tags($event_json['userid'], ENT_QUOTES));
        $image_link = stripslashes(strip_tags($event_json['image_link']));


        $qrry_1 = "select * from users WHERE userid ='" . $userid . "' ";
        $log_in_rs = mysqli_query($conn, $qrry_1);

        if (mysqli_num_rows($log_in_rs)) {
            $rd = mysqli_fetch_object($log_in_rs);
            if ($rd->imageprofile == "") {
                $colum_name = "imageprofile";
            }



            $qrry_1 = "update users SET $colum_name ='" . $image_link . "' WHERE userid ='" . $userid . "' ";
            if (mysqli_query($conn, $qrry_1)) {
                $array_out = array();

                $array_out[] = array(
                    "response" => "success");

                $output = array("code" => "200", "msg" => $array_out);
                print_r(json_encode($output, true));
            } else {
                $array_out = array();

                $array_out[] = array(
                    "response" => "problem in uploading");

                $output = array("code" => "201", "msg" => $array_out);
                print_r(json_encode($output, true));
            }
        }
    } else {
        $array_out = array();

        $array_out[] = array(
            "response" => "Json Parem are missing");

        $output = array("code" => "201", "msg" => $array_out);
        print_r(json_encode($output, true));
    }
} else
if (isset($_GET['deleteproperty'])) {
    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);
    //print_r($event_json);
    //0= owner  1= company 2= ind mechanic

    mysqli_query($conn, "Delete from property 
		where userid = '" . $_GET['userid'] . "' AND propid ='" . $_GET['deleteproperty'] . "'");

    $array_out = array();

    $array_out[] = array(
        "response" => "Delete succesfully");

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_GET['deleteImages'])) {
    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);
    //print_r($event_json);
    //0= owner  1= company 2= ind mechanic

    if (isset($event_json['userid']) && isset($event_json['image_link'])) {
        $userid = htmlspecialchars(strip_tags($event_json['userid'], ENT_QUOTES));
        $image_link = stripslashes(strip_tags($event_json['image_link']));


        mysqli_query($conn, "update users where userid='" . $userid . "'");

        $qrry_1 = "select * from users WHERE userid ='" . $userid . "' and imageprofile='" . $image_link . "'";
        $log_in_rs = mysqli_query($conn, $qrry_1);

        if (mysqli_num_rows($log_in_rs)) {
            $rd = mysqli_fetch_object($log_in_rs);
            if ($rd->imageprofile == $image_link) {
                $colum_name = "imageprofile";
            }



            $qrry_1 = "update users SET $colum_name ='' WHERE userid ='" . $userid . "'";
            if (mysqli_query($conn, $qrry_1)) {
                $array_out = array();

                $array_out[] = array(
                    "response" => "success");

                $output = array("code" => "200", "msg" => $array_out);
                print_r(json_encode($output, true));
            } else {
                $array_out = array();

                $array_out[] = array(
                    "response" => "problem in delete");

                $output = array("code" => "201", "msg" => $array_out);
                print_r(json_encode($output, true));
            }
        }
    } else {
        $array_out = array();

        $array_out[] = array(
            "response" => "Json Parem are missing");

        $output = array("code" => "201", "msg" => $array_out);
        print_r(json_encode($output, true));
    }
} else
if (isset($_GET['firstchat'])) {

    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);

    $userid = htmlspecialchars(strip_tags($event_json['userid'], ENT_QUOTES));
    $effected_id = htmlspecialchars(strip_tags($event_json['effected_id'], ENT_QUOTES));

    $qrry_1 = "update matches SET chat ='true' WHERE myid ='" . $userid . "' and matchid ='" . $effected_id . "' ";
    mysqli_query($conn, "update matches SET chat ='true' WHERE myid ='" . $effected_id . "' and matchid ='" . $userid . "'");
    if (mysqli_query($conn, $qrry_1)) {
        $array_out = array();

        $array_out[] = array(
            "response" => "update succesfully");
    }

    $output = array("code" => "202", "msg" => $array_out);
    print_r(json_encode($output, true));
}
//api place
else
if (isset($_GET['featuredproperty'])) {
    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $query_1 = "SELECT * FROM property
				LEFT JOIN category ON property.cid= category.cid
				WHERE property.status=1 and property.featured=1 ORDER BY property.propid DESC LIMIT 8";

    $log_in_rs1 = mysqli_query($conn, $query_1);
    $array_out = array();
    while ($rd = mysqli_fetch_object($log_in_rs1)) {

        $array_out[] = array(
            "propid" => $rd->propid,
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage,
            "bed" => $rd->bed,
            "bath" => $rd->bath,
            "area" => $rd->area,
            "price" => $rd->price,
            "amenities" => $rd->amenities,
            "floorplan" => $file_path . 'images/floorplan/' . $rd->floorplan,
            "purpose" => $rd->purpose,
            "name" => $rd->name,
            "description" => $rd->description,
            "phone" => $rd->phone,
            "address" => $rd->address,
            "latitude" => $rd->latitude,
            "longitude" => $rd->longitude,
            "image" => $file_path . 'images/' . $rd->image,
            "status" => $rd->status,
            "rate" => $rd->rate,
            "featured" => $rd->featured,
            "totalrate" => $rd->totalrate,
            "totalviews" => $rd->totalviews
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_GET['addproperty'])) {
    require_once("includes/function.php");
    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $file_name = str_replace(" ", "-", $_FILES['image']['name']);

    $place_image = rand(0, 99999) . "_" . $file_name;

    //Main Image
    $tpath1 = 'images/' . $place_image;
    $pic1 = compress_image($_FILES["image"]["tmp_name"], $tpath1, 160);




    if ($_FILES['floorplan']['name'] != "") {
        $file_floor_plan = str_replace(" ", "-", $_FILES['floorplan']['name']);

        $place_floor_plan_image = rand(0, 99999) . "_" . $file_floor_plan;

        //Main Image
        $tpath1 = 'images/floorplan/' . $place_floor_plan_image;
        $pic1 = compress_image($_FILES["floorplan"]["tmp_name"], $tpath1, 160);
    } else {
        $place_floor_plan_image = '';
    }


    $data = array(
        'userid' => $_POST['userid'],
        'cid' => $_POST['cid'],
        'cityid' => $_POST['cityid'],
        'purpose' => $_POST['purpose'],
        'name' => addslashes($_POST['name']),
        'description' => addslashes($_POST['description']),
        'bed' => $_POST['bed'],
        'bath' => $_POST['bath'],
        'area' => $_POST['area'],
        'amenities' => $_POST['amenities'],
        'price' => $_POST['price'],
        'phone' => $_POST['phone'],
        'address' => addslashes($_POST['address']),
        'latitude' => $_POST['latitude'],
        'longitude' => $_POST['longitude'],
        'image' => $place_image,
        'floorplan' => $place_floor_plan_image,
        'status' => 1
    );

    $qry = Insert('property', $data);

    $propid = mysqli_insert_id($conn);

    $size_sum = array_sum($_FILES['galleryimage']['size']);

    if ($size_sum > 0) {
        for ($i = 0; $i < count($_FILES['galleryimage']['name']); $i++) {
            $file_name1 = str_replace(" ", "-", $_FILES['galleryimage']['name'][$i]);

            $place_gallery_image = rand(0, 99999) . "_" . $file_name1;

            //Main Image
            $tpath1 = 'images/gallery/' . $place_gallery_image;
            $pic1 = compress_image($_FILES["galleryimage"]["tmp_name"][$i], $tpath1, 160);

            $data1 = array(
                'propid' => $propid,
                'imagename' => $place_gallery_image
            );

            $qry1 = Insert('gallery', $data1);
        }
    }

    $set['200'][] = array('propid' => $propid, 'msg' => 'Property has been added!', 'success' => 1);

    header('Content-Type: application/json; charset=utf-8');
    echo $val = str_replace('\\/', '/', json_encode($set, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
} else
if (isset($_GET['proprating'])) {
    require_once("includes/config.php");
    require_once("includes/function.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $query1 = mysqli_query($conn, "select * from rating where propid='" . $_GET['proprating'] . "' && ip ='" . $_GET['device_id'] . "'");
    while ($data1 = mysqli_fetch_assoc($query1)) {
        $rate_db1[] = $data1;
    }
    if (@count($rate_db1) == 0) {

        $data = array(
            'propid' => $_GET['proprating'],
            'rate' => $_GET['rate'],
            'ip' => $_GET['device_id'],
        );
        $qry = Insert('rating', $data);

        //Total rate result

        $query = mysqli_query($conn, "select * from rating where propid='" . $_GET['proprating'] . "'");

        while ($data = mysqli_fetch_assoc($query)) {
            $rate_db[] = $data;
            $sum_rates[] = $data['rate'];
        }

        if (@count($rate_db)) {
            $rate_times = count($rate_db);
            $sum_rates = array_sum($sum_rates);
            $rate_value = $sum_rates / $rate_times;
            $rate_bg = (($rate_value) / 5) * 100;
        } else {
            $rate_times = 0;
            $rate_value = 0;
            $rate_bg = 0;
        }

        $rate_avg = round($rate_value);

        $sql = "update property set totalrate=totalrate + 1,rate='$rate_avg' where propid='" . $_GET['proprating'] . "'";
        mysqli_query($conn, $sql);


        echo '{"goestate":[{"msg":"You have succesfully rated","rate_avg":"' . $rate_avg . '"}]}';
    } else {

        echo '{"goestate":[{"msg":"You have already rated"}]}';
    }
} else
if (isset($_GET['myproperty'])) {
    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $query_1 = "SELECT * FROM property
				LEFT JOIN category ON property.cid= category.cid
				WHERE property.status=1 and property.userid='" . $_GET['myproperty'] . "' ORDER BY property.propid DESC";

    $log_in_rs1 = mysqli_query($conn, $query_1);
    $array_out = array();
    while ($rd = mysqli_fetch_object($log_in_rs1)) {

        $array_out[] = array(
            "propid" => $rd->propid,
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage,
            "bed" => $rd->bed,
            "bath" => $rd->bath,
            "area" => $rd->area,
            "price" => $rd->price,
            "amenities" => $rd->amenities,
            "floorplan" => $file_path . 'images/floorplan/' . $rd->floorplan,
            "purpose" => $rd->purpose,
            "name" => $rd->name,
            "description" => $rd->description,
            "phone" => $rd->phone,
            "address" => $rd->address,
            "latitude" => $rd->latitude,
            "longitude" => $rd->longitude,
            "image" => $file_path . 'images/' . $rd->image,
            "status" => $rd->status,
            "rate" => $rd->rate,
            "featured" => $rd->featured,
            "totalrate" => $rd->totalrate,
            "totalviews" => $rd->totalviews
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_GET['allproperty'])) {
    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);

    if ($_GET['purpose'] != '' AND $_GET['pricemin'] != '' AND $_GET['pricemax'] != '' AND $_GET['bed'] != '' AND $_GET['bath'] != '' AND $_GET['cid'] != '' AND $_GET['cityid'] != '') {
        $query = "SELECT * FROM property
				LEFT JOIN category ON property.cid= category.cid
				LEFT JOIN city ON property.cityid= city.cityid
				WHERE property.status=1 AND property.purpose='" . $_GET['purpose'] . "'
				AND property.bath='" . $_GET['bath'] . "'
				AND property.bed='" . $_GET['bed'] . "'
				AND property.cid='" . $_GET['cid'] . "'
				AND property.cityid='" . $_GET['cityid'] . "'
				AND property.price >= '" . $_GET['pricemin'] . "' AND property.price<='" . $_GET['pricemax'] . "'";
    } else if ($_GET['purpose'] != '' AND $_GET['pricemin'] != '' AND $_GET['pricemax'] != '' AND $_GET['bath'] != '' AND $_GET['cid'] != '' AND $_GET['cityid'] != '') {
        $query = "SELECT * FROM property
				LEFT JOIN category ON property.cid= category.cid
				LEFT JOIN city ON property.cityid= city.cityid
				WHERE property.status=1 AND property.purpose='" . $_GET['purpose'] . "'
				AND property.bath='" . $_GET['bath'] . "'
				AND property.cid='" . $_GET['cid'] . "'
				AND property.cityid='" . $_GET['cityid'] . "'
				AND property.price >= '" . $_GET['pricemin'] . "' AND property.price<='" . $_GET['pricemax'] . "'
				ORDER BY propid DESC";
    } else if ($_GET['purpose'] != '' AND $_GET['pricemin'] != '' AND $_GET['pricemax'] != '' AND $_GET['bed'] != '' AND $_GET['bath'] != '' AND $_GET['cid'] != '') {
        $query = "SELECT * FROM property
				LEFT JOIN category ON property.cid= category.cid
				LEFT JOIN city ON property.cityid= city.cityid
				WHERE property.status=1 AND property.purpose='" . $_GET['purpose'] . "'
				AND property.bath='" . $_GET['bath'] . "'
				AND property.bed='" . $_GET['bed'] . "' 
				AND property.cid='" . $_GET['cid'] . "'
				AND property.price >= '" . $_GET['pricemin'] . "' AND property.price<='" . $_GET['pricemax'] . "'
				ORDER BY propid DESC";
    } else if ($_GET['purpose'] != '' AND $_GET['pricemin'] != '' AND $_GET['pricemax'] != '' AND $_GET['cid'] != '' AND $_GET['cityid'] != '') {
        $query = "SELECT * FROM property
				LEFT JOIN category ON property.cid= category.cid
				LEFT JOIN city ON property.cityid= city.cityid
				WHERE property.status=1 AND property.purpose='" . $_GET['purpose'] . "'
				AND property.cid='" . $_GET['cid'] . "'
				AND property.cityid='" . $_GET['cityid'] . "'
				AND property.price >= '" . $_GET['pricemin'] . "' AND property.price<='" . $_GET['pricemax'] . "'
				ORDER BY propid DESC";
    } else if ($_GET['purpose'] != '' AND $_GET['pricemin'] != '' AND $_GET['pricemax'] != '' AND $_GET['bed'] != '' AND $_GET['bath'] != '') {
        $query = "SELECT * FROM property
				LEFT JOIN category ON property.cid= category.cid
				LEFT JOIN city ON property.cityid= city.cityid
				WHERE property.status=1 AND property.purpose='" . $_GET['purpose'] . "'
				AND property.bed='" . $_GET['bed'] . "'
				AND property.bath='" . $_GET['bath'] . "'
				AND property.price >= '" . $_GET['pricemin'] . "' AND property.price<='" . $_GET['pricemax'] . "'
				ORDER BY propid DESC";
    } else if ($_GET['purpose'] != '' AND $_GET['pricemin'] != '' AND $_GET['pricemax'] != '' AND $_GET['bed'] != '') {
        $query = "SELECT * FROM property
				LEFT JOIN category ON property.cid= category.cid
				LEFT JOIN city ON property.cityid= city.cityid
				WHERE property.status=1 AND property.purpose='" . $_GET['purpose'] . "'
				AND property.bed='" . $_GET['bed'] . "'
				AND property.price >= '" . $_GET['pricemin'] . "' AND property.price<='" . $_GET['pricemax'] . "'
				ORDER BY propid DESC";
    } else if ($_GET['purpose'] != '' AND $_GET['pricemin'] != '' AND $_GET['pricemax'] != '' AND $_GET['bath'] != '') {
        $query = "SELECT * FROM property
				LEFT JOIN category ON property.cid= category.cid
				LEFT JOIN city ON property.cityid= city.cityid
				WHERE property.status=1 AND property.purpose='" . $_GET['purpose'] . "'
				AND property.bath='" . $_GET['bath'] . "'
				AND property.price >= '" . $_GET['pricemin'] . "' AND property.price<='" . $_GET['pricemax'] . "'
				ORDER BY propid DESC";
    } else if ($_GET['purpose'] != '' AND $_GET['pricemin'] != '' AND $_GET['pricemax'] != '' AND $_GET['cid'] != '') {
        $query = "SELECT * FROM property
				LEFT JOIN category ON property.cid= category.cid
				LEFT JOIN city ON property.cityid= city.cityid
				WHERE property.status=1 AND property.purpose='" . $_GET['purpose'] . "'
				AND property.cid='" . $_GET['cid'] . "'
				AND property.price >= '" . $_GET['pricemin'] . "' AND property.price<='" . $_GET['pricemax'] . "'
				ORDER BY propid DESC";
    } else if ($_GET['purpose'] != '' AND $_GET['pricemin'] != '' AND $_GET['pricemax'] != '' AND $_GET['cityid'] != '') {
        $query = "SELECT * FROM property
				LEFT JOIN category ON property.cid= category.cid
				LEFT JOIN city ON property.cityid= city.cityid
				WHERE property.status=1 AND property.purpose='" . $_GET['purpose'] . "'
				AND property.cityid='" . $_GET['cityid'] . "'
				AND property.price >= '" . $_GET['pricemin'] . "' AND property.price<='" . $_GET['pricemax'] . "'
				ORDER BY propid DESC";
    } else if ($_GET['purpose'] != '' AND $_GET['pricemin'] != '' AND $_GET['pricemax'] != '') {
        $query = "SELECT * FROM property
				LEFT JOIN category ON property.cid= category.cid
				LEFT JOIN city ON property.cityid= city.cityid
				WHERE property.status=1 AND property.purpose='" . $_GET['purpose'] . "'
				AND property.price >= '" . $_GET['pricemin'] . "' AND property.price<='" . $_GET['pricemax'] . "'
				ORDER BY propid DESC";
    } else {
        $query = "SELECT * FROM property
				LEFT JOIN category ON property.cid= category.cid
				LEFT JOIN city ON property.cityid= city.cityid
				WHERE property.status=1
				ORDER BY propid DESC";
    }




    $log_in_rs1 = mysqli_query($conn, $query);
    $array_out = array();
    while ($rd = mysqli_fetch_object($log_in_rs1)) {

        $array_out[] = array(
            "propid" => $rd->propid,
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage,
            "cityid" => $rd->cityid,
            "cityname" => $rd->cityname,
            "cityimage" => $file_path . 'images/' . $rd->cityimage,
            "bed" => $rd->bed,
            "bath" => $rd->bath,
            "area" => $rd->area,
            "price" => $rd->price,
            "amenities" => $rd->amenities,
            "floorplan" => $file_path . 'images/floorplan/' . $rd->floorplan,
            "purpose" => $rd->purpose,
            "name" => $rd->name,
            "description" => $rd->description,
            "phone" => $rd->phone,
            "address" => $rd->address,
            "latitude" => $rd->latitude,
            "longitude" => $rd->longitude,
            "image" => $file_path . 'images/' . $rd->image,
            "status" => $rd->status,
            "rate" => $rd->rate,
            "featured" => $rd->featured,
            "totalrate" => $rd->totalrate,
            "totalviews" => $rd->totalviews
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_GET['city'])) {

    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $query = "SELECT * FROM city ORDER BY city.cityid LIMIT 5";

    $log_in_rs1 = mysqli_query($conn, $query);
    $array_out = array();
    while ($rd = mysqli_fetch_object($log_in_rs1)) {

        $array_out[] = array(
            "cityid" => $rd->cityid,
            "cityname" => $rd->cityname,
            "cityimage" => $file_path . 'images/' . $rd->cityimage
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_GET['category'])) {

    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $query = "SELECT cid,cname,cimage FROM category ORDER BY category.cid";

    $log_in_rs1 = mysqli_query($conn, $query);
    $array_out = array();
    while ($rd = mysqli_fetch_object($log_in_rs1)) {

        $array_out[] = array(
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_GET['allpopularproperty'])) {

    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $query_1 = "SELECT * FROM property
				LEFT JOIN category ON property.cid= category.cid
				WHERE property.status=1 ORDER BY property.rate DESC";

    $log_in_rs1 = mysqli_query($conn, $query_1);
    $array_out = array();
    while ($rd = mysqli_fetch_object($log_in_rs1)) {

        $array_out[] = array(
            "propid" => $rd->propid,
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage,
            "bed" => $rd->bed,
            "bath" => $rd->bath,
            "area" => $rd->area,
            "price" => $rd->price,
            "amenities" => $rd->amenities,
            "floorplan" => $file_path . 'images/floorplan/' . $rd->floorplan,
            "purpose" => $rd->purpose,
            "name" => $rd->name,
            "description" => $rd->description,
            "phone" => $rd->phone,
            "address" => $rd->address,
            "latitude" => $rd->latitude,
            "longitude" => $rd->longitude,
            "image" => $file_path . 'images/' . $rd->image,
            "status" => $rd->status,
            "rate" => $rd->rate,
            "featured" => $rd->featured,
            "totalrate" => $rd->totalrate,
            "totalviews" => $rd->totalviews
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_GET['popularproperty'])) {

    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $query_1 = "SELECT * FROM property
				LEFT JOIN category ON property.cid= category.cid
				WHERE property.status=1 ORDER BY property.rate DESC LIMIT 5";

    $log_in_rs1 = mysqli_query($conn, $query_1);
    $array_out = array();
    while ($rd = mysqli_fetch_object($log_in_rs1)) {

        $array_out[] = array(
            "propid" => $rd->propid,
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage,
            "bed" => $rd->bed,
            "bath" => $rd->bath,
            "area" => $rd->area,
            "price" => $rd->price,
            "amenities" => $rd->amenities,
            "floorplan" => $file_path . 'images/floorplan/' . $rd->floorplan,
            "purpose" => $rd->purpose,
            "name" => $rd->name,
            "description" => $rd->description,
            "phone" => $rd->phone,
            "address" => $rd->address,
            "latitude" => $rd->latitude,
            "longitude" => $rd->longitude,
            "image" => $file_path . 'images/' . $rd->image,
            "status" => $rd->status,
            "rate" => $rd->rate,
            "featured" => $rd->featured,
            "totalrate" => $rd->totalrate,
            "totalviews" => $rd->totalviews
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_GET['latestproperty'])) {
    include('includes/function.php');
    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $query_1 = "SELECT * FROM property
				LEFT JOIN category ON property.cid= category.cid
				WHERE property.status=1 ORDER BY property.propid DESC LIMIT 5";

    $log_in_rs1 = mysqli_query($conn, $query_1);
    $array_out = array();
    while ($rd = mysqli_fetch_object($log_in_rs1)) {

        $array_out[] = array(
            "propid" => $rd->propid,
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage,
            "bed" => $rd->bed,
            "bath" => $rd->bath,
            "area" => $rd->area,
            "price" => $rd->price,
            "amenities" => $rd->amenities,
            "floorplan" => $file_path . 'images/floorplan/' . $rd->floorplan,
            "purpose" => $rd->purpose,
            "name" => $rd->name,
            "description" => $rd->description,
            "phone" => $rd->phone,
            "address" => $rd->address,
            "latitude" => $rd->latitude,
            "longitude" => $rd->longitude,
            "image" => $file_path . 'images/' . $rd->image,
            "status" => $rd->status,
            "rate" => $rd->rate,
            "featured" => $rd->featured,
            "totalrate" => $rd->totalrate,
            "totalviews" => $rd->totalviews
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_GET['cityid'])) {

    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $query_1 = "SELECT * FROM property
				WHERE cityid='" . $_GET['cityid'] . "'
				ORDER BY propid DESC";

    $log_in_rs1 = mysqli_query($conn, $query_1);
    $array_out = array();
    while ($rd = mysqli_fetch_object($log_in_rs1)) {

        $array_out[] = array(
            "propid" => $rd->propid,
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage,
            "bed" => $rd->bed,
            "bath" => $rd->bath,
            "area" => $rd->area,
            "price" => $rd->price,
            "amenities" => $rd->amenities,
            "floorplan" => $file_path . 'images/floorplan/' . $rd->floorplan,
            "purpose" => $rd->purpose,
            "name" => $rd->name,
            "description" => $rd->description,
            "phone" => $rd->phone,
            "address" => $rd->address,
            "latitude" => $rd->latitude,
            "longitude" => $rd->longitude,
            "image" => $file_path . 'images/' . $rd->image,
            "status" => $rd->status,
            "rate" => $rd->rate,
            "featured" => $rd->featured,
            "totalrate" => $rd->totalrate,
            "totalviews" => $rd->totalviews
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_GET['cid'])) {

    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $query_1 = "SELECT * FROM property
				WHERE cid='" . $_GET['cid'] . "'
				ORDER BY propid DESC";

    $log_in_rs1 = mysqli_query($conn, $query_1);
    $array_out = array();
    while ($rd = mysqli_fetch_object($log_in_rs1)) {

        $array_out[] = array(
            "propid" => $rd->propid,
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage,
            "bed" => $rd->bed,
            "bath" => $rd->bath,
            "area" => $rd->area,
            "price" => $rd->price,
            "amenities" => $rd->amenities,
            "floorplan" => $file_path . 'images/floorplan/' . $rd->floorplan,
            "purpose" => $rd->purpose,
            "name" => $rd->name,
            "description" => $rd->description,
            "phone" => $rd->phone,
            "address" => $rd->address,
            "latitude" => $rd->latitude,
            "longitude" => $rd->longitude,
            "image" => $file_path . 'images/' . $rd->image,
            "status" => $rd->status,
            "rate" => $rd->rate,
            "featured" => $rd->featured,
            "totalrate" => $rd->totalrate,
            "totalviews" => $rd->totalviews
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_GET['searchtext'])) {

    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $query = "SELECT * FROM property
				LEFT JOIN category ON property.cid= category.cid
				WHERE property.status=1 AND property.name LIKE '%" . $_GET['searchtext'] . "%' 
				OR property.address LIKE '%" . $_GET['searchtext'] . "%'
				OR property.amenities LIKE '%" . $_GET['searchtext'] . "%'				
				OR property.purpose LIKE '%" . $_GET['searchtext'] . "%' ORDER BY property.name";



    $log_in_rs1 = mysqli_query($conn, $query);
    $array_out = array();
    while ($rd = mysqli_fetch_object($log_in_rs1)) {

        $array_out[] = array(
            "propid" => $rd->propid,
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage,
            "bed" => $rd->bed,
            "bath" => $rd->bath,
            "area" => $rd->area,
            "price" => $rd->price,
            "amenities" => $rd->amenities,
            "floorplan" => $file_path . 'images/floorplan/' . $rd->floorplan,
            "purpose" => $rd->purpose,
            "name" => $rd->name,
            "description" => $rd->description,
            "phone" => $rd->phone,
            "address" => $rd->address,
            "latitude" => $rd->latitude,
            "longitude" => $rd->longitude,
            "image" => $file_path . 'images/' . $rd->image,
            "status" => $rd->status,
            "rate" => $rd->rate,
            "featured" => $rd->featured,
            "totalrate" => $rd->totalrate,
            "totalviews" => $rd->totalviews
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_GET['filterprice'])) {

    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    if ($_GET['filterprice'] != '') {
        $query = "SELECT * FROM property
				LEFT JOIN category ON property.cid= category.cid 
				LEFT JOIN city ON property.cityid= city.cityid 
				LEFT JOIN users ON property.userid= users.userid
				ORDER BY property.price " . $_GET['filterprice'] . "";
    } else {
        $query = "SELECT * FROM property
				LEFT JOIN category ON property.cid= category.cid 
				LEFT JOIN city ON property.cityid= city.cityid 
				LEFT JOIN users ON property.userid= users.userid
				ORDER BY property.propid";
    }


    $log_in_rs1 = mysqli_query($conn, $query);
    $array_out = array();
    while ($rd = mysqli_fetch_object($log_in_rs1)) {

        $array_out[] = array(
            "propid" => $rd->propid,
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage,
            "bed" => $rd->bed,
            "bath" => $rd->bath,
            "area" => $rd->area,
            "price" => $rd->price,
            "amenities" => $rd->amenities,
            "floorplan" => $file_path . 'images/floorplan/' . $rd->floorplan,
            "purpose" => $rd->purpose,
            "name" => $rd->name,
            "description" => $rd->description,
            "phone" => $rd->phone,
            "address" => $rd->address,
            "latitude" => $rd->latitude,
            "longitude" => $rd->longitude,
            "image" => $file_path . 'images/' . $rd->image,
            "status" => $rd->status,
            "rate" => $rd->rate,
            "featured" => $rd->featured,
            "totalrate" => $rd->totalrate,
            "totalviews" => $rd->totalviews
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_GET['distance'])) {

    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $latitude = $_GET['user_lat'];
    $longitude = $_GET['user_long'];

    $earthRadius = '6371.0'; // In miles(3959)  


    $query = mysqli_query($conn, "
	                SELECT p.*,c.*,city.*,
	                    ROUND(
	                        $earthRadius * ACOS(  
	                            SIN( $latitude*PI()/180 ) * SIN( latitude*PI()/180 )
	                            + COS( $latitude*PI()/180 ) * COS( latitude*PI()/180 )  *  COS( (longitude*PI()/180) - ($longitude*PI()/180) )   ) 
	                    , 1)
	                    AS distance                              
	                                      
	                FROM
	                    property p,category c, city city
	                WHERE p.cid= c.cid AND p.cityid= city.cityid AND  p.status='1'         
	                ORDER BY
	                    distance");


    $log_in_rs1 = mysqli_query($conn, $query);
    $array_out = array();
    while ($rd = mysqli_fetch_object($query)) {

        $array_out[] = array(
            "propid" => $rd->propid,
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage,
            "bed" => $rd->bed,
            "bath" => $rd->bath,
            "area" => $rd->area,
            "price" => $rd->price,
            "amenities" => $rd->amenities,
            "floorplan" => $file_path . 'images/floorplan/' . $rd->floorplan,
            "purpose" => $rd->purpose,
            "name" => $rd->name,
            "description" => $rd->description,
            "phone" => $rd->phone,
            "address" => $rd->address,
            "latitude" => $rd->latitude,
            "longitude" => $rd->longitude,
            "image" => $file_path . 'images/' . $rd->image,
            "status" => $rd->status,
            "rate" => $rd->rate,
            "featured" => $rd->featured,
            "totalrate" => $rd->totalrate,
            "totalviews" => $rd->totalviews
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_GET['propid'])) {
    $jsonObj = array();
    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);

    $query = "SELECT * FROM property
				LEFT JOIN category ON property.cid= category.cid 
				LEFT JOIN city ON property.cityid= city.cityid 
				LEFT JOIN users ON property.userid= users.userid
				WHERE propid='" . $_GET['propid'] . "'";

    $sql = mysqli_query($conn, $query)or die(mysqli_error());

    while ($data = mysqli_fetch_assoc($sql)) {

        $row['propid'] = $data['propid'];
        $row['purpose'] = $data['purpose'];
        $row['name'] = $data['name'];
        $row['description'] = stripslashes($data['description']);
        $row['phone'] = $data['phone'];
        $row['address'] = stripslashes($data['address']);
        $row['latitude'] = $data['latitude'];
        $row['longitude'] = $data['longitude'];

        $row['cityid'] = $data['cityid'];
        $row['cityname'] = $data['cityname'];
        $row['cityimage'] = $file_path . 'images/' . $data['cityimage'];

        $row['image'] = $file_path . 'images/' . $data['image'];

        $row['floorplan'] = $file_path . 'images/floorplan/' . $data['floorplan'];

        $row['bed'] = $data['bed'];
        $row['bath'] = $data['bath'];
        $row['area'] = $data['area'];
        $row['amenities'] = $data['amenities'];
        $row['price'] = $data['price'];



        $row['totalrate'] = $data['totalrate'];
        $row['rate'] = $data['rate'];
        $row['totalviews'] = $data['totalviews'];

        $row['cid'] = $data['cid'];
        $row['cname'] = $data['cname'];

        $row['userid'] = $data['userid'];
        $row['fullname'] = $data['fullname'];
        $row['imageprofile'] = $data['imageprofile'];

        $qry1 = "SELECT * FROM gallery WHERE propid='" . $_GET['propid'] . "'";
        $result1 = mysqli_query($conn, $qry1);

        if ($result1->num_rows > 0) {
            while ($row_img = mysqli_fetch_array($result1)) {
                $row1['propid'] = $data['propid'];
                $row1['gallery'] = $file_path . 'images/gallery/' . $row_img['imagename'];
                $row['galleryimage'][] = $row1;
            }
        } else {

            $row['galleryimage'][] = 'nodata';
        }
        array_push($jsonObj, $row);
    }


    $output = array("code" => "200", "msg" => $jsonObj);
    print_r(json_encode($output, true));
} else
//===========================================================all transport api start below==================================================
//==============================================transport api start below here ===================================//
if (isset($_REQUEST['alltransport'])) {
    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);

    if ($_REQUEST['purpose'] != '' AND $_REQUEST['pricemin'] != '' AND $_REQUEST['pricemax'] != '' AND $_REQUEST['color'] != '' AND $_REQUEST['fueltype'] != '' AND $_REQUEST['cid'] != '' AND $_REQUEST['cityid'] != '') {
        $query = "SELECT * FROM transport
				LEFT JOIN category ON transport.cid= category.cid
				LEFT JOIN city ON transport.cityid= city.cityid
				WHERE transport.status=1 AND transport.purpose='" . $_REQUEST['purpose'] . "'
				AND transport.fueltype='" . $_REQUEST['fueltype'] . "'
				AND transport.color='" . $_REQUEST['color'] . "'
				AND transport.cid='" . $_REQUEST['cid'] . "'
				AND transport.cityid='" . $_REQUEST['cityid'] . "'
				AND transport.price >= '" . $_REQUEST['pricemin'] . "' AND transport.price<='" . $_REQUEST['pricemax'] . "'";
    } else if ($_REQUEST['purpose'] != '' AND $_REQUEST['pricemin'] != '' AND $_REQUEST['pricemax'] != '' AND $_REQUEST['fueltype'] != '' AND $_REQUEST['cid'] != '' AND $_REQUEST['cityid'] != '') {
        $query = "SELECT * FROM transport
				LEFT JOIN category ON transport.cid= category.cid
				LEFT JOIN city ON transport.cityid= city.cityid
				WHERE transport.status=1 AND transport.purpose='" . $_REQUEST['purpose'] . "'
				AND transport.fueltype='" . $_REQUEST['fueltype'] . "'
				AND transport.cid='" . $_REQUEST['cid'] . "'
				AND transport.cityid='" . $_REQUEST['cityid'] . "'
				AND transport.price >= '" . $_REQUEST['pricemin'] . "' AND transport.price<='" . $_REQUEST['pricemax'] . "'
				ORDER BY transid DESC";
    } else if ($_REQUEST['purpose'] != '' AND $_REQUEST['pricemin'] != '' AND $_REQUEST['pricemax'] != '' AND $_REQUEST['color'] != '' AND $_REQUEST['fueltype'] != '' AND $_REQUEST['cid'] != '') {
        $query = "SELECT * FROM transport
				LEFT JOIN category ON transport.cid= category.cid
				LEFT JOIN city ON transport.cityid= city.cityid
				WHERE transport.status=1 AND transport.purpose='" . $_REQUEST['purpose'] . "'
				AND transport.color='" . $_REQUEST['color'] . "'
				AND transport.fueltype='" . $_REQUEST['fueltype'] . "' 
				AND transport.cid='" . $_REQUEST['cid'] . "'
				AND transport.price >= '" . $_REQUEST['pricemin'] . "' AND transport.price<='" . $_REQUEST['pricemax'] . "'
				ORDER BY transid DESC";
    } else if ($_REQUEST['purpose'] != '' AND $_REQUEST['pricemin'] != '' AND $_REQUEST['pricemax'] != '' AND $_REQUEST['cid'] != '' AND $_REQUEST['cityid'] != '') {
        $query = "SELECT * FROM transport
				LEFT JOIN category ON transport.cid= category.cid
				LEFT JOIN city ON transport.cityid= city.cityid
				WHERE transport.status=1 AND transport.purpose='" . $_REQUEST['purpose'] . "'
				AND transport.cid='" . $_REQUEST['cid'] . "'
				AND transport.cityid='" . $_REQUEST['cityid'] . "'
				AND transport.price >= '" . $_REQUEST['pricemin'] . "' AND transport.price<='" . $_REQUEST['pricemax'] . "'
				ORDER BY transid DESC";
    } else if ($_REQUEST['purpose'] != '' AND $_REQUEST['pricemin'] != '' AND $_REQUEST['pricemax'] != '' AND $_REQUEST['color'] != '' AND $_REQUEST['fueltype'] != '') {
        $query = "SELECT * FROM transport
				LEFT JOIN category ON transport.cid= category.cid
				LEFT JOIN city ON transport.cityid= city.cityid
				WHERE transport.status=1 AND transport.purpose='" . $_REQUEST['purpose'] . "'
				AND transport.color='" . $_REQUEST['color'] . "'
				AND transport.fueltype='" . $_REQUEST['fueltype'] . "'
				AND transport.price >= '" . $_REQUEST['pricemin'] . "' AND transport.price<='" . $_REQUEST['pricemax'] . "'
				ORDER BY transid DESC";
    } else if ($_REQUEST['purpose'] != '' AND $_REQUEST['pricemin'] != '' AND $_REQUEST['pricemax'] != '' AND $_REQUEST['color'] != '') {
        $query = "SELECT * FROM transport
				LEFT JOIN category ON transport.cid= category.cid
				LEFT JOIN city ON transport.cityid= city.cityid
				WHERE transport.status=1 AND transport.purpose='" . $_REQUEST['purpose'] . "'
				AND transport.color='" . $_REQUEST['color'] . "'
				AND transport.price >= '" . $_REQUEST['pricemin'] . "' AND transport.price<='" . $_REQUEST['pricemax'] . "'
				ORDER BY transid DESC";
    } else if ($_REQUEST['purpose'] != '' AND $_REQUEST['pricemin'] != '' AND $_REQUEST['pricemax'] != '' AND $_REQUEST['fueltype'] != '') {
        $query = "SELECT * FROM transport
				LEFT JOIN category ON transport.cid= category.cid
				LEFT JOIN city ON transport.cityid= city.cityid
				WHERE transport.status=1 AND transport.purpose='" . $_REQUEST['purpose'] . "'
				AND fueltype.fueltype='" . $_REQUEST['fueltype'] . "'
				AND fueltype.price >= '" . $_REQUEST['pricemin'] . "' AND fueltype.price<='" . $_REQUEST['pricemax'] . "'
				ORDER BY transid DESC";
    } else if ($_REQUEST['purpose'] != '' AND $_REQUEST['pricemin'] != '' AND $_REQUEST['pricemax'] != '' AND $_REQUEST['cid'] != '') {
        $query = "SELECT * FROM transport
				LEFT JOIN category ON transport.cid= category.cid
				LEFT JOIN city ON transport.cityid= city.cityid
				WHERE transport.status=1 AND transport.purpose='" . $_REQUEST['purpose'] . "'
				AND transport.cid='" . $_REQUEST['cid'] . "'
				AND transport.price >= '" . $_REQUEST['pricemin'] . "' AND transport.price<='" . $_REQUEST['pricemax'] . "'
				ORDER BY transid DESC";
    } else if ($_REQUEST['purpose'] != '' AND $_REQUEST['pricemin'] != '' AND $_REQUEST['pricemax'] != '' AND $_REQUEST['cityid'] != '') {
        $query = "SELECT * FROM transport
				LEFT JOIN category ON transport.cid= category.cid
				LEFT JOIN city ON transport.cityid= city.cityid
				WHERE transport.status=1 AND transport.purpose='" . $_REQUEST['purpose'] . "'
				AND transport.cityid='" . $_REQUEST['cityid'] . "'
				AND transport.price >= '" . $_REQUEST['pricemin'] . "' AND transport.price<='" . $_REQUEST['pricemax'] . "'
				ORDER BY transid DESC";
    } else if ($_REQUEST['purpose'] != '' AND $_REQUEST['pricemin'] != '' AND $_REQUEST['pricemax'] != '') {
        $query = "SELECT * FROM transport
				LEFT JOIN category ON transport.cid= category.cid
				LEFT JOIN city ON transport.cityid= city.cityid
				WHERE transport.status=1 AND transport.purpose='" . $_REQUEST['purpose'] . "'
				AND transport.price >= '" . $_REQUEST['pricemin'] . "' AND transport.price<='" . $_REQUEST['pricemax'] . "'
				ORDER BY transid DESC";
    } else {
        $query = "SELECT * FROM transport
				LEFT JOIN category ON transport.cid= category.cid
				LEFT JOIN city ON transport.cityid= city.cityid
				WHERE transport.status=1
				ORDER BY transid DESC";
    }




    $log_in_rs1 = mysqli_query($conn, $query);
    $array_out = array();
    while ($rd = mysqli_fetch_object($log_in_rs1)) {

        $array_out[] = array(
            "transid" => $rd->transid,
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage,
            "cityid" => $rd->cityid,
            "cityname" => $rd->cityname,
            "cityimage" => $file_path . 'images/' . $rd->cityimage,
            "color" => $rd->color,
            "fueltype" => $rd->fueltype,
            "vehicle" => $rd->vehicle,
            "price" => $rd->price,
            "amenities" => $rd->amenities,
            "floorplan" => $file_path . 'images/floorplan/' . $rd->floorplan,
            "purpose" => $rd->purpose,
            "name" => $rd->name,
            "description" => $rd->description,
            "phone" => $rd->phone,
            "address" => $rd->address,
            "latitude" => $rd->latitude,
            "longitude" => $rd->longitude,
            "image" => $file_path . 'images/' . $rd->image,
            "status" => $rd->status,
            "rate" => $rd->rate,
            "featured" => $rd->featured,
            "totalrate" => $rd->totalrate,
            "totalviews" => $rd->totalviews
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_REQUEST['transportrating'])) {
    require_once("includes/config.php");
    require_once("includes/function.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $query1 = mysqli_query($conn, "select * from rating where propid='" . $_REQUEST['transportrating'] . "' && ip ='" . $_REQUEST['device_id'] . "' and type=2");
    while ($data1 = mysqli_fetch_assoc($query1)) {
        $rate_db1[] = $data1;
    }
    if (@count($rate_db1) == 0) {

        $data = array(
            'propid' => $_REQUEST['transportrating'],
            'rate' => $_REQUEST['rate'],
            'ip' => $_REQUEST['device_id'],
            'type' => 2
        );
        $qry = Insert('rating', $data);

        //Total rate result

        $query = mysqli_query($conn, "select * from rating where propid='" . $_REQUEST['transportrating'] . "' and type=2");

        while ($data = mysqli_fetch_assoc($query)) {
            $rate_db[] = $data;
            $sum_rates[] = $data['rate'];
        }

        if (@count($rate_db)) {
            $rate_times = count($rate_db);
            $sum_rates = array_sum($sum_rates);
            $rate_value = $sum_rates / $rate_times;
            $rate_bg = (($rate_value) / 5) * 100;
        } else {
            $rate_times = 0;
            $rate_value = 0;
            $rate_bg = 0;
        }

        $rate_avg = round($rate_value);

        $sql = "update transport set totalrate=totalrate + 1,rate='$rate_avg' where transid='" . $_REQUEST['transportrating'] . "'";
        mysqli_query($conn, $sql);


        echo '{"goestate":[{"msg":"You have succesfully rated","rate_avg":"' . $rate_avg . '"}]}';
    } else {

        echo '{"goestate":[{"msg":"You have already rated"}]}';
    }
} else
if (isset($_REQUEST['mytransport'])) {
    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $query_1 = "SELECT * FROM transport
				LEFT JOIN category ON transport.cid= category.cid
				WHERE transport.status=1 and transport.userid='" . $_REQUEST['mytransport'] . "' ORDER BY transport.transid DESC";

    $log_in_rs1 = mysqli_query($conn, $query_1);
    $array_out = array();
    while ($rd = mysqli_fetch_object($log_in_rs1)) {

        $array_out[] = array(
            "propid" => $rd->propid,
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage,
            "fueltype" => $rd->fueltype,
            "color" => $rd->color,
            "vehicle" => $rd->vehicle,
            "price" => $rd->price,
            "amenities" => $rd->amenities,
            "floorplan" => $file_path . 'images/floorplan/' . $rd->floorplan,
            "purpose" => $rd->purpose,
            "name" => $rd->name,
            "description" => $rd->description,
            "phone" => $rd->phone,
            "address" => $rd->address,
            "latitude" => $rd->latitude,
            "longitude" => $rd->longitude,
            "image" => $file_path . 'images/' . $rd->image,
            "status" => $rd->status,
            "rate" => $rd->rate,
            "featured" => $rd->featured,
            "totalrate" => $rd->totalrate,
            "totalviews" => $rd->totalviews
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_REQUEST['allpopulartransport'])) {

    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $query_1 = "SELECT * FROM transport
				LEFT JOIN category ON transport.cid= category.cid
				WHERE transport.status=1 ORDER BY transport.rate DESC";

    $log_in_rs1 = mysqli_query($conn, $query_1);
    $array_out = array();
    while ($rd = mysqli_fetch_object($log_in_rs1)) {

        $array_out[] = array(
            "transid" => $rd->transid,
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage,
            "fueltype" => $rd->fueltype,
            "color" => $rd->color,
            "vehicle" => $rd->vehicle,
            "price" => $rd->price,
            "amenities" => $rd->amenities,
            "floorplan" => $file_path . 'images/floorplan/' . $rd->floorplan,
            "purpose" => $rd->purpose,
            "name" => $rd->name,
            "description" => $rd->description,
            "phone" => $rd->phone,
            "address" => $rd->address,
            "latitude" => $rd->latitude,
            "longitude" => $rd->longitude,
            "image" => $file_path . 'images/' . $rd->image,
            "status" => $rd->status,
            "rate" => $rd->rate,
            "featured" => $rd->featured,
            "totalrate" => $rd->totalrate,
            "totalviews" => $rd->totalviews
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_REQUEST['populartransport'])) {

    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $query_1 = "SELECT * FROM transport
				LEFT JOIN category ON transport.cid= category.cid
				WHERE transport.status=1 ORDER BY transport.rate DESC LIMIT 5";

    $log_in_rs1 = mysqli_query($conn, $query_1);
    $array_out = array();
    while ($rd = mysqli_fetch_object($log_in_rs1)) {

        $array_out[] = array(
            "transid" => $rd->transid,
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage,
            "fueltype" => $rd->fueltype,
            "color" => $rd->color,
            "vehicle" => $rd->vehicle,
            "price" => $rd->price,
            "amenities" => $rd->amenities,
            "floorplan" => $file_path . 'images/floorplan/' . $rd->floorplan,
            "purpose" => $rd->purpose,
            "name" => $rd->name,
            "description" => $rd->description,
            "phone" => $rd->phone,
            "address" => $rd->address,
            "latitude" => $rd->latitude,
            "longitude" => $rd->longitude,
            "image" => $file_path . 'images/' . $rd->image,
            "status" => $rd->status,
            "rate" => $rd->rate,
            "featured" => $rd->featured,
            "totalrate" => $rd->totalrate,
            "totalviews" => $rd->totalviews
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_REQUEST['latesttransport'])) {
    include('includes/function.php');
    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $query_1 = "SELECT * FROM transport
				LEFT JOIN category ON transport.cid= category.cid
				WHERE transport.status=1 ORDER BY transport.transid DESC LIMIT 5";

    $log_in_rs1 = mysqli_query($conn, $query_1);
    $array_out = array();
    while ($rd = mysqli_fetch_object($log_in_rs1)) {

        $array_out[] = array(
            "transid" => $rd->transid,
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage,
            "fueltype" => $rd->fueltype,
            "color" => $rd->color,
            "vehicle" => $rd->vehicle,
            "price" => $rd->price,
            "amenities" => $rd->amenities,
            "floorplan" => $file_path . 'images/floorplan/' . $rd->floorplan,
            "purpose" => $rd->purpose,
            "name" => $rd->name,
            "description" => $rd->description,
            "phone" => $rd->phone,
            "address" => $rd->address,
            "latitude" => $rd->latitude,
            "longitude" => $rd->longitude,
            "image" => $file_path . 'images/' . $rd->image,
            "status" => $rd->status,
            "rate" => $rd->rate,
            "featured" => $rd->featured,
            "totalrate" => $rd->totalrate,
            "totalviews" => $rd->totalviews
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_REQUEST['gettransportbycityid'])) {

    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $query_1 = "SELECT * FROM transport
				WHERE cityid='" . $_REQUEST['cityid'] . "'
				ORDER BY transid DESC";

    $log_in_rs1 = mysqli_query($conn, $query_1);
    $array_out = array();
    while ($rd = mysqli_fetch_object($log_in_rs1)) {

        $array_out[] = array(
            "transid" => $rd->transid,
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage,
            "fueltype" => $rd->fueltype,
            "color" => $rd->color,
            "vehicle" => $rd->vehicle,
            "price" => $rd->price,
            "amenities" => $rd->amenities,
            "floorplan" => $file_path . 'images/floorplan/' . $rd->floorplan,
            "purpose" => $rd->purpose,
            "name" => $rd->name,
            "description" => $rd->description,
            "phone" => $rd->phone,
            "address" => $rd->address,
            "latitude" => $rd->latitude,
            "longitude" => $rd->longitude,
            "image" => $file_path . 'images/' . $rd->image,
            "status" => $rd->status,
            "rate" => $rd->rate,
            "featured" => $rd->featured,
            "totalrate" => $rd->totalrate,
            "totalviews" => $rd->totalviews
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_REQUEST['gettransportbycid'])) {

    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $query_1 = "SELECT * FROM transport
				WHERE cid='" . $_REQUEST['cid'] . "'
				ORDER BY transid DESC";

    $log_in_rs1 = mysqli_query($conn, $query_1);
    $array_out = array();
    while ($rd = mysqli_fetch_object($log_in_rs1)) {

        $array_out[] = array(
            "propid" => $rd->propid,
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage,
            "fueltype" => $rd->fueltype,
            "color" => $rd->color,
            "vehicle" => $rd->vehicle,
            "price" => $rd->price,
            "amenities" => $rd->amenities,
            "floorplan" => $file_path . 'images/floorplan/' . $rd->floorplan,
            "purpose" => $rd->purpose,
            "name" => $rd->name,
            "description" => $rd->description,
            "phone" => $rd->phone,
            "address" => $rd->address,
            "latitude" => $rd->latitude,
            "longitude" => $rd->longitude,
            "image" => $file_path . 'images/' . $rd->image,
            "status" => $rd->status,
            "rate" => $rd->rate,
            "featured" => $rd->featured,
            "totalrate" => $rd->totalrate,
            "totalviews" => $rd->totalviews
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_REQUEST['gettransportbysearchtext'])) {

    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $query = "SELECT * FROM transport
				LEFT JOIN category ON transport.cid= category.cid
				WHERE transport.status=1 AND transport.name LIKE '%" . $_REQUEST['searchtext'] . "%' 
				OR transport.address LIKE '%" . $_REQUEST['searchtext'] . "%'
				OR transport.amenities LIKE '%" . $_REQUEST['searchtext'] . "%'				
				OR transport.purpose LIKE '%" . $_REQUEST['searchtext'] . "%' ORDER BY transport.name";



    $log_in_rs1 = mysqli_query($conn, $query);
    $array_out = array();
    while ($rd = mysqli_fetch_object($log_in_rs1)) {

        $array_out[] = array(
            "transid" => $rd->transid,
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage,
            "fueltype" => $rd->fueltype,
            "color" => $rd->color,
            "vehicle" => $rd->vehicle,
            "price" => $rd->price,
            "amenities" => $rd->amenities,
            "floorplan" => $file_path . 'images/floorplan/' . $rd->floorplan,
            "purpose" => $rd->purpose,
            "name" => $rd->name,
            "description" => $rd->description,
            "phone" => $rd->phone,
            "address" => $rd->address,
            "latitude" => $rd->latitude,
            "longitude" => $rd->longitude,
            "image" => $file_path . 'images/' . $rd->image,
            "status" => $rd->status,
            "rate" => $rd->rate,
            "featured" => $rd->featured,
            "totalrate" => $rd->totalrate,
            "totalviews" => $rd->totalviews
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_REQUEST['gettransportfilterprice'])) {

    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    if ($_REQUEST['filterprice'] != '') {
        $query = "SELECT * FROM transport
				LEFT JOIN category ON transport.cid= category.cid 
				LEFT JOIN city ON transport.cityid= city.cityid 
				LEFT JOIN users ON transport.userid= users.userid
				ORDER BY transport.price " . $_REQUEST['filterprice'] . "";
    } else {
        $query = "SELECT * FROM transport
				LEFT JOIN category ON transport.cid= category.cid 
				LEFT JOIN city ON transport.cityid= city.cityid 
				LEFT JOIN users ON transport.userid= users.userid
				ORDER BY transport.transid";
    }


    $log_in_rs1 = mysqli_query($conn, $query);
    $array_out = array();
    while ($rd = mysqli_fetch_object($log_in_rs1)) {

        $array_out[] = array(
            "propid" => $rd->propid,
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage,
            "fueltype" => $rd->fueltype,
            "color" => $rd->color,
            "vehicle" => $rd->vehicle,
            "price" => $rd->price,
            "amenities" => $rd->amenities,
            "floorplan" => $file_path . 'images/floorplan/' . $rd->floorplan,
            "purpose" => $rd->purpose,
            "name" => $rd->name,
            "description" => $rd->description,
            "phone" => $rd->phone,
            "address" => $rd->address,
            "latitude" => $rd->latitude,
            "longitude" => $rd->longitude,
            "image" => $file_path . 'images/' . $rd->image,
            "status" => $rd->status,
            "rate" => $rd->rate,
            "featured" => $rd->featured,
            "totalrate" => $rd->totalrate,
            "totalviews" => $rd->totalviews
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_REQUEST['gettranportdistance'])) {

    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $latitude = $_REQUEST['user_lat'];
    $longitude = $_REQUEST['user_long'];

    $earthRadius = '6371.0'; // In miles(3959)  


    $query = mysqli_query($conn, "
	                SELECT p.*,c.*,city.*,
	                    ROUND(
	                        $earthRadius * ACOS(  
	                            SIN( $latitude*PI()/180 ) * SIN( latitude*PI()/180 )
	                            + COS( $latitude*PI()/180 ) * COS( latitude*PI()/180 )  *  COS( (longitude*PI()/180) - ($longitude*PI()/180) )   ) 
	                    , 1)
	                    AS distance                              
	                                      
	                FROM
	                    transport p,category c, city city
	                WHERE p.cid= c.cid AND p.cityid= city.cityid AND  p.status='1'         
	                ORDER BY
	                    distance");


    $log_in_rs1 = mysqli_query($conn, $query);
    $array_out = array();
    while ($rd = mysqli_fetch_object($query)) {

        $array_out[] = array(
            "propid" => $rd->propid,
            "cid" => $rd->cid,
            "cname" => $rd->cname,
            "cimage" => $file_path . 'images/' . $rd->cimage,
            "color" => $rd->color,
            "fueltype" => $rd->fueltype,
            "vehicle" => $rd->vehicle,
            "price" => $rd->price,
            "amenities" => $rd->amenities,
            "floorplan" => $file_path . 'images/floorplan/' . $rd->floorplan,
            "purpose" => $rd->purpose,
            "name" => $rd->name,
            "description" => $rd->description,
            "phone" => $rd->phone,
            "address" => $rd->address,
            "latitude" => $rd->latitude,
            "longitude" => $rd->longitude,
            "image" => $file_path . 'images/' . $rd->image,
            "status" => $rd->status,
            "rate" => $rd->rate,
            "featured" => $rd->featured,
            "totalrate" => $rd->totalrate,
            "totalviews" => $rd->totalviews
        );
    }

    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else

if (isset($_REQUEST['gettranportbytransid'])) {

    $jsonObj = array();
    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);

    $query = "SELECT * FROM transport
				LEFT JOIN category ON transport.cid= category.cid 
				LEFT JOIN city ON transport.cityid= city.cityid 
				LEFT JOIN users ON transport.userid= users.userid
				WHERE transid='" . $_REQUEST['transid'] . "'";

    $sql = mysqli_query($conn, $query)or die(mysqli_error());

    while ($data = mysqli_fetch_assoc($sql)) {

        $row['transid'] = $data['transid'];
        $row['purpose'] = $data['purpose'];
        $row['name'] = $data['name'];
        $row['description'] = stripslashes($data['description']);
        $row['phone'] = $data['phone'];
        $row['address'] = stripslashes($data['address']);
        $row['latitude'] = $data['latitude'];
        $row['longitude'] = $data['longitude'];

        $row['cityid'] = $data['cityid'];
        $row['cityname'] = $data['cityname'];
        $row['cityimage'] = $file_path . 'images/' . $data['cityimage'];

        $row['image'] = $file_path . 'images/' . $data['image'];

        $row['floorplan'] = $file_path . 'images/floorplan/' . $data['floorplan'];

        $row['fueltype'] = $data['fueltype'];
        $row['color'] = $data['color'];
        $row['vehicle'] = $data['vehicle'];
        $row['amenities'] = $data['amenities'];
        $row['price'] = $data['price'];
        $row['totalrate'] = $data['totalrate'];
        $row['rate'] = $data['rate'];
        $row['totalviews'] = $data['totalviews'];
        $row['cid'] = $data['cid'];
        $row['cname'] = $data['cname'];
        $row['userid'] = $data['userid'];
        $row['fullname'] = $data['fullname'];
        $row['imageprofile'] = $data['imageprofile'];
        $qry1 = "SELECT * FROM gallery WHERE type=2 and propid='" . $_REQUEST['transid'] . "'";
        $result1 = mysqli_query($conn, $qry1);

        if ($result1->num_rows > 0) {
            while ($row_img = mysqli_fetch_array($result1)) {
                $row1['transid'] = $data['propid'];
                $row1['gallery'] = $file_path . 'images/gallery/' . $row_img['imagename'];
                $row['galleryimage'][] = $row1;
            }
        } else {

            $row['galleryimage'][] = 'nodata';
        }
        array_push($jsonObj, $row);
    }


    $output = array("code" => "200", "msg" => $jsonObj);
    print_r(json_encode($output, true));
} else

if (isset($_REQUEST['deletetransport'])) {
    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);
    //print_r($event_json);
    //0= owner  1= company 2= ind mechanic

    mysqli_query($conn, "Delete from transport 
		where userid = '" . $_REQUEST['userid'] . "' AND transid ='" . $_REQUEST['deletetransport'] . "'");

    $array_out = array();
    $array_out[] = array(
        "response" => "Delete succesfully");
    $output = array("code" => "200", "msg" => $array_out);
    print_r(json_encode($output, true));
} else
if (isset($_GET['addtransport'])) {
    require_once("includes/function.php");
    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);


    $file_name = str_replace(" ", "-", $_FILES['image']['name']);

    $place_image = rand(0, 99999) . "_" . $file_name;

    //Main Image
    $tpath1 = 'images/' . $place_image;
    $pic1 = compress_image($_FILES["image"]["tmp_name"], $tpath1, 160);




    if ($_FILES['floorplan']['name'] != "") {
        $file_floor_plan = str_replace(" ", "-", $_FILES['floorplan']['name']);

        $place_floor_plan_image = rand(0, 99999) . "_" . $file_floor_plan;

        //Main Image
        $tpath1 = 'images/floorplan/' . $place_floor_plan_image;
        $pic1 = compress_image($_FILES["floorplan"]["tmp_name"], $tpath1, 160);
    } else {
        $place_floor_plan_image = '';
    }

    if ($_POST) {
        $data = array(
            'userid' => $_POST['userid'],
            'cid' => $_POST['cid'],
            'cityid' => $_POST['cityid'],
            'purpose' => $_POST['purpose'],
            'name' => addslashes($_POST['name']),
            'description' => addslashes($_POST['description']),
            'fueltype' => $_POST['fueltype'],
            'color' => $_POST['color'],
            'vehicle' => $_POST['vehicle'],
            'amenities' => $_POST['otherfeature'],
            'price' => $_POST['price'],
            'phone' => $_POST['phone'],
            'address' => addslashes($_POST['address']),
            'latitude' => $_POST['latitude'],
            'longitude' => $_POST['longitude'],
            'status' => $_POST['status'],
            'featured' => $_POST['featured'],
            'floorplan' => $place_floor_plan_image,
            'image' => $place_image);

        $qry = Insert('transport', $data);

        $transid = mysqli_insert_id($conn);

        $size_sum = array_sum($_FILES['galleryimage']['size']);

        if ($size_sum > 0) {
            for ($i = 0; $i < count($_FILES['galleryimage']['name']); $i++) {
                $file_name1 = str_replace(" ", "-", $_FILES['galleryimage']['name'][$i]);

                $place_gallery_image = rand(0, 99999) . "_" . $file_name1;

                //Main Image
                $tpath1 = 'images/gallery/' . $place_gallery_image;
                $pic1 = compress_image($_FILES["galleryimage"]["tmp_name"][$i], $tpath1, 160);

                $data1 = array(
                    'propid' => $transid,
                    'imagename' => $place_gallery_image,
                    'type' => 2
                );

                $qry1 = Insert('gallery', $data1);
            }
        }

        $set['200'][] = array('transid' => $transid, 'msg' => 'Transport has been added!', 'success' => 1);
    } else {
        $set['201'][] = array('status' => false, 'msg' => 'All input fields required', 'failed' => 0);
    }
    header('Content-Type: application/json; charset=utf-8');
    echo $val = str_replace('\\/', '/', json_encode($set, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    die();
} else {
    echo"Not Found";
}

function Update_From_Firebase() {
    require_once("includes/config.php");
    $input = @file_get_contents("php://input");
    $event_json = json_decode($input, true);

    $headers = array(
        "Accept: application/json",
        "Content-Type: application/json"
    );

    $data = array();

    $ch = curl_init($firebaseDb_URL . '/.json');

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $return = curl_exec($ch);

    $json_data = json_decode($return, true);

    foreach ($json_data as $key => $item) {
        // 		echo" this user >>   ";
        // 		print_r($key);
        // 		//print_r($item);
        // 		echo"<br>";


        foreach ($item as $key1 => $item1) {

            //  $data = array("fetch"=>"true");
            //     	$ch = curl_init($firebaseDb_URL.'/'. $key .'/'.$key1.'/.json');
            //     	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //     	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
            //     	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            //     	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            //     	$return = curl_exec($ch);
            //     	$json_data = json_decode($return, true);

            if (!isset($item1['fetch'])) {

                //print_r($item1['match']);
                if ($item1['match'] == "false") {
                    $match = "false";
                }

                if ($item1['match'] == "true") {
                    $match = "true";
                }
                $effeted = $item1['effect'];

                //  echo "<br>";
                //  print_r($key);
                //         print_r($item1['type']);
                //         			echo"  this user >>>>>>    ";
                //         			print_r($key1);
                //         			print_r($item1['name']);
                //         			echo"<br>";


                $qrry_1 = "insert into matches(myid,matchid,action_type,matchorno,effected)values(";
                $qrry_1 .= "'" . $key . "',";
                $qrry_1 .= "'" . $key1 . "',";
                $qrry_1 .= "'" . $item1['type'] . "',";
                $qrry_1 .= "'" . $match . "',";
                $qrry_1 .= "'" . $effeted . "'";
                $qrry_1 .= ")";
                if (mysqli_query($conn, $qrry_1)) {
                    //echo "insert done";
                    // echo $item1['effect']=="true";
                    if ($item1['type'] == "like" && $item1['effect'] == "true") {
                        $qrry_1 = "update users SET likeuser = likeuser+1 WHERE userid ='" . $key . "' ";
                        if (mysqli_query($conn, $qrry_1)) {
                            //echo "udpate";
                        }

                        if ($item1['status'] == "1") {
                            $ch1 = curl_init($firebaseDb_URL . '/' . $key . '/' . $key1 . '/.json');
                            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, 'DELETE');
                            curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($data));
                            curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);

                            $return = curl_exec($ch1);

                            $json_data = json_decode($return, true);


                            $curl_error = curl_error($ch1);
                            $http_code = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
                        }
                    } else
                    if ($item1['type'] == "dislike" && $item1['effect'] == "true") {
                        $qrry_1 = "update users SET dislikeuser = dislikeuser+1 WHERE userid ='" . $key . "' ";
                        if (mysqli_query($conn, $qrry_1)) {
                            //echo "udpate";
                        }

                        $ch1 = curl_init($firebaseDb_URL . '/' . $key . '/' . $key1 . '/.json');
                        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, 'DELETE');
                        curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($data));
                        curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);

                        $return = curl_exec($ch1);

                        $json_data = json_decode($return, true);


                        $curl_error = curl_error($ch1);
                        $http_code = curl_getinfo($ch1, CURLINFO_HTTP_CODE);

                        if ($item1['status'] == "1") {
                            $ch1 = curl_init($firebaseDb_URL . '/' . $key . '/' . $key1 . '/.json');
                            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, 'DELETE');
                            curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($data));
                            curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);

                            $return = curl_exec($ch1);

                            $json_data = json_decode($return, true);


                            $curl_error = curl_error($ch1);
                            $http_code = curl_getinfo($ch1, CURLINFO_HTTP_CODE);
                        }
                    }
                }
            }
        }
    }



    //Delete firebase db data after insert

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $return = curl_exec($ch);

    $json_data = json_decode($return, true);


    $curl_error = curl_error($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
}
?>

