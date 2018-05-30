<?php
const DATABASE_URL = "localhost";
const DATABASE_USER = "root";
const DATABASE_PW = "";
const DATABASE_NAME = "Animeblog";

$connection = @mysqli_connect(DATABASE_URL, DATABASE_USER, DATABASE_PW, DATABASE_NAME);



if (mysqli_connect_errno() == 1049) {


  $connection = @mysqli_connect(DATABASE_URL, DATABASE_USER, DATABASE_PW);


  if (!mysqli_query($connection, "CREATE DATABASE IF NOT EXISTS ".DATABASE_NAME)) {
    echo "Adatbázis létrehozása sikertelen!";
    exit;
  }

  mysqli_select_db($connection, DATABASE_NAME);

  if (!mysqli_query($connection, <<<EOD
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `text` varchar(400) NOT NULL,
  `image` varchar(255) NOT NULL,
  `posted` date NOT NULL,
  PRIMARY KEY (`id`)
)
EOD
)) {
    echo "A post tábla létrehozása sikertelen!";
    exit;
  }
  
  if (!mysqli_query($connection, <<<EOD
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `place` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
)
EOD
)) {
    echo "A users tábla létrehozása sikertelen!";
    exit;
  }
  
  if (!mysqli_query($connection, <<<EOD
CREATE TABLE `anime` (
  `name` varchar(100) NOT NULL,
  `mainactor` varchar(40) NOT NULL,
  `year` varchar(50) NOT NULL,
  `rate` float(10) NOT NULL,
  PRIMARY KEY (`name`)
)
EOD
)) {
    echo "Az anime tábla létrehozása sikertelen!";
    exit;
  }
  
  if (!mysqli_query($connection, <<<EOD
CREATE TABLE `favorit` (
  `name` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`name`)
)
EOD
)) {
    echo "A favorit tábla létrehozása sikertelen!";
    exit;
  }
  
}

if (mysqli_connect_errno()) {
  echo "Hiba az adatbázishoz kapcsolódás során." . PHP_EOL;
  echo "Hibakód: " . mysqli_connect_errno() . PHP_EOL;
  echo "Hiba üzenet: " . mysqli_connect_error() . PHP_EOL;
  exit;
}


