CREATE DATABASE Posts;

CREATE TABLE `Posts`.`post` 
(`id` INT NOT NULL AUTO_INCREMENT, 
`userId` INT NOT NULL, 
`title` VARCHAR(255) NOT NULL, 
`body` TEXT NOT NULL, 
PRIMARY KEY (`id`));

CREATE TABLE `Posts`.`comment` 
(`id` INT NOT NULL AUTO_INCREMENT , 
 `name` VARCHAR(255) NOT NULL , 
 `email` VARCHAR(255) NOT NULL , 
 `body` TEXT NOT NULL , 
 `postId` INT NOT NULL , 
 PRIMARY KEY (`id`),
 FOREIGN KEY (`postId`) REFERENCES `Posts`.`post`(id));
