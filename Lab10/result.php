<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Анализатор Каспрук Д. Л.</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['text']) && $_POST['text']) {
            $text = $_POST['text'];
            echo "<p><i>Исходный текст:</i></p>";
            echo '<div class="src_text">' . $text . '</div>';
            test_it($text);
        } else {
            echo '<div class="src_error">Нет текста для анализа</div>';
        }

        echo "<a href=\"index.html\">Другой анализ</a><br><br>";
    }

    function test_it($text) {
        // определяем ассоциированный массив с цифрами
        $cifra = array('0' => true, '1' => true, '2' => true, '3' => true, '4' => true, '5' => true, '6' => true, '7' => true, '8' => true, '9' => true);
        
        // вводим переменные для хранения информации о:
        $cifra_amount = 0; // количество цифр в тексте
        $letter_amount = 0; // Количество букв в тексте
        $L_letter_amount = 0; // Количество строчных букв в тексте
        $U_letter_amount = 0; // Количество заглвных букв в тексте
        $punct_amount = 0; // Количество знаков препинаний в тексте
        $word = ''; // текущее слово
        $words = array(); // список всех слов
    
        for ($i = 0, $length = mb_strlen($text); $i < $length; $i++) { // перебираем все символы текста
            $char = mb_substr($text, $i, 1);
            if (array_key_exists($char, $cifra)) // если встретилась цифра
                $cifra_amount++; // увеличиваем счетчик цифр
            if (preg_match_all('/\pL/u', $char)){ // если встретилась буква
                $letter_amount++; // увеличиваем счетчик букв
                if (preg_match_all('/\p{Ll}/u', $char))
                    $L_letter_amount++;
                else
                    $U_letter_amount++;
            }
            if (preg_match_all('/\p{P}/u', $char)) // Счетчик знаков препинания
                $punct_amount++;
    
            // если в тексте встретился пробел, знак препинания или текст закончился
            if ($char == ' ' || $i == $length - 1 || mb_ereg('\p{P}', $char) || is_numeric($char)) {
                if ($word) {
                    $wordLower = mb_strtolower($word, 'UTF-8');
                    if (isset($words[$wordLower])) {
                        $words[$wordLower]++;
                    } else {
                        $words[$wordLower] = 1;
                    }
                }
                $word = '';
            } 
            else {
                $word .= $char;
            }
        }

        echo '<table>';
        echo '<tr><th>Тип информации</th><th>Количество</th></tr>';
        echo '<tr><td>Количество символов в тексте (включая пробелы)</td><td>' . mb_strlen($text, 'UTF-8') . '</td></tr>';
        echo '<tr><td>Количество букв</td><td>' . $letter_amount . '</td></tr>';
        echo '<tr><td>Количество строчных букв</td><td>' . $L_letter_amount . '</td></tr>';
        echo '<tr><td>Количество заглавных букв</td><td>' . $U_letter_amount . '</td></tr>';
        echo '<tr><td>Количество знаков препинания</td><td>' . $punct_amount . '</td></tr>';
        echo '<tr><td>Количество цифр</td><td>' . $cifra_amount . '</td></tr>';
        echo '<tr><td>Количество уникальных слов</td><td>' . count($words) . '</td></tr>';
        echo '</table>';
    
        // вызов функции для подсчета символов
        $symbs = test_symbs($text);

        echo '<table>';
        echo '<tr><th>Символ</th><th>Количество</th></tr>';
        foreach ($symbs as $char => $count) {
            echo "<tr><td>$char</td><td>$count</td></tr>";
        }
        echo '</table>';


        // вызов функции для подсчета слов и сортировки в алфавитном
        $sorted_words = sort_and_print_words($words);
        
        echo '<table>';
        echo '<tr><th>Слово</th><th>Количество</th></tr>';
        foreach ($sorted_words as $word) {
            echo "<tr><td>$word</td><td>{$words[$word]}</td></tr>";
        }
        echo '</table><br><br>';
    }
    
    
    function test_symbs($text){
        $symbs = array(); // массив символов текста
        $l_text=mb_strtolower( $text, 'UTF-8' ); // переводим текст в нижний регистр
        // последовательно перебираем все символы текста
        for($i=0; $i<mb_strlen($l_text, 'UTF-8'); $i++) {
            $char = mb_substr($l_text, $i, 1);
            if( isset($symbs[$char]) ) // если символ есть в массиве
                $symbs[$char]++; // увеличиваем счетчик повторов
            else // иначе
                $symbs[$char]=1; // добавляем символ в массив
        }
        return $symbs; // возвращаем массив с числом вхождений символов в тексте
    }

    function sort_and_print_words($words){
        $lowercaseWords = array_map('mb_strtolower', array_keys($words));
        asort($lowercaseWords);
        return $lowercaseWords;
    }
    ?>
</body>
</html>
