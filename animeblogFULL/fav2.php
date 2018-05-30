<?php
	
	require_once('connect.php');
	
	$sql = "SELECT name FROM anime";
	$result = mysqli_query($connection, $sql);
	
	if(isset($_POST['give_btn'])){
		$animename = $_POST['animename'];
		$notset = "Not set";
		
		$sql2 = "INSERT INTO favorit(name, status) VALUES ('$animename', '$notset')";
		mysqli_query($connection, $sql2);
	}
	
	$sql3 = "SELECT name, status FROM favorit";
	$result2 = mysqli_query($connection, $sql3);
	
	if(isset($_POST['finished_btn'])){
		$finished = "Befejezve";
		$anime_name = $_POST['finished_btn'];
		
		$sql4 = "UPDATE favorit SET status = '$finished' WHERE name = '$anime_name'";
		mysqli_query($connection, $sql4);
		header("location: fav2.php");
	}
	
	if(isset($_POST['plan_btn'])){
		$plan = "Tervbe véve";
		$anime_name = $_POST['plan_btn'];
		
		$sql4 = "UPDATE favorit SET status = '$plan' WHERE name = '$anime_name'";
		mysqli_query($connection, $sql4);
		header("location: fav2.php");
	}
	
	if(isset($_POST['progress_btn'])){
		$progress = "Folyamatban";
		$anime_name = $_POST['progress_btn'];
		
		$sql4 = "UPDATE favorit SET status = '$progress' WHERE name = '$anime_name'";
		mysqli_query($connection, $sql4);
		header("location: fav2.php");
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
            <li><a href="register2.php">Regisztráció</a></li>
            <li><a href="new2.php">Új poszt</a></li>
			<li><a class="active" href="fav2.php">Kedvencek</a></li>
            <li><a href="anime2.php">Animék</a></li>
            
        </ul>
    </nav>
    <div class="clearfix"></div>
    <main>
        <article class="new-form">
            <div class="new-post-title">
                <h2>Saját Anime lista</h2>
            </div>
            <table>
			<form method="post" action="fav2.php">
                <tr id="category">
                    <th>Cím</th>
                    <th>Állapot</th>
                </tr>
				<?php while($row2 = mysqli_fetch_array($result2)){ ?>
                <tr class="rowanime" name="rowanime">
					<div>
                    <th ><?php echo $row2['name']?></th>
					</div>
                    <th ><?php echo $row2['status']?></th>
                    <th>
						
						
						<button name="finished_btn"class="red-table-button" style="background-color: forestgreen;" value="<?php echo $row2['name']?>">Befejezve</button>
						<button name="plan_btn" class="red-table-button" value="<?php echo $row2['name']?>">Tervbe véve</button>
						<button name="progress_btn" class="red-table-button" style="background-color: yellow;" value="<?php echo $row2['name']?>">Folyamatban</button>
						
					</th>
					
                </tr>
				<?php } ?>
				</form>
            </table>
        </article>

        <form class="new-form" method="post" action="fav2.php">
            <div class="new-post-title">
                <h2>Anime hozzáadása a saját listához</h2>
            </div>
            <div id="new-title">
                <div id="style-select">
                <select name="animename">
					<?php while ($row = mysqli_fetch_array($result)) { ?>
						<option value="<?php echo $row[0];?>"><?php echo $row[0]; ?></option>
					<?php } ?>	
                </select>
                </div>
            </div>
            <div>
                <button id="red-button" name="give_btn" type="submit">Hozzáad</button>
            </div>
        </form>
    </main>
</div>

</body>
</html>