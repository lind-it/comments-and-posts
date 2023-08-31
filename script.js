let form = document.querySelector("#form");

form.addEventListener("submit", (e)=>{
    //отменяем отправку данных через форму, чтобы страница не перезагружалась
    e.preventDefault();

    //делаем проверку на длинну отправляемого запроса
    let input = document.querySelector("#searchingText");
    if (input.value.length < 3)
    {
        alert("Введите текст, больше 3х символов");
        return;
    }

    sendData(input.value);
})

function sendData(value)
{
    let promise = new Promise((resolve, reject)=>
    {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost:8000/comment-search.php");

        let formData = new FormData();
        formData.append("text", value);
        xhr.send(formData);

        xhr.onreadystatechange = () =>
        {
            if(xhr.readyState == 4)
            {
                let data = JSON.parse(xhr.responseText)
                if (data.length == 0)
                {
                    reject();   
                }
                resolve(data);
            }
        }
    })
    promise.then((requestData)=>
    {
        commentsView(requestData);
    });
    promise.catch(()=> alert("комментарии не найдены"));
}

function commentsView(requestData)
{
    let foundComments = document.querySelector(".found-comments");
    //очищаем блок с найденными комментами 
    foundComments.innerHTML = "";

    for(let i = 0; i < requestData.length; i++)
    {
        foundComments.innerHTML += 
        `<div>
            <p><h1>ID: ${requestData[i]["id"]}</h1></p>
            <p>name: ${requestData[i]["userId"]}</p>
            <p>email: ${requestData[i]["title"]}</p>
            <p>body: ${requestData[i]["body"]}</p>
        </div>`;
    }
}