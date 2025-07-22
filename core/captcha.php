<?php

use Gregwar\Captcha\CaptchaBuilder;

$phr= new \Gregwar\Captcha\PhraseBuilder(3, '0123456789');

$builder = new CaptchaBuilder(null, $phr);
$builder->build($width=120, $height =80, $font = null);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
    $_SESSION['code_captcha'] = $builder->getPhrase();
}

