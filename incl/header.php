<header class="container">
    <img src="/assets/image/logo-home.png" alt="Логотип" class="logo">
    <nav>
        <a href="?page=home">О нас</a>
        <a href="?page=catalog">Каталог</a>
        <a href="">Контакты</a>
    </nav>
    <?
    if (isset($_COOKIE['user_id'])) {
        $id = $_COOKIE['user_id'];
        $sql = "SELECT * FROM `user` WHERE `id` = '$id'";
        $result = $connect->query($sql)->fetch();
    ?>

        <div class="name_out">
            <a href="?page=profile">
                <?=
                $result['Name'];
                ?>
            </a>
            <a href="?page=exit">Выйти</a>
        </div>
    <? } else { ?>
        <form method="post" name="auth">
            <input type="submit" value="Войти" name="auth">
        </form>
        <?
        if (isset($_POST['auth'])) {
            header('Location:?page=auth');
            exit;
        }
        ?>

    <? }
    ?>
</header>