<?php
session_start();
require '../../../dbcon.php';
$title = "Add Headset Specs";
require '../../inc/header.php';

require '../../functions/logic.php';
$id = $_GET['id'];
$spec_query = "SELECT * FROM headset_specs WHERE product_id = '$id'";
$spec_result = mysqli_query($con, $spec_query);
$spec = mysqli_fetch_assoc($spec_result);

if (isset($_POST['submit'])) {
    // Retrieve data from the form
    $product_id = sanitize_data(mysqli_real_escape_string($con, $_POST['product_id']));

    // General Information
    $model = sanitize_data(mysqli_real_escape_string($con, $_POST['model']));
    $type = sanitize_data(mysqli_real_escape_string($con, $_POST['type']));
    $design = sanitize_data(mysqli_real_escape_string($con, $_POST['design']));
    $connectivity = sanitize_data(mysqli_real_escape_string($con, $_POST['connectivity']));
    $wireless_range = sanitize_data(mysqli_real_escape_string($con, $_POST['wireless_range']));
    $in_the_box = sanitize_data(mysqli_real_escape_string($con, $_POST['in_the_box']));

    // Audio Information
    $driver = sanitize_data(mysqli_real_escape_string($con, $_POST['driver']));
    $frequency_response = sanitize_data(mysqli_real_escape_string($con, $_POST['frequency_response']));
    $bluetooth = sanitize_data(mysqli_real_escape_string($con, $_POST['bluetooth']));
    $controls = sanitize_data(mysqli_real_escape_string($con, $_POST['controls']));
    $control_features = sanitize_data(mysqli_real_escape_string($con, $_POST['control_features']));
    $built_in_mic = sanitize_data(mysqli_real_escape_string($con, $_POST['built_in_mic']));

    // Additional Features
    $water_resistant = sanitize_data(mysqli_real_escape_string($con, $_POST['water_resistant']));
    $additional_features = sanitize_data(mysqli_real_escape_string($con, $_POST['additional_features']));

    // Battery Information
    $battery_life = sanitize_data(mysqli_real_escape_string($con, $_POST['battery_life']));
    $charging_port = sanitize_data(mysqli_real_escape_string($con, $_POST['charging_port']));
    $charging_time = sanitize_data(mysqli_real_escape_string($con, $_POST['charging_time']));

    // Update data into headset_specs table
    $sql = "UPDATE headset_specs SET model=?, `type`=?, design=?, connectivity=?, wireless_range=?, in_the_box=?, driver=?, frequency_response=?, bluetooth=?, controls=?, control_features=?, `built-in_mic`=?, water_resistant=?, additional_features=?, battery_life=?, charging_port=?, charging_time=? WHERE product_id=?";
    $params = [$model, $type, $design, $connectivity, $wireless_range, $in_the_box, $driver, $frequency_response, $bluetooth, $controls, $control_features, $built_in_mic, $water_resistant, $additional_features, $battery_life, $charging_port, $charging_time, $product_id];
    $result = mysqli_execute_query($con, $sql, $params);

    if ($result) {
        $_SESSION['success_msg'] = "Record inserted successfully";
        ?>
        <script>
            window.location.href = "../../products/index.php";
        </script><?php
        exit();
    } else {
        $_SESSION['fail_msg'] = "Error updating record: " . mysqli_error($con);
        ?>
        <script>
            window.location.href = "../../products/index.php";
        </script><?php
        exit();
    }
}

if (isset($_SESSION['success_msg'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
                    ' . $_SESSION['success_msg'] . '</div>';
    unset($_SESSION['success_msg']);
}

if (isset($_SESSION['fail_msg'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
                    ' . $_SESSION['fail_msg'] . '</div>';
    unset($_SESSION['fail_msg']);
}
?>

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Add Headphone Specs</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="../dashboard.php">Dashboard</a></li>
                            <li><a href="../products/index.php">Products</a></li>
                            <li class="active">Add Headphone Specs</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Add Headphone Specs</strong>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <input type="hidden" name="product_id"
                                value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">

                            <!-- General Information -->
                            <h3>General Information</h3>
                            <div class="form-group">
                                <label for="model">Model:</label>
                                <input type="text" name="model" id="model" class="form-control"
                                    value="<?= $spec['model']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="type">Type:</label>
                                <input type="text" name="type" id="type" class="form-control"
                                    value="<?= $spec['type']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="design">Design:</label>
                                <input type="text" name="design" id="design" class="form-control"
                                    value="<?= $spec['design']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="connectivity">Connectivity:</label>
                                <input type="text" name="connectivity" id="connectivity" class="form-control"
                                    value="<?= $spec['connectivity']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="wireless_range">Wireless Range:</label>
                                <input type="text" name="wireless_range" id="wireless_range" class="form-control"
                                    value="<?= $spec['wireless_range']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="in_the_box">In the Box:</label>
                                <input type="text" name="in_the_box" id="in_the_box" class="form-control"
                                    value="<?= $spec['in_the_box']; ?>" required>
                            </div>

                            <!-- Audio Information -->
                            <h3>Audio Information</h3>
                            <div class="form-group">
                                <label for="driver">Driver:</label>
                                <input type="text" name="driver" id="driver" class="form-control"
                                    value="<?= $spec['driver']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="frequency_response">Frequency Response:</label>
                                <input type="text" name="frequency_response" id="frequency_response"
                                    class="form-control" value="<?= $spec['frequency_response']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="bluetooth">Bluetooth:</label>
                                <input type="text" name="bluetooth" id="bluetooth" class="form-control"
                                    value="<?= $spec['bluetooth']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="controls">Controls:</label>
                                <input type="text" name="controls" id="controls" class="form-control"
                                    value="<?= $spec['controls']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="control_features">Control Features:</label>
                                <input type="text" name="control_features" id="control_features" class="form-control"
                                    value="<?= $spec['control_features']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="built_in_mic">Built-in Microphone:</label>
                                <select name="built_in_mic" id="built_in_mic" class="form-control" required>
                                    <option value="1" <?= ($spec['built-in_mic'] == 1) ? 'selected' : '' ?>>Yes</option>
                                    <option value="0" <?= ($spec['built-in_mic'] == 0) ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>

                            <!-- Additional Features -->
                            <h3>Additional Features</h3>
                            <div class="form-group">
                                <label for="water_resistant">Water Resistant:</label>
                                <select name="water_resistant" id="water_resistant" class="form-control" required>
                                    <option value="1" <?= ($spec['water_resistant'] == 1) ? 'selected' : '' ?>>Yes</option>
                                    <option value="0" <?= ($spec['water_resistant'] == 0) ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="additional_features">Additional Features:</label>
                                <input type="text" name="additional_features" id="additional_features"
                                    class="form-control" value="<?= $spec['additional_features']; ?>" required>
                            </div>

                            <!-- Battery Information -->
                            <h3>Battery Information</h3>
                            <div class="form-group">
                                <label for="battery_life">Battery Life:</label>
                                <input type="text" name="battery_life" id="battery_life" class="form-control"
                                    value="<?= $spec['battery_life']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="charging_port">Charging Port:</label>
                                <input type="text" name="charging_port" id="charging_port" class="form-control"
                                    value="<?= $spec['charging_port']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="charging_time">Charging Time:</label>
                                <input type="text" name="charging_time" id="charging_time" class="form-control"
                                    value="<?= $spec['charging_time']; ?>" required>
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