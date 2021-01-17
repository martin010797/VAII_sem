<link rel="stylesheet" href="MVC/public/css/insert_item_style.css">

<div id="insertItemContainer" class="container shadow-lg">
    <h2 class="text-center">Vloženie prvku</h2>
    <form class="form-group" method="post" enctype="multipart/form-data">
        <br/>
        <?php
        /** @var Array[] $data */
        if ($data == null) {
            ?>
            <div id="titlesOfForm">
                Názov
            </div>
            <input required type="text" class="form-control mb-2" name="title" placeholder="Vlož názov">

            <div id="titlesOfForm">
                Popis
            </div>
            <textarea class="form-control" id="popis_prvku" name="popis_prvku" rows="3" placeholder="Vlož popis"></textarea>

            <div id="titlesOfForm">
                Dĺžka trvania
            </div id="titlesOfForm">
            <input type="text" name="duration" class="form-control mb-2" placeholder="Vlož dĺžku trvania (film)">
            <div id="titlesOfForm">
                Počet sérií
            </div>
            <input type="text" name="numbOfSe" class="form-control mb-2" placeholder="Vlož počet sérií (seriál)">

            <input type="radio" name="type" value="m" checked>Film
            <input type="radio" name="type" value="s">Seriál
            <div id="titlesOfForm">
                Obrázok
            </div>
            <input required type="file" name="image"/>

            <br/>
            <input type="submit" class="btn btn-primary mt-2" name="submit" value="Nahrať"/>

            <?php
        } else {
            ?>
            <div id="titlesOfForm">
                Názov
            </div>
            <input required type="text" class="form-control mb-2" name="title" placeholder="Vlož názov"
                   value='<?= $data[0][0] ?>'>
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
            <textarea class="form-control" id="popis_prvku" name="popis_prvku" rows="3"><?= $data[0][1] ?></textarea>
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
            <input type="text" name="duration" class="form-control mb-2" placeholder="Vlož dĺžku trvania (film)"
                   value='<?php
                   if ($data[0][2] == "m") {
                       echo $data[0][3];
                   }
                   ?>'>
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
            <input type="text" name="numbOfSe" class="form-control mb-2" placeholder="Vlož počet sérií (seriál)"
                   value='<?php
                   if ($data[0][2] == "s") {
                       echo $data[0][3];
                   }
                   ?>'>
            <?php if (isset($data[1][3])) {
                foreach ($data[1][3] as $error) {
                    ?>
                    <div class="text-danger">
                        <?= $error ?>
                    </div>

                <?php }
            } ?>
            <input type="radio" name="type" value="m" <?php
            if ($data[0][2] == "m") {
                echo 'checked';
            }
            ?>>Film
            <input type="radio" name="type" value="s" <?php
            if ($data[0][2] == "s") {
                echo 'checked';
            }
            ?>>Seriál
            <div id="titlesOfForm">
                Obrázok
            </div>
            <input required type="file" name="image"/>

            <br/>
            <input type="submit" name="submit" class="btn btn-primary mt-2" value="Nahrať"/>
            <?php
        }
        ?>
    </form>
</div>

