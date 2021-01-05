<?php
/** @var \App\Core\AAuthenticator $auth */
?>
<link rel="stylesheet" href="http://localhost/VAII_SEM/MVC/public/css/item_detail_style.css">

<div class="container shadow">
    <div class="row bg-secondary text-light">
        <div class="col-md-3 border pt-3 text-center">
            <?php
                /** @var \App\MovieInfo $data */
            echo '<img src=data:image;base64,' . $data->getImage() . ' class="img-thumbnail" alt="Cinque Terre">';
            ?>
            <!--<p>Release date: 2009</p>-->
            <?php
            if ($_GET['type'] == 'm'){
                echo '<p>Dĺžka trvania: ' . $data->getDuration() . '</p>';
            }
            if ($_GET['type'] == 's'){
                echo '<p>Počet sérií: ' . $data->getNumberOfSeasons() . '</p>';
            }
            ?>

        </div>

        <div class="col-md-7 bg-dark border pt-3">
            <h3 style="color: dodgerblue">
                <?php
                echo $data->getTitle()
                ?>
            </h3>
            <?php
            echo $data->getDescription();
            ?>

        </div>

        <div class="col-md-2 border pt-3 text-center pb-3">
            <?php
            $typ = $_GET['type'];
            $id = $_GET['id'];
            if ($auth->isLogged()) { ?>
            <button type="button" class="btn btn-info mb-3" onclick="location.href='?c=detail&a=edit&type=<?= $typ ?>&id=<?= $id ?>'">Upraviť</button>
            <?php } ?>
            <?php if ($auth->isMaintainer()) { ?>
            <button type="button" class="btn btn-warning mb-3 " onclick="location.href='?c=detail&a=delete&type=<?= $typ ?>&id=<?= $id ?>'">Vymazať z databázy</button>
            <?php } ?>
        </div>
    </div>
</div>
