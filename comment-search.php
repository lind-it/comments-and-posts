<?php

$conn = new mysqli("localhost", "root", "", "Posts");

$text = "%" . $_POST["text"] . "%";

$stmt = $conn->prepare("SELECT DISTINCT post.id, post.userId, post.title, post.body, comment.postId 
                        FROM post JOIN comment ON post.id = comment.postId 
                        WHERE comment.body LIKE ?");
$stmt->bind_param("s", $text);
$stmt->execute();
$result = $stmt->get_result();
//помещаем полученныйе данные в массив для отправки на страницу
$outputdata = [];
while ($row = $result->fetch_assoc()) {
    $outputdata[] = $row;
}

echo json_encode($outputdata);