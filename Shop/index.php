<?php 
include_once('../resources/php_lib/elements.php');
include_once('../resources/php_lib/functions.php');
require('../rw-config.php');
  
  if(isset($_GET['cat']))
  {
	if($_GET['cat']=='LivingRoom'
	|| $_GET['cat']=='BedRoom'
	|| $_GET['cat']=='Outdoor'
	|| $_GET['cat']=='Study'
	|| $_GET['cat']=='Decors'
	|| $_GET['cat']=='Dining'
	)
	{
		$cat=$_GET['cat'];
		rw_meta($cat.'- RoyalWoods');
		rw_header();
		rw_content_filter($cat);
	}
  }
  else
	{
	rw_meta('Shop'); //All the Including Files are Included in This
	rw_header();
	rw_all_content();
	}
  rw_footer();
