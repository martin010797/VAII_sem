<form method="post" enctype="multipart/form-data">
    <br/>
    <?php
    /** @var \App\SeriesInfo $data */
    if ($data->getType() == "m") {
        $itemName = $data->getTitle();
    }
    ?>
    <input type="hidden" value="<?php
    if ($data->getType() == "s") {
        echo $data->getItem_Id();
    }else{
        echo $data->getId();
    } ?>" name="id">
    <input type="text" name="title" placeholder="Vloz nadpis" value="<?= $data->getTitle() ?>">
    <input type="text" name="description" placeholder="Vloz text" value="<?= $data->getDescription() ?>">
    <input type="text" name="duration" placeholder="Vloz dlzku trvania" value="<?php
    if ($data->getType() == "m") {
        echo $data->getDuration();
    }
    ?>">
    <input type="text" name="numbOfSe" placeholder="Vloz pocet serii" value="<?php
    if ($data->getType() == "s") {
        echo $data->getNumberOfSeasons();
    }
    ?>">
    <input type="radio" name="type" value="m" <?php
    if ($data->getType() == "m") {
        echo 'checked';
    }
    ?>>Movie
    <input type="radio" name="type" value="s"<?php
    if ($data->getType() == "s") {
        echo 'checked';
    }
    ?>>Series

    <input type="file" name="image"/>

    <br/><br/>
    <input type="submit" name="submit" value="Upload"/>
</form>

