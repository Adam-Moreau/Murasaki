<?php
require_once 'sql/connexion.php';
require_once 'sql/get.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Murasaki</title>
    
    <!-- Move CSS imports to the bottom of the head section -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

        <?php include 'navbar.html'; ?>
   
    
        <div class="row frontTitle d-flex justify-content-center align-items-center">
            <div class="col-12">
                <p class="title text-center">Bienvenue sur Murasaki !</p>
            </div>
        </div>
        
        <div class="row d-flex justify-content-between">

            <div class="col-9 vocTabBox">
                <h1 class="boxTitleWhite">Tableaux de vocabulaire</h1>
                <a class="btnText" href="#">
                    <div class="btnNav">
                    Voir les tableaux
                        
                    </div>
                </a> 
                
                <!-- <button class="btnNav">Voir les tableaux</button> -->
            </div>
            <div class="col-3 dailyKanjiBox">
                <div class="front shadow">
                    <h1 class="boxTitle">Le kanji du jour</h1>
                    <p class="dailyKanjiCharacter">
                        <?php
                        $kanjiOfTheDay = getDailyKanji();
                        echo $kanjiOfTheDay['kanji_character'];
                        ?>
                    </p>
                </div>
                <div class="back dailyKanjiCharacter shadow">
                    <p class="kunyomi">
                        <?php
                        $kanjiOfTheDay = getDailyKanji();
                        echo $kanjiOfTheDay['kanji_kunyomi'];
                        ?>
                    </p>
                    <p class="trad">
                        <?php
                        $kanjiOfTheDay = getDailyKanji();
                        echo $kanjiOfTheDay['kanji_meaning'];
                        ?>
                    </p>
                    <p class="romaji">
                        <?php
                        $kanjiOfTheDay = getDailyKanji();
                        echo $kanjiOfTheDay['kanji_romaji_writing'];
                        ?>
                    </p>
                </div>
            </div>    
        </div>
        <div class="row d-flex justify-content-between">

            <div class="col-3 kanaBox">
                <h1 class="boxTitleWhite">Les kanas</h1>
                <a class="btnText" href="#">
                    <div class="btnNav">
                        Voir les tableaux
                        
                    </div>
                </a> 
            </div>
            <div class="col-9 trainingBox">
                <h1 class="boxTitleWhite">Salle de révisions</h1>
                <a class="btnText" href="#">
                    <div class="btnNav">
                        Voir les tableaux 
                    </div>
                </a> 
            </div>
            
        </div>
        <div class="row d-flex justify-content-between">

            <div class="col-3 adminBox">
                <h1 class="boxTitleWhite">Administration</h1>
                <a class="btnTextAdmin" href="mithrandir-portal.php">
                    <div class="btnNavAdmin">
                        Speak, Friend, and Enter
                        
                    </div>
                </a> 
            </div>
        </div>

   

</body>
</html>
