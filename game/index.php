<html>
<head>
    <?php include '../partials/head.php'?>
    <title>Card game</title>
    <style>
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
            width: 20vw;
            text-align:center;
            /*height: 40vw;*/
            color:white;
            text-shadow: -1px -1px 0 rgba(0,0,0,1), 1px -1px 0 rgba(0,0,0,1), -1px 1px 0 rgba(0,0,0,1), 1px 1px 0 rgba(0,0,0,1), -2px -2px 0 white, 1px -2px 0 white, -2px 1px 0 white, 1px 1px 0 white;
            font-size: 10rem;
        }

        .pcard2{
            border: 5px solid white;
            border-radius: 2rem;
            margin:1rem;
            height:100%
        }
        
    </style>
</head>
<body>
<div class="container">
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
            <div class="pcard bg-dark">
                <div class="pcard2">2</div>
            </div>
        </div>
        <div class="col">
            <div class="pcard bg-danger">
                <div class="pcard2">6</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button class="btn- btn-primary" style="width:100%">Draw new cards</button>
        </div>
    </div>
</div>
<!-- var treeData = JSON.parse(ajaxFunction('jsonfile.php'));-->
<script>
    
</script>
</body>
</html>