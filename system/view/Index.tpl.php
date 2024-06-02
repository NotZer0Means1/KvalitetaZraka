Dobrodosli u Aplikaciju KvalitetaZraka! <br> <br>
<?php foreach ($data['resources'] as $key => $resource) { ?>
    <strong>
        <?=$key?>
        <?=$resource['url']?>
    </strong>
    <br>
    Metoda: <?=$resource['method']?>
    <br>
    <?=$resource['description']?>
    <br>
<?php } ?>