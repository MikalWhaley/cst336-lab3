<?php

//setup
function setup(){
    $deck1 = generateDeck();
    shuffle($deck1['cards']);
    $players = getHand($deck);
    
}

function generateDeck(){
    $suits = array('C', 'S', 'H', 'D');
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
    setup();
    score();
    display();
    return true;
}

//score
function score($players){
    for($x = 0; $x < 4; $x++){
        $values[$x] = $players[$x]["value"];
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
        if($players[$x]["value"] != $winners_score){
            $totalScore = $totalScore + $players["value"][$x];
        }
    }
    for($x = 0; $x < $winners; $x++){
        if($players[$x]["value"] == $winners_score){
            $players[$x]["score"] = $totalScore;
        }
    }
    return true;
}


//display
function display(){
    for($x = 0; $x < 4; $x++){
        echo "<img id='player$x' src='players/$x.png' alt='$x' title='Player $x' width='70' >";
        for($y = 0; $y < sizeof($players["cards"]); $y++){
            $source = "cards/" . $players[$x]["cards"]["suit"] . "/" . $players[$x]["cards"]["face"] . ".png";
            echo "<img id='player$x_cards' src='$source' alt='card$x' title = 'Card $x' width='70' >";
        }
    }
    for($x = 0; $x < 4; $x++){
        echo $players['name'][$x] . ": ";
    }
    for($x = 0; $x < 4; $x++){
        echo "Score" . $players['value'][$x];
    }
    
    
    return true;
}
//get hand
function getHand($deck){
    $players = array('numplayers'=>4, 'player' =>array());
    
    for($i =0;$i<4;$i++){
        $players['player'][$i]['hand'] = array_pop($deck);
        }
        return $players;
    }
    
    
    
    
?>