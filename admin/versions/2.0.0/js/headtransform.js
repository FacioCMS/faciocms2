/*****//* (c) Copyright FacioCMS Maciej Dębowski 2021-today *//*****/
/*****/ 

if(document.querySelector("#use-as-head")) {
    document.head.innerHTML += document.querySelector("#use-as-head").innerHTML
    document.querySelector("#use-as-head").remove()
    document.querySelector("#head-transform-script").remove()
}