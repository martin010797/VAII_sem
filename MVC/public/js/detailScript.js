/*class Detail {
    constructor() {
    }

    async getAddToListButton(){
        //TODO dokoncit zmenu tlacidla pre pridavanie a mazanie zo zoznamu
        var html = '';
        var button = document.getElementById('addOrRemoveButton');

        //dostanem vsetky filmy uzivatela
        let responseMovies = await fetch('?c=Movies&a=jsonMovies');
        let dataMovies = await responseMovies.json();
        //dostanem vsetky serialy uzivatela
        let responseSeries = await fetch('?c=Series&a=jsonSeries');
        let data = await responseSeries.json();

        //ak uz v zozname ma tak tlacidlo na odobratie
        //<button type="button" class="btn btn-success mb-3" onclick="location.href='#'">Pridať do zoznamu</button>

        //ak este v zozname prvok nema tak tlacidlo na pridanie
        html += `<button type="button" class="btn btn-warning mb-3" onclick="location.href='#'">Pridať do zoznamu</button>`

        button.innerHTML = html;
    }
}
document.addEventListener('DOMContentLoaded', () => {
    var detail = new Detail();
});*/