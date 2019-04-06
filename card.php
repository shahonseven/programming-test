<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Playing Cards</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        ol {
            counter-reset: item;
            margin-left: 0;
            padding-left: 0;
        }
        li {
            display: block;
            margin-bottom: .5em;
            margin-left: 2em;
        }
        li::before {
            display: inline-block;
            content: "Player " counter(item) ": ";
            counter-increment: item;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Playing Cards</a>
    </nav>
    <div class="p-5">
        <div class="row">
            <div class="col-sm-8">
                <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                    <div class="form-group row">
                        <label for="numOfPlayers" class="col-sm-3 col-form-label">Number Of Players</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="numOfPlayers" name="numOfPlayers" value="<?= isset($_POST['numOfPlayers']) ? $_POST['numOfPlayers'] : '' ?>">
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-primary mb-2">Deal Cards!</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-4">
                <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                    <button type="submit" class="btn btn-danger mb-2" name="irregularity">Irregularity</button>
                </form>
            </div>
        </div>

        <?php
        $totalCardsInDeck = 52;

        if (!empty($_POST)) {
            if (isset($_POST['irregularity'])) {
                echo '<div class="alert alert-danger" role="alert">Irregularity occurred</div>';
                return;
            }

            // check for null or invalid value
            if (empty($_POST['numOfPlayers']) 
                or !is_numeric($_POST['numOfPlayers']) 
                or $_POST['numOfPlayers'] < 1)
            {
                echo '<div class="alert alert-danger" role="alert">Input value does not exist or value is invalid</div>';
                return;
            }

            // build deck
            $deck  = [];
            $suits = ['C', 'D', 'H', 'S',];
            $cards = ['A', 2, 3, 4, 5, 6, 7, 8, 9, 'X', 'J', 'Q', 'K',];
            foreach ($suits as $suit) {
                foreach ($cards as $card) {
                    $deck[] = "$suit-$card";
                }
            }

            // deal cards to players
            $players = [];
            $totalPlayers = (int) $_POST['numOfPlayers'];

            for ($i = 0; $i < $totalCardsInDeck; $i++) {
                for ($j = 0; $j < $totalPlayers; $j++) {
                    shuffle($deck);
                    if (!empty($deck)) {
                        $players[$j][] = array_shift($deck);
                    }
                }
            }

            // display results
            echo '<h4>Results</h4>';
            echo '<ol>';
            foreach ($players as $player => $cards) {
                echo '<li> ' . implode(', ', $cards) . '</li>';
            }
            echo '</ol>';
        }
        ?>
    </div>
</body>
</html>
