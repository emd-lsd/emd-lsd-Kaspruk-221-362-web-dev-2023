<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная работа 9| Каспрук Дмитрий Леонидович | Группа 221-362 | Вариант 9</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <img src="uni_logo.png" alt="University Logo" class="logo">
        <h1>Лабораторная работа</h1>
        <p>Выполнил: Каспрук Дмитрий Леонидович<br>Группа: 221-362<br>Номер лабораторной работы: 9 Вариант: 9</p>
    </header>
    <main>
    <?php
        // Инициализация переменных
        $initialArgument = 1;
        $numValues = 10;
        $step = 1;
        $minValue = 1;
        $maxValue = 100;

        // Инициализация типа верстки
        $markupType = 'D';

        // Вычисление и вывод значений функции
        echo "<h2>Вычисление значений функции</h2>";

        switch ($markupType) {
            case 'A':
                echo "<p>Простая верстка текстом:</p>";
                for ($i = 0; $i < $numValues; $i++) {
                    $currentArgument = $initialArgument + $i * $step;
                    $functionValue = calculateFunction($currentArgument);
                    echo "f($currentArgument)=$functionValue<br>";
                }
                break;

            case 'B':
                echo "<p>Маркированный список:</p><ul>";
                for ($i = 0; $i < $numValues; $i++) {
                    $currentArgument = $initialArgument + $i * $step;
                    $functionValue = calculateFunction($currentArgument);
                    echo "<li>f($currentArgument)=$functionValue</li>";
                }
                echo "</ul>";
                break;

            case 'C':
                echo "<p>Нумерованный список:</p><ol>";
                for ($i = 0; $i < $numValues; $i++) {
                    $currentArgument = $initialArgument + $i * $step;
                    $functionValue = calculateFunction($currentArgument);
                    echo "<li>f($currentArgument)=$functionValue</li>";
                }
                echo "</ol>";
                break;

            case 'D':
                echo "<p>Табличная верстка:</p>";
                echo "<table border='1' cellspacing='0'>";
                echo "<tr><th>№</th><th>Аргумент</th><th>Значение функции</th></tr>";
                for ($i = 0; $i < $numValues; $i++) {
                    $currentArgument = $initialArgument + $i * $step;
                    $functionValue = calculateFunction($currentArgument);
                    echo "<tr><td>$i</td><td>$currentArgument</td><td>$functionValue</td></tr>";
                }
                echo "</table>";
                break;

            case 'E':
                echo "<p>Блочная верстка:</p>";
                for ($i = 0; $i < $numValues; $i++) {
                    $currentArgument = $initialArgument + $i * $step;
                    $functionValue = calculateFunction($currentArgument);
                    echo "<div style='border: 2px solid red; margin-right: 8px; display: inline-block; padding: 5px;'>";
                    echo "f($currentArgument)=$functionValue";
                    echo "</div>";
                }
                break;

            default:
                echo "Неверный тип верстки";
        }

        // Вычисление и вывод максимального, минимального, среднего и суммы значений функции
        $valuesArray = [];
        for ($i = 0; $i < $numValues; $i++) {
            $currentArgument = $initialArgument + $i * $step;
            $functionValue = calculateFunction($currentArgument);
            $valuesArray[] = $functionValue;
        }

        echo "<h2>Статистика значений функции</h2>";
        echo "Максимальное значение: " . round(max($valuesArray), 3) . "<br>";
        echo "Минимальное значение: " . round(min($valuesArray), 3) . "<br>";
        echo "Среднее арифметическое: " . round(array_sum($valuesArray) / count($valuesArray), 3) . "<br>";
        echo "Сумма значений: " . round(array_sum($valuesArray), 3) . "<br>";

        // Функция для вычисления значения функции
        function calculateFunction($x)
        {
            // Ваша функция здесь
            // f(x)={x^2 * (x-2)+4 при x<=10; 11x-55 При 10<x<20; (x-100)/(100-x)-x/10+2 при x>=20;}
            if ($x <= 10) {
                return round($x**2 * ($x - 2) + 4, 3);
            } elseif ($x > 10 && $x < 20) {
                return round(11 * $x - 55, 3);
            } elseif ($x >= 20) {
                // Проверка деления на ноль
                if (100 - $x == 0 || $x == 0) {
                    return "error";
                }
                return round(($x - 100) / (100 - $x) - $x / 10 + 2, 3);
            } else {
                return "error";
            }
        }
        ?>

        <?php
        // Вывод типа верстки в футере
        echo "<script>document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('footer p').innerText = 'Тип верстки: $markupType';
        });</script>";
        ?>

    </main>
    <footer>
        <p>Тип верстки:</p>
    </footer>
</body>
</html>
