


<link rel="stylesheet" href="MVC/public/css/main_page_style.css">

<div class="jumbotron text-center shadow">
    <h2>What to watch</h2>
    <p>Vitajte na stránke kde si môžete vytvárať zoznamy svojich obľúbených filmov a seriálov.</p>
    <p>Na základe týchto zoznamov sa môžte jednoducho rozhodovať čo si pozriete.</p>
</div>

<div class="container pt-3 pb-5">
    <h2>Naposledy pridané filmy</h2>
    <div class="row bg-secondary text-light">
        <?php
        /** @var \App\MovieInfo $data */
        foreach ($data['movie'] as $movie) {
            echo '<div id="itemField" class="col-md border pt-3">';

            if (!is_null($movie->getImageName())){
                $name = "'MVC/public/images/no_image.png'";
                echo '<img src="MVC/public/images/'. $movie->getImageName() . '" class="img-thumbnail" onerror="this.onerror=null; this.src=' . $name .'" alt="">';
            }else{
                echo '<img src="MVC/public/images/no_image.png" class="img-thumbnail" alt="Cinque Terre">';
            }

            echo '<h3><a href="?c=Detail&id=' . $movie->getId() .'&type=m">' . $movie->getTitle() . '</a>';
            echo '</h3>';
            if (strlen($movie->getDescription()) > 300){
                echo '<p>' . substr($movie->getDescription(), 0, 300) . '...</p>';
            }else{
                echo $movie->getDescription();
            }
            echo "</div>";

        }
        ?>
    </div>

    <h2 class="pt-3">Naposledy pridané seriály</h2>
    <div class="row bg-secondary text-light">
        <?php
        /** @var \App\SeriesInfo $data */
        foreach ($data['series'] as $series) {
            echo '<div id="itemField" class="col-md border pt-3">';

            if (!is_null($series->getImageName())){
                $name = "'MVC/public/images/no_image.png'";
                echo '<img src="MVC/public/images/'. $series->getImageName() . '" class="img-thumbnail" onerror="this.onerror=null; this.src=' . $name .'" alt="">';
            }else{
                echo '<img src="MVC/public/images/no_image.png" class="img-thumbnail" alt="Cinque Terre">';
            }

            echo '<h3><a href="?c=Detail&id=' . $series->getItem_Id() .'&type=s">' . $series->getTitle() .  '</a>';
            echo '</h3>';
            if (strlen($series->getDescription()) > 300){
                echo '<p>' . substr($series->getDescription(), 0, 300) . '...</p>';
            }else{
                echo $series->getDescription();
            }
            echo "</div>";

        }
        ?>
    </div>


</div>


