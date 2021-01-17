<link rel="stylesheet" href="MVC/public/css/main_page_style.css">

<div class="container-fluid pt-3 pb-5">
    <h2>Seriály</h2>
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

        echo '<div id="itemField" class="col-md border pt-3">';

        if (!is_null($series->getImageName())){
            $name = "'MVC/public/images/no_image.png'";
            echo '<img src="MVC/public/images/'. $series->getImageName() . '" class="img-thumbnail" onerror="this.onerror=null; this.src=' . $name .'" alt="">';
        }else{
            echo '<img src="MVC/public/images/no_image.png" class="img-thumbnail" alt="Cinque Terre">';
        }

        echo '<h3><a href="?c=Detail&id=' . $series->getItem_Id() .'&type=s">' . $series->getTitle() . '</a>';
        echo '</h3>';
        if (strlen($series->getDescription()) > 250){
            echo '<p>' . substr($series->getDescription(), 0, 250) . '...</p>';
        }else{
            echo $series->getDescription();
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
