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
	foreach([['bg-danger',2], ['bg-dark',1], ['bg-warning',0]] as $i){
        array_push($hand, ['colour'=>$i,'number'=>$number]);
    }
}
		
shuffle($hand);
$cleanhand = [];
foreach($hand as $i){
    array_push($cleanhand, ['colour'=>$i['colour'][0],'number'=>$i['number']]);
}

$p1hand = [];
$p2hand = [];

$winners = [];
$rounds = [];

// Each round: []
for ($i=0; $i < sizeof($hand); $i+=2){
    $round = [$cleanhand[$i], $cleanhand[$i+1]];
	if (is_greater_than($hand[$i], $hand[$i+1])){
		array_push($rounds, ['p1'=>$cleanhand[$i], 'p2'=>$cleanhand[$i+1], "1"]);
        array_push($p1hand, $round[0]);
        array_push($p1hand, $round[1]);
    }
	else{
        array_push($rounds, ['p1'=>$cleanhand[$i], 'p2'=>$cleanhand[$i+1], 'winner'=>"2"]);
        array_push($p2hand, $round[0]);
        array_push($p2hand, $round[1]);
    }
}

$gameno = file_get_contents("____current.txt");

$gameid = base64($gameno);

if (count($p1hand)>count($p2hand)){$winner="1";$loser="2";}
elseif (count($p2hand)>count($p1hand)){$winner="2";$loser="1";}
else {$winner = "!!Oh dear. The computer messed up.!!";}

file_put_contents($gameid.'.json', json_encode(Array("winner"=>$winner, "loser" => $loser, "rounds"=>$rounds,"p1hand"=>$p1hand,"p2hand"=>$p2hand)));

//Comment out to not change gameid between rounds
file_put_contents("____current.txt", $gameno+1);

echo $gameid;

?>