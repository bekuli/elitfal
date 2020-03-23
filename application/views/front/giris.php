<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="main">

    <div class="container">
        <center>
            <div class="row">
            	<div class="col-md-12">
            		<div class="logo">ELİT FAL
	                </div>
	                <div class="error"><?php if (isset($error)){echo $error;}?></div>
	                <div id="login">

	                    <form action="" method="post">

	                        <fieldset class="clearfix">

	                            <p><span class="fa fa-envelope"></span>
	                                <input type="email" name="email" required="" Placeholder="E-posta" required>
	                            </p>
	                            <p><span class="fa fa-lock"></span>
	                                <input type="password" name="password" required="" Placeholder="Şifre" required>
	                            </p>
	                            <div>
	                                <span style="width:48%; text-align:left;  display: inline-block;"><a class="small-text" href="#">Şifremi Unutum</a></span>
	                                <span style="width:50%; text-align:right;  display: inline-block;"><input type="submit" value="Giriş Yap"></span>
	                            </div>

	                        </fieldset>

	                    </form>


	                </div>
                </div>
            </div>
        </center>
    </div>

</div>


<style>

.error{
	color:#fff;
	font-size:20px;
	padding-bottom:20px;
}


div.main{
     /* IE6-9 fallback on horizontal gradient */
height:calc(100vh);
width:100%;
}

[class*="fontawesome-"]:before {
  font-family: 'FontAwesome', sans-serif;
}

/* ---------- GENERAL ---------- */

* {
  box-sizing: border-box;
    margin:0px auto;

  &:before,
  &:after {
    box-sizing: border-box;
  }

}

body {
   background: #b50000; /* Old browsers */
background: -moz-radial-gradient(center, ellipse cover,  #b50000 1%, #880000 100%); /* FF3.6+ */
background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(1%,#b50000), color-stop(100%,#880000)); /* Chrome,Safari4+ */
background: -webkit-radial-gradient(center, ellipse cover,  #b50000 1%,#880000 100%); /* Chrome10+,Safari5.1+ */
background: -o-radial-gradient(center, ellipse cover,  #b50000 1%,#880000 100%); /* Opera 12+ */
background: -ms-radial-gradient(center, ellipse cover,  #b50000 1%,#880000 100%); /* IE10+ */
background: radial-gradient(ellipse at center,  #b50000 1%,#880000 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b50000', endColorstr='#880000',GradientType=1 );
    color: #606468;
  font: 87.5%/1.5em 'Open Sans', sans-serif;
  margin: 0;
}

a {
	color: #eee;
	text-decoration: none;
}

a:hover {
	text-decoration: underline;
	color:#fff;
}

input {
	border: none;
	font-family: 'Open Sans', Arial, sans-serif;
	font-size: 14px;
	line-height: 1.5em;
	padding: 0;
	-webkit-appearance: none;
	outline: 0;
}

p {
	line-height: 1.5em;
}


.container {
  position: relative;
  top: 20%;
}

/* ---------- LOGIN ---------- */

#login form{
	width: 250px;
}

#login{
  padding: 0px 22px;
}
.logo{
color:#fff;
font-size:50px;
  line-height: 125px;
}

#login form span.fa {
	background-color: #fff;
	border-radius: 3px 0px 0px 3px;
	color: #000;
	display: block;
	float: left;
	height: 50px;
    font-size:24px;
	line-height: 50px;
	text-align: center;
	width: 50px;
}

#login form input {
	height: 50px;
}
fieldset{
    padding:0;
    border:0;
    margin: 0;

}
#login form input[type="text"], input[type="password"], input[type="email"] {
	background-color: #fff;
	border-radius: 0px 3px 3px 0px;
	color: #000;
	margin-bottom: 1em;
	padding: 0 16px;
	width: 200px;
}

#login form input[type="submit"] {
  border-radius: 3px;
  -moz-border-radius: 3px;
  -webkit-border-radius: 3px;
  background-color: #000000;
  color: #eee;
  font-weight: bold;
  /* margin-bottom: 2em; */
  text-transform: uppercase;
  padding: 5px 10px;
  height: 30px;
}

#login form input[type="submit"]:hover {
	background-color: #fff;
	color:#000;
}

#login > p {
	text-align: center;
}

#login > p span {
	padding-left: 5px;
}
.middle {
  display: flex;
}
</style>