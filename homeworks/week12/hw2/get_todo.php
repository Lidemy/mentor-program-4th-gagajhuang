<?php 
	require_once('conn.php');
	header('Content-type:application/json;charset=utf-8');
	header('Access-Control-Allow-Origin: *');
	//錯誤處理
	if (empty($_GET['id'])) {
		$json = array(
			"ok" => false,
			"message" => "Please add id in url"
		);

		$response = json_encode($json);
		echo $response;
		die();
	}

	$id = intval($_GET['id']);//轉為數字

	$sql = "SELECT id, todo from gaga_w12_hw2_todos WHERE id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i', $id);
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
	// $todos = array();
	$row = $result->fetch_assoc();
	$json = array(
		"ok" => true,
		"data" => array(
			"id" => $row['id'],
			"todo" => $row["todo"],
		)
	);
	$response = json_encode($json);
	echo($response);
	die();
?>