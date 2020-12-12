<html>
<head>
    <?php include 'partials/head.php'?>
    <title>Card game</title>
    <style>
        body {
            background-color: lightsalmon;
        }
        .list-group-item , .card {
            background-color: #f8f9fa !important;
            color: #111;
        }

        .lgtitle {
            background-color: #f0f1f2 !important;
            color: #111;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Welcome to the card game.</h1>
                <p>Please sign in or view the leaderboard below the sign-in box.</p>
                <div class="alert alert-warning">Compatibility warning: Doesn't work with Internet Explorer, as it hasn't seen a new version since 2013. Use Edge, Chrome or Firefox instead. This website is also not particularly mobile-optimised. Sorry about that...</div>
            </div>
        </div>
        <div class="row">
            <div class="card-group">
                <form class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item lgtitle">
                            <h2><img src="haddock.jpg" class="card-img-top" alt="YOUR NAME!"></h2>
                        </li>
                        <li class="list-group-item">
                            <div class="form-group">
                                <div class="label" for="p1name">Player 1</div>
                                <input type="text" id="p1name" class="form-control">
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-group">
                                <div class="label" for="p2name">Player 2</div>
                                <input type="text" id="p2name" class="form-control">
                            </div>
                        </li>
                    </ul>
                </form>
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item lgtitle">
                            <h2>Options</h2>
                        </li>
                        <li class="list-group-item lgtitle">
                            <h3>New game?</h3>
                        </li>
                        <li class="list-group-item">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="oldnew" id="new" value="new" checked>
                                <label class="form-check-label" for="new">
                                    New game
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="oldnew" id="old" value="old">
                                <label class="form-check-label" for="old">
                                    Continue existing game (specify compete URL below)
                                </label>
                                <input type="text" id="url" class="form-control">
                            </div>
                        </li>
                        <li class="list-group-item lgtitle">
                            <h3 class="">Difficulty</h3> <!-- Placebo option - has no effect on actual gameplay-->
                        </li>
                        <li class="list-group-item">
                            <small><i>This is a placebo. Or is it?</i></small>
                        </li>
                        <li class="list-group-item">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="difficulty" id="easy" value="easy" checked>
                                <label class="form-check-label" for="easy">
                                    Easy
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="difficulty" id="medium" value="medium">
                                <label class="form-check-label" for="medium">
                                    Medium
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="difficulty" id="hard" value="hard">
                                <label class="form-check-label" for="hard">
                                    Hard
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item lgtitle">
                            <h3 class="">Ready?</h3>
                        </li>
                        <li class="list-group-item">
                            <button class="btn btn-primary" id="submit">Let's go!</button>
                        </li>
                    </ul>
                </div>
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
        $('#submit').click(
            function () {
                $.post('authlogin.php', {p1name: $('#p1name').val(), p2name: $('#p2name').val()}).done(function(data){
                    if(data == "true"){
                        if($("input:radio[name=oldnew]:checked").val() == "new"){
                            window.location.href="game"
                        }
                        else if($("input:radio[name=oldnew]:checked").val() == "old"){
                            if ($('#url').val() == "") {
                                alert("Please enter a game URL.")
                            }else{
                                window.location.href=$('#url').val()
                            }
                        }
                    }
                    else{
                        alert(data)
                    }
                })
            }
        )

        $.getJSON("getleaderboard.php", function(data){
            data.forEach(function(item, index){
                $('tbody').html($('tbody').html()+ "\n <tr><td>"+item[0]+"</td><td>"+item[1]+"</td></tr>");
            }
            )
        })
    </script>
</body>
</html>
