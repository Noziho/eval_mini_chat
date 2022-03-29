const sendMessage = document.querySelector('#send-button');
const messageContainer = document.querySelector('#container-message');

const divMessage = document.createElement('div');
divMessage.className = 'message';

const authorContainer = document.createElement('p');
authorContainer.className = 'user';

if (sendMessage) {

    sendMessage.addEventListener('click', () => {
        const xhr = new XMLHttpRequest();
        xhr.responseType = 'json';

        const body = {
            content: document.querySelector('#message-content').value,
        };

        xhr.open('post', '/index.php?c=messageApi&a=add-message');

        xhr.onload = function () {
            if (xhr.status === 404) {
                alert('Aucun endpoint n\'a été trouvé');
                return;
            }
            else if (xhr.status === 400) {
                alert('Un paramètre est manquant');
                return;
            }

            if (messageContainer) {
                setInterval( function () {
                    fetch('/index.php?c=chat&a=get-all', {method: 'POST'})
                        .then(response => response.json())
                        .then(response => {
                            refreshChat(response);
                            console.log(response);
                        });
                }, 1000);

            }
        }

        xhr.send(JSON.stringify(body));
        document.querySelector('#message-content').value = '';
    })

}


function refreshChat (messages) {
    messageContainer.innerHTML = ''
    for (let i = 0; i < messages.length; i++) {
        messageContainer.innerHTML += "<div class='message'>" + "<p class='user'>" +
            messages[i]['author']+ "</p>" + "<p>" + messages[i]['content']+ "</p>" + "</div>";

    }
}