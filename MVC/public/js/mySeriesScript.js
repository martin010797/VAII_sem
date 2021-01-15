class MySeries {
    constructor() {
        this.getSeries();
    }

    async getSeries(){
        try {
            let response = await fetch('?c=Series&a=jsonSeries');
            let data = await response.json();

            var series = document.getElementById('series-list');
            var html = '';
            var rw = 0;
            var firstTime = true;
            data.forEach((series) => {
                rw++;
                if ((rw === 5) || (firstTime === true)){
                    //zaciatok
                    html += `<div class="row bg-secondary text-light">`;
                    if (firstTime === false){
                        rw = 1;
                    }
                    firstTime = false;
                }
                html += `<div class="col-md border pt-3">`;
                if (series.image_name != null){
                    html += `<img src="MVC/public/images/${series.image_name}" class="img-thumbnail" alt="Cinque Terre">`
                }else {
                    html += `<img src="MVC/public/images/no_image.png" class="img-thumbnail" alt="Cinque Terre">`
                    //html += `<img src=data:image;base64,${series.image} class="img-thumbnail" alt="Cinque Terre">`;
                }
                if (series.item_id != null && series.title != null){
                    html += `<h3><a href="?c=Detail&id=${series.item_id}&type=s">${series.title}</a>`;
                    html += `</h3>`;
                }
                if (series.description != null){
                    html += `<p>${series.description.substr(0,250)}...</p>`;
                    html += `</div>`;
                }
                if (rw === 4){
                    //ukoncenie
                    html += `</div>`;
                }
            });
            if (rw !== 4 && firstTime === false){
                html += `</div>`;
            }
            if (firstTime === true){
                html += `<div class="jumbotron text-center shadow"><h2>Žiadne seriály nie sú v zozname.</h2> </div>`
            }
            series.innerHTML = html;
        }catch (e) {
            console.error("Chyba: " + e.message);
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    var mySeries = new MySeries();
});