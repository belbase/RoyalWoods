<?php
require_once 'rw-config.php';
session_start();
if(isset($_SESSION['admin']['pin']))
{
	unset($_SESSION['admin']['pin']);
	session_destroy();
	header("Location: ".ROOT_HT."/");
}
elseif(isset($_SESSION['user']['pin']))
{
	unset($_SESSION['user']['pin']);
	session_destroy();
	header("Location: ".ROOT_HT."/");
}

elseif(!isset($_SESSION['admin']['login'])||!isset($_SESSION['user']['pin']))
{
	header("Location: ".ROOT_HT."/login.php");
}

