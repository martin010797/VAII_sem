class MyMovies {
    constructor() {
        this.getMovies();
    }

    async getMovies(){
        try {
            //ajaxove volanie
            let response = await fetch('?c=Movies&a=jsonMovies');
            let data = await response.json();

            var movies = document.getElementById('movies-list');
            var html = '';
            var rw = 0;
            var firstTime = true;
            data.forEach((movie) => {
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
                if (movie.image_name != null){
                    html += `<img src="MVC/public/images/${movie.image_name}" class="img-thumbnail" onerror="this.onerror=null; this.src='MVC/public/images/no_image.png'" alt="">`;
                    //html += `<img src="MVC/public/images/${movie.image_name}" class="img-thumbnail" alt="Cinque Terre">`
                }else {
                    html += `<img src="MVC/public/images/no_image.png" class="img-thumbnail" alt="Cinque Terre">`

                    //html += `<img src=data:image;base64,${movie.image} class="img-thumbnail" alt="Cinque Terre">`;
                }
                if (movie.item_id != null && movie.title != null){
                    html += `<h3><a href="?c=Detail&id=${movie.item_id}&type=m">${movie.title}</a>`;
                    html += `</h3>`;
                }
                if (movie.description != null){
                    html += `<p>${movie.description.substr(0,250)}...</p>`;
                    html += `</div>`;
                }
                if (rw === 4){
                    //ukoncenie
                    html += `</div>`;
                }
            });
            if (rw !== 4  && firstTime === false){
                html += `</div>`;
            }
            if (firstTime === true){
                html += `<div class="jumbotron text-center shadow"><h2>Žiadne filmy nie sú v zozname.</h2> </div>`
            }
            movies.innerHTML = html;
        }catch (e) {
            console.error("Chyba: " + e.message);
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    var myMovies = new MyMovies();
});