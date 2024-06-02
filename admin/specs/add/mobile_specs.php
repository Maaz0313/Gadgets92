<?php
session_start();
require '../../../dbcon.php';
$title = "Add Mobile Specs";
require '../../inc/header.php';

require '../../functions/logic.php';

(int)$productId = isset($_GET['product_id']) ? sanitize_data(mysqli_real_escape_string($con, $_GET['product_id'])) : null;


if(isset($_POST['submit'])) {
    
// Sanitize input data
$deviceType = sanitize_data(mysqli_real_escape_string($con, $_POST['device_type']));
$sim = sanitize_data(mysqli_real_escape_string($con, $_POST['sim']));
$os = sanitize_data(mysqli_real_escape_string($con, $_POST['os']));
$dimensions = sanitize_data(mysqli_real_escape_string($con, $_POST['dimensions']));
$weight = sanitize_data(mysqli_real_escape_string($con, $_POST['weight']));
$waterproof = sanitize_data(mysqli_real_escape_string($con, $_POST['waterproof']));
$buildMaterial = sanitize_data(mysqli_real_escape_string($con, $_POST['build_material']));
$colors = sanitize_data(mysqli_real_escape_string($con, $_POST['colors']));
$touchScreen = sanitize_data(mysqli_real_escape_string($con, $_POST['touch_screen']));
$display = sanitize_data(mysqli_real_escape_string($con, $_POST['display']));
$screenSize = sanitize_data(mysqli_real_escape_string($con, $_POST['screen_size']));
$screenResolution = sanitize_data(mysqli_real_escape_string($con, $_POST['screen_resolution']));
$bezelLessDisplay = sanitize_data(mysqli_real_escape_string($con, $_POST['bezel_less_display']));
$screenProtection = sanitize_data(mysqli_real_escape_string($con, $_POST['screen_protection']));
$rearCamera = sanitize_data(mysqli_real_escape_string($con, $_POST['rear_camera']));
$sensor = sanitize_data(mysqli_real_escape_string($con, $_POST['sensor']));
$flash = sanitize_data(mysqli_real_escape_string($con, $_POST['flash']));
$rearVideoRecording = sanitize_data(mysqli_real_escape_string($con, $_POST['rear_video_recording']));
$rearFeatures = sanitize_data(mysqli_real_escape_string($con, $_POST['rear_features']));
$frontCamera = sanitize_data(mysqli_real_escape_string($con, $_POST['front_camera']));
$ram = sanitize_data(mysqli_real_escape_string($con, $_POST['ram']));
$chipset = sanitize_data(mysqli_real_escape_string($con, $_POST['chipset']));
$gpu = sanitize_data(mysqli_real_escape_string($con, $_POST['gpu']));
$cpuCores = sanitize_data(mysqli_real_escape_string($con, $_POST['cpu_cores']));
$internalStorage = sanitize_data(mysqli_real_escape_string($con, $_POST['internal_storage']));
$sdCardSlot = sanitize_data(mysqli_real_escape_string($con, $_POST['sd_card_slot']));
$battery_capacity = sanitize_data(mysqli_real_escape_string($con, $_POST['battery_capacity']));
$battery_features = sanitize_data(mysqli_real_escape_string($con, $_POST['battery_features']));
$fastCharging = sanitize_data(mysqli_real_escape_string($con, $_POST['fast_charging']));
$networkSupport = sanitize_data(mysqli_real_escape_string($con, $_POST['network_support']));
$bluetooth = sanitize_data(mysqli_real_escape_string($con, $_POST['bluetooth']));
$wifi = sanitize_data(mysqli_real_escape_string($con, $_POST['wifi']));
$usb = sanitize_data(mysqli_real_escape_string($con, $_POST['usb']));
$gps = sanitize_data(mysqli_real_escape_string($con, $_POST['gps']));
$nfc = sanitize_data(mysqli_real_escape_string($con, $_POST['nfc']));
$audioJack = sanitize_data(mysqli_real_escape_string($con, $_POST['audio_jack']));
$fmRadio = sanitize_data(mysqli_real_escape_string($con, $_POST['fm_radio']));
$loudSpeaker = sanitize_data(mysqli_real_escape_string($con, $_POST['loud_speaker']));
$fingerprintSensor = sanitize_data(mysqli_real_escape_string($con, $_POST['fingerprint_sensor']));
$otherSensors = sanitize_data(mysqli_real_escape_string($con, $_POST['other_sensors']));

// Insert query
$insertQuery = "INSERT INTO `mobile_specs` (`product_id`, `device_type`, `sim`, `os`, `dimensions`, `weight`, `waterproof`, `build_material`, `colors`, `touch_screen`, `display`, `screen_size`, `screen_resolution`, `bezel_less_display`, `screen_protection`, `rear_camera`, `sensor`, `flash`, `rear_video_recording`, `rear_features`, `front_camera`, `ram`, `chipset`, `gpu`, `cpu_cores`, `internal_storage`, `sd_card_slot`, `battery_capacity`, `battery_features`, `fast_charging`, `network_support`, `bluetooth`, `wifi`, `usb`, `gps`, `nfc`, `audio_jack`, `fm_radio`, `loud_speaker`, `fingerprint_sensor`, `other_sensors`) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$params = [$productId, $deviceType, $sim, $os, $dimensions, $weight, $waterproof, $buildMaterial, $colors, $touchScreen, $display, $screenSize, $screenResolution, $bezelLessDisplay, $screenProtection, $rearCamera, $sensor, $flash, $rearVideoRecording, $rearFeatures, $frontCamera, $ram, $chipset, $gpu, $cpuCores, $internalStorage, $sdCardSlot, $battery_capacity, $battery_features, $fastCharging, $networkSupport, $bluetooth, $wifi, $usb, $gps, $nfc, $audioJack, $fmRadio, $loudSpeaker, $fingerprintSensor, $otherSensors];

$result = mysqli_execute_query($con, $insertQuery, $params); // Assuming you have a function called mysqli_execute_query 
    if ($result === TRUE) {
        $_SESSION['success_msg'] = "Mobile specs added successfully.";
        ?><script>window.location.href = "../../products/index.php";</script><?php
    }
    else {
        $_SESSION['error_msg'] = "Error: " . $insertQuery . "<br>" . $con->error;
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
                            <li class="active">Add Mobile Specs</li>
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
                        <strong class="card-title">Add Mobile Specs</strong>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="device_type">Device Type</label>
                                <input type="text" id="device_type" name="device_type" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="sim">SIM</label>
                                <input type="text" id="sim" name="sim" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="os">OS</label>
                                <input type="text" id="os" name="os" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="dimensions">Dimensions</label>
                                <input type="text" id="dimensions" name="dimensions" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="weight">Weight</label>
                                <input type="text" id="weight" name="weight" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="waterproof">Waterproof</label>
                                <input type="text" id="waterproof" name="waterproof" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="build_material">Build Material</label>
                                <input type="text" id="build_material" name="build_material" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="colors">Colors</label>
                                <input type="text" id="colors" name="colors" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="touch_screen">Touch Screen</label>
                                <input type="text" id="touch_screen" name="touch_screen" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="display">Display</label>
                                <input type="text" id="display" name="display" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="screen_size">Screen Size</label>
                                <input type="text" id="screen_size" name="screen_size" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="screen_resolution">Screen Resolution</label>
                                <input type="text" id="screen_resolution" name="screen_resolution" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="bezel_less_display">Bezel Less Display</label>
                                <input type="text" id="bezel_less_display" name="bezel_less_display" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="screen_protection">Screen Protection</label>
                                <input type="text" id="screen_protection" name="screen_protection" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="rear_camera">Rear Camera</label>
                                <input type="text" id="rear_camera" name="rear_camera" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="sensor">Camera Sensor</label>
                                <input type="text" id="sensor" name="sensor" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="flash">Flash</label>
                                <input type="text" id="flash" name="flash" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="rear_video_recording">Rear Video Recording</label>
                                <input type="text" id="rear_video_recording" name="rear_video_recording" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="rear_features">Rear Features</label>
                                <input type="text" id="rear_features" name="rear_features" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="front_camera">Front Camera</label>
                                <input type="text" id="front_camera" name="front_camera" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="ram">RAM</label>
                                <input type="text" id="ram" name="ram" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="chipset">Chipset</label>
                                <input type="text" id="chipset" name="chipset" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="gpu">GPU</label>
                                <input type="text" id="gpu" name="gpu" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="cpu_cores">CPU Cores</label>
                                <input type="text" id="cpu_cores" name="cpu_cores" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="internal_storage">Internal Storage</label>
                                <input type="text" id="internal_storage" name="internal_storage" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="sd_card_slot">SD Card Slot</label>
                                <input type="text" id="sd_card_slot" name="sd_card_slot" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="battery_capacity">Battery Capacity</label>
                                <input type="text" id="battery_capacity" name="battery_capacity" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="battery_features">Battery Features</label>
                                <input type="text" id="battery_features" name="battery_features" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="fast_charging">Fast Charging</label>
                                <input type="text" id="fast_charging" name="fast_charging" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="network_support">Network Support</label>
                                <input type="text" id="network_support" name="network_support" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="bluetooth">Bluetooth</label>
                                <input type="text" id="bluetooth" name="bluetooth" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="wifi">Wifi</label>
                                <input type="text" id="wifi" name="wifi" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="usb">USB</label>
                                <input type="text" id="usb" name="usb" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="gps">GPS</label>
                                <input type="text" id="gps" name="gps" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="nfc">NFC</label>
                                <input type="text" id="nfc" name="nfc" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="audio_jack">Audio Jack</label>
                                <input type="text" id="audio_jack" name="audio_jack" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="fm_radio">FM Radio</label>
                                <input type="text" id="fm_radio" name="fm_radio" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="loud_speaker">Loud Speaker</label>
                                <select name="loud_speaker" id="loud_speaker" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fingerprint_sensor">Fingerprint Sensor</label>
                                <input type="text" id="fingerprint_sensor" name="fingerprint_sensor" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="other_sensors">Other Sensors</label>
                                <input type="text" id="other_sensors" name="other_sensors" class="form-control" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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