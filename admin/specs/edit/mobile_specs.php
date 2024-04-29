<?php
session_start();
require '../../../dbcon.php';
$title = "Add Mobile Specs";
require '../../inc/header.php';

require '../../functions/logic.php';

$productId = isset($_GET['id']) ? sanitize_data($_GET['id']) : 0;

// Fetch product specs for the given product ID
$sql = "SELECT * FROM mobile_specs WHERE product_id = $productId";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);


if (isset($_POST['submit'])) {

    // Sanitize input data
    $releaseDate = sanitize_data($_POST['release_date']);
    $deviceType = sanitize_data($_POST['device_type']);
    $sim = sanitize_data($_POST['sim']);
    $os = sanitize_data($_POST['os']);
    $dimensions = sanitize_data($_POST['dimensions']);
    $weight = sanitize_data($_POST['weight']);
    $waterproof = sanitize_data($_POST['waterproof']);
    $buildMaterial = sanitize_data($_POST['build_material']);
    $colors = sanitize_data($_POST['colors']);
    $touchScreen = sanitize_data($_POST['touch_screen']);
    $display = sanitize_data($_POST['display']);
    $screenSize = sanitize_data($_POST['screen_size']);
    $screenResolution = sanitize_data($_POST['screen_resolution']);
    $bezelLessDisplay = sanitize_data($_POST['bezel_less_display']);
    $screenProtection = sanitize_data($_POST['screen_protection']);
    $rearCamera = sanitize_data($_POST['rear_camera']);
    $sensor = sanitize_data($_POST['sensor']);
    $flash = sanitize_data($_POST['flash']);
    $rearVideoRecording = sanitize_data($_POST['rear_video_recording']);
    $rearFeatures = sanitize_data($_POST['rear_features']);
    $frontCamera = sanitize_data($_POST['front_camera']);
    $ram = sanitize_data($_POST['ram']);
    $chipset = sanitize_data($_POST['chipset']);
    $gpu = sanitize_data($_POST['gpu']);
    $cpuCores = sanitize_data($_POST['cpu_cores']);
    $internalStorage = sanitize_data($_POST['internal_storage']);
    $sdCardSlot = sanitize_data($_POST['sd_card_slot']);
    $battery_capacity = sanitize_data($_POST['battery_capacity']);
    $battery_features = sanitize_data($_POST['battery_features']);
    $fastCharging = sanitize_data($_POST['fast_charging']);
    $networkSupport = sanitize_data($_POST['network_support']);
    $bluetooth = sanitize_data($_POST['bluetooth']);
    $wifi = sanitize_data($_POST['wifi']);
    $usb = sanitize_data($_POST['usb']);
    $gps = sanitize_data($_POST['gps']);
    $nfc = sanitize_data($_POST['nfc']);
    $audioJack = sanitize_data($_POST['audio_jack']);
    $fmRadio = sanitize_data($_POST['fm_radio']);
    $loudSpeaker = sanitize_data($_POST['loud_speaker']);
    $fingerprintSensor = sanitize_data($_POST['fingerprint_sensor']);
    $otherSensors = sanitize_data($_POST['other_sensors']);
    // Update query
    $updateQuery = "UPDATE `mobile_specs` SET `release_date`='$releaseDate', `device_type`='$deviceType', `sim`='$sim', `os`='$os', `dimensions`='$dimensions', `weight`='$weight', `waterproof`='$waterproof', `build_material`='$buildMaterial', `colors`='$colors', `touch_screen`='$touchScreen', `display`='$display', `screen_size`='$screenSize', `screen_resolution`='$screenResolution', `bezel_less_display`='$bezelLessDisplay', `screen_protection`='$screenProtection', `rear_camera`='$rearCamera', `sensor`='$sensor', `flash`='$flash', `rear_video_recording`='$rearVideoRecording', `rear_features`='$rearFeatures', `front_camera`='$frontCamera', `ram`='$ram', `chipset`='$chipset', `gpu`='$gpu', `cpu_cores`='$cpuCores', `internal_storage`='$internalStorage', `sd_card_slot`='$sdCardSlot', `battery_capacity`='$battery_capacity', `battery_features`='$battery_features', `fast_charging`='$fastCharging', `network_support`='$networkSupport', `bluetooth`='$bluetooth', `wifi`='$wifi', `usb`='$usb', `gps`='$gps', `nfc`='$nfc', `audio_jack`='$audioJack', `fm_radio`='$fmRadio', `loud_speaker`='$loudSpeaker', `fingerprint_sensor`='$fingerprintSensor', `other_sensors`='$otherSensors' WHERE `product_id`='$productId'";
    $res = $con->query($updateQuery);
    if ($res) {
        $_SESSION['success_msg'] = "Mobile specs updated successfully.";
?><script>
            window.location.href = "../../products/index.php";
        </script><?php
                } else {
                    $_SESSION['fail_msg'] = "Error updating mobile specs: " . $con->error;
                    ?><script>
            window.location.href = "../../products/index.php";
        </script><?php
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
                                <label for="release_date">Release Date</label>
                                <input type="date" id="release_date" name="release_date" class="form-control" value="<?= $row['release_date']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="device_type">Device Type</label>
                                <input type="text" id="device_type" name="device_type" class="form-control" value="<?= $row['device_type']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="sim">SIM</label>
                                <input type="text" id="sim" name="sim" class="form-control" value="<?= $row['sim']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="os">OS</label>
                                <input type="text" id="os" name="os" class="form-control" value="<?= $row['os']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="dimensions">Dimensions</label>
                                <input type="text" id="dimensions" name="dimensions" class="form-control" value="<?= $row['dimensions']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="weight">Weight</label>
                                <input type="text" id="weight" name="weight" class="form-control" value="<?= $row['weight']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="waterproof">Waterproof</label>
                                <input type="text" id="waterproof" name="waterproof" class="form-control" value="<?= $row['waterproof']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="build_material">Build Material</label>
                                <input type="text" id="build_material" name="build_material" class="form-control" value="<?= $row['build_material']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="colors">Colors</label>
                                <input type="text" id="colors" name="colors" class="form-control" value="<?= $row['colors']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="touch_screen">Touch Screen</label>
                                <input type="text" id="touch_screen" name="touch_screen" class="form-control" value="<?= $row['touch_screen']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="display">Display</label>
                                <input type="text" id="display" name="display" class="form-control" value="<?= $row['display']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="screen_size">Screen Size</label>
                                <input type="text" id="screen_size" name="screen_size" class="form-control" value="<?= $row['screen_size']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="screen_resolution">Screen Resolution</label>
                                <input type="text" id="screen_resolution" name="screen_resolution" class="form-control" value="<?= $row['screen_resolution']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="bezel_less_display">Bezel Less Display</label>
                                <input type="text" id="bezel_less_display" name="bezel_less_display" class="form-control" value="<?= $row['bezel_less_display']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="screen_protection">Screen Protection</label>
                                <input type="text" id="screen_protection" name="screen_protection" class="form-control" value="<?= $row['screen_protection']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="rear_camera">Rear Camera</label>
                                <input type="text" id="rear_camera" name="rear_camera" class="form-control" value="<?= $row['rear_camera']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="sensor">Camera Sensor</label>
                                <input type="text" id="sensor" name="sensor" class="form-control" value="<?= $row['sensor']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="flash">Flash</label>
                                <input type="text" id="flash" name="flash" class="form-control" value="<?= $row['flash']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="rear_video_recording">Rear Video Recording</label>
                                <input type="text" id="rear_video_recording" name="rear_video_recording" class="form-control" value="<?= $row['rear_video_recording']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="rear_features">Rear Features</label>
                                <input type="text" id="rear_features" name="rear_features" class="form-control" value="<?= $row['rear_features']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="front_camera">Front Camera</label>
                                <input type="text" id="front_camera" name="front_camera" class="form-control" value="<?= $row['front_camera']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="ram">RAM</label>
                                <input type="text" id="ram" name="ram" class="form-control" value="<?= $row['ram']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="chipset">Chipset</label>
                                <input type="text" id="chipset" name="chipset" class="form-control" value="<?= $row['chipset']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="gpu">GPU</label>
                                <input type="text" id="gpu" name="gpu" class="form-control" value="<?= $row['gpu']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="cpu_cores">CPU Cores</label>
                                <input type="text" id="cpu_cores" name="cpu_cores" class="form-control" value="<?= $row['cpu_cores']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="internal_storage">Internal Storage</label>
                                <input type="text" id="internal_storage" name="internal_storage" class="form-control" value="<?= $row['internal_storage']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="sd_card_slot">SD Card Slot</label>
                                <input type="text" id="sd_card_slot" name="sd_card_slot" class="form-control" value="<?= $row['sd_card_slot']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="battery_capacity">Battery Capacity</label>
                                <input type="text" id="battery_capacity" name="battery_capacity" class="form-control" value="<?= $row['battery_capacity']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="battery_features">Battery Features</label>
                                <input type="text" id="battery_features" name="battery_features" class="form-control" value="<?= $row['battery_features']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="fast_charging">Fast Charging</label>
                                <input type="text" id="fast_charging" name="fast_charging" class="form-control" value="<?= $row['fast_charging']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="network_support">Network Support</label>
                                <input type="text" id="network_support" name="network_support" class="form-control" value="<?= $row['network_support']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="bluetooth">Bluetooth</label>
                                <input type="text" id="bluetooth" name="bluetooth" class="form-control" value="<?= $row['bluetooth']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="wifi">Wifi</label>
                                <input type="text" id="wifi" name="wifi" class="form-control" value="<?= $row['wifi']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="usb">USB</label>
                                <input type="text" id="usb" name="usb" class="form-control" value="<?= $row['usb']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="gps">GPS</label>
                                <input type="text" id="gps" name="gps" class="form-control" value="<?= $row['gps']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nfc">NFC</label>
                                <input type="text" id="nfc" name="nfc" class="form-control" value="<?= $row['nfc']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="audio_jack">Audio Jack</label>
                                <input type="text" id="audio_jack" name="audio_jack" class="form-control" value="<?= $row['audio_jack']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="fm_radio">FM Radio</label>
                                <input type="text" id="fm_radio" name="fm_radio" class="form-control" value="<?= $row['fm_radio']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="loud_speaker">Loud Speaker</label>
                                <select name="loud_speaker" id="loud_speaker" class="form-control">
                                    <option value="1" <?= $row['loud_speaker'] == 1 ? 'selected' : ''; ?>>Yes</option>
                                    <option value="0" <?= $row['loud_speaker'] == 0 ? 'selected' : ''; ?>>No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fingerprint_sensor">Fingerprint Sensor</label>
                                <input type="text" id="fingerprint_sensor" name="fingerprint_sensor" class="form-control" value="<?= $row['fingerprint_sensor']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="other_sensors">Other Sensors</label>
                                <input type="text" id="other_sensors" name="other_sensors" class="form-control" value="<?= $row['other_sensors']; ?>" required>
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