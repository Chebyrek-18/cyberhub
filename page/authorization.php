<div class="autoriz">
    <form method="post" class="reg_form" name="auth">
        <p><?= $errors['valid'] ?? '' ?></p>
        <input class="input_text" type="text" name="email" placeholder="email">
        <p><?= $errors["email"] ?? '' ?></p>
        <input class="input_text" type="password" name="password" placeholder="Пароль">
        <p><?= $errors["password"] ?? '' ?></p>
        <input class="reg_btn" type="submit" value="Войти" name="auth">
        <a href="?page=register">Нет аккаунта</a>
        <a href="?page=home">Отмена</a>
    </form>
    <h2><?= $_COOKIE['id'] ?></h2>
</div>

<?php
if (isset($_POST['auth'])) {
    $errors = [];
    if (empty($_POST['email'])) {
        $errors["email"] = "Поле email обязательное";
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Некорректный email";
    }
    if (empty($_POST['password'])) {
        $errors["password"] = "Поле password обязательное";
    }
    if (count($errors) <= 0) {
        $email = $_POST['email'];
        $sql = "SELECT `id`, `email`, `password`, `user_role_id`, `Name` FROM `user` WHERE `email`='$email'";
        $result = $connect->query($sql)->fetch();
        if (!empty($result['email'])) {
            if ($result['password'] != $_POST['password']) {
                $errors['valid'] = "Неверный пароль или почта";
            } else {
                setcookie('user_id', $result['id'], time() + (3600 * 1), "/");
                header('Location:?page=home');
                exit;
            }
        } else {
            $errors["valid"] = "Неверный пароль или почта";
        }
    }
}
