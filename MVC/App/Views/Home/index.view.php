

<link rel="stylesheet" href="http://localhost/VAII_SEM/MVC/public/css/main_page_style.css">

<div class="jumbotron text-center shadow">
    <h2>What to watch</h2>
    <p>Vitajte na stránke kde si môžete vytvárať zoznamy svojich obľúbených filmov a seriálov.</p>
    <p>Na zákalde týchto zoznamov sa môžte jednoducho rozhodovať čo si pozriete.</p>
</div>

<div class="container pt-3 pb-5">
    <h2>Naposledy pridané filmy</h2>
    <div class="row bg-secondary text-light">
        <?php
        /** @var \App\MovieInfo $data */
        foreach ($data['movie'] as $movie) {
            echo '<div class="col-md border pt-3">';
            if (is_null($movie->getImage())) {
                echo '<img src="../mvc-master/public/images/no_image.png" class="img-thumbnail" alt="Cinque Terre">';
            } else {
                echo '<img src=data:image;base64,' . $movie->getImage() . ' class="img-thumbnail" alt="Cinque Terre">';
            }
            echo '<h3><a href="?c=Detail&id=' . $movie->getId() .'&type=m">' . $movie->getTitle() . '</a>';
            echo '</h3>';
            //echo '<p>' . $movie->getDescription() . '</p>' ;
            echo '<p>' . substr($movie->getDescription(), 0, 380) . '...</p>';
            echo "</div>";

        }
        ?>
    </div>

    <h2 class="pt-3">Naposledy pridané seriály</h2>
    <div class="row bg-secondary text-light">
        <?php
        /** @var \App\SeriesInfo $data */
        foreach ($data['series'] as $series) {
            echo '<div class="col-md border pt-3">';
            if (is_null($series->getImage())) {
                echo '<img src="../mvc-master/public/images/no_image.png" class="img-thumbnail" alt="Cinque Terre">';
            } else {
                echo '<img src=data:image;base64,' . $series->getImage() . ' class="img-thumbnail" alt="Cinque Terre">';
            }
            echo '<h3><a href="?c=Detail&id=' . $series->getItem_Id() .'&type=s">' . $series->getTitle() .  '</a>';
            echo '</h3>';
            //echo '<p>' . $movie->getDescription() . '</p>' ;
            echo '<p>' . substr($series->getDescription(), 0, 380) . '...</p>';
            echo "</div>";

        }
        ?>
    </div>


</div>


