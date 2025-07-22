<?php

use Rum\core\Db;

require_once '../vendor/autoload.php';

$config = require_once '../config/config.php';
require_once '../core/functions.php';


$db = Db::getInstance()->getConnection($config['db']);
$data = json_decode(file_get_contents('php://input'), true);

!session_id() && session_start();


// add comment
if (isset($_POST['addComment'])) {
    $errors = [];
    $message = $_POST['message'];
    if (empty($message) || strlen($message) < 2) {
        $errors[] = 'Message cannot be empty or not anouth message';
    }

    if ((int)$_POST['captcha'] !== getCode()) {
        $errors[] = 'Wrong code';
    }
    unset($_POST);
    if (!empty($errors)) {
        echo json_encode([
            'status' => 'error',
            'msg' => htmlError($errors)
        ]);

    } else {
        $userAgent = userAgent();
        $userIP = userIP();
        $db->query("INSERT INTO comments (user_agent, userIP, comment, created_at)
                            VALUES (?,?,?,?)", [$userAgent, $userIP, $message, time()]);

        echo json_encode([
            'status' => 'success',
        ]);
    }
    die;
}

if ($data['action'] == 'inputCode') {
    $code_captcha = $_SESSION['code_captcha'];
    $userCode = (int)$data['input'];
    if ($userCode == $code_captcha){
        echo json_encode([
            'status' => 'success',
            'message' => '<p class="check_captcha_success">code is valid</p>'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
        ]);
    }
    return;
}

if ($data['action'] == 'reloadCaptcha') {
    $builder = captchaGenerate();
    echo json_encode([
        'status' => 'success',
        'code'=>$_SESSION['code_captcha'],
        'inlineCpt'=> $builder->inline()
    ]);return;
}
die;
