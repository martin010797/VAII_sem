<link rel="stylesheet" href="MVC/public/css/main_page_style.css">

<div class="container-fluid pt-3 pb-5">
    <h2>Filmy</h2>
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

            if (!is_null($movie->getImageName())){
                //echo '<img src="MVC/public/images/'. $movie->getImageName() . '" class="img-thumbnail" alt="Cinque Terre">';
                $name = "'MVC/public/images/no_image.png'";
                echo '<img src="MVC/public/images/'. $movie->getImageName() . '" class="img-thumbnail" onerror="this.onerror=null; this.src=' . $name .'" alt="">';
            }else{
                echo '<img src="MVC/public/images/no_image.png" class="img-thumbnail" alt="Cinque Terre">';
                //echo '<img src=data:image;base64,' . $series->getImage() . ' class="img-thumbnail" alt="Cinque Terre">';
            }
            echo '<h3><a href="?c=Detail&id=' . $movie->getId() .'&type=m">' . $movie->getTitle() . '</a>';
            echo '</h3>';
            if (strlen($movie->getDescription()) > 250){
                echo '<p>' . substr($movie->getDescription(), 0, 250) . '...</p>';
            }else{
                echo $movie->getDescription();
            }
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
