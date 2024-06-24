const enter_button = document.querySelector("#enter");
enter_button.addEventListener("click", () => {
    console.log("click");
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "./get.php?url=" + encodeURIComponent(document.querySelector('#url').value));
    xhr.send();
    xhr.onloadend = () => {
        const html = xhr.responseText;
        console.log(html);
        var e = 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.20.0'
        let t = window.open('about:blank').document;
        t.write(`
            <head>
                <title>Source of ${location.href}</title>
                <link rel="stylesheet" href="${e}/themes/prism.min.css">
            </head>

            <body bgcolor="#f5f2f0">
                <script src="${e}/components/prism-core.min.js"></script>
                <script src="${e}/plugins/autoloader/prism-autoloader.min.js"></script>
                <script src="${e}/plugins/autolinker/prism-autolinker.min.js"></script>
            </body>
        `);
        t.close();
        var r = t.body.appendChild(t.createElement('pre')).appendChild(t.createElement('code'));
        r.className = 'language-html';
        r.appendChild(t.createTextNode(html));
    };
});