<?php
session_start();
require '../../../dbcon.php';
$title = "Add Smartwatch Specs";
require '../../inc/header.php';

require '../../functions/logic.php';

$productId = isset($_GET['id']) ? sanitize_data($_GET['id']) : 0;
$selectQuery = "SELECT * FROM sm_watch_specs WHERE product_id = '$productId'";
$result = mysqli_query($con, $selectQuery);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $product_id = sanitize_data(mysqli_real_escape_string($con, $_POST['product_id']));

    // Display Information
    $model = sanitize_data(mysqli_real_escape_string($con, $_POST['model']));
    $weight = sanitize_data(mysqli_real_escape_string($con, $_POST['weight']));
    $dial_shape = sanitize_data(mysqli_real_escape_string($con, $_POST['dial_shape']));
    $bluetooth = sanitize_data(mysqli_real_escape_string($con, $_POST['bluetooth']));
    $gps = sanitize_data(mysqli_real_escape_string($con, $_POST['gps']));
    $call_function = sanitize_data(mysqli_real_escape_string($con, $_POST['call_function']));
    $notification = sanitize_data(mysqli_real_escape_string($con, $_POST['notification']));
    $display = sanitize_data(mysqli_real_escape_string($con, $_POST['display']));
    $screen_size = sanitize_data(mysqli_real_escape_string($con, $_POST['screen_size']));
    $os = sanitize_data(mysqli_real_escape_string($con, $_POST['os']));
    $compatible_os = sanitize_data(mysqli_real_escape_string($con, $_POST['compatible_os']));

    // Battery and Display Features
    $wifi = sanitize_data(mysqli_real_escape_string($con, $_POST['wifi']));
    $sensors = sanitize_data(mysqli_real_escape_string($con, $_POST['sensors']));
    $battery_type = sanitize_data(mysqli_real_escape_string($con, $_POST['battery_type']));
    $battery_life = sanitize_data(mysqli_real_escape_string($con, $_POST['battery_life']));

    // Additional Features
    $touchscreen = sanitize_data(mysqli_real_escape_string($con, $_POST['touchscreen']));
    $fitness_features = sanitize_data(mysqli_real_escape_string($con, $_POST['fitness_features']));
    $water_resistant = sanitize_data(mysqli_real_escape_string($con, $_POST['water_resistant']));
    $extra_features = sanitize_data(mysqli_real_escape_string($con, $_POST['extra_features']));

    // Perform the database updation
    $sql = "UPDATE `sm_watch_specs` SET `model`=?, `weight`=?, `dial_shape`=?, `bluetooth`=?, `gps`=?, `call_function`=?, `notification`=?, `display`=?, `screen_size`=?, `os`=?, `compatible_os`=?, `wifi`=?, `sensors`=?, `battery_type`=?, `battery_life`=?, `touchscreen`=?, `fitness_features`=?, `water_resistant`=?, `extra_features`=? WHERE `product_id`=?";
    $params = [$model, $weight, $dial_shape, $bluetooth, $gps, $call_function, $notification, $display, $screen_size, $os, $compatible_os, $wifi, $sensors, $battery_type, $battery_life, $touchscreen, $fitness_features, $water_resistant, $extra_features, $product_id];
    $result = mysqli_execute_query($con, $sql, $params);

    if ($result) {
        $_SESSION['success_msg'] = "Smart Watch specs updated successfully!";
        ?>
        <script>
            window.location.href = "../../products/index.php";
        </script><?php

    } else {
        $_SESSION['fail_msg'] = "Error: " . mysqli_error($con);
        ?>
        <script>
            window.location.href = "../../products/index.php";
        </script><?php

    }
}
?>
<div class="breadcrumbs">
    <div class="breadcrumb-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Add Smartwatch Specs</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="../dashboard.php">Dashboard</a></li>
                            <li><a href="../products/index.php">Products</a></li>
                            <li class="active">Add Smartwatch Specs</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Add Smartwatch Specs</strong>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <input type="hidden" name="product_id"
                                value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">

                            <!-- Display Information -->
                            <h3>Display Information</h3>
                            <div class="form-group">
                                <label for="model">Model:</label>
                                <input type="text" name="model" id="model" class="form-control"
                                    value="<?= $row['model'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="weight">Weight:</label>
                                <input type="text" name="weight" id="weight" class="form-control"
                                    value="<?= $row['weight'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="dial_shape">Dial Shape:</label>
                                <input type="text" name="dial_shape" id="dial_shape" class="form-control"
                                    value="<?= $row['dial_shape'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="bluetooth">Bluetooth:</label>
                                <select name="bluetooth" id="bluetooth" class="form-control" required>
                                    <option value="1" <?= $row['bluetooth'] == 1 ? 'selected' : '' ?>>Yes</option>
                                    <option value="0" <?= $row['bluetooth'] == 0 ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="gps">GPS:</label>
                                <select name="gps" id="gps" class="form-control" required>
                                    <option value="1" <?= $row['gps'] == 1 ? 'selected' : '' ?>>Yes</option>
                                    <option value="0" <?= $row['gps'] == 0 ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="call_function">Call Function:</label>
                                <select name="call_function" id="call_function" class="form-control" required>
                                    <option value="1" <?= $row['call_function'] == 1 ? 'selected' : '' ?>>Yes</option>
                                    <option value="0" <?= $row['call_function'] == 0 ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="notification">Notification:</label>
                                <select name="notification" id="notification" class="form-control" required>
                                    <option value="1" <?= $row['notification'] == 1 ? 'selected' : '' ?>>Yes</option>
                                    <option value="0" <?= $row['notification'] == 0 ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="display">Display Tech:</label>
                                <input type="text" name="display" id="display" class="form-control"
                                    value="<?= $row['display'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="screen_size">Screen Size:</label>
                                <input type="text" name="screen_size" id="screen_size" class="form-control"
                                    value="<?= $row['screen_size'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="os">Operating System:</label>
                                <input type="text" name="os" id="os" class="form-control" value="<?= $row['os'] ?>"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="compatible_os">Compatible Operating System:</label>
                                <input type="text" name="compatible_os" id="compatible_os" class="form-control"
                                    value="<?= $row['compatible_os'] ?>" required>
                            </div>
                            <!-- Battery and Display Features -->
                            <h3>Battery and Display Features</h3>
                            <div class="form-group">
                                <label for="wifi">Wi-Fi:</label>
                                <input type="text" name="wifi" id="wifi" class="form-control"
                                    value="<?= $row['wifi'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="sensors">Sensors:</label>
                                <input type="text" name="sensors" id="sensors" class="form-control"
                                    value="<?= $row['sensors'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="battery_type">Battery Type:</label>
                                <input type="text" name="battery_type" id="battery_type" class="form-control"
                                    value="<?= $row['battery_type'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="battery_life">Battery Life:</label>
                                <input type="text" name="battery_life" id="battery_life" class="form-control"
                                    value="<?= $row['battery_life'] ?>" required>
                            </div>

                            <!-- Additional Features -->
                            <h3>Additional Features</h3>
                            <div class="form-group">
                                <label for="touchscreen">Touchscreen:</label>
                                <select name="touchscreen" id="touchscreen" class="form-control" required>
                                    <option value="1" <?= $row['touchscreen'] == 1 ? 'selected' : '' ?>>Yes</option>
                                    <option value="0" <?= $row['touchscreen'] == 0 ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="fitness_features">Fitness Features:</label>
                                <input type="text" name="fitness_features" id="fitness_features" class="form-control"
                                    value="<?= $row['fitness_features'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="water_resistant">Water Resistant:</label>
                                <input type="text" name="water_resistant" id="water_resistant" class="form-control"
                                    value="<?= $row['water_resistant'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="extra_features">Extra Features:</label>
                                <input type="text" name="extra_features" id="extra_features" class="form-control"
                                    value="<?= $row['extra_features'] ?>" required>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group mt-4">
                                <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require '../../inc/footer.php';
?>