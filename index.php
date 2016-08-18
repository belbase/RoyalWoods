<?php 
/*
 * 
 ******************************************************************** 
 * @Package Name: RoyalWoods- The Online Furniture Market
 * @Author: Deepak Belbase, Sagar Kumar
 * /////////////////////////////////////
 * This File Contain all nececery things and codeing in @Package/resources/element.php
 ********************************************************************
 *   
 */
include_once('resources/php_lib/elements.php');
include_once('resources/php_lib/functions.php');
require('rw-config.php');

    rw_meta('RoyalWoods - The online Furniture Store');
    rw_header();
    ?>

<div id='rw_main_doc'>
    <div class='rw_frame_one'> <div class='rw_content_frame'>
<!--IMAGE DIV START--><div class="rw_featured_image"> </div>
<!--CONTENT DIV START--><div class="rw_featured_content"><center>
                                                        <h1>High Quality Furniture that's built to last</h1>
                                                        <p id="rw_green_label">
                                                            Online Shopping for High Quality,
                                                            Affordable Home Furniture and Home Decors at Royalwoods,
                                                            We have been providing Best Value, Best Selection,
                                                            and Best Service to Our Customers.
                                                        </p>
						</center>
<!--CONTENT DIV END--></div>
    </div><div class='rw_content_frame'>
<!--1MARQUEE DIV START--><div class="rw_home_content_box">
    <img src="<?php echo ROOT_HT;?>/resources/images/.85301924176_n.jpg" height="50%" width="100%" />
							<h3>Bed Room</h3>
							<p>
                                                            Explore Our Our Wide Range of Collection for Luxury Living
							</p>
<!--1MARQUEE DIV END--></div>
<!--2MARQUEE DIV START--><div class="rw_home_content_box">
    <img src="<?php echo ROOT_HT;?>/resources/images/.79283461510_n.jpg" height="50%" width="100%" />
							<h3>Decors</h3>
							<p>
                                                            Feel The Real Power of Decorating with our Rich Decorating Accessories.
							</p>
<!--2MARQUEE DIV END--></div>
<!--3MARQUEE DIV START--><div class="rw_home_content_box">
    <img src="<?php echo ROOT_HT;?>/resources/images/964721.10835_n.jpg" />
                                                        <h3>Dining</h3>
							<p>
                                                            We serve best kind of Wooden Furniture For Dinning, especially Dining Tables .
							</p>
						
<!--3MARQUEE DIV END--></div>
</div></div>
    <?php
    rw_footer();



