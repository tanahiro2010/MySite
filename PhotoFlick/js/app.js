const content_box = document.querySelector('.grid-container');
const cookie = decodeURIComponent(document.cookie);
let session_id = "";
console.log(cookie);
if (cookie != "") {
    const xhr = new XMLHttpRequest();
    const formData = new FormData();
    const cookies = cookie.split(';');

    for (let obj of cookies){
        if (obj.includes('session_id=')){
            session_id = obj.replace('session_id=', '').replace(' ', '');
        }
    }

    console.log(`Session_id: ${session_id}`);

    if (session_id != ""){
        formData.append('session_id', session_id);

        xhr.open('POST', './php/session.php');
        xhr.send(formData);
    
        xhr.onloadend = (() => {
            const response = xhr.responseText;
            console.log(response);
            if (response != "False"){
                const user = JSON.parse(response);
                const mail = user['mail'];
                const name = user['name'];
                console.log(`mail: ${mail}\nname: ${name}`);
                
                document.querySelectorAll('.account-button')[0].style = 'display: none';
                document.querySelector('.account-menu').style = 'display: flex';
            }
        });
    }
}

const setup = (() =>{
    const xhr = new XMLHttpRequest();

    xhr.open('GET', './php/get-pictures.php');
    xhr.send();

    xhr.onloadend = (() => {
        const response_str = xhr.responseText;
        console.log(response_str);
        const response_json = JSON.parse(response_str);
        const keys = Object.keys(response_json);
        console.log(keys);
        let html = '';
        for (let obj of keys) {
            const file_type = response_json[obj]["type"];
            let image_path = `./php/db/images/${obj}.`;
            switch (file_type) {
                case 'image/jpeg':
                    image_path += "jpg";
                    break
                case 'image/gif':
                    image_path += "gif";
                    break
                case 'image/png':
                    image_path += "png";
                    break;
            }

            html += `<div class="grid-item" onclick="location.href='./view.html?id=${obj}'"><img src="${image_path}" width="200" height="300" style="width:200px;object-fit: cover;"/><h3>${response_json[obj].title}</h3></div>`;
        }
        console.log(html);
        document.querySelector('.grid-container').innerHTML = html;
    });
});

setup();