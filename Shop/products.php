<?php
include_once '../resources/php_lib/functions.php';
include_once '../resources/php_lib/elements.php';
require_once '../rw-config.php';
if(isset($_GET['id']))
{
    $prid=$_GET['id'];
    if(rw_check_product($_GET['id'])!='1')
    {
        header('location:'.ROOT_HT.'/error.php');
    }
 
    else
    {
           if(isset($_GET['buy']))
        {
            if($_GET['buy']=='now')
                {
                    header('location:checkout.php?buy=now&product_id='.$prid.'');
            
                }
                else 
                {
                    header('location:'.ROOT_HT.'/error.php');
                }
        }
        
        $data=rw_getproduct($prid);
        $cat=$data['cat'];
        $title=$data['title'];
        $disc=$data['disc'];
        $price=$data['price'];
        $img=$data['img'];
    }
    
}

 else
 {
    header('location:'.ROOT_HT.'/error.php');
 }
 rw_meta('Product Info- RoyalWoods');
 rw_header();
?>
<div id='rw_main_doc'><div class="rw_frame_one"><div class="rw_content_frame">
            <?php
            echo "<div class='rw_image_view' style='border-bottom:1px solid black;'>";
            echo "<img src='".ROOT_HT."/resources/images/".$img."'/>";
            echo "</div>";
            
            echo "<div class='rw_featured_content'>
                <h1>".$title."</h1>
                    <hr>
                <p id='rw_green_label'> Price:".$price."</p>
                 <p> <a href='products.php?buy=now&id=".$prid."' id='rw_button_m'> Buy Now</a> </p>   
            </div>";
            ?>
        </div>
        <div class="rw_content_frame">
            <p> <?php
            if(isset($msg))
            {
                echo $msg;
            }
            echo "<div class='rw_image_view' style='text-align:left; width:49%;'><p>".$disc."</p></div>";?></p>
        </div>
</div>
<?php
rw_footer();
?>