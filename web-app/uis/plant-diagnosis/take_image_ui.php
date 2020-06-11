<?php

include '../../models/crop_details.php';

$cropName = "Tomato";
$cropSrcUrl = "../../assets/images/tomato.jpg";

$selectedCropName = "Tomato";
$selectedCropImageSrc = "";

switch ($selectedCropName){
    case "Tomato":
        $selectedCropImageSrc = "../../assets/images/tomato.jpg";
        break;
    case "Potato":
        $selectedCropImageSrc = "../../assets/images/potato.jpg";
        break;
    case "Mage":
        $selectedCropImageSrc = "../../assets/images/maze.jpg";
        break;
    default:
        $selectedCropImageSrc = null;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" >
    <meta id="Viewport" name="viewport" content="initial-scale=1, maximum-scale=1,
        minimum-scale=1, user-scalable=no">
    <title>PDS-Take Image</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/take_image_ui.css">
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
            margin-bottom: 10px;
        }
        .uploadButton{
            height: 20px;
            width: 20px;
        }
    </style>
</head>
<body>
<div class="container col-sm-12 col-md-8 col-lg-8">
    <nav class="d-flex justify-content-between shadow ">
        <h5 class="text-blueGray p-2">Plant Diagnosis Systems</h5>
        <div class="float-right">
            <p class="pt-2 text-blueGray">
                <i class="fa fa-power-off fa-lg pr-2" aria-hidden="true"></i>
            </p>
        </div>
    </nav>
</div>
<div class="container d-flex flex-column justify-content-center" style="margin-top: 2%">
    <div class="text-center">
        <img src="<?php echo ($selectedCropImageSrc != null) ? $selectedCropImageSrc : $cropSrcUrl ?>" style="border-radius: 50%; height: 125px; width: 125px">
        <p class="text-center" style="font-weight: bold"><?php echo $cropName?></p>
    </div>
    <div class="text-center">
        <h2 id="pickImagesText" class="d-block">Pick Images</h2>
    </div>
    <div class="text-center">
        <img src="" id="selectedImageOne" class="" height="2px;" width="2px">
<!--        <img src="" id="selectedImageTwo" class="" height="2px;" width="2px">-->
<!--        <img src="" id="selectedImageThree" class="" height="2px;" width="2px">-->
    </div>
    <div  class="text-center" id="uploadButton">
        <button style="border: none; background-color: transparent;" class=""><i class="fa fa-upload text-secondary fa-lg" aria-hidden="true"></i></button>
    </div>
    <div class="text-center mt-2">
        <input type="file" id="selecteImage" onchange="displayImage(this)" multiple accept="images/*">
        <label for="files" class="shadow pickImages" onclick="triggerClick()"><span style="padding-right: 10px"></span>Pick Images</label>
    </div>
</div>



<script>
    function triggerClick() {
        document.querySelector('#selecteImage').click();
    }

    function displayImage(e) {
        if (e.files[0]){
            var reader = new FileReader();

            reader.onload = function (e) {
                document.querySelector('#selectedImageOne').setAttribute('src', e.target.result);
                document.querySelector('#selectedImageOne').setAttribute('class', 'selectedImage');
                document.querySelector('#pickImagesText').setAttribute('class', 'd-none');
                document.querySelector('#uploadButton').setAttribute('class', 'uploadButton');
            }
            reader.readAsDataURL(e.files[0])
        }

        // if (e.files[1]){
        //     var reader1 = new FileReader();
        //
        //     reader1.onload = function (e) {
        //         document.querySelector('#selectedImageTwo').setAttribute('src', e.target.result);
        //         document.querySelector('#selectedImageTwo').setAttribute('class', 'selectedImage');
        //         document.querySelector('#pickImagesText').setAttribute('class', 'd-none');
        //     }
        //     reader1.readAsDataURL(e.files[1])
        // }
        // if (e.files[2]){
        //     var reader2 = new FileReader();
        //
        //     reader2.onload = function (e) {
        //         document.querySelector('#selectedImageThree').setAttribute('src', e.target.result);
        //         document.querySelector('#selectedImageThree').setAttribute('class', 'selectedImage');
        //         document.querySelector('#pickImagesText').setAttribute('class', 'd-none');
        //     }
        //     reader2.readAsDataURL(e.files[2])
        // }
    }

    // cropName = localStorage.getItem("cropName");
    // console.log(cropName);

    cropUr = "../../assets/images/tomato.jpg";
    cropN= "Tomato";
</script>
</body>
</html>