<?php
	
	require_once('connect.php');
	
	if(isset($_POST['upload_btn'])) {
		$images = "images/";
		$img = $images . basename($_FILES['filename']['name']);
		
		$image = $_FILES['filename']['name'];
		$title = $_POST['post_title'];
		$text = $_POST['post_content'];
		
		$now = date("Y-m-d", time());
		
		$sql = "INSERT INTO post(title, text, image, posted) VALUES ('$title', '$text', '$image', '$now')";
		mysqli_query($connection, $sql);
		header("location: index.php");
		
		if(move_uploaded_file($_FILES['filename']['tmp_name'], $img)){
			$msg = "Image uploaded successfully!";
		}else{
			$msg = "Problem!";
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
            <li><a href="register2.php">Regisztráció</a></li>
            <li><a class="active" href="new2.php">Új poszt</a></li>
			<li><a href="fav2.php">Kedvencek</a></li>
            <li><a href="anime2.php">Animék</a></li>
            
        </ul>
    </nav>
    <div class="clearfix"></div>
    <main>
        <form class="new-form" method="post" action="new2.php" enctype="multipart/form-data">
            <div class="new-post-title">
                <h2>Új poszt hozzáadása</h2>
            </div>
            <div id="new-title">
                <h2>Cím:</h2>
                <input type="text" name="post_title" id="title-input" placeholder="Poszt címe...">
            </div>
            <div id="new-content">
                <h2>Tartalom:</h2>
                <textarea name="post_content" id="content-input"
                          cols="80" rows="10" placeholder="Ide írd a tartalmat..."></textarea>
            </div>
            <div id="new-photo">
                <h2>Kép hozzáadása:</h2>
                <input type="file" name="filename" accept="image/gif, image/jpeg, image/png">
            </div>
            <div id="post-content">
                <button class="red-table-button" name="upload_btn"type="submit">Közzététel</button>
            </div>
        </form>
    </main>
</div>

</body>
</html>