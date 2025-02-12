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
<div class="price container">
    <div class="top">
        <h2>Каталог</h2>
        <?
        if ($user_role == 'admin') { ?>
            <form method="post" name="add">
                <input type="submit" value="Добавить товар" name="add">
            </form>
        <?
            if (isset($_POST['add'])) {
                header('Location:?page=add');
                exit;
            }
        }
        ?>
    </div>
    <div class="cards">
        <?
        $sql = "SELECT `id`, `name`, `about`, `price`, `img` FROM `product`";
        $tovar = $connect->query($sql);
        foreach ($tovar as $result) {
        ?>
            <div class="card">
                <?
                if ($user_role == 'admin') { ?>
                    <p><?= $result['id'] ?></p>
                <?
                }
                ?>
                <div class="img">
                    <img src="<?= $result['img'] ?>" alt="">
                </div>
                <h3><?= $result['name'] ?></h3>
                <p><?= $result['about'] ?></p>
                <div class="price_btn">
                    <p><?= $result['price'] ?></p>
                    <?
                    if ($user_role == 'admin') { ?>
                        <a href="?page=edit_page&id_product=<?= $result['id'] ?>">Редактировать</a>
                    <? } else {
                    ?>
                        <input type="button" value="Купить">
                    <?
                    }
                    ?>
                </div>
            </div>
        <?
        } ?>
    </div>
</div>