<?php include 'header.html'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $category = $_POST['category'];
    $attachment = $_POST['attachment'] ?? '';

    echo "<p>Здравствуйте, $name</p>";

    if ($category === 'proposal') {
        echo "<p>Спасибо за ваше предложение:</p>";
    } elseif ($category === 'complaint') {
        echo "<p>Мы рассмотрим Вашу жалобу:</p>";
    }

    echo "<textarea>$message</textarea>";

    if ($attachment !== '') {
        echo "Вы приложили следующий файл: $attachment";
    }

    echo '<a class="btn" href="index.php?name=' . urlencode($name) . '&email=' . urlencode($email) . '&source=' . urlencode($_POST['source']) . '"><br>Заполнить снова</a>';
}
?>

</body>
</html>
