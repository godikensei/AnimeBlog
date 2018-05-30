<?php
	
	require_once('connect.php');
	
	$sql = "SELECT * FROM targonca";
	$result = mysqli_query($connection, $sql);
	
	
	
	

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
			<li><a href="fav2.php">Kedvencek</a></li>
            <li><a class="active" href="anime2.php">Animék</a></li>
            
        </ul>
    </nav>
    <div class="clearfix"></div>
    <main>
       <table>
           <tr id="category">
               <th>Anime</th>
               <th>Főszereplő</th>
               <th>Megjelenés</th>
               <th>Értékelés</th>
           </tr>
		   <?php while($row = mysqli_fetch_array($result)){ ?>
           <tr class="rowanime">
               <th><?php echo $row['name']?></th>
               <th><?php echo $row['mainactor']?></th>
               <th><?php echo $row['year']?></th>
               <th><?php echo $row['rate']?></th>
           </tr>
		   <?php } ?>
           
		   
		   
       </table>
    </main>
</div>

</body>
</html>