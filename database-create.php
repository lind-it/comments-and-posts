<?php

$dbCreate = "CREATE DATABASE Posts;";

$postTableCreate = "CREATE TABLE `Posts`.`post` 
(`id` INT NOT NULL AUTO_INCREMENT, 
`userId` INT NOT NULL, 
`title` VARCHAR(255) NOT NULL, 
`body` TEXT NOT NULL, 
PRIMARY KEY (`id`));";

$commentTableCreate = "CREATE TABLE `Posts`.`comment` 
(`id` INT NOT NULL AUTO_INCREMENT , 
 `name` VARCHAR(255) NOT NULL , 
 `email` VARCHAR(255) NOT NULL , 
 `body` TEXT NOT NULL , 
 `postId` INT NOT NULL , 
 PRIMARY KEY (`id`),
 FOREIGN KEY (`postId`) REFERENCES `Posts`.`post`(id));";

$conn = new mysqli("localhost", "root", "");

//три разных запроса, так как mysqli поддерждивает только одинг запрос за раз
$conn->query($dbCreate);
$conn->query($postTableCreate);
$conn->query($commentTableCreate);

if($conn->error)
{
    //выводим ошибку и в браузерную консоль, и на саму страницу
    echo '<script>console.log("база данных не создана")</script>'."\n";
    echo '<script>console.log("' . $conn->error .'")</script>'."\n";

    print("база данных не создана");
    print($conn->error);
}

else
{
    //выводим сообщение и в браузерную консоль, и на саму страницу
    echo '<script>console.log("база данных создана")</script>'."\n";
    print("база данных создана");
}