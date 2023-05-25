<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<title>Log In</title>
</head>
<style>
    .body{
        background-color: aqua;
        background-size: cover;
		background-image: url(bg.gif);
    }
    .container{
        margin: 100px auto;
        padding: 50px;
        padding-top: 25px;
        background-color: aqua;
        border-radius: 50px;
        background-color: transparent
    }
    .container-fluid{
        justify-content: center;
        text-align: center;
        border-radius: 35px;
		padding: 20px;
		width: 50%;
        border: 3px dotted black;
        padding-bottom: 20px;
        padding-top: 10px;
        background-color: aliceblue;
    }
    input[type=submit]:hover {
			background-color: aqua;
            
	}
    input[type=text], input[type=password] {
			border-radius: 6px;
			padding: 10px;
			width: 100%;
    }
    ul{
        margin: auto;

    }
    li{
        display: inline;
        padding-left: 5%;
    }
    .r{
        float:right;
        padding-right: 50px;
        text-decoration: none;
    }
    .bt{
        padding: 3px;
        padding-top: 5px; 
        border-radius: 50px;; 
        width:90px;  
        background-image: linear-gradient(45deg, rgb(202, 109, 109) , rgb(94, 94, 209));
        background-size: 300%;
        background-position: left;
        transition: background-position 0.5s;
    }
    button[type=button]:hover, button[type=button]:focus {
        background-position: right;
        
    }
    
</style>
<body class="body">
    <ul>
        <li><a href="#"><button class="bt my-2" type="button"><a style="text-decoration: none; color: black;" href="home.html">Home</a></button></a></li>
        <li><a href="#"><button class="bt my-2" type="button">About Us</button></a></li>
        <li><a href="#"><button class="bt my-2" type="button">Contact Us</button></a></li>
        <li class="r"><a href="login.php"><button class="bt my-2" type="button">Log In</button></a></li>
    </ul>
    
    <div class="container" >
            <h2 style="text-align: center; font-family: 'Courier New', Courier, monospace;"><b>Register</b></h2>
            <div class="container-fluid">
                <form method="POST" action="backend.php">
                    <label for="username" class="col-form-label my-1 " style="float:left;">Email</label><br>
                    <input type="text"  name="user_email" id="user_email" placeholder="Email" required><br>
                    <label for="username" class="col-form-label my-1 " style="float:left;">Full Name</label><br>
                    <input type="text"  name="user_name" id="user_name" placeholder="Full Name" required><br>
                    <label for="password"  class="col-form-label my-1" style="float:left;" >Password</label><br>
                    <input type="password"  name="user_pass" id="user_pass" placeholder="Password" required><br>
                    <input type="submit" value="Register" class="my-2  btn btn-success border border-dark rounded" style="float:right; padding-left: 20px; padding-right: 20px;" name="btn-confirm" id="btn-confirm">
                </form>
            </div>
    </div>
</body>
</html>