<?php
    include '../config/connection.php';

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

            // TODO 1 : List Wisata Filter Berdasarkan Kode Kota = Kota
            $queryListKota = "SELECT * FROM tbl_kota";
            $reqListKota = mysqli_query($AUTH, $queryListKota);

            $_response = array();
            while($row = mysqli_fetch_array($reqListKota)){
                array_push(
                    $_response, array(
                        'kota_kode' => $row[0],
                        'kota_nama' => $row[1],
                        'kota_ratting' => $row[2],
                        'kota_gambar' => $row[3])
                    );
            }
            echo json_encode(array(
                "message" => "Data kota TERSEDIA di database", 
                "code" => 200, 
                "status" => true, 
                "result" => $_response)
            );

            mysqli_close($AUTH);
    } else {
        echo json_encode(array(
            "message" => "Forbidden, This request ISN'T this METHOD and must be FILL PARAMETER.", 
            "code" => 400, 
            "status" => false)
        );
    }

?>