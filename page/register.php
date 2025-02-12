<div class="reg">
    <form method="post" class="reg_form" name="register">
        <input class="input_text" type="text" name="email" placeholder="Почта">
        <p><?= $errors["email"] ?? '' ?></p>
        <input class="input_text" type="password" name="password" placeholder="Пароль">
        <p><?= $errors["password"] ?? '' ?></p>
        <input class="input_text" type="text" name="name" placeholder="Имя">
        <p><?= $errors["name"] ?? '' ?></p>
        <input class="reg_btn" type="submit" value="Зарегистрироваться" name="register">
        <a href="?page=auth">Уже есть аккаунт</a>
        <a href="?page=home">Отмена</a>
    </form>
</div>

<?
if (isset($_POST['register'])) {
    $errors = [];
    if (empty($_POST['email'])) {
        $errors['email'] = 'это поле обязательно';
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Некоретная почта';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'это поле обязательно';
    } else if (strlen($_POST['password']) < 6) {
        $errors['password'] = 'Минимальная длина поля 6 символов';
    } else if (strlen($_POST['password']) > 20) {
        $errors['password'] = 'Максимальная длина поля 20 символов';
    }
    if (empty($_POST['name'])) {
        $errors['name'] = 'это поле обязательно';
    }
    if (count($errors) <= 0) {

        $email = $_POST['email'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $sql = "INSERT INTO `user`(`email`, `password`, `Name`) 
        VALUES ('$email','$password','$name')";
        $connect->query($sql);
        header('Location:?page=auth');
        exit;
    }
}
?>