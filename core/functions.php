<?php


function pd($data):void
{
    echo "<pre>".print_r($data, true)."</pre>";
    die;
}

function get_comments()
{
    global $db;
    $comments = $db->query("SELECT * FROM comments order by id desc limit 12")->findAll();

    foreach ($comments as $k => $comment) {
        if (empty($comments[$k]['created_at'])){
            continue;
        }
        $comments[$k]['created_at'] = date('d-m-Y', $comments[$k]['created_at']);
    }
    return $comments;
}

function getCode()
{
    return 111;
}


