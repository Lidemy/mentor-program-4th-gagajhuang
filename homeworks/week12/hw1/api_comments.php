<?php 
	require_once('conn.php');
	header('Content-type:application/json;charset=utf-8');
	header('Access-Control-Allow-Origin: *');
	//錯誤處理
	if (empty($_GET['site_key'])) { 
		$json = array(
			"ok" => false,
			"message" => "Please send site_key in url"
		);

		$response = json_encode($json);
		echo $response;
		die();
	}

	$site_key = $_GET['site_key'];
	// $before = $_GET['before'];

	$sql = "SELECT id, nickname, content, created_at from gaga_w12_hw1_comments WHERE site_key = ? " . (empty($_GET['before']) ? '' : 'and id <?') . " ORDER BY id DESC limit 5";
	$stmt = $conn->prepare($sql);
	if (empty($_GET['before'])) {
		$stmt->bind_param('s', $site_key);
	}else{
		$stmt->bind_param('si', $site_key, $_GET['before']);
	}
	$result = $stmt->execute();
	// 錯誤訊息
	if(!$result){
		$json = array(
			"ok" => false,
			"message" => $conn->error,
		);

		$response = json_encode($json);
		echo $response;
		die();
	}

	$result = $stmt->get_result();
	$comments = array();
	while ($row = $result->fetch_assoc()) {
		array_push($comments, array(
			"id" => $row['id'],
			"nickname" => $row["nickname"],
			"content" => $row["content"],
			"created_at" => $row["created_at"],
		));
	};
	$json = array(
		"ok" => true,
		"comments" => $comments
	);
	$response = json_encode($json);
	echo($response);
	die();
?>