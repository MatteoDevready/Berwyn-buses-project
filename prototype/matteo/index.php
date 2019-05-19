    <!doctype html>
    <?php require_once "student.php" ?>
    <?php require_once "module.php" ?>
    <html>
        <head>
            <title>Class</title>
        </head>
        <body>
                    <?php
                        $paul = new Student();
                        $paul->id = "K1243456";
                        $paul->givenName = "Paul";
                        $paul->familyName = "Neve";

                        $paul = new Student();
                        $paul->id = "K178456";
                        $paul->givenName = "robert";
                        $paul->familyName = "honolulu";

                        $paul = new Student();
                        $paul->id = "K128456";
                        $paul->givenName = "Damien";
                        $paul->familyName = "Picard";

                        $paul = new Student();
                        $paul->id = "K123456";
                        $paul->givenName = "Hamza";
                        $paul->familyName = "Holly";

                        $flowerarr = new Module();
                        $flowerarr->id = "CI1000";
                        $flowerarr->name = "Flower Arranging";
                        $flowerarr->venue = "Third dustbin to the left";
                        $flowerarr->addStudents($paul)
                    ?>
                    <?php foreach($flowerarr->students as $s):?>
                        <p>
                            <?= $s->id ?>
                            <?= $s->givenName ?>
                            <?= $s->familyName ?>
                        </p>
                        <?php endforeach?>
                    <p> The first student on
                    <b><?=$flowerarr->students[0]->givenName ?>
                    <?=$flowerarr->students[0]->familyName ?>
                    </b>
                </body>
            </html>    