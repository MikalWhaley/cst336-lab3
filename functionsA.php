<?php

//setup
function setup(){
    return true;
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
    arsort($players);
    foreach($players as $key => $value){
        if($value > 42){
            next;
        }
        else if($value == $players[0]["value"]){
            $winners = $winners + 1;
        }
    }
    for($x = $winners; $x < sizeof($players); $x++){
        $totalScore = $totalScore + $players[$x]["value"];
    }
    for($x = 0; $x < $winners; $x++){
        $players[$x]["score"] = $totalScore;
    }
    return true;
}

//display
function display(){
    
    return true;
}

?>