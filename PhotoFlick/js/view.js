const xhr = new XMLHttpRequest();

const img = document.querySelector('.img');
const title = document.querySelector('.picture-title');
const text = document.querySelector('.picture-text');
const create_day = document.querySelector('.create-day');
const picture_id = new URL(location.href).searchParams.get('id');



console.log(`Picture id: ${picture_id}`);
xhr.open('GET', `./php/get_image_info.php?id=${picture_id}`);
xhr.send();

xhr.onloadend = (() => {
    const response_str = xhr.responseText;
    console.log(response_str);
    if (response_str == 'False') {
        swal.fire('Error', 'そのような画像は存在しません');
        location.href = '/';
        return;
    } else {
        const response = JSON.parse(response_str);
        const file_type = response['type'];
        // 'image/jpeg', 'image/gif', 'image/png'
        let image_path = `./php/db/images/${picture_id}.`;
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
        img.src = image_path;
        title.innerText = response['title'];
        text.innerText = response['text'];
        create_day.innerText = response['create_day'];
        return;
    }
});