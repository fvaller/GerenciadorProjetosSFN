<?php

$app->middlewares('before', function ($c) {
	session_start();
	echo 'before';
});

$app->middlewares('before', function ($c) {
	header("Content-type: text/html; charset=UTF-8");
	echo 'before 2';
});

$app->middlewares('after', function ($c) {
	echo 'after';
});
$app->middlewares('after', function ($c) {
	echo 'after 2';
});