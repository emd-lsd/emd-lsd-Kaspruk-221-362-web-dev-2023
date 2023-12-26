<!DOCTYPE html>
<html>
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная работа №5</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>



<?php
    include 'db.php';
    $result = mysqli_query($mysql, 'SELECT * FROM terms');
?>

<h2>Таблица с данными о терминах программирования и их определениях</h2>
<table>
    <tr>
        <th>Термин</th>
        <th>Определение</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['term']; ?></td>
            <td><?php echo $row['definition']; ?></td>
        </tr>
    <?php } ?>
</table>

<h2>Набор картинок</h2>
<div class="box">
    <?php
    $result = mysqli_query($mysql, 'SELECT * FROM images');
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="filters__img">
            <img class="img-widget" title="<?php echo $row['name']; ?>" src="<?php echo $row['src']; ?>"/>
        </div>
        <?php
    }
    ?>
</div>
</body>
</html>