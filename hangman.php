<?php 
include "header.php";

// All the body parts
$bodyParts = ["0","1","2","3","4","5","6"];

function getCurrentPicture($part){
    return "./images/hangman_". $part. ".png";
}

// Get all the hangman Parts
function getParts(){
    global $bodyParts;
    return isset($_SESSION["parts"]) ? $_SESSION["parts"] : $bodyParts;
}

// add part to the Hangman
function addPart(){
    $parts = getParts();
    array_shift($parts);
    $_SESSION["parts"] = $parts;
}

// get Current Hangman Body part
function getCurrentPart(){
    $parts = getParts();
    return $parts[0];
}

if(!isset($_SESSION['word'])){
    $words = file("words.txt");
    $word = rtrim(strtoupper($words[array_rand($words)]));
    $_SESSION['word'] = $word;
    $_SESSION['guesses'] = [];
    $_SESSION['lives'] = 6;
    // Reset hangman parts
    //This ensures that at the beginning of a new game, the hangman parts are set to the default values stored in $bodyParts.
    $_SESSION['parts'] = $bodyParts;
    if(!isset($_SESSION['gamesWon'])){
        $_SESSION['gamesWon'] = 0;
    }
    if(!isset($_SESSION['gamesLost'])){
        $_SESSION['gamesLost'] = 0;
    }
}

// Check if the reset button is pressed
if (isset($_POST['resetScoreboard'])) {
    // Reset the scoreboard
    $_SESSION['gamesWon'] = 0;
    $_SESSION['gamesLost'] = 0;
}

if(isset($_POST['guess'])){
    if(!in_array($_POST['guess'], $_SESSION['guesses'])){
        //The === false ensures that the condition is only true when the letter is not found in the word.
        if(strpos($_SESSION['word'], $_POST['guess']) === false){
            $_SESSION['lives']--;
            addPart();
        }
        $_SESSION['guesses'] [] = $_POST['guess'];
    } else {
        echo "You have already guessed that letter";
    }
}

$remainingLetters = array_diff(range('A', 'Z'), $_SESSION['guesses']);

if($_SESSION['lives'] <= 0){
    ?>
    <div class="alert alert-danger text-center" id ="lostAlertBox" role="alert">
        You have Lost!
    </div>
    <div class="text-center">
        The word was:
        <h1><?php echo $_SESSION['word']?></h1>
        <a href="hangman.php" class = "btn btn-success" role = "button">Play Again?</a>
    </div>
    <?php
    $_SESSION['gamesLost']++;
    unset($_SESSION['word']);
} else {
    $lettersLeftToGuess = 0;
    $currentStateOfPlay = '';
    $wordLength = strlen($_SESSION['word']);
    for($i = 0; $i < $wordLength; $i++) {
        if(in_array($_SESSION['word'][$i], $_SESSION['guesses'])){
            $currentStateOfPlay .= $_SESSION['word'][$i];
        } else {
            $currentStateOfPlay .= "_";
            $lettersLeftToGuess++;
        }
        $currentStateOfPlay .= " ";
    }

    ?>

    <div class="text-center" id="currentStateOfPlay">
            <h1><?php echo $currentStateOfPlay; ?></h1>
    </div>
   
   <?php

    if($lettersLeftToGuess == 0){
        ?>
        <div class="alert alert-success text-center" role="alert">
            You Won!
            </div>
                <div class="text-center">
                <a href="hangman.php" class = "btn btn-success" role = "button">Play Again?</a>
                </div>
        <?php
        $_SESSION['gamesWon']++;
        unset($_SESSION['word']);
    }
  
}


if ($_SESSION['lives'] !=0 && $lettersLeftToGuess != 0){
?>

<form class="row g-5" method = "post" action = "">
  <div class="col-auto">
  <select class="form-select" name="guess">
  <?php
        foreach($remainingLetters AS $letter){
            echo '<option value = "'.strtoupper($letter).'">'.strtoupper($letter).'</option>';
        }
    ?>
    </select>
  </div>
  <div class="col-auto">
    <button type="submit" name = "submit" value = "GUESS" class="btn btn-primary mb-3">GUESS</button>
  </div>
</form>

<?php
}
?>

<div class ="row" id="scoreboardRow">
    <div class="col-md-6"><img src="<?php echo getCurrentPicture(getCurrentPart());
    ?>" alt="">
    </div>
    <div class="col-md-6">
        <ul class="list-group">
            <li class="list-group-item active">SCOREBOARD</li>
            <li class="list-group-item d-flex justify-content-between">Games Won<span class = "badge bg-primary"><?php echo $_SESSION ['gamesWon']?></span></li>
            <li class="list-group-item d-flex justify-content-between">Games Lost<span class = "badge bg-primary"><?php echo $_SESSION ['gamesLost']?></span></li>
            <li class="list-group-item d-flex justify-content-between">Games Total<span class = "badge bg-primary"><?php echo $_SESSION ['gamesLost'] + $_SESSION['gamesWon']?></span></li>
        </ul>
        <form method="post" action="">
            <button type="submit" name="resetScoreboard" class="btn btn-warning mt-2">Reset Scoreboard</button>
        </form>
    </div>
</div>

<?php
include "footer.php";
?>