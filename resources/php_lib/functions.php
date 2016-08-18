<?php
   
      /*
       * Package RoyalWoods Furnitures
       * Author: Deepak Belbase (14113000447) and Sagar Kumar(14113000487)
       * 
       */
      session_start();
        function currdatetime()
        {
            $date_array = getdate();
            $currtimedate=$date_array['year']."-".$date_array['mon']."-".$date_array['mday']." ".$date_array['hours'].":".$date_array['minutes'].":".$date_array['seconds'];
            return $currtimedate;
            
        }
      
		function rw_gen_rand_pin($len) //To genrate the pin randomly
        {
             $string=  str_shuffle("1234567890111112222233333444445555566666777778888899999"); //to shuffle the pin
            $shufflechar= substr($string,0,$len);// to assign charcter of length $len
            return $shufflechar;
           
        }
        
       function rw_check_pin($db)   //check if pin assigned is exist(1) or not (0)
		{                   //And if exist a new pin will return with recursion
			$pin=rw_gen_rand_pin('10');
			$query = mysqli_query(rw_connect(),"select pin from ".$db." where pin=".$pin)or die("end");
		
			if(mysqli_num_rows($query)=='0')
			{
                            mysqli_close(rw_connect());
                            return $pin;
				
			}
			else
			{	
				 mysqli_close(rw_connect());
                                 rw_check_pin($db);
			}
		}
                function rw_pin($pin)
                {
                    $link=  rw_connect() or die("Error ".  mysqli_error($link));
                    $result=$link->query("SELECT * FROM rw_users_info WHERE pin ='".$pin."'");
                    if(mysqli_num_rows($result)=='1')
			{
                            mysqli_close(rw_connect());
                            return '1';
				
			}
                    else
			{	
				mysqli_close(rw_connect());
                                return '0';
			}
                }   
            function rw_username($u) // To Check if Username exists('1') or not('0')
                {

                         $link = rw_connect() or die("Error " . mysqli_error($link));
                         $tablename='rw_users';
                         $query = "SELECT * FROM ".$tablename." WHERE username ='".$u."'" or die("Error in the consult.." . mysqli_error($link));
                         $result = $link->query($query);
                         if(mysqli_num_rows($result)=='1')
                         {
                             mysqli_close($link);
                             return '1';
                         }
                         else 
                         {
                             mysqli_close($link);
                             return '0';    
                         }
                }
            function rw_email($e) // To Check if Username exists('1') or not('0')
                {

                         $link = rw_connect() or die("Error " . mysqli_error($link));
                         $tablename='rw_users_info';
                         $query = "SELECT * FROM ".$tablename." WHERE email ='".$e."'" or die("Error in the consult.." . mysqli_error($link));
                         $result = $link->query($query);
                         if(mysqli_num_rows($result)=='1')
                         {
                             mysqli_close($link); 
                             return '1';
                         }
                         else 
                         {
                             mysqli_close($link); 
                             return '0';    
                         }
                }
            function rw_phone($p) // To Check if Phone No exists('1') or not('0')
                {

                         $link = rw_connect() or die("Error " . mysqli_error($link));
                         $tablename='rw_users_info';
                         $query = "SELECT * FROM ".$tablename." WHERE phone ='".$p."'" or die("Error in the consult.." . mysqli_error($link));
                         $result = $link->query($query);
                         if(mysqli_num_rows($result)=='1')
                         {
                             mysqli_close($link); 
                             return '1';
                         }
                         else 
                         {
                             mysqli_close($link); 
                             return '0';    
                         }
                }
             function rw_register_new_user($username,$password,$fname,$lname,$sex,$dob,$email,$phone)//To register Password
                {
			$db="rw_users";
                        $pin= rw_check_pin($db);
                        $ref=$pin."12345";
                        $timenow=currdatetime();
                        $acctype="H";
                        $query1 = mysqli_query(rw_connect(),"INSERT INTO ".$db." (username, password, pin, ref) VALUES('".$username."','".$password."','".$pin."','".$ref."' )")or die("1 not exicuted");
			$query2 = mysqli_query(rw_connect(),"INSERT INTO ".$db."_info (pin, fname, lname, dob, sex, email, phone) VALUES('".$pin."','".$fname."','".$lname."','".$dob."', '".$sex."', '".$email."','".$phone."')")or die("2 not exicuted");
                        $query3 = mysqli_query(rw_connect(),"INSERT INTO ".$db."_meta (pin, datetime, acctype) VALUES('".$pin."','".$timenow."','".$acctype."' )")or die("3 not exicuted");
                        if(!$query1&&!$query2&&!$query3)
                            {
                                return '0';
                            }
                        else
                            {
                                mysqli_close(rw_connect());
                                return '1';
                            }
                        
                }  
                
                
                
        function rw_check_var_type($var) //To check the entered string is any of email'e', phone'p' and username'u' or not(0)
            {
                if(rw_username($var)=='1')
                {
                    $rw_login_token='u';
                }
                elseif(rw_email($var)=='1')
                {
                    $rw_login_token='e';
                }
                elseif(rw_phone($var))
                {
                    $rw_login_token='p';
                }
                else
                {
                    $rw_login_token='n';    
                }
                return $rw_login_token;
            }
            
        function rw_convert_email2pin($var) //it simply get pin from email if not it return Zero (0)
                {
                   $link = rw_connect() or die("Error " . mysqli_error($link));
                $result = $link->query("SELECT * FROM rw_users_info WHERE email ='".$var."'");
                if(rw_email($var)=='1')
                {
                while($row = mysqli_fetch_array($result))
                    {
                        return $row['pin'];
                    }
                   mysqli_close($link); 
                }
                else 
                {
                    mysqli_close($link);
                    return '0';    
                } 
                }
                function rw_convert_phone2pin($var) //it simply get pin from phone if not it return Zero (0)
                {
                   $link = rw_connect() or die("Error " . mysqli_error($link));
                $result = $link->query("SELECT * FROM rw_users_info WHERE phone ='".$var."'");
                if(rw_phone($var)=='1')
                {
                while($row = mysqli_fetch_array($result))
                    {
                        return $row['pin'];
                    }
                   mysqli_close($link); 
                }
                else 
                {
                    mysqli_close($link);
                    return '0';    
                } 
                }
                function rw_convert_username2pin($var)//it simply get pin from username if not it return Zero (0)
                {
                   $link = rw_connect() or die("Error " . mysqli_error($link));
                $result = $link->query("SELECT * FROM rw_users WHERE username ='".$var."'");
                if(rw_username($var)=='1')
                {
                while($row = mysqli_fetch_array($result))
                    {
                        return $row['pin'];
                    }
                   mysqli_close($link); 
                }
                else 
                {
                    mysqli_close($link);
                    return '0';    
                } 
                }
          // return pin from any of email, username and phone
                function rw_getpin($var)
                {
                    if(rw_convert_email2pin($var))
                    {
                      return rw_convert_email2pin($var);   
                    }
                    elseif(rw_convert_phone2pin ($var))
                    {
                        return rw_convert_phone2pin($var);
                    }
                    elseif(rw_convert_username2pin($var))
                    {
                        return rw_convert_username2pin($var);
                    }
                    else
                    {
                        return 0;
                    }
                }
                
     /*	function rw_adlogin($u,$pwd) //To check the username and password of Admin 
                {	
		$query = mysqli_query(rw_connect(),"select * from rw_admin where username = ".$u." and password =".$pwd);
		if(!$query){if(mysqli_num_rows($query)=='0')
			{
				return '0';
			}
                        else 
                        {
                            while($result=mysqli_fetch_array($query))
                            {
                                session_start();
				$_SESSION['admin']['pin'] = $result['pin'];
                                return'1';
                            }  
                        }
                        }
	}
*/  
                
                function rw_check_pwd($pin,$password) // check Username and password is matched(1) or not(0)//need to repear
                {                                    //require Testing
                $link = rw_connect() or die("Error " . mysqli_error($link));
                $result = $link->query("SELECT * FROM rw_users WHERE pin ='".$pin."'");
                while($row = mysqli_fetch_array($result))
                    {   if($row['password']==$password)
                        {   mysqli_close($link);   
                            return '1';
                        }
                        else
                        {   mysqli_close($link);
                            return '0';
                        }
                    }
                    
                 }

                 function  rw_getuserinfo($pin)
                {
                    $link = rw_connect() or die("Error " . mysqli_error($link));
                    $result1 = $link->query("SELECT * FROM rw_users_info WHERE pin ='".$pin."'");
                    if(rw_pin($pin)=='1')
                        {
                            while($row = mysqli_fetch_array($result1))
                                {
                                    return array('fname'=>$row['fname'],
                                            'lname'=>$row['lname'],
                                            'dob'=>$row['dob'],
                                            'sex'=>$row['sex'],
                                            'email'=>$row['email'],
                                            'phone'=>$row['phone']);
                                }
                            mysqli_close($link); 
                        }
                    else 
                    {
                            mysqli_close($link);
                            return array('fname'=>'0',
                                     'lname'=>'0',
                                    'dob'=>'0',
                                    'sex'=>'0',
                                    'email'=>'0',
                                    'phone'=>'0'); 
                    } 
                }
       function  rw_getuser($pin)
                {
                    $link = rw_connect() or die("Error " . mysqli_error($link));
                    $result1 = $link->query("SELECT * FROM rw_users WHERE pin ='".$pin."'");
                    if(rw_pin($pin)=='1')
                        {
                            while($row = mysqli_fetch_array($result1))
                                {
                                    return array('username'=>$row['username'],
                                            'password'=>$row['password'],
                                            'ref'=>$row['ref']);
                                }
                            mysqli_close($link); 
                        }
                    else 
                    {
                            mysqli_close($link);
                            return array('username'=>'0',
                                     'password'=>'0',
                                    'ref'=>'0'); 
                    } 
                }
        function rw_session($user,$pin)// it check the session and strat it automatically
        {
                
                if(isset($_SESSION[$user][$pin]))
                {
                    return $_SESSION[$user][$pin];
                }
                else 
                {
                    return '0';
                }
        }  
        //Product Related
            function rw_check_product($id)
    {
        $link=  rw_connect() or die("Error ".  mysqli_error($link));
        $result=$link->query("SELECT * FROM rw_product WHERE prid ='".$id."'");
            if(mysqli_num_rows($result)=='1')
            {
                mysqli_close($link);
                return '1';
            }
            else
            {	
		mysqli_close($link);
                return '0';
            }
    }
      
          function  rw_getproduct($id)
                {
                    $link = rw_connect() or die("Error " . mysqli_error($link));
                    $result1 = $link->query("SELECT * FROM rw_product WHERE prid ='".$id."'");
                    if(rw_check_product($id)=='1')
                        {
                            while($row = mysqli_fetch_array($result1))
                                {
                                    return array('title'=>$row['title'],
                                            'cat'=>$row['cat'],
                                            'disc'=>$row['disc'],
                                            'price'=>$row['price'],
                                            'img'=>$row['img'],
                                            'stat'=>$row['stat']);
                                }
                            mysqli_close($link); 
                        }
                    else 
                    {
                            mysqli_close($link);
                            return array('title'=>'0',
                                     'cat'=>'0',
                                    'disc'=>'0',
                                    'price'=>'0',
                                    'img'=>'0',
                                    'stat'=>'0'); 
                    } 
                }

       function rw_new_product_id()   //check if pin assigned is exist(1) or not (0)
		{                   //And if exist a new pin will return with recursion
			$pin=rw_gen_rand_pin('12');
			$query = mysqli_query(rw_connect(),"select * from rw_product where prid=".$pin)or die("end");
		
			if(mysqli_num_rows($query)=='0')
			{
                            mysqli_close(rw_connect());
                            return $pin;
				
			}
			else
			{	
				 mysqli_close(rw_connect());
                                 rw_new_product_id();
			}
		}
                                
            function rw_check_oid($oid)
    {
        $link=  rw_connect() or die("Error ".  mysqli_error($link));
        $result=$link->query("SELECT * FROM rw_order WHERE oid ='".$oid."'");
            if(mysqli_num_rows($result)=='1')
            {
                mysqli_close($link);
                return '1';
            }
            else
            {	
		mysqli_close($link);
                return '0';
            }
    }
              function rw_gen_oid()   //check if pin assigned is exist(1) or not (0)
		{                   //And if exist a new pin will return with recursion
			$oid="OD".rw_gen_rand_pin('10')."IN";
			$query = mysqli_query(rw_connect(),"select * from rw_order where oid='".$oid."'")or die("end");
		
			if(mysqli_num_rows($query)=='0')
			{
                            mysqli_close(rw_connect());
                            return $oid;
				
			}
			else
			{	
				 mysqli_close(rw_connect());
                                 rw_gen_oid();
			}
		}
        function  rw_getorder($oid)
                {
                    $link = rw_connect() or die("Error " . mysqli_error($link));
                    $result1 = $link->query("SELECT * FROM rw_order WHERE prid ='".$oid."'");
                    if(rw_check_oid($oid)=='1')
                        {
                            while($row = mysqli_fetch_array($result1))
                                {
                                    return array('oid'=>$row['oid'],
                                            'dop'=>$row['dop'],
                                            'pin'=>$row['pin'],
                                            'price'=>$row['price'],
                                            'prid'=>$row['prid'],
                                            'title'=>$row['title'],
                                            'stat'=>$row['stat']);
                                }
                            mysqli_close($link); 
                        }
                    else 
                    {
                            mysqli_close($link);
                            return array('oid'=>'0',
                                     'dop'=>'0',
                                    'pin'=>'0',
                                    'price'=>'0',
                                    'prid'=>'0',
                                    'title'=>'0',
                                    'stat'=>'0'); 
                    } 
                }
