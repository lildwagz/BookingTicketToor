<?php
	$respon = array();

	include '../config/connection.php';

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		
		if (trim($_POST['username'])== "") {
			$response["message"] = trim("Fill your username here..");
			$response["code"] = 400;
			$response["status"] = false;

			echo json_encode($response);
		}else if (trim($_POST['password'])== "") {
			$response["message"] = trim("Fill your password here..");
			$response["code"] = 400;
			$response["status"] = false;

			echo json_encode($response);
		}else{
			$username_get = trim($_POST['username']);
			$password_get = trim($_POST['password']);

			$q_search = mysqli_query($AUTH,"SELECT * FROM tbl_user where user_username = '$username_get' and user_password = '$password_get'");

			$response = array();
			$exec = mysqli_num_rows($q_search);

			if($exec > 0){
				$response["informasi_user"] = array();

				while ($row = mysqli_fetch_array($q_search)) {
					$fecth_data_user = array();

					$fecth_data_user["user_kode"] = $row["user_kode"];
					$fecth_data_user["user_namalengkap"] = $row["user_namalengkap"];
					$fecth_data_user["user_jeniskelamin"] = $row["user_jeniskelamin"];
					$fecth_data_user["user_username"] = $row["user_username"];
					$fecth_data_user["user_password"] = $row["user_password"];
					$fecth_data_user["user_email"] = $row["user_email"];
					$fecth_data_user["user_picture"] = $row["user_picture"];
					$fecth_data_user["user_created"] = $row["user_created"];

					$response["message"] = trim("Login successfully..");
					$response["code"] = 200;
					$response["status"] = true;

					array_push($response["informasi_user"], $fecth_data_user);
				}
				echo json_encode($response);
			}else{
				$response["message"] = trim("Login failed..");
				$response["code"] = 400;
				$response["status"] = false;
				echo json_encode($response);
			}
		}

	}else{
		$response["message"] = trim("Forbbiden");
		$response["code"] = 403;
		$response["status"] = false;
		echo json_encode($response);
	}

?>