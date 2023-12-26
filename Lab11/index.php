<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Таблица умножения в разных верстках, Лабораторная №11</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <header>
        <div id="main_menu">
            <?php
            echo '<a href="?html_type=TABLE'; // начало ссылки ТАБЛИЧНАЯ ФОРМА
            if(isset($_GET['content']) ) // если параметр content был передан в скрипт
                echo '&content='.$_GET['content']; // добавляем в ссылку второй параметр
            echo '"'; // завершаем формирование адреса ссылки и закрываем кавычку

            // если в скрипт был передан параметр html_type и параметр равен TABLE
            if( array_key_exists('html_type', $_GET) && $_GET['html_type']== 'TABLE' )
                echo ' class="selected"'; // ссылка выделяется через CSS-класс
            echo '>Табличная верстка</a>'; // конец ссылки ТАБЛИЧНАЯ ФОРМА

            echo '<br>';

            echo '<a href="?html_type=DIV'; // начало ссылки БЛОЧНАЯ ФОРМА
            if( isset($_GET['content']) ) // если параметр content был передан в скрипт
                echo '&content='.$_GET['content']; // добавляем в ссылку второй параметр
            echo '"'; // завершаем формирование адреса ссылки и закрываем кавычку

            // если в скрипт был передан параметр html_type и параметр равен DIV
            if( array_key_exists('html_type', $_GET) && $_GET['html_type']== 'DIV' )
                echo ' class="selected"'; // ссылка выделяется через CSS-класс
            echo '>Блочная верстка</a>'; // конец ссылки БЛОКОВАЯ ФОРМА
            ?>
        </div> 
    </header>
    <main>
        <div class="inline">
            <div id="product_menu">
                <?php
                    echo '<a href="?content=n/a';
                    if (isset($_GET['html_type']))
                        echo '&html_type=' . $_GET['html_type'];
                    echo '"';

                    if (!isset($_GET['content'])||$_GET['content'] == "n/a") // если в скрипт НЕ был передан параметр content
                        echo ' class="selected"'; // ссылка выделяется через CSS-класс
                    echo '>Вся таблица умножения</a>'; // конец ссылки
                    
                    for( $i=2; $i<=9; $i++ ) // цикл со счетчиком от 2 до 9 включительно
                    {
                        echo '<a href="?content=' . $i . '';
                        if (isset($_GET['html_type']))
                            echo '&html_type=' . $_GET['html_type'];
                        echo '"';
                        if (isset($_GET['content']) && $_GET['content'] == $i)
                            echo ' class="selected"';
                        echo '>Таблица умножения на ' . $i . '</a>';
                    }
                ?>
            </div>

            <section class="exmple">
                <?php
                    if (!isset($_GET['html_type'])||$_GET['html_type']== 'TABLE' )
                        outTableForm(); // выводим таблицу умножения в табличной форме
                    else
                        outDivForm(); // выводим таблицу умножения в блочной форме
                ?>
            </section>
        </div>
        <?php
            // функция ВЫВОДИТ ТАБЛИЦУ УМНОЖЕНИЯ В ТАБЛИЧНОЙ ФОРМЕ
            function outTableForm() {
                // если параметр content не был передан в программу
                if( !isset($_GET['content'])||$_GET['content'] == 'n/a'){
                    for($i=2; $i<10; $i++) // цикл со счетчиком от 2 до 9
                    {
                        echo '<table class="tvRow">'; // оформляем таблицу в табличной форме
                        outRowTable( $i ); // вызывем функцию, формирующую содержание
                        // столбца умножения на $i (на 4, если $i==4)
                        echo '</table>';
                    }
                }
                else
                {
                    echo '<table class="tvSingleRow">'; // оформляем таблицу в табличной форме
                    outRowTable( $_GET['content'] ); // выводим выбранный в меню столбец
                    echo '</table>';
                } 
            }

            // функция ВЫВОДИТ ТАБЛИЦУ УМНОЖЕНИЯ В БЛОЧНОЙ ФОРМЕ
            function outDivForm () {
                // если параметр content не был передан в программу
                if( !isset($_GET['content'])||$_GET['content']=="n/a"){
                    for($i=2; $i<10; $i++) // цикл со счетчиком от 2 до 9
                    {
                        echo '<div class="ttRow">'; // оформляем таблицу в блочной форме
                        outRow( $i ); // вызывем функцию, формирующую содержание
                        // столбца умножения на $i (на 4, если $i==4)
                        echo '</div>';
                    }
                }
                else
                {
                    echo '<div class="ttSingleRow">'; // оформляем таблицу в блочной форме
                    outRow( $_GET['content'] ); // выводим выбранный в меню столбец
                    echo '</div>';
                } 
            }

            //функция ВЫВОДИТ СТОЛБЕЦ ТАБЛИЦЫ УМНОЖЕНИЯ ДЛЯ TABLE
            function outRowTable($n){
                for ($i=2; $i<=9; $i++){
                    echo '<tr><td>';
                    echo outNumAsLink($n);
                    echo 'x';
                    echo outNumAsLink($i);
                    echo '</td><td>';
                    echo outNumAsLink($i*$n);
                    echo '</td></tr>';
                }
            }


            // функция ВЫВОДИТ СТОЛБЕЦ ТАБЛИЦЫ УМНОЖЕНИЯ DIV
            function outRow ( $n ){
                for($i=2; $i<=9; $i++){
                    echo outNumAsLink($n);
                    echo 'x';
                    echo outNumAsLink($i);
                    echo '=';
                    echo outNumAsLink($i*$n).'<br>';

                } 
            } 


            //преобразует число в соответствующую ему ссылку (если это возможно) и возвращает ее. 
            function outNumAsLink( $x ) {
                if( $x<=9 ){
                    echo '<a href="?content='.$x.'&html_type=';
                    if (!isset($_GET['html_type']))
                        echo 'TABLE"';
                    else 
                        echo $_GET['html_type'].'"';
                    echo '>'.$x.'</a>';
                }
                else
                    echo $x;
            }
        ?>
    </main>

    <footer id="footer">
        <?php 
            date_default_timezone_set("Europe/Moscow");
            if (!isset($_GET['html_type']))
                echo 'Верстка не выбрана <br>';
            else if ($_GET['html_type']=="TABLE")
                echo 'Табличная верстка <br>';
            else
                echo 'Блочная верстка <br>';

            if( !isset($_GET['content']) || $_GET['content'] == 'n/a')
                $s='Таблица умножения полностью. <br>';
            else
                $s='Столбец таблицы умножения на '.$_GET['content']. '. <br>';
            echo $s.date('d.Y.M h:i:s'); 
        ?>
    </footer>
</body>
</html>