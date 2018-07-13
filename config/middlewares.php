<?php

$middlewares = [
	'before' => [
		function ($c) {
			session_start();
		},
		function ($c) {
			header("Content-type: text/html; charset=UTF-8");
		},
	],
	'after' => [
		function ($c) {
			echo 'after';
		},
		function ($c) {
			echo 'after 2';
		},
	],
];