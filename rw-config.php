<?php
    

function rw_connect()
	{
                $host='localhost'; //Set The Host
                $user='root';   //You have to put your mysql username to run this
                $pass=''; //you have to put your mqsql password here
                $database='rw_database'; //name of Your database
		$link=mysqli_connect($host,$user,$pass,$database);
		return $link;
	}

/* 
 This define the root path of the dir of mains
 * @var ROOT
 */

/* 
 This define the Server path of the dir of mains
 * @var ROOT_HT
 */

define('ROOT_HT',"http://localhost/royalwoods");
define('SHOP_HT',"http://localhost/royalwoods/Shop");
define('ROOT_DIR',realpath(dirname(__FILE__)));
/*if your File is not saved in server root 
 * you must need to change your @var ROOT_HT
 */