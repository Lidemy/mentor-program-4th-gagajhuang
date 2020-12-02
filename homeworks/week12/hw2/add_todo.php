<?php 
	require_once('conn.php');
	header('Content-type:application/json;charset=utf-8');

	//錯誤處理
	if (empty($_POST['todo'])) {
		$json = array(
			"ok" => false,
			"message" => "Please input missing fields"
		);

		$response = json_encode($json);
		echo($response);
		die();
	}

	$todo = $_POST['todo'];
	$sql = "INSERT INTO gaga_w12_hw2_todos(todo) VALUES(?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('s', $todo);
	$result = $stmt->execute();
	// 錯誤訊息
	if(!$result){
		$json = array(
			"ok" => false,
			"message" => $conn->error,
		);

		$response = json_encode($json);
		echo($response);
		die();
	}
	$json = array(
		"ok" => true,
		"message" => "success",
		"id" => $conn->insert_id,//最新新增的 id
	);
	$response = json_encode($json);
	echo($response);
	die();
?>