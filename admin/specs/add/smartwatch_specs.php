<?php
session_start();
require '../../../dbcon.php';
$title = "Add Smartwatch Specs";
require '../../inc/header.php';

require '../../functions/logic.php';

if (isset($_POST['submit'])) {
    $product_id = sanitize_data($_POST['product_id']);

    // Display Information
    $weight = sanitize_data($_POST['weight']);
    $dial_shape = sanitize_data($_POST['dial_shape']);
    $bluetooth = sanitize_data($_POST['bluetooth']);
    $gps = sanitize_data($_POST['gps']);
    $call_function = sanitize_data($_POST['call_function']);
    $notification = sanitize_data($_POST['notification']);
    $display = sanitize_data($_POST['display']);
    $screen_size = sanitize_data($_POST['screen_size']);
    $os = sanitize_data($_POST['os']);
    $compatible_os = sanitize_data($_POST['compatible_os']);

    // Battery and Display Features
    $wifi = sanitize_data($_POST['wifi']);
    $sensors = sanitize_data($_POST['sensors']);
    $battery_type = sanitize_data($_POST['battery_type']);
    $battery_life = sanitize_data($_POST['battery_life']);

    // Additional Features
    $touchscreen = sanitize_data($_POST['touchscreen']);
    $fitness_features = sanitize_data($_POST['fitness_features']);
    $water_resistant = sanitize_data($_POST['water_resistant']);
    $extra_features = sanitize_data($_POST['extra_features']);

    // Perform the database insertion
    $sql = "INSERT INTO sm_watch_specs (product_id, `weight`, dial_shape, bluetooth, gps, call_function, `notification`, display, screen_size, os, compatible_os, wifi, sensors, battery_type, battery_life, touchscreen, fitness_features, water_resistant, extra_features) 
            VALUES ('$product_id', '$weight', '$dial_shape', '$bluetooth', '$gps', '$call_function', '$notification', '$display', '$screen_size', '$os', '$compatible_os', '$wifi', '$sensors', '$battery_type', '$battery_life', '$touchscreen', '$fitness_features', '$water_resistant', '$extra_features')";

    $result = mysqli_query($con, $sql);

    if ($result) {
        $_SESSION['success_msg'] = "Record inserted successfully!";
?><script>
            window.location.href = "../products/index.php";
        </script><?php

                } else {
                    $_SESSION['fail_msg'] = "Error: " . mysqli_error($con);
                    ?><script>
            window.location.href = "../products/index.php";
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
                            <input type="hidden" name="product_id" value="<?php echo isset($_GET['product_id']) ? $_GET['product_id'] : ''; ?>">

                            <!-- Display Information -->
                            <h3>Display Information</h3>
                            <div class="form-group">
                                <label for="weight">Weight:</label>
                                <input type="text" name="weight" id="weight" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="dial_shape">Dial Shape:</label>
                                <input type="text" name="dial_shape" id="dial_shape" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="bluetooth">Bluetooth:</label>
                                <select name="bluetooth" id="bluetooth" class="form-control" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="gps">GPS:</label>
                                <select name="gps" id="gps" class="form-control" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="call_function">Call Function:</label>
                                <select name="call_function" id="call_function" class="form-control" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="notification">Notification:</label>
                                <select name="notification" id="notification" class="form-control" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="display">Display:</label>
                                <input type="text" name="display" id="display" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="screen_size">Screen Size:</label>
                                <input type="text" name="screen_size" id="screen_size" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="os">Operating System:</label>
                                <input type="text" name="os" id="os" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="compatible_os">Compatible Operating System:</label>
                                <input type="text" name="compatible_os" id="compatible_os" class="form-control" required>
                            </div>
                            <!-- Battery and Display Features -->
                            <h3>Battery and Display Features</h3>
                            <div class="form-group">
                                <label for="wifi">Wi-Fi:</label>
                                <input type="text" name="wifi" id="wifi" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="sensors">Sensors:</label>
                                <input type="text" name="sensors" id="sensors" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="battery_type">Battery Type:</label>
                                <input type="text" name="battery_type" id="battery_type" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="battery_life">Battery Life:</label>
                                <input type="text" name="battery_life" id="battery_life" class="form-control" required>
                            </div>

                            <!-- Additional Features -->
                            <h3>Additional Features</h3>
                            <div class="form-group">
                                <label for="touchscreen">Touchscreen:</label>
                                <select name="touchscreen" id="touchscreen" class="form-control" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="fitness_features">Fitness Features:</label>
                                <input type="text" name="fitness_features" id="fitness_features" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="water_resistant">Water Resistant:</label>
                                <input type="text" name="water_resistant" id="water_resistant" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="extra_features">Extra Features:</label>
                                <input type="text" name="extra_features" id="extra_features" class="form-control" required>
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