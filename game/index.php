<html>
<head>
    <?php include '../partials/head.php'?>
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
            min-width: 20vw;
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
<div class="container" id="card-screen">
    <div class="row">
        <div class="col">
            <h1>Player 1's card</h1>
        </div>
        <div class="col">
            <div class="h1">Player 2's card</div>
        </div>
    </div>
    <div class="row" >
        <div class="col">
            <div class="pcard blank-card" id="p1col">
                <div class="pcard2" id="p1">X</div>
            </div>
        </div>
        <div class="col">
            <div class="pcard blank-card" id="p2col">
                <div class="pcard2" id="p2">X</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button class="btn- btn-primary" id="nextcard" style="width:100%">Draw new cards</button>
        </div>
    </div>
</div>

<div class="container" id="gameover" style="display:none">
    <div class="row">
        <div class="col">
            <h1>Game over!</h1>
            <h2>Player <span id="winner"></span> won.</h2>
            <h3>Look at their hand and feel sad.</h3>
        </div>
    </div>

    <div class="row">
        <div class="col" id="wincards">

        </div>
    </div>

    <div class="row">
        <div class="col">
            <h2>Player <span id="loser"></span> is an absolute loser.</h2>
            <h3>Here's their hand:</h3>
        </div>
    </div>    
    <div class="row">
        <div class="col" id="losecards">

        </div>
    </div>
</div>
<!-- var treeData = JSON.parse(ajaxFunction('jsonfile.php'));-->
<script>
    'use strict';
    function game_over(){
        $('#nextcard').remove()
        $('#card-screen').fadeOut(1000, function(){
        $('#gameover').fadeIn(1000)})
    }

    function next_card (game_data) {
        if (curr_card = null){
            var curr_card = 0;
        }
        if(curr_card<15){
            ["p1","p2"].forEach(function(i){
                $('#'+i+'col').removeClass().addClass([game_data['rounds'][curr_card][i]['colour'], "pcard"])
                $('.pcard2#'+i).text(game_data['rounds'][curr_card][i]['number'])
            })
            console.log(curr_card)
            if(curr_card==14){
                game_over()
            }
        }
        curr_card+=1
    }

    function generate_game_over_screen (game_data) {

        game_data['p'+game_data['winner']+'hand'].forEach(function(i){
            $('#wincards').html($('#wincards').html() + '<div class="pcard pcard-small '+i['colour']+'"><div class="pcard2">'+i['number']+'</div></div>')
        })
        $('#winner').text(game_data['winner'])
        game_data['p'+game_data['loser']+'hand'].forEach(function(i){
            $('#losecards').html($('#losecards').html() + '<div class="pcard pcard-small '+i['colour']+'"><div class="pcard2">'+i['number']+'</div></div>')
        })
        $('#loser').text(game_data['loser'])
    }

    function setup (game_data) {
        console.log(game_data)
        generate_game_over_screen(game_data)
        $('#nextcard').click(function(){next_card(game_data)})
    }

    //Gets a gameid
    $.get( "../games/____engine.php", function( data ) {
        console.log(data)
        $.getJSON('../games/'+data+'.json', function(data){
            setup(data)
        })
    });
</script>
</body>
</html>