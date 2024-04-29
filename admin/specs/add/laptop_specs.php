<?php
session_start();
require '../../../dbcon.php';
$title = "Add Laptop Specs";
require '../../inc/header.php';

require '../../functions/logic.php';

$productId = isset($_GET['product_id']) ? sanitize_data($_GET['product_id']) : 0;

if (isset($_POST['submit'])) {
    // Retrieve data from the form
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
    $model = mysqli_real_escape_string($con, $_POST['model']);
    $os = mysqli_real_escape_string($con, $_POST['os']);
    $dimensions = mysqli_real_escape_string($con, $_POST['dimensions']);
    $weight = mysqli_real_escape_string($con, $_POST['weight']);
    $colors = mysqli_real_escape_string($con, $_POST['colors']);
    $touch_screen = isset($_POST['touch_screen']) ? 1 : 0;

    // Display Information
    $screen_size = mysqli_real_escape_string($con, $_POST['screen_size']);
    $screen_resolution = mysqli_real_escape_string($con, $_POST['screen_resolution']);
    $display = mysqli_real_escape_string($con, $_POST['display']);
    $display_features = mysqli_real_escape_string($con, $_POST['display_features']);

    // Processor Information
    $processor = mysqli_real_escape_string($con, $_POST['processor']);
    $processor_variant = mysqli_real_escape_string($con, $_POST['processor_variant']);
    $graphics = mysqli_real_escape_string($con, $_POST['graphics']);
    $clock_speed = mysqli_real_escape_string($con, $_POST['clock_speed']);
    $cores = mysqli_real_escape_string($con, $_POST['cores']);
    $cache = mysqli_real_escape_string($con, $_POST['cache']);
    $sys_arch = mysqli_real_escape_string($con, $_POST['sys_arch']);

    // Memory and Storage
    $ram_memory = mysqli_real_escape_string($con, $_POST['ram_memory']);
    $ram_type = mysqli_real_escape_string($con, $_POST['ram_type']);
    $ram_frequency = mysqli_real_escape_string($con, $_POST['ram_frequency']);
    $ssd_storage = mysqli_real_escape_string($con, $_POST['ssd_storage']);
    $hdd_storage = mysqli_real_escape_string($con, $_POST['hdd_storage']);

    // Battery Information
    $battery = mysqli_real_escape_string($con, $_POST['battery']);
    $power_supply = mysqli_real_escape_string($con, $_POST['power_supply']);

    // Connectivity
    $bluetooth = mysqli_real_escape_string($con, $_POST['bluetooth']);
    $wifi = mysqli_real_escape_string($con, $_POST['wifi']);
    $ethernet_port = mysqli_real_escape_string($con, $_POST['ethernet_port']);

    // Ports and Other Features
    $usb_port = mysqli_real_escape_string($con, $_POST['usb_port']);
    $hdmi_port = mysqli_real_escape_string($con, $_POST['hdmi_port']);
    $multi_card_slot = mysqli_real_escape_string($con, $_POST['multi_card_slot']);
    $headset_jack = isset($_POST['headset_jack']) ? 1 : 0;
    $webcam = isset($_POST['webcam']) ? 1 : 0;
    $mic = isset($_POST['mic']) ? 1 : 0;
    $speakers = mysqli_real_escape_string($con, $_POST['speakers']);

    // Keyboard Information
    $keyboard = mysqli_real_escape_string($con, $_POST['keyboard']);
    $backlit_keyboard = isset($_POST['backlit_keyboard']) ? 1 : 0;
    $disk_drive = isset($_POST['disk_drive']) ? 1 : 0;

    // Insert data into laptop_specs table
    $sql = "INSERT INTO laptop_specs (product_id, model, os, dimensions, `weight`, colors, touch_screen, screen_size, screen_resolution, display, display_features, 
            processor, processor_variant, graphics, clock_speed, cores, cache, sys_arch, ram_memory, ram_type, ram_frequency, ssd_storage, hdd_storage, battery, power_supply, 
            bluetooth, wifi, ethernet_port, usb_port, hdmi_port, multi_card_slot, headset_jack, webcam, mic, speakers, disk_drive, keyboard, backlit_keyboard) 
            VALUES ('$product_id', '$model', '$os', '$dimensions', '$weight', '$colors', '$touch_screen', '$screen_size', '$screen_resolution', '$display', '$display_features', 
            '$processor', '$processor_variant', '$graphics', '$clock_speed', '$cores', '$cache', '$sys_arch', '$ram_memory', '$ram_type', '$ram_frequency', '$ssd_storage', '$hdd_storage',
            '$battery', '$power_supply', '$bluetooth', '$wifi', '$ethernet_port', '$usb_port', '$hdmi_port', '$multi_card_slot', '$headset_jack', '$webcam', '$mic', 
            '$speakers', '$disk_drive','$keyboard', '$backlit_keyboard')";

    $result = mysqli_query($con, $sql);

    if ($result) {
        $_SESSION['success_msg'] = "Record inserted successfully";
?><script>
            window.location.href = "../products/index.php"
        </script><?php
                    exit();
                } else {
                    $_SESSION['fail_msg'] = "Error inserting record: " . mysqli_error($con);
                    ?><script>
            window.location.href = "../products/index.php"
        </script><?php
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

                            <!-- Design Information -->
                            <h3 class="my-3">Design Information</h3>
                            <div class="form-group">
                                <label for="dimensions" class="form-label">Dimensions:</label>
                                <input type="text" name="dimensions" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="weight" class="form-label">Weight:</label>
                                <input type="text" name="weight" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="colors" class="form-label">Colors:</label>
                                <input type="text" name="colors" class="form-control" required>
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
                                <label for="ram_memory" class="form-label">RAM Memory:</label>
                                <input type="text" name="ram_memory" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="ram_type" class="form-label">RAM Type:</label>
                                <input type="text" name="ram_type" class="form-control" required>
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

                            <!-- Ports and Other Features -->
                            <h3 class="my-3">Ports and Other Features</h3>
                            <div class="form-group">
                                <label for="ethernet_port" class="form-label">Ethernet Port:</label>
                                <input type="text" name="ethernet_port" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="usb_port" class="form-label">USB Ports:</label>
                                <input type="text" name="usb_port" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="hdmi_port" class="form-label">HDMI Port:</label>
                                <input type="text" name="hdmi_port" class="form-control" required>
                            </div>
                            <!-- multi card slot -->

                            <div class="form-group">
                                <label for="multi_card_slot" class="form-label">Multi Card Slot:</label>
                                <input type="text" name="multi_card_slot" class="form-control" required>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" id="headset_jack" class="form-check-input" name="headset_jack">
                                <label for="headset_jack" class="form-label">Headset Jack</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" id="webcam" class="form-check-input" name="webcam">
                                <label for="webcam" class="form-check-label">Webcam</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" id="mic" class="form-check-input" name="mic">
                                <label for="mic" class="form-check-label">Microphone</label>
                            </div>

                            <div class="form-group">
                                <label for="speakers" class="form-label">Speakers:</label>
                                <input type="text" name="speakers" class="form-control" required>
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
<?php require '../../inc/footer.php'; ?>