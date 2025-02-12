<?
if (isset($_COOKIE['user_id'])) {
    $id = $_COOKIE['user_id'];
    $sql = "SELECT * FROM `user` WHERE `id` = '$id'";
    $result = $connect->query($sql)->fetch();
    if (1 == $result['user_role_id']) {
        $user_role = 'admin';
    } else {
        $user_role = 'user';
    }
}
?>
<form method="post" class="container">
    <input type="text" name="name" placeholder="Имя" value="<?= $result['Name'] ?>">
    <input type="text" name="email" placeholder="Почта" value="<?= $result['email'] ?>">
    <input type="text" name="password" placeholder="Пароль" value="<?= $result['password'] ?>">
    <input type="submit" value="Обновить данные" name="edit_profile">
</form>

<?
if (isset($_POST['edit_profile'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "UPDATE `user` SET 
    `name`='$name',
    `email`='$email',
    `password`='$password'
    WHERE `id`='$id'";
    $connect->query($sql);
    header('Location:?page=profile&id=' . $id);
    exit;
}

if ($user_role == 'admin') {
    $sql = "SELECT * FROM `user`";
    $result = $connect->query($sql);
?>
    <h3 class="container" z>Все пользователи</h3>
    <?
    foreach ($result as $users) {
    ?>
        <form method="post" class="container">

            <input name="id" type="text" value="<?= $users['id'] ?>" readonly>
            <input type="text" name="name" value="<?= $users['Name'] ?>">
            <input type="email" name="email" value="<?= $users['email'] ?>">
            <input type="text" name="password" value="<?= $users['password'] ?>">
            <input type="text" name="user_role_id" value="<?= $users['user_role_id'] ?>">
            <input type="submit" value="Изменить" name="update">
            <input type="submit" value="Удалить" name="delete">
            <br>
        </form>
<?
    }
}
?>

<?
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $uri = $_POST['user_role_id'];
    $sql = "UPDATE `user` SET 
        `Name`='$name',
        `password`='$password',
        `user_role_id`='$uri',
        `email` = '$email'
        WHERE `id`='$id'";

    $connect->query($sql);
    header('Location:?page=profile');
    exit;
} else if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM `user` WHERE `id`='$id'";
    $connect->query($sql);
    header('Location:?page=profile');
    exit;
}
?>