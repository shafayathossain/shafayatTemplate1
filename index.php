<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
?>
<html>
    <head>
    	<meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/slick.css">
        <link rel="stylesheet" type="text/css" href="css/slick-theme.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/slick.min.js"></script>
    </head>
    <body data-spy="affix" data-target=".navbar" data-offset="50">
        <?php
            
            $servername="localhost";
            $username="root";
            $password="";
            $dbname="shafayat";
            $conn=new mysqli($servername, $username, $password, $dbname);
            if($conn->connect_error)
            {
                die("Connection Failed" .$conn->connect_error);
            }
            /*else{
                echo "success";
            }*/
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $email=$_POST["email"];
                if($_POST["signup"] == "Sign Up")
                {
                    $fName=$_POST["firstname"];
                    $lName=$_POST["lastname"];
                    
                    $pass=$_POST["password"];
                    $sql="INSERT INTO info(fName,lName,email,password) VALUES ('$fName','$lName','$email','$pass')";
                    if(mysqli_query($conn, $sql))
                    {
                        echo "success";
                    }
                    else 
                    {
                        if(mysqli_errno($conn)==1062)
                        {
                            echo "Email already taken";
                        }
                        else
                        {
                            echo "Something wrong. Try again";
                        }
                    }
                }
                else if($_POST["signup"]=="Sign In")
                {
                    $pass=$_POST["password"];
                    $sql1="SELECT * from info where email='$email' and password='$pass'";
                    $result= mysqli_query($conn, $sql1);
                    if($row= mysqli_fetch_assoc($result))
                    {
                        $_SESSION['email']=$email;
                        $_SESSION['Name']=$row["lName"];
                    }
                    else
                        echo "unsuccessfull";
                }
            }
            else if(isset($_GET['logout']))
            {
                session_destroy();
                header("refresh:0; url=index.php");
            }
                
        ?>
    	<section id="home">
        	<nav class="navbar navbar-custom" data-spy="affix" data-offset-top="205">
                <div class="container">
                   <div class="navbar-header">
                       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
                           <span class="sr-only">Toggle navigation</span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                       </button>
                       <a class="navbar-brand" href="#"><img class="img-responsive" src="images/logo.PNG"></a>
                   </div>
                   <div class="collapse navbar-collapse" id="collapse">
                        <form class="navbar-form navbar-right" id="navbar-search" method="post">
                            <input type="search" placeholder="Search...">
                            <button class="btn button1" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                       </form>
                       <ul class="nav navbar-nav navbar-right">
                           <li><a href="#home">Home<span class="sr-only">(current)</span></a></li>
                           <li><a href="#about-us">About Us</a></li>
                           <li><a href="#our-trainers">Our Trainers</a></li>
                           <li><a href="#our-courses">Courses</a></li>
                           <li><a href="#findus">Find Us</a></li>
                           <?php
                                if(!isset($_SESSION['Name']))
                                {
                                    echo "<li><a id=\"signupbut\">SIGNUP</a></li>";
                                    echo "<li><a id=\"signinbut\">SIGN IN</a></li>";
                                        
                                }
                                else
                                {
                                    echo "<li><a>Welcome ".$_SESSION['Name']."</a></li>";
                                    echo "<li><a href=\"index.php?logout=true\">Logout</a></li>";
                                }
                            ?>
                       </ul>
                   </div>
               </div>
            </nav>
            <div id="banner">
            	<div class="container">
                	<div class="col-sm-12">
                        <h2>One of The Best eLearning Sites</h2>
                        <h4>with enriched bangla tutorials and Courses</h4>
                        <button id="signupbut" class="signup1">Let's Start</button>
                    </div>
                </div>
            </div>
        </section>
        <section id="about-us">
        	<div id="features">
                <div class="container">
                    <div class="col-sm-4 text-center part_1">
                        <h3>Starts From Basic</h3>
                        <p>Our trainers strats form very basic of courses to make them prepared perfectly.</p>
                    </div>
                    <div class="col-sm-4 text-center part_2">
                        <h3>Provide Video of The Class</h3>
                        <p>After every class, we provide video of the class in case of further need.</p>
                    </div>
                    <div class="col-sm-4 text-center part_3">
                        <h3>Bangla Tutorials</h3>
                        <p>Here our trainers write tutorials on various topics that you are searching for.</p>
                    </div>
                    <div class="col-sm-12 text-center">
                        <h2>We Provide Best Courses of All Time</h2>
                        <p>After course end, you will feel your skill what our trainer's provide tou you.</p>
                        <button id="signup2">Signup and Start A Course Now</button>
                    </div>
                </div>
            </div>
            <div id="about-info">
            	<div class="container-fluid">
                	<div class="col-sm-6 text-center">
                    	<h2>We Give You Awesomeness</h2>
                        <p>One of the best trainers you will  ever found</p>
                        <div class="col-sm-6">
                        	<p><span>3</span><br>Trainers</p>
                        </div>
                        <div class="col-sm-6">
                            <p><span>5</span><br>Courses</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="our-trainers">
            <div class="container">
            	<div class="col-sm-12">
                    <h2>OUR TRAINERS</h2>
                    <div class="margin">
                        <div class="margin secondone" style="margin-left: 0px;">
                            <img class="img-circle img-responsive one" src="images/trainers/1.jpg">
                            <img class="img-circle img-responsive two" src="images/trainers/1.jpg">
                            <img class="img-circle img-responsive three" src="images/trainers/1.jpg">
                            <img class="img-circle img-responsive repeatone" src="images/trainers/1.jpg">
                            <img class="img-circle img-responsive repeattwo" src="images/trainers/1.jpg">
                            <img class="img-circle img-responsive repeattwo" src="images/trainers/1.jpg">
                        </div>
                    </div>
                    <div class="abouttrainers text-center">
                        <div class="texts secondone">
                            <div class="first">
                                <h3>Trainer's name</h3>
                                <p>Some</p>
                                <p>Description</p>
                                <div class="links">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="second">
                                <h3>Trainer's name</h3>
                                <p>Some</p>
                                <p>Description</p>
                                <div class="links">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="third">
                                <h3>Trainer's name</h3>
                                <p>Some</p>
                                <p>Description</p>
                                <div class="links">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="first">
                                <h3>Trainer's name</h3>
                                <p>Some</p>
                                <p>Description</p>
                                <div class="links">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="our-courses">
            <div class="container text-center">
                <div class="col-sm-12">
                    <h2>Our Courses</h2>
                </div>
                <div class="col-sm-4">
                    <div class="java">
                        <img class="img-responsive" src="images/courses/54-business-and-marketing-concepts_AGREEMENT.jpg">
                        <a href="#"><h4>OOP with Java</h4></a>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
                            Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="java">
                        <img class="img-responsive" src="images/courses/54-business-and-marketing-concepts_BUSINESS-MODEL.jpg">
                        <a href="#"><h4>Android</h4></a>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
                            Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="java">
                        <img class="img-responsive" src="images/courses/54-business-and-marketing-concepts_DEVELOP.jpg">
                        <a href="#"><h4>Database Management</h4></a>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
                            Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="findus">
            <div class="container text-center">
                <h2>Find Us</h2>
                <div class="col-sm-6">
                    <b>MyCT</b>
                    <p>Lorem ipsum dolor sit amet, <br>consectetuer adipiscing elit. <br>Aenean commodo ligula eget dolor.</p>
                </div>
                <div class="col-sm-6">
                    <b>Newsletter</b>
                    <form method="POST">
                        <input type="email" name="email" placeholder="EMAIL"><br>
                        <input type="submit" value="SEND">
                    </form>
                </div>
            </div>
        </section>
        <section id="signup">
            <div class="formbox">
                <img id="close1" src="images/signup/close-searc.png">
                <img id="close2" src="images/signup/cross-close-or-delete-circular-interface-button-symbol_318-70281.png">
                <form method="post" id="signupform">
                    <h3>Sign Up</h3>
                    <input type="text" name="firstname" autofocus placeholder="First Name" required>
                    <input type="text" name="lastname" autofocus placeholder="Last Name" required>
                    <input type="email" name="email" autofocus placeholder="Email" required>
                    <input type="password" name="password" autofocus placeholder="Password" required>
                    <input type="submit" name="signup" value="Sign Up">
                </form>
            </div>
        </section>
        <section id="signin">
            <div class="formbox">
                <img id="close3" src="images/signup/close-searc.png">
                <img id="close4" src="images/signup/cross-close-or-delete-circular-interface-button-symbol_318-70281.png">
                <form method="post" id="signinform">
                    <h3>Sign In</h3>
                    <input type="email" name="email" autofocus placeholder="Email" required>
                    <input type="password" name="password" autofocus placeholder="Password" required>
                    <input type="submit" name="signup" value="Sign In">
                </form>
            </div>
        </section>
        <script>
            $(document).ready(function(){
                $chield=1;
                var margin=$("#our-trainers .secondone").css("margin-left");
                margin=parseFloat(margin);
                
                setInterval(function(){
                    var m={'margin-left':margin};
                    
                    $("#our-trainers .secondone").animate(m,1000);
                    if(margin<=-705)
                    {
                        var m={'margin-left':0};
                        $("#our-trainers .secondone").animate(m,0);
                    }
                    margin=margin-235;
                    if(margin<-705)
                        margin = -235;
                },3000);
            });
            $("#signupbut").click(function(){
                $("#signup").css("display","block");
            });
            $("#close1").mouseover(function(){
                $(this).css("display","none");
                $("#close2").css("display","block");
            });
            $("#close2").mouseout(function(){
                $(this).css("display","none");
                $("#close1").css("display","block");
            });
            $("#close2").click(function(){
                $("#signup").fadeOut();
            });
            $("#signinbut").click(function(){
                $("#signin").css("display","block");
            });
            $("#close3").mouseover(function(){
                $(this).css("display","none");
                $("#close4").css("display","block");
            });
            $("#close4").mouseout(function(){
                $(this).css("display","none");
                $("#close3").css("display","block");
            });
            $("#close4").click(function(){
                $("#signin").fadeOut();
            });
        </script>
    </body>
</html>
