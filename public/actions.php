<?php

$config = require_once '../config/config.php';
require_once '../core/functions.php';
require_once '../core/Db.php';


$db = Db::getInstance()->getConnection($config['db']);
//$data = json_decode(file_get_contents('php://input'), true);
//var_dump(file_exists('../Vi/table-comments.php'));die;

function htmlError($errs)
{

    $htmlError = '<ul>';
    foreach ($errs as $err) {
        $htmlError .= '<li>' . $err . '</li>';
    }
    $htmlError .= '</ul>';
    return $htmlError;

}


// add comment
if (isset($_POST['addComment'])) {
    $errors = [];
    $message = $_POST['message'];
    if (empty($message) || strlen($message) < 2) {
        $errors[] = 'Message cannot be empty or not anouth message';
    }
    if ((int)$_POST['checkCode'] !== getCode()) {
        $errors[] = 'Wrong code';
    }
    unset($_POST);
    if (!empty($errors)) {
        echo json_encode([
            'status' => 'error',
            'msg' => htmlError($errors)
        ]);

    } else {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $db->query("INSERT INTO comments (user_agent, comment, created_at)
                            VALUES (?, ?, ?)", [
                    $user_agent, $message, time()
                ]);

        echo json_encode([
            'result' => 'success',
        ]);
        die;
    }
}



//    echo json_encode([
//        'result' => 'error',
//    ]); die;


