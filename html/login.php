<?php
error_reporting( E_ALL );
	session_start();
	if ((!isset($_POST['login'])) || (!isset($_POST['passwd']))) {
		header('Location: index.php');
		exit();
	}

	require_once "connect.php";

	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($connection->connect_errno != 0) {
		echo "Error: ".$connection->connect_errno;
	}
	else {
		$login = $_POST['login'];
		$passwd = $_POST['passwd'];
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	
		if ($rezultat = @$connection->query(
		sprintf("SELECT * FROM users WHERE login='%s'",
		mysqli_real_escape_string($connection, $login)))) {
			$usr_count = $rezultat->num_rows;
			if($usr_count > 0) {
				$row = $rezultat->fetch_assoc();
				if ($passwd == $row['pass']) {
					$_SESSION['logged'] = true;
					$_SESSION['id'] = $row['id'];
					$_SESSION['login'] = $row['login'];
					
					unset($_SESSION['error']);
					$rezultat->free_result();
					
					header('Location: main_panel.php');
				}
				else {
					$_SESSION['error'] = '<span style="color:red;font-size:25px;">Invalid credentials!</span>';
					header('Location: index.php');
				}
				
			} else {
				$_SESSION['error'] = '<span style="color:red;font-size:25px;">Invalid credentials!</span>';
				header('Location: index.php');	
			}
		}
		$connection->close();
	}	
?>
