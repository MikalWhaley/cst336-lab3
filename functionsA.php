<?php

//setup
function setup(){
    $deck = generateDeck();
    shuffle($deck['cards']);
    $players = getHand($deck);
    return $players;
    
}

function generateDeck(){
    $suits = array('clubs', 'spades', 'hearts', 'diamonds');
    $face = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13');
    $deck = array("numCards"=>52, "cards"=>array());
    
    $card_count = 0;
    for($x = 0; $x < 4; $x++){
        for($y = 0; $y < 13; $y++){
            $deck["cards"][$card_count]["suit"] = $suits[$x];
            $deck["cards"][$card_count]["face"] = $face[$y];
            $card_count = $card_count + 1;
        }
    }
        return $deck;
}


//play
function play(){
    $players = setup();
    $players = score($players);
    display($players);
    return true;
}

//score
function score($players){
    for($x = 0; $x < 4; $x++){
        $values[$x] = $players['player'][$x]["value"];
    }
    rsort($values);
    $winners = 0;
    $winners_score = 0;
    $totalScore = 0;
    for($x = 0; $x < 4; $x++){
        if($values[$x] <= 42 AND $winners == 0){
            $winners_score = $values[$x];
            $winners = 1;

        }
        else if($values[$x] == $winners_score){
            $winners = $winners + 1;
        }
    }
    for($x = 0; $x < 4; $x++){
        if($players['player'][$x]["value"] != $winners_score){
            $totalScore = $totalScore + $players['player'][$x]["value"];
            $players['player'][$x]["winner"] = false;
        }
    }
    for($x = 0; $x < 4; $x++){
        if($players['player'][$x]["value"] == $winners_score){
            $players['player'][$x]["score"] = $totalScore;
            $players['player'][$x]["winner"] = true;
        }
    }
    return $players;
}


//display
function display($players){
    echo "<div id='output'>";
    for($x = 0; $x < 4; $x++){
        $name = $players['player'][$x]['name'];
        echo "<figure class='item'>";
        echo "<img id='player' src='players/$x.jpg' alt='$x' title='Player $x' width='70' >";
        echo "<figcaption class='caption'>$name</figcaption>";
        echo "</figure>";
        for($y = 0; $y < count($players['player'][$x]["hand"]); $y++){
            $source = "cards/" . $players['player'][$x]["hand"][$y]["suit"] . "/" . $players['player'][$x]["hand"][$y]["face"] . ".png";
            echo "<img id='cards' src='$source' alt='card$y' title = 'Card $y' width='70' >";
        }
        $score_to_echo = $players['player'][$x]['value'];
        echo "<h3 id='score'> Score: $score_to_echo </h3>";
        echo "<br><br>";
    }
    for($x = 0; $x < 4; $x++){
        if($players['player'][$x]["winner"] == true){
            $winner = $players['player'][$x]['name'];
            $points = $players['player'][$x]['score'];
            echo "<h2> $winner wins $points points!!! </h2>";
            echo "<br><br>";
        }
    }
    echo "</div";
    return true;
}
//get hand
function getHand($deck){
    $players = array('numplayers'=>4, 'player' =>array());
    $players['player'][0]['name'] = "Virgil";
    $players['player'][1]['name'] = "Ye";
    $players['player'][2]['name'] = "Heron";
    $players['player'][3]['name'] = "Osiris";
    
    for($i = 0; $i < 4; $i++){
        $players['player'][$i]['value'] = 0;
        $x = 0;
        do{
            $players['player'][$i]['hand'][$x] = array_pop($deck['cards']);
            $players['player'][$i]['value'] = $players['player'][$i]['value'] + $players['player'][$i]['hand'][$x]['face'];
            $x = $x + 1;
        } while($players['player'][$i]['value'] < 37);
        
    }
    return $players;
}
    
    
    
    
?>