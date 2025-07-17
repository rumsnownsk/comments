<?php
$comments = get_comments();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="/assets/css/main.css" rel="stylesheet"  crossorigin="anonymous">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center h3 my-3">Leave your comment</h1>
        </div>
    </div>
    <div class="row">
        <form action="" method="" id="formComment" class="d-flex">

            <div class="mb-3">
                <label for="message" class="form-label">Your message</label>
                <textarea name="message" class="form-control" id="message" rows="3" placeholder="не менее 20 символов"></textarea>
            </div>
            <div class="mb-3 d-flex ">



                <input type="text" name="addComment" hidden="hidden">

                <button type="submit" class="btn btn-primary" id="btn-submit" >Send message</button>
            </div>
        </form>
        <div id="errorMessage" class="alert alert-danger" role="alert" hidden>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12 mt-5">
            <div id="allComments">
               <?php require 'table-comments.php'?>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="/assets/js/main.js" crossorigin="anonymous"></script>

</body>
</html>