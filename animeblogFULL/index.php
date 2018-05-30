<?php
    session_start();

    require_once('connect.php');

    if(isset($_POST['login_btn'])){
        $username = $_POST['loginname'];
        $password = $_POST['loginpw'];       

		$password = md5($password);
		$sql = "SELECT * FROM users WHERE nickname = '$username' AND password = '$password'";
		$result = mysqli_query($connection, $sql);
		
		if (mysqli_num_rows($result) == 1){
			$_SESSION['message'] = "Bejelentkezve!";
			$_SESSION['nickname'] = $username;
			header("location: index.php");
		}else{
			$_SESSION['message'] = "Rossz felhasználónév/jelszó kombináció";
		}
    }
	
	$result = mysqli_query($connection, "SELECT * FROM post");



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
                <li><a class="active" href="index.php">Főoldal</a></li>
                <li><a href="register2.php">Regisztráció</a></li>
				<?php if(isset($_SESSION['nickname'])) { ?>
					<li><a href="new2.php">Új poszt</a></li>
					<li><a href="fav2.php">Kedvencek</a></li>
					<li><a href="anime2.php">Animék</a></li>
				<?php } ?>
				
				
                
                
            </ul>
        </nav>
    <div class="clearfix"></div>
	<?php
	if(isset($_SESSION['nickname']))
	{
		echo "<div style='width: 50%; margin: 20px auto; background: green; height: 30px; text-align: center; font-size: 20px; padding-top: 10px;'>",'Üdvözöllek '.$_SESSION['nickname']."</div>";
	}
	?>
	<?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg' style='width: 50%; margin: 20px auto; background: brown; height: 30px; text-align: center; font-size: 20px; padding-top: 10px;'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
	?>
	
	<?php
	if(!isset($_SESSION['nickname']))
	{
		
     echo "
		<aside>
        <form method='post' action='index.php'>
            <label>Felhasználónév:  <input type='text' name='loginname'></label>
            <label>Jelszó:  <input type='password' name='loginpw'></label>
            <input class='red-table-button' name='login_btn' type='submit' value='Bejelentkezés'>
        </form>
		</aside>";
	}
	
	if(isset($_SESSION['nickname']))
	{
		echo "<aside style='background-color: transparent;'><a href='logout.php' style='color: black; text-decoration: none;' class='red-table-button' style='margin: 50px;'>Kijelentkezés</a></aside>";
	}
	?>
	
    <main>
		<?php

            while ($row = mysqli_fetch_array($result)) {

                ?>
        <article>
            <div class="post-title">
            <h2> <?php echo $row['title']; ?></h2>
            </div>
            <div class="post-content">
                <?php echo $row['text']; ?>
            </div>
            <div class="post-photo">
                <img src="images/<?php echo $row['image'] ?>"
                     height="200">
            </div>
            <div class="post-date">
				<?php echo $row['posted']; ?>
			</div>
        </article>
		<?php

            }

            ?>
    </main>
    </div>
<footer>
    <div>Készítette: Godó Norbert</div>

</footer>

</body>
</html>