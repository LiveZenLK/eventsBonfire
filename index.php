<?php
    $install_url = 'http'.((empty($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off')?'':'s') .'://'. $_SERVER['SERVER_NAME'] .'/eventsBonfire/public/';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Welcome to CI-Bonfire</title>
        <base target="_blank">
        <link rel="stylesheet" type="text/css" href="public/assets/css/bootstrap.min.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="public/assets/css/bootstrap-responsive.min.css" media="screen" />
        <style>
            body {
                font-family:sans-serif;
            }
            #intro {
                width:700px;
                margin-left:-390px;
                position:fixed;
                left:50%;
                top:60px;
                padding:10px 30px;
            }
            h1 {
                text-align:center;
            }
            .continue {
                padding:10px 0;
                text-align:center;
            }
        </style>
    </head>
    <body>
        <div id="intro" class="well">
            <h1>Welcome to Ruptly</h1>
            <p style="margin-left: 260px;">Click Contiue Button for Login</p>
            <div class="continue">
                <a class="btn btn-primary" href="<?php echo $install_url ?>">Continue &raquo;</a>
            </div>
        </div>

        <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="public/assets/js/jquery-1.7.2.min.js"><\/script>')</script>

        <!-- This would be a good place to use a CDN version of jQueryUI if needed -->
        <script type="text/javascript" src="public/assets/js/bootstrap.min.js" ></script>
    </body>
</html>