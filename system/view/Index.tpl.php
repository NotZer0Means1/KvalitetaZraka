Dobrodosli u Aplikaciju KvalitetaZraka! <br> <br>

<?php foreach ($resources as $key => $data) { ?>
    <strong>
        <?=$key?>
        <?=$data['url']?>
    </strong>
    <br>
    Metoda: <?=$data['method']?>
    <br>
    <?=$data['description']?>
    <br>
<?php } ?>