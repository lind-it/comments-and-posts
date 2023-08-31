<?php
$postsDownload = curl_init();
$commentsDownload = curl_init();

//Задаем настройки для скачивания постов
curl_setopt($postsDownload, CURLOPT_URL, 'https://jsonplaceholder.typicode.com/posts');
curl_setopt($postsDownload, CURLOPT_RETURNTRANSFER, 1);

//Задаем настройки для скачивания комментариев
curl_setopt($commentsDownload, CURLOPT_URL, 'https://jsonplaceholder.typicode.com/comments');
curl_setopt($commentsDownload, CURLOPT_RETURNTRANSFER, 1);

//преобразуем полученные данные в массив
$postsResult = array(json_decode(curl_exec($postsDownload), true))[0];
$commentsResult = array(json_decode(curl_exec($commentsDownload), true))[0];

$conn = new mysqli("localhost", "root", "", "Posts");



//закидываем данные о комметариях в базу данных
for($i = 0; $i < count($postsResult); $i++)
{
    $id = $postsResult[$i]['id'];
    $userId = $postsResult[$i]['userId'];
    $title = $postsResult[$i]['title'];
    $body = $postsResult[$i]['body'];

    $query = "INSERT INTO `post`(`id`, `userId`, `title`, `body`) 
              VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiss", $id, $userId, $title, $body);
    $stmt->execute();
    
}
if($conn->error)
{
    print("посты не загружены");
    print($conn->error);
}

//закидываем данные о постах в базу данных
for($i = 0; $i < count($commentsResult); $i++)
{
    $id = $commentsResult[$i]['id'];
    $name = $commentsResult[$i]['name'];
    $email = $commentsResult[$i]['email'];
    $body = $commentsResult[$i]['body'];
    $postId = $commentsResult[$i]['postId'];

    $query = "INSERT INTO `comment`(`id`, `name`, `email`, `body`, `postId`) 
              VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("isssi", $id, $name, $email, $body, $postId);
    $stmt->execute();
}

if($conn->error)
{
    //выводим ошибку и в браузерную консоль, и на саму страницу
    echo '<script>console.log("комментарии не загружены")</script>'."\n";
    echo '<script>console.log("' . $conn->error .'")</script>'."\n";

    print("комментарии не загружены");
    print($conn->error);
}

else
{
    //выводим сообщение и в браузерную консоль, и на саму страницу
    echo 
    '<script>console.log("Загруженно' . count($postsResult) . ' постов и ' . count($commentsResult) . ' комментариев к ним)</script>'."\n";
    print("Загруженно" . count($postsResult) . " постов и " . count($commentsResult) . " комментариев к ним");
}


curl_close($postsDownload);
curl_close($commentsDownload);