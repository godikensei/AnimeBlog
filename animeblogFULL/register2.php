<?php
    session_start();

    require_once('connect.php');
	
	//$username = $_POST['nickname'];
    //$password = $_POST['pw'];
    //$password2 = $_POST['pw2'];
    //$first = $_POST['firstname'];
    //$last = $_POST['lastname'];
    //$place = $_POST['place'];
	
	if(isset($_POST['register_btn'])){
	
		
		if(empty($_POST['nickname'])){
				$error_message = "Minden mezőt ki kell tölteni!";
				
		}else {
			$check_username = mysqli_query($connection, "SELECT * FROM users WHERE nickname = '".$_POST['nickname']."'");
				if(mysqli_num_rows($check_username) > 0)
				{
					$error_message = "A felhasználónév már létezik!";
				}
		}
		
		if(empty($_POST['firstname'])){
				$error_message = "Minden mezőt ki kell tölteni!";
				
		}
		if(empty($_POST['lastname'])){
				$error_message = "Minden mezőt ki kell tölteni!";
				
		}
		
		
		if($_POST['pw'] != $_POST['pw2']){
			$error_message = "A jelszavaknak egyezniük kell!";
		}
		
		
		
		if(!isset($error_message)){
				
				$_POST['pw'] = md5($_POST['pw']); //kódolás
				$sql = "INSERT INTO users(nickname, password, firstname, lastname, place) VALUES('".$_POST['nickname']."', '".$_POST['pw']."', '".$_POST['firstname']."', '".$_POST['lastname']."', '".$_POST['place']."')";
				mysqli_query($connection, $sql);
				$success_message = "Sikeresen regisztráltál!";
				$_SESSION['nickname'] = $nickname;
				header("location: index.php");
			
		}
		
		
		
		
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AnimeBlog</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<header>
    <div>AnimeBlog</div>
</header>
<div>
    <nav>
        <ul>
            <li><a href="index.php">Főoldal</a></li>
            <li><a class="active" href="register2.php">Regisztráció</a></li>
            <?php if(isset($_SESSION['nickname'])) { ?>
					<li><a href="new2.php">Új poszt</a></li>
					<li><a href="fav2.php">Kedvencek</a></li>
					<li><a href="anime2.php">Animék</a></li>
				<?php } ?>
            
            
        </ul>
    </nav>
    <div class="clearfix"></div>
	
	<!--<?php //if ($errorMessage) { ?>
      <div class="error-message" style="color:white;">
        <?php echo $errorMessage ?>
      </div>
    <?php// } ?>-->
	
	<?php if(!empty($success_message)) { ?>	
	<div class="success-message" style="color:white;"><?php if(isset($success_message)) echo $success_message; ?></div>
	<?php } ?>
	<?php if(!empty($error_message)) { ?>	
	<div class="error-message" style="width: 50%; margin: 20px auto; background: brown; height: 30px; text-align: center; font-size: 20px; padding-top: 10px;"><?php if(isset($error_message)) echo $error_message; ?></div>
	<?php } ?>
	
	<?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg' style='width: 50%; margin: 20px auto; background: brown; height: 30px; text-align: center; font-size: 20px; padding-top: 10px;'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
	?>
    <main>
        <div class="new-form">
        <form method="post" action="register2.php">
            <div class="registerstyle">
            <label>Felhasználónév:</label><br>
            <input type="text" name="nickname"><br>
            </div>
            <div class="registerstyle">
            <label>Jelszó:</label><br>
            <input type="password" name="pw"><br>
            </div>
            <div class="registerstyle">
            <label>Jelszó megismétlése:</label><br>
            <input type="password" name="pw2"><br>
                </div>
            <div class="registerstyle">
            <label>Vezetéknév:</label><br>
            <input type="text" name="firstname"><br>
            </div>
            <div class="registerstyle">
            <label>Keresztnév:</label><br>
            <input type="text" name="lastname"><br>
            </div>
            <div class="registerstyle">
            <label>Születési hely:</label><br>
            <input type="text" name="place"><br>
            </div>
            <div class="registerstyle">
            <button class="red-table-button" type="submit" name="register_btn" >Regisztrálok</button>
            </div>
        </form>
        </div>
    </main>
</div>

</body>
</html>