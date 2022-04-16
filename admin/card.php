<?php
$id = $_SESSION["user_id"];
$sql_1 = "SELECT * FROM adminproperty ap INNER JOIN properties p ON ap.properties_id = p.id 
        INNER JOIN admin a ON ap.admin_id = a.id WHERE ap.admin_id = $id";

$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    echo "Something went wrong!123";
    return;
}
$properties = mysqli_fetch_all($result_1, MYSQLI_ASSOC);
$row_count = mysqli_num_rows($result_1);
if ($row_count != 0) {
    foreach ($properties as $property) {
        $property_images = glob("img/properties/" . $property['id'] . "/*");
?>
        <div class="property-card property-id-<?= $property['id'] ?> row" style="align-items: center; margin-left: auto; margin-right: auto; color: black">
            <div class="image-container col-md-4">
                <img src="<?= $property_images[0] ?>" />
            </div>
            <div class="content-container col-md-8">

                <div class="detail-container">
                    <div class="property-name"><?= $property['name'] ?></div>
                    <div class="property-address"><?= $property['address'] ?></div>
                    <div class="property-gender">
                        <?php
                        if ($property['gender'] == "male") {
                        ?>
                            <img src="img/male.png" />
                        <?php
                        } else {
                        ?>
                            <img src="img/female.png" />
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="rent-container col-9">
                        <div class="rent">₹ <?= number_format($property['rent']) ?>/-</div>
                        <div class="rent-unit">per month</div>
                    </div>
                    <!-- edit hostel code -->
                    <div class="button-container col-3">
                        <button class="b" href="#" data-toggle="modal" data-target="#edit-modal">Edit</a>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>