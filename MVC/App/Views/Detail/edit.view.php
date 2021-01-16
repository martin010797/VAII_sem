<link rel="stylesheet" href="http://localhost/VAII_SEM/MVC/public/css/insert_item_style.css">

<div id="insertItemContainer" class="container shadow-lg">
    <h2 class="text-center">Úprava prvku</h2>
    <form method="post" enctype="multipart/form-data">
        <?php
        /** @var Array[] $data */
        ?>
        <input type="hidden" value="<?php
        if ($data[0]->getType() == "s") {
            echo $data[0]->getItem_Id();
        } else {
            echo $data[0]->getId();
        } ?>" name="id">
        <div id="titlesOfForm">
            Názov
        </div>
        <input required type="text" class="form-control mb-2" name="title" placeholder="Vlož názov" value="<?= $data[0]->getTitle() ?>">
        <?php if (isset($data[1][0])) {
            foreach ($data[1][0] as $error) {
                ?>
                <div class="text-danger">
                    <?= $error ?>
                </div>

            <?php }
        } ?>

        <div id="titlesOfForm">
            Popis
        </div>
        <textarea class="form-control" id="popis_prvku" name="popis_prvku" rows="3"><?= $data[0]->getDescription() ?></textarea>
        <?php if (isset($data[1][1])) {
            foreach ($data[1][1] as $error) {
                ?>
                <div class="text-danger">
                    <?= $error ?>
                </div>
            <?php }
        } ?>
        <div id="titlesOfForm">
            Dĺžka trvania
        </div>
        <input type="text" class="form-control mb-2" name="duration" placeholder="Vlož dĺžku trvania (film)" value="<?php
        if ($data[0]->getType() == "m") {
            echo $data[0]->getDuration();
        }
        ?>">

        <?php if (isset($data[1][2])) {
            foreach ($data[1][2] as $error) {
                ?>
                <div class="text-danger">
                    <?= $error ?>
                </div>

            <?php }
        } ?>
        <div id="titlesOfForm">
            Počet sérií
        </div>
        <input type="text" class="form-control mb-2" name="numbOfSe" placeholder="Vlož počet sérií (seriál)" value="<?php
        if ($data[0]->getType() == "s") {
            echo $data[0]->getNumberOfSeasons();
        }
        ?>">
        <?php if (isset($data[1][3])) {
            foreach ($data[1][3] as $error) {
                ?>
                <div class="text-danger">
                    <?= $error ?>
                </div>

            <?php }
        } ?>
        <input hidden type="radio" name="type" value="m" <?php
        if ($data[0]->getType() == "m") {
            echo 'checked';
        }
        ?>>
        <input hidden type="radio" name="type" value="s"<?php
        if ($data[0]->getType() == "s") {
            echo 'checked';
        }
        ?>>
        <div id="titlesOfForm">
            Obrázok
        </div>
        <input required type="file" name="image"/>

        <br/>
        <input type="submit" class="btn btn-primary mt-2 mb-3" name="submit" value="Nahrať"/>
    </form>
</div>
