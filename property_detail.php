<?php
session_start();
require "includes/database_connect.php";

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$property_id = $_GET["property_id"];

$sql_1 = "SELECT * FROM properties WHERE id = $property_id";

$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    echo "Something went wrong!456";
    return;
}
$property = mysqli_fetch_assoc($result_1);
if (!$property) {
    echo "Something went wrong!123";
    return;
}

$sql_3 = "SELECT p.id,p.name,p.address,p.gender,p.rent,a.id,a.amenitie0,a.amenitie1,a.amenitie2,a.amenitie3,a.amenitie4,a.amenitie5,a.amenitie6,a.amenitie7,a.amenitie8,a.amenitie9,a.amenitie10,a.amenitie11,a.amenitie12,a.amenitie13,a.amenitie14,a.amenitie15
FROM properties p 
INNER JOIN amenities a 
ON p.id = a.id 
WHERE a.id = $property_id";

$result_3 = mysqli_query($conn, $sql_3);
if (!$result_3) {
    echo "Something went wrong!555";
    return;
}
$amenities = mysqli_fetch_all($result_3, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $property['name']; ?> | PG Life</title>

    <?php
    include "includes/head_links.php";
    ?>
    <link href="css/property_detail.css" rel="stylesheet" />
    <link href="css/extra.css" rel="stylesheet" />
</head>

<body class="anim" style="color: black;">
    <?php
    include "includes/header.php";
    ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb py-2">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <?= $property['name']; ?>
            </li>
        </ol>
    </nav>

    <div id="property-images" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            $property_images = glob("admin/img/properties/profile" . $property['id'] . ".png");
            foreach ($property_images as $index => $property_image) {
            ?>
                <li data-target="#property-images" data-slide-to="<?= $index ?>" class="<?= $index == 0 ? "active" : ""; ?>"></li>
            <?php
            }
            ?>
        </ol>
        <div class="carousel-inner">
            <?php
            foreach ($property_images as $index => $property_image) {
            ?>
                <div class="carousel-item <?= $index == 0 ? "active" : ""; ?>">
                    <img class="d-block w-100" src="<?= $property_image ?>" alt="slide">
                </div>
            <?php
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#property-images" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#property-images" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="property-summary page-container" style="color: white;">
        <div class="detail-container">
            <div class="property-name"><?= $property['name'] ?></div>
            <div class="property-address" style="color: white;"><?= $property['address'] ?></div>
            <div class="property-gender">
                <?php
                if ($property['gender'] == "male") {
                ?>
                    <img src="img/male.png">
                <?php
                } else {
                ?>
                    <img src="img/female.png">
                <?php
                }
                ?>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="rent-container col-6">
                <div class="rent">₹ <?= number_format($property['rent']) ?>/-</div>
                <div class="rent-unit" style="color: white;">per month</div>
            </div>
            <div class="button-container col-6">

                <?php
                //Check if user is loging or not
                if ($user_id != NULL) {
                ?>
                    <div class="filter-bar row justify-content-around">
                        <button class="btn b" data-toggle="modal" data-target="#booking-modal">
                            <span>Get Token</span>
                        </button>
                    </div>
                <?php
                } else {
                ?>
                    <a class="btn b" href="#" data-toggle="modal" data-target="#login-modal">Get Token</a>
                <?php
                }
                ?>

            </div>
        </div>
    </div>

    <div class="property-amenities anim" style="color: white;">
        <div class="page-container">
            <h1>Amenities</h1>
            <?php
            foreach ($amenities as $amenity) {
            ?>
                <div class="row justify-content-between a1" style="color: black;">
                    <div class="col-md-3">
                        <div class="amenity-container">
                            <?php
                            if ($amenity['amenitie0'] == "cctv") {
                            ?>
                                <img src="img/amenities/<?= $amenity['amenitie0'] ?>.svg">
                                <span><?= $amenity['amenitie0'] ?></span><br />

                            <?php
                            }
                            if ($amenity['amenitie1'] == "ac") {
                            ?>
                                <img src="img/amenities/<?= $amenity['amenitie1'] ?>.svg">
                                <span><?= $amenity['amenitie1'] ?></span><br />
                            <?php
                            }
                            if ($amenity['amenitie2'] == "bed") {
                            ?>
                                <img src="img/amenities/<?= $amenity['amenitie2'] ?>.svg">
                                <span><?= $amenity['amenitie2'] ?></span><br />
                            <?php
                            }
                            if ($amenity['amenitie3'] == "double bed") {
                            ?>
                                <img src="img/amenities/<?= $amenity['amenitie3'] ?>.svg">
                                <span><?= $amenity['amenitie3'] ?></span>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="amenity-container">
                            <?php
                            if ($amenity['amenitie4'] == "dining") {
                            ?>
                                <img src="img/amenities/<?= $amenity['amenitie4'] ?>.svg">
                                <span><?= $amenity['amenitie4'] ?></span><br />
                            <?php
                            }
                            if ($amenity['amenitie5'] == "gym") {
                            ?>
                                <img src="img/amenities/<?= $amenity['amenitie5'] ?>.svg">
                                <span><?= $amenity['amenitie5'] ?></span><br />
                            <?php
                            }
                            if ($amenity['amenitie6'] == "lift") {
                            ?>
                                <img src="img/amenities/<?= $amenity['amenitie6'] ?>.svg">
                                <span><?= $amenity['amenitie6'] ?></span><br />
                            <?php
                            }
                            if ($amenity['amenitie7'] == "parking") {
                            ?>
                                <img src="img/amenities/<?= $amenity['amenitie7'] ?>.svg">
                                <span><?= $amenity['amenitie7'] ?></span>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="amenity-container">
                            <?php
                            if ($amenity['amenitie8'] == "powerbackup") {
                            ?>
                                <img src="img/amenities/<?= $amenity['amenitie8'] ?>.svg">
                                <span><?= $amenity['amenitie8'] ?></span><br />
                            <?php
                            }
                            if ($amenity['amenitie9'] == "washing machine") {
                            ?>
                                <img src="img/amenities/<?= $amenity['amenitie9'] ?>.svg">
                                <span><?= $amenity['amenitie9'] ?></span><br />
                            <?php
                            }
                            if ($amenity['amenitie10'] == "geyser") {
                            ?>
                                <img src="img/amenities/<?= $amenity['amenitie10'] ?>.svg">
                                <span><?= $amenity['amenitie10'] ?></span><br />
                            <?php
                            }
                            if ($amenity['amenitie11'] == "rowater") {
                            ?>
                                <img src="img/amenities/<?= $amenity['amenitie11'] ?>.svg">
                                <span><?= $amenity['amenitie11'] ?></span>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="amenity-container">
                            <?php if ($amenity['amenitie12'] == "tv") {
                            ?>
                                <img src="img/amenities/<?= $amenity['amenitie12'] ?>.svg">
                                <span><?= $amenity['amenitie12'] ?></span><br />
                            <?php
                            }
                            if ($amenity['amenitie13'] == "wifi") {
                            ?>
                                <img src="img/amenities/<?= $amenity['amenitie13'] ?>.svg">
                                <span><?= $amenity['amenitie13'] ?></span><br />
                            <?php
                            }
                            if ($amenity['amenitie14'] == "fire exit") {
                            ?>
                                <img src="img/amenities/<?= $amenity['amenitie14'] ?>.svg">
                                <span><?= $amenity['amenitie14'] ?></span><br />
                            <?php
                            }
                            if ($amenity['amenitie15'] == "garden") {
                            ?>
                                <img src="img/amenities/<?= $amenity['amenitie15'] ?>.svg">
                                <span><?= $amenity['amenitie15'] ?></span>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <div class="modal fade" id="booking-modal" tabindex="-1" role="dialog" aria-labelledby="booking-heading" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="booking-heading">Generate Token</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="booking-form" class="form" role="form" method="post" action="api/booking_submit.php">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            <p><input type="hidden" name="properties_id" value="<?= $property_id ?>"></p>
                            <p><input type="hidden" name="user_id" value="<?= $user_id ?>"></p>
                            <input type="text" class="form-control" name="full_name" placeholder="Full Name" maxlength="30" required>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-phone-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="phone" placeholder="Phone Number" maxlength="10" minlength="10" required>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-block btn-primary" name="submit">Okay</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    include "includes/signup_modal.php";
    include "includes/login_modal.php";
    include "includes/footer.php";
    ?>

    <script type="text/javascript" src="js/property_detail.js"></script>
</body>

</html>