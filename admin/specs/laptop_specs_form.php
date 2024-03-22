<?php
session_start();
require '../../dbcon.php';
$title = "Add Laptop Specs";
require '../inc/header.php';

require '../functions/logic.php';

$productId = isset($_GET['product_id']) ? sanitize_data($_GET['product_id']) : 0;

if (isset($_POST['submit'])) {
    // Retrieve data from the form
    $product_id = $_POST['product_id'];
    $model = $_POST['model'];
    $os = $_POST['os'];
    $touch_screen = isset($_POST['touch_screen']) ? 1 : 0;

    // Display Information
    $screen_size = $_POST['screen_size'];
    $screen_resolution = $_POST['screen_resolution'];
    $display = $_POST['display'];
    $display_features = $_POST['display_features'];

    // Processor Information
    $processor = $_POST['processor'];
    $processor_variant = $_POST['processor_variant'];
    $graphics = $_POST['graphics'];
    $clock_speed = $_POST['clock_speed'];
    $cores = $_POST['cores'];
    $cache = $_POST['cache'];
    $sys_arch = $_POST['sys_arch'];

    // Memory and Storage
    $ram = $_POST['ram'];
    $ram_frequency = $_POST['ram_frequency'];
    $ssd_storage = $_POST['ssd_storage'];
    $hdd_storage = $_POST['hdd_storage'];

    // Battery Information
    $battery = $_POST['battery'];
    $power_supply = $_POST['power_supply'];

    // Connectivity
    $bluetooth = $_POST['bluetooth'];
    $wifi = $_POST['wifi'];
    $ethernet_port = $_POST['ethernet_port'];

    // Ports and Other Features
    $usb_port = $_POST['usb_port'];
    $hdmi_port = $_POST['hdmi_port'];
    $headset_jack = $_POST['headset_jack'];
    $webcam = isset($_POST['webcam']) ? 1 : 0;
    $mic = isset($_POST['mic']) ? 1 : 0;

    // Keyboard Information
    $keyboard = $_POST['keyboard'];
    $backlit_keyboard = isset($_POST['backlit_keyboard']) ? 1 : 0;
    $disk_drive = isset($_POST['disk_drive']) ? 1 : 0;

    // Insert data into laptop_specs table
    $sql = "INSERT INTO laptop_specs (product_id, model, os, touch_screen, screen_size, screen_resolution, display, display_features, 
            processor, processor_variant, graphics, clock_speed, cores, cache, sys_arch, ram, ram_frequency, ssd_storage, hdd_storage, battery, power_supply, 
            bluetooth, wifi, ethernet_port, usb_port, hdmi_port, headset_jack, webcam, mic, disk_drive, keyboard, backlit_keyboard) 
            VALUES ('$product_id', '$model', '$os', '$touch_screen', '$screen_size', '$screen_resolution', '$display', '$display_features', 
            '$processor', '$processor_variant', '$graphics', '$clock_speed', '$cores', '$cache', '$sys_arch', '$ram', '$ram_frequency', '$ssd_storage', '$hdd_storage', 
            '$battery', '$power_supply', '$bluetooth', '$wifi', '$ethernet_port', '$usb_port', '$hdmi_port', '$headset_jack', '$webcam', '$mic', 
            '$disk_drive','$keyboard', '$backlit_keyboard')";

    $result = mysqli_query($con, $sql);

    if ($result) {
        $_SESSION['success_msg'] = "Record inserted successfully";
        ?><script>window.location.href = "../products/index.php"</script><?php
        exit();
    } else {
        $_SESSION['fail_msg'] = "Error inserting record: " . mysqli_error($con);
        ?><script>window.location.href = "../products/index.php"</script><?php
        exit();
    }
}
?>
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Add Mobile Specs</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="../dashboard.php">Dashboard</a></li>
                            <li><a href="../products/index.php">Products</a></li>
                            <li class="active">Add Laptop Specs</li>
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
                        <strong class="card-title">Add Laptop Specs</strong>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <input type="hidden" name="product_id" value="<?php echo isset($_GET['product_id']) ? $_GET['product_id'] : ''; ?>">

                            <!-- General Information -->
                            <h3 class="my-3">General Information</h3>
                            <div class="form-group">
                                <label for="model" class="form-label">Model:</label>
                                <input type="text" name="model" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="os" class="form-label">Operating System:</label>
                                <input type="text" name="os" class="form-control" required>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" id="touch_screen" class="form-check-input" name="touch_screen">
                                <label for="touch_screen" class="form-check-label">Touch Screen</label>
                            </div>

                            <!-- Display Information -->
                            <h3 class="my-3">Display Information</h3>
                            <div class="form-group">
                                <label for="screen_size" class="form-label">Screen Size (in inches):</label>
                                <input type="text" name="screen_size" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="screen_resolution" class="form-label">Screen Resolution:</label>
                                <input type="text" name="screen_resolution" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="display" class="form-label">Display:</label>
                                <input type="text" name="display" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="display_features" class="form-label">Display Features:</label>
                                <input type="text" name="display_features" class="form-control" required>
                            </div>

                            <!-- Processor Information -->
                            <h3 class="my-3">Processor Information</h3>
                            <div class="form-group">
                                <label for="processor" class="form-label">Processor:</label>
                                <input type="text" name="processor" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="processor_variant" class="form-label">Processor Variant:</label>
                                <input type="text" name="processor_variant" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="graphics" class="form-label">Graphics:</label>
                                <input type="text" name="graphics" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="clock_speed" class="form-label">Clock Speed:</label>
                                <input type="text" name="clock_speed" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="cores" class="form-label">Number of Cores:</label>
                                <input type="text" name="cores" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="cache" class="form-label">Cache:</label>
                                <input type="text" name="cache" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="sys_arch" class="form-label">System Architecture:</label>
                                <input type="text" name="sys_arch" class="form-control" required>
                            </div>

                            <!-- Memory and Storage -->
                            <h3 class="my-3">Memory and Storage</h3>
                            <div class="form-group">
                                <label for="ram" class="form-label">RAM:</label>
                                <input type="text" name="ram" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="ram_frequency" class="form-label">RAM Frequency:</label>
                                <input type="text" name="ram_frequency" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="ssd_storage" class="form-label">SSD Storage:</label>
                                <input type="text" name="ssd_storage" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="hdd_storage" class="form-label">HDD Storage:</label>
                                <input type="text" name="hdd_storage" class="form-control" required>
                            </div>

                            <!-- Battery Information -->
                            <h3 class="my-3">Battery Information</h3>
                            <div class="form-group">
                                <label for="battery" class="form-label">Battery:</label>
                                <input type="text" name="battery" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="power_supply" class="form-label">Power Supply:</label>
                                <input type="text" name="power_supply" class="form-control" required>
                            </div>

                            <!-- Connectivity -->
                            <h3 class="my-3">Connectivity</h3>
                            <div class="form-group">
                                <label for="bluetooth" class="form-label">Bluetooth:</label>
                                <input type="text" name="bluetooth" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="wifi" class="form-label">Wi-Fi:</label>
                                <input type="text" name="wifi" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="ethernet_port" class="form-label">Ethernet Port:</label>
                                <input type="text" name="ethernet_port" class="form-control" required>
                            </div>

                            <!-- Ports and Other Features -->
                            <h3 class="my-3">Ports and Other Features</h3>
                            <div class="form-group">
                                <label for="usb_port" class="form-label">USB Ports:</label>
                                <input type="text" name="usb_port" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="hdmi_port" class="form-label">HDMI Port:</label>
                                <input type="text" name="hdmi_port" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="headset_jack" class="form-label">Headset Jack:</label>
                                <input type="text" name="headset_jack" class="form-control" required>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" id="webcam" class="form-check-input" name="webcam">
                                <label for="webcam" class="form-check-label">Webcam</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" id="mic" class="form-check-input" name="mic">
                                <label for="mic" class="form-check-label">Microphone</label>
                            </div>

                            <!-- Keyboard Information -->
                            <h3 class="my-3">Keyboard Information</h3>
                            <div class="form-group">
                                <label for="keyboard" class="form-label">Keyboard:</label>
                                <input type="text" name="keyboard" class="form-control" required>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" id="backlit_keyboard" class="form-check-input" name="backlit_keyboard">
                                <label for="backlit_keyboard" class="form-check-label">Backlit Keyboard</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" id="disk_drive" name="disk_drive" class="form-check-input">
                                <label for="disk_drive" class="form-check-label">Disk Drive</label>
                            </div>
                            <!-- Submit Button -->
                            <br>
                            <button type="submit" name="submit" class="btn btn-primary w-25">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- END MAIN CONTENT-->
    <?php require '../inc/footer.php'; ?>