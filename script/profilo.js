

function deletePost(event){
    fetch("post_delete.php?q=" + event.currentTarget.dataset.postId);
    const toDelete = event.currentTarget.parentNode.parentNode;
    toDelete.remove();
}


function onJson(json) {
    console.log(json);
    console.log(json.length);
    if (!json) {
        const notFound = document.createElement("div")
        notFound.textContent = "No data."
        mainFeed.appendChild(notFound);
    }
    else {
        for (let i = 0; i < json.length; i++) {
            const article = document.querySelector("article");
            const div = document.createElement("div");
            div.classList.add("post");
            const autore = document.createElement("div");
            autore.classList.add("author");
            autore.textContent = json[i].autore;
            div.appendChild(autore);
            const titolo = document.createElement("div");
            titolo.classList.add("title");
            titolo.textContent = json[i].title;
            div.appendChild(titolo);
            const contenuto = document.createElement("div");
            contenuto.classList.add("content");
            contenuto.textContent = json[i].content
            div.appendChild(contenuto);
            const pageDeleteContent = document.createElement('div');
            pageDeleteContent.classList.add('delete_content');
            div.appendChild(pageDeleteContent);
            const pageDelete = document.createElement('button');
            pageDelete.classList.add('delete');
            pageDelete.textContent = "Elimina post";
            pageDelete.dataset.postId = json[i].Post_id;
            pageDeleteContent.appendChild(pageDelete);
            article.appendChild(div);
            
            
            
            const deleteButtons = document.querySelectorAll('.delete');
            for (const deleteButton of deleteButtons){
            deleteButton.addEventListener('click',deletePost);
            }


        }
    }
}

function onResponse(response) {
    return response.json();
}

fetch("PostFetch.php?posts=my_post").then(onResponse).then(onJson);