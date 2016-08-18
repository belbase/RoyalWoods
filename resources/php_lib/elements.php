<?php
            
            function rw_meta($title)
    {
                echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
                <html xmlns='http://www.w3.org/1999/xhtml'>
                <head>
                <link rel='stylesheet' type='text/css' href='".ROOT_HT."/resources/css/style.css' />
				<link rel='stylesheet' type='text/css' href='".ROOT_HT."/resources/css/bootstrap.css' />
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                <title>".$title."</title>	
                </head>
                <body>";
            }
            function rw_search()
            {
                $formdata="<div id='rw_header_search'>
                <form action='".ROOT_HT."/search.php' method='GET'> 
                <input type='text' name='rw_search' placeholder='Search...'/>
                <input type='submit' name='search' Value='Search' class='rw_md_button'/> 
                </form>
                </div>";
                echo $formdata;
                
            }
                    function rw_user_log()
                    {
                        if(rw_session('user','pin')=='0'&&rw_session('admin','pin')=='0')
                        {
                            echo "<div id='rw_head_log'> <!--Logged In log-->
                            <label for='rw_checkbox'>Sign In</label>
                            <input id='rw_checkbox' type='checkbox'/>
                            <div class='down'>
                            <form action='".ROOT_HT."/login.php' method='POST'>
                            <input type='text' name='user' placeholder='Username' required/><br/>
                            <input type='password' name='pwd' placeholder='Password' required/><br/>
                            <input type='submit' name='login' value='login'/>
                            </form>
                            Not Have Account!<br/>
                            <a href='".ROOT_HT."/register.php'>Register Now!</a>
                            </div>
                            </div>";
                        }
                        else
                        {
                        if(rw_session('user','pin')!='0')
                        {
                         $ID=rw_session('user','pin');
                         
                        }
                        elseif(rw_session('admin','pin')!='0')
                        {
                           $ID=rw_session('admin','pin'); 
                        }
                        $data=  rw_getuser($ID);
                        $info=  rw_getuserinfo($ID);
                        $uname=$data['username'];
                        $img=$ID.'_n.jpg';
                       echo "<div id='rw_head_log'> <!--Logged In log-->
                    <label for='rw_checkbox'>
                        <img id='head_img' src='".ROOT_HT."/resources/images/".$img."'/>&nbsp;&nbsp;
                            ".$uname."</label>
                    <input id='rw_checkbox' type='checkbox'/>
                    <div class='down'>
                    <ul id='header_link'>
                    <li><a href='".ROOT_HT."/logout.php'>Logout </a></li>
                    </ul>    
                    </div>
                    </div>"; 
                }
            }
             function rw_pr_menu()
            {    
               echo "<div id='rw_menu'><ul class='rw_primary'>
               <li><a href='".ROOT_HT."/'>HOME</a></li>
                <li><a href='".SHOP_HT."'>SHOP</a>
                    <ul class='drop'>
                    <li><a href='".SHOP_HT."/?cat=LivingRoom'>LIVING ROOM</a></li>
                    <li><a href='".SHOP_HT."/?cat=Dining'>DINING</a></li>
                    <li><a href='".SHOP_HT."/?cat=BedRoom'>BEDROOM</a></li>
                    <li><a href='".SHOP_HT."/?cat=Study'>STUDY</a></li>
                    <li><a href='".SHOP_HT."/?cat=Outdoor'>OUTDOOR</a></li>
                    <li><a href='".SHOP_HT."/?cat=Decors'>DECORS</a></li>
                    </ul>
                </li>
		<li><a href='".ROOT_HT."/About'>ABOUT</a></li>
		<li><a href='".ROOT_HT."/ContactUs'>CONTACT US</a></li>
                </ul></div></div>";
            }

           function rw_header()
            {
                echo "<div id='rw_header'><div id='rw_logo_zone'>";// @div=rw_main_doc starts in rw_header() and ends in rw_footer
                rw_search();
                echo "<div id='rw_header_logo'><a href='".ROOT_HT."/'><img src='".ROOT_HT."/resources/images/logo.png'/></a></div>";
                rw_user_log();
                echo "</div>";
                rw_pr_menu();
            }
              function  rw_footer()
            {
                //$material="FOOTER";
                echo "<div id='rw_footer'>
  
                        <ul id='rw_social_list'>
                            <li><a href='http://facebook.com/MakeADifferentStyle'><img src='".ROOT_HT."/resources/images/1458520725_facebook.png' class='rw_footer_icon'> </a></li>
                            <li><a href='http://twitter.com/MakeADifferentStyle'><img src='".ROOT_HT."/resources/images/1458520739_twitter.png' class='rw_footer_icon'> </a></li>
                            <li><a href='http://in.linkedin.com/MakeADifferentStyle'><img src='".ROOT_HT."/resources/images/1458520754_linkedin.png' class='rw_footer_icon'> </a></li>
                        </ul>
                        <ul id='rw_footer_link'>
                            <li><a href='".ROOT_HT."/'>Home</a></li>
                            <li><a href='".ROOT_HT."/About'>About</a></li>
                            <li><a href='".SHOP_HT."'>Shop</a></li>
                            <li><a href='".ROOT_HT."/ContactUs'>Contact Us</a></li>
                        </ul>
                        <div id='rw_lower_footer' style='position:relative; height: 20%; width:100%;border-top:1px solid #000000;float: left;'>
       
                        <p>&copy; 2016 MADS Inc. <a href='#' style='float: right;'>By Make A Different Style</a></p>
                            </div>
                            </div>
                            </div>
                            </body>
                            </html>";
                 //ends the @div id= rw_main_doc division
            }

            /*****************************************************************
             *  Regarding Content Filter for Shop Catagory
             * 
             *****************************************************************/
             function rw_content_filter($cat)
                            {
                                $link = rw_connect() or die("Error " . mysqli_error($link));
                                $result = $link->query("SELECT * FROM rw_product WHERE cat ='".$cat."' AND stat='P'");
                                    echo "<div id='rw_main_doc'><div class='rw_content_frame'>";
                                    if(mysqli_num_rows($result)!='0')
                                    {   
                                        while($row = mysqli_fetch_array($result))
                                        {   
                                            $prid=$row['prid'];
                                            $pr_catagory=$row['cat'];
                                            $pr_title=$row['title'];
                                            $pr_price=$row['price'];
                                            $pr_img=$row['img'];
                                            echo "<div class='rw_product_div'><h4><center>".$pr_title."</center></h4><br/>";
                                            echo "<a href=".SHOP_HT."/products.php?id=".$prid."><img src='".ROOT_HT."/resources/images/".$pr_img."'/></a><br/>";
                                            echo "<span class='rw_product_price'> Rs.".$pr_price."</span>"
                                                    . "<br/> </br><a href='".SHOP_HT."/products.php?id=".$prid."' id='rw_button_m'> Read More</a>"
                                                    . "<a href='".SHOP_HT."/checkout.php?buy=now&product_id=".$prid."' id='rw_button_m_o'>Buy Now</a></div>";    
                                        }
                                    mysqli_close($link);
                                    }
                                    else 
                                    {
                                         echo 'result not found';
                                     }
                                     echo"</ul></div>";

                            }
                            function rw_all_content()
                            {
                                $link = rw_connect() or die("Error " . mysqli_error($link));
                                $result = $link->query("SELECT * FROM rw_product WHERE stat='P'");
                                    echo "<div id='rw_main_doc'><div class='rw_content_frame'>";
                                    if(mysqli_num_rows($result)!='0')
                                    {   
                                        while($row = mysqli_fetch_array($result))
                                        {   
                                            $prid=$row['prid'];
                                            $pr_catagory=$row['cat'];
                                            $pr_title=$row['title'];
                                            $pr_price=$row['price'];
                                            $pr_img=$row['img'];
                                            echo "<div class='rw_product_div'><h4><center>".$pr_title."</center></h4><br/>";
                                            echo "<a href=".SHOP_HT."/products.php?id=".$prid."><img src='".ROOT_HT."/resources/images/".$pr_img."'/></a><br/>";
                                            echo "<span class='rw_product_price'> Rs.".$pr_price."</span>"
                                                    . "<br/> </br><a href='".SHOP_HT."/products.php?id=".$prid."' id='rw_button_m'> Read More</a>"
                                                    . "<a href='".SHOP_HT."/checkout.php?buy=now&product_id=".$prid."' id='rw_button_m_o'>Buy Now</a></div>";
                                        }
                                    mysqli_close($link);
                                    }
                                    else 
                                    {
                                         echo 'result not found';
                                     }
                                     echo"</ul></div>";

                            }
             /*****************************************************************
             *  Regarding page content of page folder
             * 
             *****************************************************************/
                 function rw_admin_header()
{   
    //if(rw_session('admin','pin')=='1')
    //{
        echo"<div id='rw_editor_header'>"
                . "<img src='".ROOT_HT."/resources/images/logo2.png' style='height:100%'/>"
                . "<label for='rw_admin_drop'>"
                . " <img id='head_img' src='".ROOT_HT."/resources/images/1870847334_n.jpg'/>"
                . " </label>"
                . "<input type='checkbox' id='rw_admin_drop'/>"
                . "<br/><div id='rw_admin_drop_menu'>"
                . "<ul>"
                . "<li><a href='".ROOT_HT."/Admin/editor.php'>Editor</a></li>"
                . "<li><a href='".ROOT_HT."/Admin/editor.php'>Editor</a></li>"
                . "<li><a href='".ROOT_HT."/logout.php'> Logout</a></li>"
                . "</ul>"
                . "</div></div>";

    //}
 /*else
    {
        header("location:".ROOT_HT."/Admin/login.php");  
    } */
}  