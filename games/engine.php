<?php
/*

Choo choo I'm a steam engine!

  o O___ _________
 _][__|o| |O O O O|
<_______|-|_______|
 /O-O-O     o   o

 */

 //card - [['red',2],10]

function is_greater_than($card1, $card2){
    if ($card1['number'] > $card2['number']){
        if (($card1['colour'][1] > $card2['colour'][1]) or ($card1['colour'][0] == "yellow" and $card2['colour'][0] == "red")){
            return true;
        }
        else{
            return false;
        }
    }
    else{
    return false;
    }
}

// Function adapted from one by https://stackoverflow.com/users/119212/instanceof-me
function base64($num) {
    $index = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
    $res = '';
    do {
      $res = $index[$num % 62] . $res;
      $num = intval($num / 62);
    } while ($num);
    return $res;
  }

$hand = [];

for ($number=1;$number<=10;$number++){
	foreach([['Red',2], ['Black',1], ['Yellow',0]] as $i){
        array_push($hand, ['colour'=>$i,'number'=>$number]);
    }
}
		
shuffle($hand);
$cleanhand = [];
foreach($hand as $i){
    array_push($cleanhand, ['colour'=>$i['colour'][0],'number'=>$i['number']]);
}

$player1hand = [];
$player2hand = [];

$winners = [];
$rounds = [];

// Each round: []
for ($i=0; $i < sizeof($hand); $i+=2){
    $round = [$cleanhand[$i], $cleanhand[$i+1]];
	if (is_greater_than($hand[$i], $hand[$i+1])){
		array_push($rounds, ['player1'=>$cleanhand[$i], 'player2'=>$cleanhand[$i+1], "1"]);
        array_push($player1hand, $round[0]);
        array_push($player1hand, $round[1]);
    }
	else{
        array_push($rounds, ['player1'=>$cleanhand[$i], 'player2'=>$cleanhand[$i+1], 'winner'=>"2"]);
        array_push($player2hand, $round[0]);
        array_push($player2hand, $round[1]);
    }
}

$gameno = file_get_contents("current.txt");

$gameid = base64($gameno);

file_put_contents($gameid.'.json', json_encode(Array("rounds"=>$rounds,"player1hand"=>$player1hand,"player2hand"=>$player2hand)));

//Comment out to not change gameid between rounds
file_put_contents("current.txt", $gameno+1);

echo $gameid;

?>