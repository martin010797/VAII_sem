<link rel="stylesheet" href="http://localhost/VAII_SEM/MVC/public/css/main_page_style.css">

<div class="container-fluid pt-3 pb-5">
    <h2>Series</h2>
    <?php
    /** @var \App\SeriesInfo $data */
    $rw = 0;
    $firstTime = true;
    $cl = 0;
    foreach ($data as $series) {
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
        if (is_null($series->getImage())) {
            echo '<img src="../mvc-master/public/images/no_image.png" class="img-thumbnail" alt="Cinque Terre">';
        } else {
            echo '<img src=data:image;base64,' . $series->getImage() . ' class="img-thumbnail" alt="Cinque Terre">';
        }
        echo '<h3><a href="?c=Detail&id=' . $series->getItem_Id() .'&type=s">' . $series->getTitle() . '</a>';
        echo '</h3>';
        echo '<p>' . substr($series->getDescription(), 0, 250) . '...</p>';
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
