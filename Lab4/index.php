<?php include 'header.html'; ?>

<form action="home.php" method="POST">
    <label for="name">ФИО:</label>
    <input type="text" name="name" id="name" required value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>"><br>

    <label for="email">Ваш е‐майл:</label>
    <input type="email" name="email" id="email" placeholder="example@example.com" required value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>"><br>

    <label for="message">Сообщение:</label>
    <textarea name="message" id="message" required></textarea><br>

    <label for="category">Тема обращения:</label>
    <select name="category" id="category" required>
        <option value="proposal">Предложение</option>
        <option value="complaint">Жалоба</option>
    </select><br>

    <label for="attachment">Вложения:</label>
    
    <input class="com-inp" type="file" id="attachment" name="attachment"><br>

    <label for="consent">Даю согласие на обработку данных:</label>
    <input type="checkbox" name="consent" id="consent" required><br>

    <label>Источник информации:</label>
    <input type="radio" name="source" value="internet" required <?php echo isset($_GET['source']) && $_GET['source'] === 'internet' ? 'checked' : ''; ?>>Реклама из интернета
    <input type="radio" name="source" value="friends" required <?php echo isset($_GET['source']) && $_GET['source'] === 'friends' ? 'checked' : ''; ?>>Рассказали друзья<br>

    <input type="submit" value="Отправить">
</form>

</body>
</html>
