<?php

    require '../../models/db.php';
    require '../../apis/all_apis.php';
    $allApis = new AllApis();
    if (isset($_POST['updateApi'])){
        $apiName = $allApis->API_NAME;
        $apiUrl = $_POST['apiUrl'];

//        $db = mysqli_connect("localhost", "root", "", "pds_web");
        $query = "UPDATE apis SET api_url='$apiUrl' WHERE api_name='$apiName'";

        mysqli_query($conn, $query);
    }

    session_start();
    if (isset($_SESSION['IS_LOGIN_ADMIN'])) {

        $msg = "";
        if (isset($_POST['addNewCrop'])) {
            //the path to store the uploaded image
            $target = "../../assets/images/" . basename($_FILES['selectIconImage']['name']);

            //connect to databse
//            $db = mysqli_connect("localhost", "root", "", "pds_web");

            //get all the submitted data from the form
            $cropIconImage = $_FILES['selectIconImage']['name'];
            $cropName = $_POST['cropName'];

            $sql = "INSERT INTO landing_page_crops (crop_icon_image, crop_name) VALUES ('$cropIconImage', '$cropName')";
            mysqli_query($conn, $sql); //stores the submitted data into the database table : landing_page_crops

            //Move the uploaded image into the folder: assets/images
            if (move_uploaded_file($_FILES['selectIconImage']['tmp_name'], $target)) {
                $msg = "Crop Upladed successfully";
            } else {
                $msg = "Somethings went wrong";
            }
        }
    ?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta id="Viewport" name="viewport" content="initial-scale=1, maximum-scale=1,
        minimum-scale=1, user-scalable=no">
    <title>Configurations</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/material_design_input_field.css">
    <link rel="stylesheet" href="../../css/configurations.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        .selectedImage{
            height: 150px;
            width: 150px;
            border-radius: 50%;
            margin-top: 15px;
            margin-bottom: 25px;
        }
    </style>
</head>
<body>
<div class="container col-sm-12 col-md-8 col-lg-8">
    <nav class="d-flex justify-content-between shadow ">
        <h5 class="text-blueGray p-2">Plant Selection</h5>
        <div class="float-right">
            <p class="pt-2 text-blueGray">
<!--                <i class="fa fa-cog fa-lg" aria-hidden="true"></i>-->
                <span class="text-blueGray">
                    <a href="../../authentication/logout.php" class="text-blueGray"><i class="fa fa-power-off fa-lg pr-2 pl-4" aria-hidden="true"></i></a>
                </span>
            </p>
        </div>
    </nav>
</div>

<div class="container col-sm-12 col-md-8 col-lg-8">
<!--     Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active pl-5 pr-5" data-toggle="tab" href="#updateApiTab"><i class="fa fa-eyedropper" style="color: cadetblue" aria-hidden="true"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link pl-5 pr-5" data-toggle="tab" href="#uploadPlantTab" ><i class="fa fa-picture-o" style="color: cadetblue" aria-hidden="true"></i></a>
        </li>
    </ul>

<!--    Tab panes -->
    <div class="tab-content">
        <div class="tab-pane container active text-center" id="updateApiTab">
            <h3 class="text-blueGray mt-2">Update API</h3>
            <h4 class="text-blueGray">Api Name : <?php echo $allApis->API_NAME?></h4>

            <form method="post" action="configurations_ui.php">
                <div class="form-group">
                    <input type="text" name="apiUrl" id="updateApiField" required class="input-area">
                    <label for="updateApiField" class="label">API URL</label>
                    <span class="inputFieldIconStyle"><i class="material-icons text-secondary">border_color</i></span>
                </div>
                <div class="text-center mt-3">
                    <input type="submit" name="updateApi" class="btn rounded-btn text-blueGray w-25" style="border: 1px solid lightslategray; font-weight: bold" value="Update">
                </div>
            </form>
        </div>
        <div class="tab-pane container fade" id="uploadPlantTab">
            <div class="text-center">
                <h2 class="text-blueGray">Add New Crop</h2>
            </div>
            <form method="post" action="configurations_ui.php" enctype="multipart/form-data">
                <div class="text-center mt-2">
                    <input type="file" id="selectIconImage" name="selectIconImage" onchange="displayImage(this)" accept="images/*">
                    <label for="selectIconImage" class="btn uploadPlantIcon mt-3" style="font-weight: bold">Upload Image Icon</label>
                </div>
                <div class="text-center">
                    <h4 id="noCropIconSelectedText" class="mt-3 d-block" style="font-weight: bold; color: red">No crop icon selected!</h4>
                </div>
                <div class="text-center">
                    <img src="" id="selectedIconImage" class="" height="2px;" width="2px">
                </div>
                <div class="form-group">
                    <input type="text" id="enterCropNameField" name="cropName" required class="input-area">
                    <label for="enterCropNameField" class="label">Enter crop name</label>
                    <span class="inputFieldIconStyle"><i class="material-icons text-secondary">border_color</i></span>
                </div>
                <div class="text-center mt-3">
                    <input type="submit" class="btn rounded-btn text-blueGray w-25" name="addNewCrop" style="border: 1px solid lightslategray; font-weight: bold" value="Add New Crop">
                </div>
            </form>
        </div>
    </div>

</div>

<script src="../../js/bootstrap.min.js"></script>
<script>
    function triggerClick() {
        document.querySelector('#selectIconImage').click();
    }

    function displayImage(e) {
        if (e.files[0]){
            var reader = new FileReader();

            reader.onload = function (e) {
                document.querySelector('#selectedIconImage').setAttribute('src', e.target.result);
                document.querySelector('#selectedIconImage').setAttribute('class', 'selectedImage');
                document.querySelector('#noCropIconSelectedText').setAttribute('class', 'd-none');
                // localStorage.setItem('selectedCropIconImageUrl', e.target.result);
            }
            reader.readAsDataURL(e.files[0]);
            // localStorage.setItem('imgUrl', e.target.result);
        }
    }
</script>
</body>
</html>

<?php }else{
header('Location:../authentication/login_page.php');
die();
}
?>