<?php
    function action($action, $params = array(), $description = null){
        global $koneksi;
        $actionEsc = esc($action);
        $descriptionEsc = esc($description);
        $jsonParams = json_encode($params);
        $timestamp = date('Y-m-d H:i:s');
        if(isset($_SESSION['id'])){
            $user = $_SESSION['id'];
        } else {
            $user = $_SESSION['id_pending']; // Untuk self register
        }
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; // Bisa diubah sesuai dengan keadaan server. 
        $koneksi->query("INSERT INTO tb_log (`action`, `description`, params, `timestamp`, `user`, ip)
         VALUES ('$actionEsc', '$description', '$jsonParams', '$timestamp', '$user', '$ip')");
    }
?>