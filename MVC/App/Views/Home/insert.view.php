<form method="post" enctype="multipart/form-data">
    <br/>
    <input required type="text" name="title" placeholder="Vloz nadpis">
    <input required type="text" name="description" placeholder="Vloz text">
    <input type="text" name="duration" placeholder="Vloz dlzku trvania">
    <input type="text" name="numbOfSe" placeholder="Vloz pocet serii">
    <input type="radio" name="type" value="m" checked>Movie
    <input type="radio" name="type" value="s">Series

    <input required type="file" name="image"/>

    <br/><br/>
    <input type="submit" name="submit" value="Upload"/>
</form>

