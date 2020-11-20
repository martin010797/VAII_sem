<link rel="stylesheet" href="http://localhost/VAII_SEM/MVC/public/css/main_page_style.css">

<div class="container-fluid pt-3 pb-5">
    <h2>Movies</h2>
        <?php
        /** @var \App\MovieInfo $data */
        $rw = 0;
        $firstTime = true;
        $cl = 0;
        foreach ($data as $movie) {
            $rw++;
            if (($rw == 5) || ($firstTime == true)){
                //zaciatok
                echo '<div class="row bg-secondary text-light">';
                if ($firstTime == false){
                    $rw = 1;
                }
                $firstTime = false;
            }

            echo '<div class="col-md border pt-3">';
            if (is_null($movie->getImage())) {
                echo '<img src="../mvc-master/public/images/no_image.png" class="img-thumbnail" alt="Cinque Terre">';
            } else {
                echo '<img src=data:image;base64,' . $movie->getImage() . ' class="img-thumbnail" alt="Cinque Terre">';
            }
            echo '<h3><a href="?c=Detail&id=' . $movie->getId() .'&type=m">' . $movie->getTitle() . '</a>';
            echo '</h3>';
            //echo '<p>' . $movie->getDescription() . '</p>' ;
            echo '<p>' . substr($movie->getDescription(), 0, 250) . '...</p>';
            echo "</div>";

            if (($rw == 4)){
                //ukoncenie
                echo '</div>';

            }
        }
        if ($rw != 4){
            echo '</div>';
        }

        ?>

</div>
