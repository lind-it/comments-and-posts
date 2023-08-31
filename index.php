<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

    <form action="" method="post" id="form">
        <div class="mb-3">
        <label for="searchingText" class="form-label">Введите текст комментария</label>
            <input type="text" name="text" class="form-control" id="searchingText" aria-describedby="searchingText">
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>

    <div class="found-comments">
    </div>

    <script src="script.js"></script>
</body>

</html>