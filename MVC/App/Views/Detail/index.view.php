<?php
/** @var \App\Core\AAuthenticator $auth */
?>
<link rel="stylesheet" href="MVC/public/css/item_detail_style.css">

<div class="container shadow">
    <div class="row bg-secondary text-light">
        <div id="itemField" class="col-md-3 border pt-3 text-center">
            <?php
            /** @var \App\MovieInfo $data */
            if (!is_null($data['item']->getImageName())){
                $name = "'MVC/public/images/no_image.png'";
                echo '<img src="MVC/public/images/'. $data['item']->getImageName() . '" class="img-thumbnail" onerror="this.onerror=null; this.src=' . $name .'" alt="">';
                //echo '<img src="MVC/public/images/'. $data['item']->getImageName() . '" class="img-thumbnail" alt="Cinque Terre">';
            }else{
                echo '<img src="MVC/public/images/no_image.png" class="img-thumbnail" alt="Cinque Terre">';
            }
            ?>
            <?php
            if ($_GET['type'] == 'm'){
                echo '<p>Dlžka trvania: ' . $data['item']->getDuration() . '</p>';
            }
            if ($_GET['type'] == 's'){
                echo '<p>Pocet sérií: ' . $data['item']->getNumberOfSeasons() . '</p>';
            }
            ?>

        </div>

        <div class="col-md-7 bg-dark border pt-3">
            <h3 style="color: dodgerblue">
                <?php
                echo $data['item']->getTitle()
                ?>
            </h3>
            <?php
            echo $data['item']->getDescription();
            ?>

        </div>

        <div id="itemField" class="col-md-2 border pt-3 text-center pb-3">
            <?php
            $typ = $_GET['type'];
            $id = $_GET['id'];
            if ($auth->isLogged() && !$auth->isMaintainer()) {
                if ($data['isInList']){?>
                    <button type="button" class="btn btn-warning mb-3" onclick="location.href='?c=Detail&a=removeFromList&id=<?= $id ?>&type=<?= $typ ?>'">Odobrať zo zoznamu</button>
                <?php }else{ ?>
                    <button id="add" type="button" class="btn btn-success mb-3" onclick="location.href='?c=Detail&a=addToList&id=<?= $id ?>&type=<?= $typ ?>'">Pridať do zoznamu</button>
                <?php } ?>
            <?php } ?>

            <div id="addOrRemoveButton">
            </div>

            <?php if ($auth->isMaintainer()) { ?>
                <button type="button" class="btn btn-info mb-3" onclick="location.href='?c=detail&a=edit&type=<?= $typ ?>&id=<?= $id ?>'">Upravit</button>
                <button type="button" class="btn btn-danger mb-3 " onclick="location.href='?c=detail&a=delete&type=<?= $typ ?>&id=<?= $id ?>'">Vymazat z databázy</button>
            <?php } ?>
        </div>
    </div>
</div>
