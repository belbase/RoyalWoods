<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once('/resources/php_lib/elements.php');
include_once('/resources/php_lib/functions.php');
require('rw-config.php');

    rw_meta('RoyalWoods - The online Furniture Store');
    rw_header();
    ?>

<div id='rw_main_doc'>
    <div class='rw_frame_one'> <div class='rw_content_frame'>
            
<?php
if(isset($_GET['search']))
    
{
    if(isset($_GET['rw_search']))
	{
	$term = $_GET['rw_search'];  
    $link = rw_connect() or die("Error " . mysqli_error($link));
    $result = $link->query("SELECT * FROM rw_product WHERE cat LIKE '%".$term."%' OR title LIKE '%".$term."%' OR disc LIKE '%".$term."%' AND stat='P'");
    if(mysqli_num_rows($result)!='0')
    {   
		echo "<div id='rw_search_title'>Search Term is <label class='orange'>".$term."</label></div>";
    while($row = mysqli_fetch_array($result))
    {   
        $prid=$row['prid'];
        $pr_catagory=$row['cat'];
        $pr_title=$row['title'];
        $pr_price=$row['price'];
        $pr_img=$row['img'];
        echo "<div class='rw_search_div'> <div class='rw_search_img'><a href=".ROOT_HT."/Shop/products.php?id=".$prid."><img src='".ROOT_HT."/resources/images/".$pr_img."'/></a></div><br/>";
        echo "<div class='rw_seach_text'><span class='rw_seach_block_title'>".$pr_title."</span><br/>";
        echo "<span class='rw_search_block_price'>Rs. ".$pr_price."</span><br/><br/>
		<a id='rw_button_m' href=".ROOT_HT."/Shop/products.php?id=".$prid."> Read More</a> <a href='".ROOT_HT."/Shop/checkout.php?buy=now&product_id=".$prid."' id='rw_button_m_o'>Buy Now</a>
		</div></div>";    
    }
    mysqli_close($link);
    }
    else 
    {
        $term = $_GET['rw_search'];  
		echo "<div id='rw_search_title'>Search Not Found For <label class='orange'>".$term."</label></div>";
		echo "<div class='rw_search_div_e'> <img src='".ROOT_HT."/resources/images/magnifying-glass-512.png'> 
		<p> Oops! Product You're Looking For is Not Found!</p>
		</div>";
    }
    }
}
 else {
echo 'not working';    
}?>
        </div></div>
<?php
rw_footer();
?>