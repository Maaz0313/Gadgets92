<?php

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

	$_SESSION["success_msg"] = "Your Review & Rating Successfully Submitted";

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

	$query = "
	SELECT * FROM user_reviews 
	ORDER BY id DESC
	";

	$result = $connect->query($query, PDO::FETCH_ASSOC);

	foreach ($result as $row) {
		$review_content[] = array(
			'user_name' => $row["user_name"],
			'user_review' => $row["user_review"],
			'rating' => $row["user_rating"],
			'datetime' => date('l jS, F Y h:i:s A', $row["datetime"])
		);

		if ($row["user_rating"] == '5') {
			$five_star_review++;
		}

		if ($row["user_rating"] == '4') {
			$four_star_review++;
		}

		if ($row["user_rating"] == '3') {
			$three_star_review++;
		}

		if ($row["user_rating"] == '2') {
			$two_star_review++;
		}

		if ($row["user_rating"] == '1') {
			$one_star_review++;
		}

		$total_review++;

		$total_user_rating = $total_user_rating + $row["user_rating"];

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

	echo json_encode($output);

}