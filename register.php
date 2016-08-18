 <?php
        /*********************************************************
         * Including The Required File   and Path                *
         *********************************************************
         * 
         */
        require 'rw-config.php';
        include('resources/php_lib/elements.php');
        include('resources/php_lib/functions.php');
        /*********************************************************
         * Fetching The File Via Posting Method                  *
         *********************************************************/
        if(rw_session('user','pin')!='0' || rw_session('admin','pin')!='0')
        {   
            header("location:".ROOT_HT."/");
        }
        if(isset($_POST['login']))
        {
            $msg="it's working";
            $fname=$_POST['fname'];
            $lname=$_POST['lname'];
            $sex=$_POST['sex'];
            $year=$_POST['year'];
            $day=$_POST['day'];
            $month=$_POST['month'];
            $dob=$year."-".$day."-".$month;
            $email=$_POST['email'];
            $remail=$_POST['remail'];
            $phone=$_POST['phone'];
            $phone_len=strlen($phone);
            $username=$_POST['username'];
            $password=$_POST['password'];
            $pass_len=strlen($password);
    /*********************************************************
     * Form Validation For Registration Form                 *
     *********************************************************/
            $rpwd=$_POST['rpwd'];
            if(empty($fname)) //check if First Name is left Blank 
                              // @var $f_er is set for Errors in Form Validatimn
                {
                    $f_er="Enter First Name";
                }
            if(empty($lname)) //check if Last Name is left Blank
                {
                    $f_er="Enter Last Name";
                }
            elseif(empty($sex)) //check if sex is left unselected
                {
                    $f_er="Select Sex";
                }
            elseif(empty($day)) //check if Day is left Unselected
                {
                    $f_er="Select Day";
                }
            elseif(empty($month) || $month=='0') //check if Month is left unselected
                {
                    $f_er="Select Month";
                }
            elseif(empty($year)) //check if Year is left unselected
                {
                    $f_er="Select Year";
                }
            elseif(!checkdate($month, $day, $year)) //check if date entered is valid
                {
                    $f_er="Invalid Date of Birth";
                }
            elseif(empty($email)) //check if Email is left Blank
                {
                    $f_er="Enter Email";
                }
            elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)) //check if Email is valid email address
                {
                    $f_er="Enter a valid email id";
                }
            elseif($remail!=$email) //check if reenteremail is not matched
                {
                    $f_er="Re-enter E-mail";
                }
            elseif(rw_email($email)!='0') //check if email is already in database
                {
                    $f_er="E-mail is already Registered with other User";
                }
            elseif($phone_len!='10') //check if Email is valid email address
                {
                    $f_er="Enter valid phone number";
                }
            elseif(rw_phone($phone)!='0') //check if Phone Number is already in Database
                {
                    $f_er="Phone Number is already used";
                }
            elseif(empty($username))
                {
                    $f_er="Don't Leave Username Empty";
                }
            elseif(rw_username($username)!='0') //Check if Email is already entered in database
                {
                    $f_er="Username is already taken </br> Chosse different Username";
                }
            elseif(empty($password))
                {
                    $f_er="Don't Leave Password Empty";
                }
            elseif($pass_len<=8 && $pass_len>=16)
                {
                    $f_er="Password Should Be within (8-16) Character";
                }
            elseif($password!=$rpwd)
                {
                    $f_er="Password not match";
                }
            /*********************************************************
             * //Ending The Form Validation                          *
             * //Now Registering The New User if Form pass through   *
             * the validation Process                                *
             *********************************************************/
                
             else{
                 
                    $q=rw_register_new_user($username, $password, $fname, $lname, $sex, $dob, $email, $phone);
                    if($q=='1')
                    {
                        $sucess="Succesffuly Registered User!";
                        
                    }
                    else
                    {
                        $f_er="Not Registered";
                    }

             }
            
        }
        rw_meta('Register New User');
        rw_header(); //calling the header that will purse header element
    ?>
        <div id='rw_main_doc'>
    <div id="rw_form">
        
    <?php 
            if(isset($f_er))
            {
               echo "<div id='reg_error'>".$f_er."</div>"; 
            }
            elseif(isset($sucess))
            {
                echo "<div id='reg_success'>".$sucess."</div>";
            }
            else
            {
                echo "<br/><br><br/><br>";
            }
        ?>
        <br/>
        <br/>
        <form action="" method="POST"> <!-- Registration Form for New User-->
        <input type="text" name="fname" placeholder="First Name" required/> &nbsp;&nbsp;
        <input type="text" name="lname" placeholder="Last Name" required/> <br/>
        <input type="radio" name="sex" value="M" checked/> Male &nbsp;&nbsp;
        <input type="radio" name="sex" value="F"/> Female<br/>
        <select name="day" required>
           <option selected>Day</option>
            <?php
            for($i="1";$i<="31";$i++)
            {
                echo "<option value=".$i.">".$i."</option>";
            }
            ?>
           
        </select> 
         <select name="month" required>
            <?php
            $month = array( "Month", "January", "Febuary", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
            for($i="0";$i<="12";$i++)
            {
                if($i == "0")
                {
                     echo"<option selected>".$month[$i]."</option>";
                }
                else 
                {
                    echo "<option value=".$i.">".$month[$i]."</option>";
                }
            }
            ?>
        </select> 
         <select name="year" required>
            <option selected>Year</option>
            <?php
            for($i="1960";$i<="2016";$i++)
            {
             
              echo "<option value=".$i.">".$i."</option>";
              
            }
           
            ?>
        </select> <br/>
        <input type="text" name="email" placeholder="Enter an Email" required/> <br/>
        <input type="text" name="remail" placeholder="Re-enter Email" required/> <br/>
        <input type="text" name="phone" placeholder="Enter Your Phone No" required/> <br/>
        <input type="text" name="username" placeholder="Chosse a Username" required/> <br/>
        <input type="password" name="password" placeholder="Enter New Password" required/> <br/>
        <input type="password" name="rpwd" placeholder="Re-enter Password" required/> <br/>
        <input type="submit" name="login" Value="Register"/> <br/>
        
    </form>
    </div>
<?php
            rw_footer();