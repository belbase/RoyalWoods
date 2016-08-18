<?php
include_once '../resources/php_lib/functions.php';
include_once '../resources/php_lib/elements.php';
require_once '../rw-config.php';
rw_meta('Checkout');
rw_header();
if(rw_session('user','pin')!='0')
{
    $pin=  rw_session('user','pin');
    if(isset($_GET['buy']))
    {
        if($_GET['buy']=='now')
            {
                $msg1="Buy Now";
                if(isset($_GET['product_id']))
                {
                    if(rw_check_product($_GET['product_id'])!='1')
                        {
                            header('location:'.ROOT_HT.'/error.php');
                        }
                    else
                        {
                                $prid=$_GET['product_id'];
                                $data=rw_getproduct($prid);
                                $cat=$data['cat'];
                                $title=$data['title'];
                                $disc=$data['disc'];
                                $price=$data['price'];                               
                                $img=$data['img'];                                
                                if(isset($_GET['order']))
                                {
                                    if($_GET['order']=="con")
                                    {                                       
                                        $prise=$price;
                                        $oid=rw_gen_oid();
                                        $dop=currdatetime();
                                        $link=rw_connect();
                                        $stat='C';
                                        $query="INSERT INTO rw_order(oid, dop, prid, title, price, stat, pin) VALUES ('".$oid."', '".$dop."', '".$prid."', '".$title."', '".$price."', '".$stat."', '".$pin."')";
                                        mysqli_query(rw_connect(), $query)or die('Not Running');
                                        mysqli_close(rw_connect());
                                        $order="done";
                                    }
                                }
                                else
                                {
                                    $order="run";
                                    
                                    
                                }
                        }
                    }
                }
        }
        else
        {
            header('location:'.ROOT_HT.'/error.php');
        }
}
else
{
    header('location:'.ROOT_HT.'/login.php');
}
           
?>
<div id="rw_main_doc">
    <div class="rw_content_frame">

            <div class="rw_frame_one" style="height:350px;">
            <div class='rw_order_log'>
        <?php
            if(isset($order))
                {
                    if($order=="run")
                    {
                        echo"<img src='".ROOT_HT."/resources/images/".$img."'/><p>"
                        . "<h3>".$title."</h3>"
                        . "<p id='rw_green_p'> Price:".$price.'</p></p><br/>';
                        echo"<a href='".ROOT_HT."/Shop/checkout.php?buy=now&order=con&product_id=".$prid."' id='rw_button_m_o' float='left';>"
                        . " Confirm </a>";
                    }
                    elseif($order=="done")
                    {                  
                        echo" Thanks For Shoping with Us</br>";
						echo"<br/>
						<table class='tg'>
						<tr>
						<th class='tg-d55q' colspan='3'> Invoice</th>
						</tr>
						<tr>
						<td class='tg-yw4l' colspan='2'>Order ID: ".$oid."</td>
						<td class='tg-yw4l'>DOP: ".$dop."</td>
						</tr>
						<tr>
						<td class='tg-yw4l'>Sr. No</td>
						<td class='tg-yw4l'>Particular</td>
						<td class='tg-yw4l'>prise</td>
						</tr>
						<tr>
						<td class='tg-yw4l' rowspan='5'>1.</td>
						<td class='tg-yw4l' rowspan='5'>".$title."<br/><i> ".$prid."<i></td>
						<td class='tg-yw4l' rowspan='5'>".$price."</td>
						</tr>
						<tr></tr>
						<tr></tr>
						<tr></tr>
						<tr></tr>
 
						<tr>
						<td class='tg-yw4l' colspan='2'> Grand</td>
						<td class='tg-yw4l'>".$price."</td>
						</tr>
						</table>
						";
                    }
                }
                    
            ?>
    </div></div></div>
    <?php
        rw_footer();