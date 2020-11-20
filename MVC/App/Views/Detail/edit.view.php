<form method="post" enctype="multipart/form-data">
    <br/>
    <?php
    /** @var \App\SeriesInfo $data */
    if ($data[0]->getType() == "m") {
        $itemName = $data[0]->getTitle();
    }
    ?>
    <input type="hidden" value="<?php
    if ($data[0]->getType() == "s") {
        echo $data[0]->getItem_Id();
    }else{
        echo $data[0]->getId();
    } ?>" name="id">
    <input required type="text" name="title" placeholder="Vloz nadpis" value='<?= $data[0]->getTitle() ?>'>
    <?php if (isset($data[1][0])) {
        foreach ($data[1][0] as $error ) {
            ?>
            <div>
                <?= $error?>
            </div>

        <?php }}?>
    <input required type="text" name="description" placeholder="Vloz text" value='<?= $data[0]->getDescription() ?>'>
    <?php if (isset($data[1][1])) {
        foreach ($data[1][1] as $error ) {
            ?>
            <div>
                <?= $error?>
            </div>

        <?php }}?>
    <input type="text" name="duration" placeholder="Vloz dlzku trvania" value="<?php
    if ($data[0]->getType() == "m") {
        echo $data[0]->getDuration();
    }
    ?>">
    <?php if (isset($data[1][2])) {
        foreach ($data[1][2] as $error ) {
            ?>
            <div>
                <?= $error?>
            </div>

        <?php }}?>
    <input type="text" name="numbOfSe" placeholder="Vloz pocet serii" value="<?php
    if ($data[0]->getType() == "s") {
        echo $data[0]->getNumberOfSeasons();
    }
    ?>">
    <?php if (isset($data[1][3])) {
        foreach ($data[1][3] as $error ) {
            ?>
            <div>
                <?= $error?>
            </div>

        <?php }}?>
    <input type="radio" name="type" value="m" <?php
    if ($data[0]->getType() == "m") {
        echo 'checked';
    }
    ?>>Movie
    <input type="radio" name="type" value="s"<?php
    if ($data[0]->getType() == "s") {
        echo 'checked';
    }
    ?>>Series

    <input required type="file" name="image"/>

    <br/><br/>
    <input type="submit" name="submit" value="Upload"/>
</form>

