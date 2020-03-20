<?php
include '../config/connection.php';


if ($_SERVER['REQUEST_METHOD']=='POST') {
	# code...
	$user_kode = trim($_POST['user_kode']);
	$user_namalengkap = trim($_POST['user_namalengkap']);
	$user_jeniskelamin = trim($_POST['user_jeniskelamin']);
	$user_username = trim($_POST['user_username']);
	$user_password = trim($_POST['user_password']);
	$user_email = trim($_POST['user_email']);
	$user_picture = trim($_POST['user_picture']);

	$queryCek = mysqli_query($AUTH, "SELECT * FROM tbl_user WHERE user_username = '$user_username'");

	$row = mysqli_num_rows($queryCek);

	$response = array();

	if($row > 0){
		$response["message"] = trim("Username Already Exist");
		$response["code"] = 400;
		$response["status"] = false;

		echo json_encode($response);

	}else{
		$queryInsert = "INSERT INTO tbl_user (user_kode, user_namalengkap, user_jeniskelamin, user_username, user_password, user_email, user_picture) VALUES ($user_kode,'$user_namalengkap' ,'$user_jeniskelamin','$user_username','$user_password','$user_email','$user_picture')";
		$exec = mysqli_query($AUTH,$queryInsert);

		$cekData = mysqli_query($AUTH, "SELECT * FROM tbl_user WHERE user_username = '$user_username'");

		$rows = mysqli_num_rows($cekData);

		if ($exec > 0) {

			$response["user"] = array();

			while ($row = mysqli_fetch_array($cekData)) {
				$data = array();

				$data["user_kode"] = $row["user_kode"];
				$data["user_namalengkap"] = $row["user_namalengkap"];
				$data["user_jeniskelamin"] = $row["user_jeniskelamin"];
				$data["user_username"] = $row["user_username"];
				$data["user_password"] = $row["user_password"];
				$data["user_email"] = $row["user_email"];
				$data["user_picture"] = $row["user_picture"];
				$data["user_created"] = $row["user_created"];

				$response["message"] = trim("You have been registered!");
				$response["code"] = 200;
				$response["status"] = true;

				array_push($response["user"],$data);
			}
			echo json_encode($response);
		}else{
			$response["message"] = trim("failed to registered!");
			$response["code"] = 400;
			$response["status"] = false;

			echo json_encode($response);

		}
	}

}else{
	$response["message"] = trim("Forbidden");
	$response["code"] = 403;
	$response["status"] = false;

	echo json_encode($response);	

}



?>