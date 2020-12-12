<?php
session_start();
if (!isset($_SESSION['p1'])){
    header("Location: ../?please_sign_in");
    exit();
}
?>
<html>
<head>
    <?php include '../partials/head.php';
    $get = array_map('htmlspecialchars', $_GET);?>
    <title>Card game</title>
    <style>
        body{background-color: yellow;}
        .pcard {
            margin:auto auto;
            padding: .375rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
           /* background-color: #fff;
            background-clip: padding-box;*/
            border: 5px solid black;
            border-radius: 2rem;
            box-shadow: 10px 10px grey;
            min-width: 25%;
            text-align:center;
            /*height: 40vw;*/
            color:white;
            text-shadow: -1px -1px 0 rgba(0,0,0,1), 1px -1px 0 rgba(0,0,0,1), -1px 1px 0 rgba(0,0,0,1), 1px 1px 0 rgba(0,0,0,1), -2px -2px 0 white, 1px -2px 0 white, -2px 1px 0 white, 1px 1px 0 white;
            font-size: 10rem;
        }

        .pcard2 {
            border: 5px solid white;
            border-radius: 2rem;
            margin:1rem;
            height:100%
        }

        .blank-card {
            color: transparent;
            border: 5px solid transparent;
            box-shadow: 10px 10px transparent;
            color: transparent;
            text-shadow: unset;
            text-shadow: -1px -1px 0 transparent, 1px -1px 0 transparent, -1px 1px 0 transparent, 1px 1px 0 transparent, -2px -2px 0 transparent, 1px -2px 0 transparent, -2px 1px 0 transparent, 1px 1px 0 transparent;
        }

        .blank-card > .pcard2 {
            border-color: transparent;
        }

        .pcard-small {
            font-size: 5rem;
            display:inline-block;
            min-width:12vw;
            margin:15px;
        }
        .pcard-small > .pcard2 {
           height:9rem;
           margin:0.5rem;
        }
        
    </style>
</head>
<body>
    <!--
    -->
<div class="container" id="card-screen">
    <div class="row">
        <div class="col">
            <h1><?php echo $_SESSION['p1']??'Player 1';?>'s card</h1>
        </div>
        <div class="col">
            <div class="h1"><?php echo $_SESSION['p2']??'Player 2';?>'s card</div>
        </div>
    </div>
    <div class="row">
        <div class="col"><span class="badge badge-success" style="display:none" id="p1win">Won this round!</span></div>
        <div class="col"><span class="badge badge-success" style="display:none" id="p2win">Won this round!</span></div>
    </div>
    <div class="row" >
        <div class="col">
            <div class="pcard blank-card" id="p1col">
                <div class="pcard2" id="p1">11<!-- Number goes here --></div>
            </div>
        </div>
        <div class="col">
            <div class="pcard blank-card" id="p2col">
                <div class="pcard2" id="p2">11<!-- Number goes here--></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button class="btn btn-primary" id="nextcard" style="width:100%;display:block;">Draw new cards</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="alert alert-info"><i>Note: To pick up a game at a later date, copy down the URL, and type it into the box when you next sign in.</i></div>
        </div>
    </div>
</div>

<div class="container" id="gameover" style="display:none">
    <div class="row">
        <div class="col">
            <h1>Game over!</h1>
            <h2><span id="winner"></span> won.</h2>
            <h3>Look at their hand and feel sad.</h3>
        </div>
    </div>

    <div class="row">
        <div class="col" id="wincards">

        </div>
    </div>

    <div class="row">
        <div class="col">
            <h2><span id="loser"></span> is an absolute loser.</h2>
            <h3>Here's their hand:</h3>
        </div>
    </div>    
    <div class="row">
        <div class="col" id="losecards">

        </div>
    </div>
    <div class="row">
        <div class="col"><h1>Leaderboard</h1></div>
    </div>
    <div class="row">
            <div class="col">                
                    <table class="table bg-white">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Score</th>
                            </tr>
                        </thead>
                        <tbody>
                
                        </tbody>
                    </table>
            </div>
        </div>
</div>
<script>
    'use strict'; var curr_card=<?php echo $get['pos'] ?? -1?>;

    function set_param(param, value) { // Changes URL 'get' parameters
        var href = new URL(window.location)
        href.searchParams.set(param, value)
        history.pushState({}, null, href.toString())
    }

    function game_over(fade=true){
        $('#nextcard').remove()
        if (fade){
            $('#card-screen').fadeOut(1000, function(){
            $('#gameover').fadeIn(1000)})
        }
        else{
            $('#card-screen').hide()
            $('#gameover').show()
        }
    }

    function next_card (game_data) {
        curr_card += 1
        set_param('pos', curr_card)

        if(curr_card<15){
            ["p1","p2"].forEach(function(i){
                $('#'+i+'col').removeClass().addClass([game_data['rounds'][curr_card][i]['colour'], "pcard"])
                $('.pcard2#'+i).text(game_data['rounds'][curr_card][i]['number'])
            })
            console.log("Current card: ", curr_card)
            if(curr_card==14){
                game_over()
            }
        }
    }

    function generate_game_over_screen (game_data) {

        var names = {'1':'<?php echo $_SESSION['p1']??'Player 1';?>', '2':'<?php echo $_SESSION['p2']??'Player 2';?>'}

        game_data['p'+game_data['winner']+'hand'].forEach(function(i){
            $('#wincards').html($('#wincards').html() + '<div class="pcard pcard-small '+i['colour']+'"><div class="pcard2">'+i['number']+'</div></div>')
        })
        $('#winner').text(names[game_data['winner']])
        game_data['p'+game_data['loser']+'hand'].forEach(function(i){
            $('#losecards').html($('#losecards').html() + '<div class="pcard pcard-small '+i['colour']+'"><div class="pcard2">'+i['number']+'</div></div>')
        })
        $('#loser').text(names[game_data['loser']])

        // Sets up leaderboard
        $.getJSON("../getleaderboard.php", function(data){
            data.forEach(function(item, index){
                $('tbody').html($('tbody').html()+ "\n <tr><td>"+item[0]+"</td><td>"+item[1]+"</td></tr>");
            }
            )
        })
    }

    function setup (game_id) {
        console.log("Game ID: ",game_id)
        $.getJSON("../games/"+game_id+'.json', function(data){
            generate_game_over_screen(data)
            $('#nextcard').click(function(){next_card(data)})

            //Alternative setup if someone resumes a game (shows the cards before the button press if they are picking up mid-game, and jumps straight to game over if they are picking up at the end)
            if (curr_card>-1){
                curr_card -= 1
                next_card(data)
            }
            else if (curr_card == 14) {
                game_over(false)
            }
        })

    }


    <?php // If provided with a gameid in the URL, sets up game with that id. Otherwise, gets a new one and sets up game with that.
    if (isset($get['id'])) {
        echo 'setup("'.$get['id'].'")';
    }
    
    else {
        echo '// Gets a gameid and starts the setup process with it
        $.get( "../games/____engine.php", function( data ) {
                setup(data)
                set_param("id", data)
        });;';
    }?>
</script>
</body>
</html>