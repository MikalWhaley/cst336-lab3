<!DOCTYPE html>

<html>
    <head>
        <title> SilverJack </title>
        <link href="styles.css" rel="stylesheet" type="text/css" />
        <style>
        </style>
    </head>
    <body>
        <h1>
            "SILVERJACK"
        </h1>
        <div id="main">
            <?php
                $count = 1;
                include 'functionsA.php';
                $starttime = microtime(true);
                play();
                $endtime = microtime(true);
                $timediff = $endtime - $starttime;
                echo "<h2 id='output'> Elapsed time: $timediff seconds </h2>";
            ?>
            <?php session_start()?>
            <form name="testForm" method="post">
            <?php 
                if (empty($_SESSION['cnt'])){
                    $_SESSION['cnt'] = 0;
                    $_SESSION['total_time'] = 0;
                    echo "<h2 id='output'> Average elapsed time: $timediff seconds </h2>";
                    echo "<h2 id='output'> Games played: 1 </h2>";
                }
            ?>

            <input type="submit" name="next" id="next" value='"PLAY AGAIN"'/>

            <?php
                 if(isset($_POST['next'])){
                    $_SESSION['cnt']++;
                    $_SESSION['total_time'] = $_SESSION['total_time'] + $timediff;
                    $count = $_SESSION['cnt'] + 1;
                    $average = $_SESSION['total_time'] / $count;
                    echo "<h2 id='output'> Average elapsed time: $average seconds </h2>";
                    echo "<h2 id='output'> Games played: $count </h2>";
                }
            ?>
            </form>

        </div>
        
    </body>
</html>