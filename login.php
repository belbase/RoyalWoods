<?php 
include('resources/php_lib/elements.php');
include('resources/php_lib/functions.php');
require_once'rw-config.php';
if(rw_session('user','pin')!='0' || rw_session('admin','pin')!='0')
{   
    header("location:".ROOT_HT."/");
}
elseif(isset($_POST['login']))
{
    $currid=$_POST['user'];
    $pwd=$_POST['pwd'];
    /**/
    //Check if Username is available
    if(rw_check_var_type($currid)=='n')
    {
        $rw_login_error="Wrong Username/Email/Mobile No. enters <br/> you can <a href='#'>register</a> to Login";
    }
 else {
        if(rw_getpin($currid)!='0')
        {
            $pin=rw_getpin($currid);
           if(rw_check_pwd($pin, $pwd)!='1')
           {
               $rw_login_error="Wrong Username Password Combinatiom";
           }
            else 
            {
              
               $_SESSION['user']['pin']=$pin;
              // echo "session Start";
               // echo $_SESSION['user']['pin'];
               if(isset($_POST['kmr']))
                {
                    //Code to set the Cookie to Keep you login
                    //even after you've press the cross button of browser
                }
                    //Now redirect it to Last Page From where you press to login
                header("location:".ROOT_HT."/");
            }
        }
    }
}
?>
<?php
		rw_meta('Login- Royalwoods');
        rw_header();
         ?>
<!--IMAGE DIV START-->

<div id='rw_main_doc'><div id='rw_login_frame'>
<div id="rw_login_image">IMAGE</div>
<!--FORM DIV START--><div id="rw_login_form">
      <?php
                if(isset($rw_login_error))
                {
                    echo "<div class='rw_login_error'>".$rw_login_error."</div><br/>"; 
                }
                else
                {
                    echo"<br/></br> <br/>";
                }
                ?>
        
                <form action="" method="POST">
                    <input type="text" name="user" placeholder="Username/Email" required/> <br/>
                    <input type="password" name="pwd" placeholder="********" required/><br/>
                    <input type="checkbox" name="kmr" checked/> <label> Keep Me Remember</label><br/>
                    <input type="submit" name="login" value="Login"/><br/>
                    <span id='rw_account_reg'> Don't have Account?<br/> You can <a href='register.php'>register</a> from here </span>
                    
                </form></div></div>
<?php             rw_footer();