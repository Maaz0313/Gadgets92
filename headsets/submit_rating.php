<?php
require('../inc/functions.inc.php');
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$base_url = $protocol . $_SERVER['HTTP_HOST'];

//submit_rating.php

$connect = new PDO("mysql:host=localhost;dbname=gadgets92", "root", "root");

if (isset($_POST["rating_data"])) {
	date_default_timezone_set('Asia/Karachi');
	$data = array(
		':product_id' => $_POST["product_id"],
		':user_id' => $_POST["user_id"],
		':rating' => $_POST["rating_data"],
		':review_heading' => $_POST["review_heading"],
		':review_summary' => $_POST["review_summary"],
		':created_at' => date('Y-m-d H:i:s', time())

	);

	$query = "
	INSERT INTO user_reviews 
	(product_id, user_id, rating, review_heading, review_summary, created_at) 
	VALUES (:product_id, :user_id, :rating, :review_heading, :review_summary, :created_at)
	";

	$statement = $connect->prepare($query);

	$statement->execute($data);

	echo "Your Review & Rating Successfully Submitted";

}

if (isset($_POST["action"])) {
	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;
	$review_content = array();

	$product_id = $_POST["product_id"];
	$query = "SELECT user_reviews.*, users.name, users.profile FROM user_reviews INNER JOIN users ON user_reviews.user_id = users.id WHERE product_id = $product_id";

	$result = $connect->query($query, PDO::FETCH_ASSOC);

	if ($result->rowCount() == 0) {
		$output = '';
	} else {

		foreach ($result as $row) {
			$review_content[] = array(
				'user_name' => $row["name"],
				'profile' => $base_url . "/profiles/" . $row["profile"],
				'review_heading' => $row["review_heading"],
				'review_summary' => $row["review_summary"],
				'rating' => $row["rating"],
				'datetime' => facebook_time_ago($row["created_at"])
			);

			if ($row["rating"] == '5') {
				$five_star_review++;
			}

			if ($row["rating"] == '4') {
				$four_star_review++;
			}

			if ($row["rating"] == '3') {
				$three_star_review++;
			}

			if ($row["rating"] == '2') {
				$two_star_review++;
			}

			if ($row["rating"] == '1') {
				$one_star_review++;
			}

			$total_review++;

			$total_user_rating = $total_user_rating + $row["rating"];

		}

		$average_rating = $total_user_rating / $total_review;

		$output = array(
			'average_rating' => number_format($average_rating, 1),
			'total_review' => $total_review,
			'five_star_review' => $five_star_review,
			'four_star_review' => $four_star_review,
			'three_star_review' => $three_star_review,
			'two_star_review' => $two_star_review,
			'one_star_review' => $one_star_review,
			'review_data' => $review_content
		);
	}

	echo json_encode($output);

}