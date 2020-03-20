<?php
    include '../config/connection.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (trim($_POST['kota_kode']) == "") {
            echo json_encode(array(
                "message" => "Check fill this parameter, it must be filled.", 
                "code" => 400, 
                "status" => false));
        } else {
            $kodekota_get = $_POST['kota_kode'];

            $queryListWisata = "SELECT tbl_destinasiwisata.dest_kode, tbl_destinasiwisata.dest_namadestinasi, tbl_destinasiwisata.dest_deskripsi , tbl_destinasiwisata.dest_lokasi , tbl_destinasiwisata.dest_ratting, tbl_destinasiwisata.dest_hargatiket  , tbl_destinasiwisata.dest_gambar, tbl_kota.kota_nama, tbl_kota.kota_ratting, tbl_kota.kota_gambar, tbl_kota.kota_kode FROM tbl_destinasiwisata JOIN tbl_kota ON tbl_destinasiwisata.kota_kode = tbl_kota.kota_kode WHERE tbl_kota.kota_kode = '$kodekota_get' ORDER BY tbl_destinasiwisata.dest_kode";
            $reqListWisata = mysqli_query($AUTH, $queryListWisata);

            $_response = array();
            while($row = mysqli_fetch_array($reqListWisata)){
                array_push(
                    $_response, array(
                        'dest_kode' => $row[0],
                        'dest_namadestinasi' => $row[1],
                        'dest_deskripsi ' => $row[2],
                        'dest_lokasi ' => $row[3],
                        'dest_ratting' => $row[4],
                        'dest_hargatiket  ' => $row[5],
                        'dest_gambar' => $row[6],
                        'kota_nama' => $row[7],
                        'kota_ratting' => $row[8],
                        'kota_gambar' => $row[9],
                        'kota_kode' => $row[10])
                    );
            }
            echo json_encode(array(
                "message" => "Data list tempat wisata TERSEDIA di database", 
                "code" => 200, 
                "status" => true, 
                "result" => $_response)
            );

            mysqli_close($AUTH);
        }
    } else {
        echo json_encode(array(
            "message" => "Forbidden, This request ISN'T this METHOD and must be FILL PARAMETER.", 
            "code" => 400, 
            "status" => false)
        );
    }
?>