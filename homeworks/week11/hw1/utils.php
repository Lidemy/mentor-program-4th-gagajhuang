<?php
	require_once('conn.php');

	function generateToken(){
		$str = '';
		for ($i=1; $i<=16 ; $i++) { 
			$str .= chr(rand(65,90));
		}
		return $str;
	}

	function getUserFromUsername($username){
		global $conn;
		// users
		$sql = sprintf("SELECT * FROM gaga_w11_hw1_users WHERE username = '%s'", $username);
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		return $row; // username, id, nickname, role
	}
	
	// 跳脫特殊字元
	function escape($str){
		return htmlspecialchars($str, ENT_QUOTES);
	}

	// 權限判斷 $action: update, delete, create
	function hasPermission($user, $action, $comment){
		if ($user === NULL) {
			return false;
		}
    if ($user['role'] === 'Admin') {
      return true;
    }
    if ($user['role'] === 'Normal') {
    	if ($action === 'create') return true;
      return $comment['username'] === $user['username'];
    }
    if ($user['role'] === 'Banned') {
    	if ($action === 'update') return false;
      return $action !== 'create';
    }
	}
?>