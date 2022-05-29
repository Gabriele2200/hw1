
function onJsonRicerca(json) {
    console.log(json);
    console.log(json.length);
    if (!json) {
        document.querySelector("article").innerHTML = "";
        const post = document.querySelector("article");
        const notFound = document.createElement("div")
        notFound.classList.add("no_data");
        notFound.textContent = "No data."
        post.appendChild(notFound);
    }
    else {
        document.querySelector("article").innerHTML = "";
        const searchResponse = document.createElement("div"); 
        searchResponse.textContent = "Stavi cercando... " + json[0].ricerca + " ha ritornato " + json.length + " accoppiamenti"; 
        searchResponse.classList.add("search_success"); 
        document.querySelector("article").appendChild(searchResponse);
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
            article.appendChild(div);
            risultati.appendChild(article);

        }
    }
}

function onJson(json) {
    console.log(json);
    console.log(json.length);
    if (!json) {
        const post = document.querySelector(".post");
        const notFound = document.createElement("div");
        notFound.classList.add("No_data");
        notFound.textContent = "No data.";
        post.appendChild(notFound);
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
            article.appendChild(div);


        }
    }
}

function onResponse(response) {
    return response.json();
}

fetch("PostFetch.php?posts=all").then(onResponse).then(onJson);

function onJsonMeteo_Cc(json){
    console.log(json);
    const w_div = document.querySelector('#Meteo_div');
    w_div.classList.remove("hidden");

    const metric_value = json[0].Temperature.Metric.Value + ' ' + json[0].Temperature.Metric.Unit + '°';
    console.log(metric_value);
    const weather_T = json[0].WeatherText;
    console.log(weather_T);
    const Meteo_p=document.querySelector('#Parag_M');
    Meteo_p.innerHTML= weather_T + '  <span></span>'
    Meteo_p.querySelector('span').textContent=metric_value;
    w_div.querySelector('a').href= json[0].Link;


} 


function onJsonMeteo_l(json){
    console.log(json);
    console.log(json[0].Key); // check
    City_key = (json[0].Key);
    const City_name=document.querySelector('#Title_M');
    City_name.textContent= (json[0].LocalizedName);
}
function RicercaCond(){
    fetch("condition_meteo.php?m="+ City_key).then(onResponse).then(onJsonMeteo_Cc)
}


function sendRequest(event){
    event.preventDefault();

    const text = document.querySelector('#content').value;
    const encoded_t = encodeURIComponent(text);
    const tipo = document.querySelector('#tipo').value;
    if(tipo === 'post'){
        const Ans_div=document.querySelector('#Risposta_R');
        Ans_div.classList.add('hidden'); 
        if(text)
        fetch("PostFetch.php?cerca=" + encoded_t).then(onResponse).then(onJsonRicerca);
        else {
        document.querySelector("article").innerHTML = "";
        const post = document.querySelector("article");
        const notFound = document.createElement("div")
        notFound.textContent = "No data."
        post.appendChild(notFound);
        }
    }
    if(tipo === 'meteo'){
        const Ans_div=document.querySelector('#Risposta_R');
        Ans_div.classList.remove('hidden'); 
        if(text){
            
            fetch("get_meteo_div.php?c="+encoded_t).then(onResponse).then(onJsonMeteo_l).then(RicercaCond);
        }
    }



}




const form = document.querySelector('#ricerca');
form.addEventListener('submit', sendRequest);