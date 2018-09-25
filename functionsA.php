<?php

//setup
function setup(){
    return true;
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
    $winners = 0;
    $totalScore = 0;
    arsort($players["value"]);
    foreach($players as $key => $value){
        if($value > 42){
            next;
        }
        else if($value == $players["value"][0]){
            $winners = $winners + 1;
        }
    }
    for($x = $winners; $x < sizeof($players["name"]); $x++){
        $totalScore = $totalScore + $players["value"][$x];
    }
    for($x = 0; $x < $winners; $x++){
        $players["score"][$x] = $totalScore;
    }
    return true;
}

//display
function display(){
    for($x = 0; $x < 4; $x++){
        echo "<img id='player$x' src='players/$x.png' alt='$x' title='Player $x' width='70' >";
        for($y = 0; $y < sizeof($players["cards"]); $y++){
            $source = "cards/" . $players[$x]["cards"]["suit"] . "/" . $players[$x]["cards"]["value"] . ".png";
            echo "<img id='player$x_cards' src='$source' alt='card$x' title = 'Card $x' width='70' >";
        }
    }
    for($x = 0; $x < 4; $x++){
        echo "$players['name'][$x]: ";
    }
    for($x = 0; $x < 4; $x++){
        echo "score $players['value'][$x]"
    }
    
    
    return true;
}

?>