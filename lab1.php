<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
          integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>LAB_1</title>
</head>

<body>


<div class="container content">
    <div class="row">
        <div class="col-12 header">
            <h3>Лабораторная №1 </h3>
            <h1>Гаджиев, Борисов P33202 </h1>
            <h2>Вариант 21053</h2>
        </div>
        <div class="col-12 graph ml-5"><img src="img/area.png"></div>
        <?php
        $start = microtime(True);
        if (isset($_POST['submit'])) {
            $x = (float)filter_input(INPUT_POST, 'x');
            $y = (float)filter_input(INPUT_POST, 'y');
            $r = (float)filter_input(INPUT_POST, 'r');
            $x_range = array(-2, -1.5, -1, -0.5, 0, 0.5, 1, 1.5, 2);

            $correct = False;
            if(!is_null($x) and !is_null($y) and !is_null($r) and in_array($x, $x_range) and $y >= -5 and $y <= 3 and $r >= 2 and $r <= 5) {
                $correct = True;
            }

            if ($correct){
                $hit = True;
                $halfR = $r / 2;

                if ($x >= 0 && $y <= 0 && $y>= ($x-$r)/2) {
                    $hit = true;
                }

                if ($x <= 0 && $y <= 0 && $x*$x+$y*$y<=$r*$r) {
                    $hit = true;
                }

                if ($x >= 0 && $y >= 0 && $x >= -$r && $y <= $halfR) {
                    $hit = true;
                }

                $hit_str = 'Промах';
                if ($hit) {
                    $hit_str = 'Попадание';
                }

                echo '<div class="col-12 mb-3">';
                echo '<h3>'.$hit_str.'</h3>';
                echo '</div>';
            } else {
                if(is_null($x) or !in_array($x, $x_range)) {
                    echo '<div class="col-12 mb-3" >';
                    echo '<h3>Не корректный X</h3>';
                    echo '</div>';
                }
                if(is_null($y) or $y < -5 or $y > 3) {
                    echo '<div class="col-12 mb-3" >';
                    echo '<h3>Не корректный Y</h3>';
                    echo '</div>';
                }
                if(is_null($r) or $r < 2 or $r > 5) {
                    echo '<div class="col-12 mb-3" >';
                    echo '<h3>Не корректный R</h3>';
                    echo '</div>';
                }
            }

        }
        ?>

        <form method="POST" action="lab1.php" class="forms">
            <div class="x">
                <p>Изменение X: Checkbox</p>
                <input type="hidden" name="x" id="x_field" value="100" required>
                <div class="form-check">
                    <input class="form-check-input x-button" type="checkbox" onclick="changeX(this)" value="-2">
                    <label class="form-check-label label">-2</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input x-button" type="checkbox" onclick="changeX(this)" value="-1.5">
                    <label class="form-check-label label">-1.5</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input x-button" type="checkbox" onclick="changeX(this)" value="-1">
                    <label class="form-check-label label">-1</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input x-button" type="checkbox" onclick="changeX(this)" value="-0.5">
                    <label class="form-check-label label">-0.5</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input x-button" type="checkbox" onclick="changeX(this)" value="0">
                    <label class="form-check-label label">0</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input x-button" type="checkbox" onclick="changeX(this)" value="0.5">
                    <label class="form-check-label label">0.5</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input x-button" type="checkbox" onclick="changeX(this)" value="1">
                    <label class="form-check-label label">1</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input x-button" type="checkbox" onclick="changeX(this)" value="1.5">
                    <label class="form-check-label label">1.5</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input x-button" type="checkbox" onclick="changeX(this)" value="2">
                    <label class="form-check-label label">2</label>
                </div>
            </div>
            <div class="col-12 Y-text mb-3">
                <p>Изменение Y: Text</p>
                <input id="y" name="y" type="text" class="form-control field" style="background-color:#55cff5;"
                       placeholder="Введите Y в диапозоне (-5..3)" required>
            </div>
            <div class="col-12 R-text mb-3">
                <p>Изменение R: Text</p>
                <input id="r" name="r" type="text" class="form-control field"  style="background-color:#55cff5; "
                       placeholder="Введите R в диапозоне (2..5)" required>
            </div>
            <div class="col-12 submit-button mb-3">
                <input class="btn btn-primary" type="submit" value="Отправить" name="submit">
            </div>
        </form>
        <?php
        if (isset($x, $y, $r, $hit_str, $start)) {
            $duration = microtime(True) - $start;
            $result = array(
                $x, $y, $r,
                $hit_str,
                time(),
                $duration
            );
            $_SESSION['results'][] = $result;
        }

        if (isset($_SESSION['results'])) {
            echo '<div class="col-12 mb-5">';
            echo '<table class = "tb" border="2">';
            echo '<tr>
                    <th>X</th>
                    <th>Y</th>
                    <th>R</th>
                    <th>Результат</th>
                    <th>Время работы</th>
                    <th>Текущее время</th>
                    </tr>';
            foreach ($_SESSION['results'] as $value) {
                $x_cur = $value[0];
                $y_cur = $value[1];
                $r_cur = $value[2];
                $hit_cur = $value[3];
                $time_cur = $value[4];
                $duration_cur = $value[5];

                $ftime = date('H:i:s', $time_cur);

                echo '<tr>';
                echo '<td>' .$x_cur .'</td>';
                echo '<td>' .$y_cur .'</td>';
                echo '<td>' .$r_cur .'</td>';
                echo '<td>' .$hit_cur .'</td>';
                echo '<td>' .sprintf('%.8f', $duration_cur) .'</td>';
                echo '<td>' .$ftime .'</td>';
            }
            echo '</div>';
        }
        ?>
    </div>
</div>

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
        crossorigin="anonymous">
</script>
<script src="./js/buttons.js"></script>
<script src="./js/inputValid.js"></script>

</body>
</html>

