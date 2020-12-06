<?php 
	require_once('conn.php');
	header('Content-type:application/json;charset=utf-8');

	//錯誤處理
	if (empty($_POST['content']) || empty($_POST['nickname']) || empty($_POST['site_key'])) {
		$json = array(
			"ok" => false,
			"message" => "Please input missing fields"
		);

		$response = json_encode($json);
		echo $response;
		die();
	}

	$site_key = $_POST['site_key'];
	$nickname = $_POST['nickname'];
	$content = $_POST['content'];
	$sql = "INSERT INTO gaga_w12_hw1_comments(site_key, nickname, content) VALUES(?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('sss', $site_key, $nickname, $content);
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
	//物件
	$json = array(
		"ok" => true,
		"message" => "success"
	);
	$response = json_encode($json);
	echo $response;
	die();
?>