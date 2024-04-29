<?php
session_start();
require '../../../dbcon.php';
$title = "Add Television Specs";
require '../../inc/header.php';

require '../../functions/logic.php';

$productId = isset($_GET['id']) ? $_GET['id'] : '';

$selectQuery = "SELECT * FROM tv_specs WHERE product_id = '$productId'";
$result = mysqli_query($con, $selectQuery);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $product_id = sanitize_data($_POST['product_id']);

    // TV Information
    $model = sanitize_data($_POST['model']);
    $launch_year = sanitize_data($_POST['launch_year']);
    $in_the_box = sanitize_data($_POST['in_the_box']);
    $weight_with_stand = sanitize_data($_POST['weight_with_stand']);
    $weight_without_stand = sanitize_data($_POST['weight_without_stand']);

    // Display Features
    $display = sanitize_data($_POST['display']);
    $screen_size = sanitize_data($_POST['screen_size']);
    $screen_resolution = sanitize_data($_POST['screen_resolution']);
    $display_features = sanitize_data($_POST['display_features']);
    $video_formats = sanitize_data($_POST['video_formats']);

    // Audio Formats and Other Fields
    $audio_formats = sanitize_data($_POST['audio_formats']);
    $no_of_speakers = sanitize_data($_POST['no_of_speakers']);
    $output_per_speaker = sanitize_data($_POST['output_per_speaker']);
    $total_speaker_output = sanitize_data($_POST['total_speaker_output']);
    $sound_tech = sanitize_data($_POST['sound_tech']);
    $smart_tv = sanitize_data($_POST['smart_tv']);
    $os = sanitize_data($_POST['os']);
    $internet_connectivity = sanitize_data($_POST['internet_connectivity']);
    $bluetooth = sanitize_data($_POST['bluetooth']);
    $screen_mirroring = sanitize_data($_POST['screen_mirroring']);
    $preloaded_apps = sanitize_data($_POST['preloaded_apps']);
    $voice_assistant = sanitize_data($_POST['voice_assistant']);
    $more_features = sanitize_data($_POST['more_features']);
    $usb = sanitize_data($_POST['usb']);
    $hdmi = sanitize_data($_POST['hdmi']);
    $ethernet = sanitize_data($_POST['ethernet']);
    $power_requirement = sanitize_data($_POST['power_requirement']);
    $power_consumption = sanitize_data($_POST['power_consumption']);

    // Perform the database insertion
    $sql = "UPDATE `tv_specs` SET `model`='$model', `launch_year`='$launch_year', `in_the_box`='$in_the_box', `weight_with_stand`='$weight_with_stand', `weight_without_stand`='$weight_without_stand', `display_tech`='$display', `screen_size`='$screen_size', `screen_resolution`='$screen_resolution', `display_features`='$display_features', `video_formats`='$video_formats', `audio_formats`='$audio_formats', `no_of_speakers`='$no_of_speakers', `output_per_speaker`='$output_per_speaker', `total_speaker_output`='$total_speaker_output', `sound_tech`='$sound_tech', `smart_tv`='$smart_tv', `os`='$os', `internet_connectivity`='$internet_connectivity', `bluetooth`='$bluetooth', `screen_mirroring`='$screen_mirroring', `preloaded_apps`='$preloaded_apps', `voice_assistant`='$voice_assistant', `more_features`='$more_features', `usb`='$usb', `hdmi`='$hdmi', `ethernet`='$ethernet', `power_requirement`='$power_requirement', `power_consumption`='$power_consumption' WHERE `product_id`='$product_id'";

    $result = mysqli_query($con, $sql);

    if ($result) {
        $_SESSION['success_msg'] = "TV specs updated successfully!";
        ?><script>window.location.href = "../../products/index.php"</script><?php
    } else {
        $_SESSION['fail_msg'] = "Error: " . mysqli_error($con);
        ?><script>window.location.href = "../../products/index.php"</script><?php
    }
}
?>
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Add Television Specs</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Add Television Specs</li>
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
                        <strong class="card-title">Add Television Specs</strong>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <input type="hidden" name="product_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
                            <!-- TV Information -->
                            <div class="form-group">
                                <label for="model">Model</label>
                                <input type="text" id="model" name="model" class="form-control" value="<?= $row['model'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="launch_year">Launch Year</label>
                                <input type="text" id="launch_year" name="launch_year" class="form-control" value="<?= $row['launch_year'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="in_the_box">In The Box</label>
                                <textarea id="in_the_box" name="in_the_box" class="form-control" required><?= $row['in_the_box'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="weight_with_stand">Weight with Stand</label>
                                <input type="text" id="weight_with_stand" name="weight_with_stand" class="form-control" value="<?= $row['weight_with_stand'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="weight_without_stand">Weight without Stand</label>
                                <input type="text" id="weight_without_stand" name="weight_without_stand" class="form-control" value="<?= $row['weight_without_stand'] ?>" required>
                            </div>

                            <!-- Display Features -->
                            <div class="form-group">
                                <label for="display">Display Technology</label>
                                <input type="text" id="display" name="display" class="form-control" value="<?= $row['display_tech'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="screen_size">Screen Size</label>
                                <input type="text" id="screen_size" name="screen_size" class="form-control" value="<?= $row['screen_size'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="screen_resolution">Screen Resolution</label>
                                <input type="text" id="screen_resolution" name="screen_resolution" class="form-control" value="<?= $row['screen_resolution'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="display_features">Display Features</label>
                                <textarea id="display_features" name="display_features" class="form-control" required><?= $row['display_features'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="video_formats">Video Formats</label>
                                <input type="text" id="video_formats" name="video_formats" class="form-control" value="<?= $row['video_formats'] ?>" required>
                            </div>

                            <!-- Audio Formats and Other Fields -->
                            <div class="form-group">
                                <label for="audio_formats">Audio Formats</label>
                                <input type="text" id="audio_formats" name="audio_formats" class="form-control" value="<?= $row['audio_formats'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="no_of_speakers">Number of Speakers</label>
                                <input type="number" id="no_of_speakers" name="no_of_speakers" class="form-control" value="<?= $row['no_of_speakers'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="output_per_speaker">Output per Speaker</label>
                                <input type="text" id="output_per_speaker" name="output_per_speaker" class="form-control" value="<?= $row['output_per_speaker'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="total_speaker_output">Total Speaker Output</label>
                                <input type="text" id="total_speaker_output" name="total_speaker_output" class="form-control" value="<?= $row['total_speaker_output'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="sound_tech">Sound Technology</label>
                                <input type="text" id="sound_tech" name="sound_tech" class="form-control" value="<?= $row['sound_tech'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="smart_tv">Smart TV</label>
                                <select name="smart_tv" id="smart_tv" class="form-control" required>
                                    <option value="1" <?= $row['smart_tv'] == 1 ? 'selected' : '' ?>>Yes</option>
                                    <option value="0" <?= $row['smart_tv'] == 0 ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="os">Operating System</label>
                                <input type="text" id="os" name="os" class="form-control" value="<?= $row['os'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="internet_connectivity">Internet Connectivity</label>
                                <input type="text" id="internet_connectivity" name="internet_connectivity" class="form-control" value="<?= $row['internet_connectivity'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="bluetooth">Bluetooth</label>
                                <select name="bluetooth" id="bluetooth" class="form-control" required>
                                    <option value="1" <?= $row['bluetooth'] == 1 ? 'selected' : '' ?>>Yes</option>
                                    <option value="0" <?= $row['bluetooth'] == 0 ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="screen_mirroring">Screen Mirroring</label>
                                <select name="screen_mirroring" id="screen_mirroring" class="form-control" required>
                                    <option value="1" <?= $row['screen_mirroring'] == 1 ? 'selected' : '' ?>>Yes</option>
                                    <option value="0" <?= $row['screen_mirroring'] == 0 ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="preloaded_apps">Preloaded Apps</label>
                                <textarea id="preloaded_apps" name="preloaded_apps" class="form-control" required><?= $row['preloaded_apps'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="voice_assistant">Voice Assistant</label>
                                <textarea id="voice_assistant" name="voice_assistant" class="form-control" required><?= $row['voice_assistant'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="more_features">More Features</label>
                                <textarea id="more_features" name="more_features" class="form-control" required><?= $row['more_features'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="usb">USB Ports</label>
                                <input type="text" id="usb" name="usb" class="form-control" value="<?= $row['usb'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="hdmi">HDMI Ports</label>
                                <input type="text" id="hdmi" name="hdmi" class="form-control" value="<?= $row['hdmi'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="ethernet">Ethernet Port</label>
                                <select name="ethernet" id="ethernet" class="form-control" required>
                                    <option value="1" <?= $row['ethernet'] == 1 ? 'selected' : '' ?>>Yes</option>
                                    <option value="0" <?= $row['ethernet'] == 0 ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="power_requirement">Power Requirement</label>
                                <input type="text" id="power_requirement" name="power_requirement" class="form-control" value="<?= $row['power_requirement'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="power_consumption">Power Consumption</label>
                                <input type="text" id="power_consumption" name="power_consumption" class="form-control" value="<?= $row['power_consumption'] ?>" required>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group mt-4">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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