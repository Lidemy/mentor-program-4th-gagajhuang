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
		$sql = sprintf("SELECT * FROM gaga_users WHERE username = '%s'", $username);
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		return $row; // username, id, nickname
	}
	
?>