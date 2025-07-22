<?php


use Gregwar\Captcha\CaptchaBuilder;
use Rum\core\Db;

$db = Db::getInstance()->getConnection($config['db']);


function pd($data): void
{
    echo "<pre>" . print_r($data, true) . "</pre>";
    die;
}

function get_comments()
{
    global $db;
    $comments = $db->query("SELECT * FROM comments order by id desc limit 12")->findAll();

    foreach ($comments as $k => $comment) {
        if (empty($comments[$k]['created_at'])) {
            continue;
        }
        $comments[$k]['created_at'] = date('d-m-Y', $comments[$k]['created_at']);
    }
    return $comments;
}

function getCode(): int|bool
{
    return (int)$_SESSION['code_captcha'] ?? false;
}

function htmlError($errs)
{
    $htmlError = '<ul>';
    foreach ($errs as $err) {
        $htmlError .= '<li>' . $err . '</li>';
    }
    $htmlError .= '</ul>';

    return $htmlError;
}

function captchaGenerate()
{
    $phr = new \Gregwar\Captcha\PhraseBuilder(3, '0123456789');

    $builder = new CaptchaBuilder(null, $phr);
    $builder->build($width = 120, $height = 80, $font = null);
    $_SESSION['code_captcha'] = $builder->getPhrase();

    return $builder;
}

function userAgent(): string
{
    return $_SERVER['HTTP_USER_AGENT'] ?? '';
}

function userIP(): string
{
    return $_SERVER['REMOTE_ADDR'] ?? '';
}





