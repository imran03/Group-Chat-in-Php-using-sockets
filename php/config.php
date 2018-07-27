<?php
	session_start();

	define('URL_BASE', '/chatonline/');
	define('SOCKET_FRONTEND', '192.168.0.167:25003');
	define('SOCKET_BACKEND_IP', '192.168.0.167');
	define('SOCKET_BACKEND_PORT', '25003');

	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', 'root@123');
	define('DB_NAME', 'onlinechat');
	define('DB_CHARSET', 'utf8');
?>