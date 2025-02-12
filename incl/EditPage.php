<?
if (isset($_GET['id_product'])) {
    $id = $_GET['id_product'];
    $sql = "SELECT `id`, `name`, `about`, `price`, `img` FROM `product` WHERE `id`='$id'";
    $result = $connect->query($sql)->fetch();
?>
    <h2 class="container">Редактирование товара</h2>
    <div class="result container">
        <h3><?= $result['name'] ?></h3>
        <img src="<?= $result['img'] ?> " alt="">
        <p>цена <?= $result['price']; ?></p>
        <p>Вес <?= $result['about']; ?></p>
        <br>
        <form method="post">
            <input type="submit" name="p_delete" value="Удалить данный товар">
        </form>
        <?
        if (isset($_POST['p_delete'])) {
            $sql = "DELETE FROM `product` WHERE `id`='$id'";
            $connect->query($sql);
            header('Location:?page=catalog');
            exit;
        }
        ?>
    </div>
    <br>
    <h3 class="container">Выберите что обновить</h3>
    <form method="post" name="update" enctype="multipart/form-data" class="container">
        <input type="text" name="name" value="<?= $result['name'] ?>" placeholder="Название">
        <?
        if (isset($_POST['update'])) {
            if (empty($_POST['name'])) {
                $name = $result['name'];
            } else {
                $name = $_POST['name'];
            }
        }
        ?>
        <input type="text" name="price" value="<?= $result['price'] ?>" placeholder="цена">
        <?
        if (isset($_POST['update'])) {
            if (empty($_POST['price'])) {
                $price = $result['price'];
            } else {
                $price = $_POST['price'];
            }
        }
        ?>
        <input type="file" name="img">
        <input type="text" name="about" value="<?= $result['about'] ?>" placeholder="Вес">
        <?
        if (isset($_POST['update'])) {
            if (empty($_POST['about'])) {
                $about = $result['about'];
            } else {
                $about = $_POST['about'];
            }
        }
        ?>
        <input type="submit" value="Обновить" name="update">
    </form>
    </div>
<?
}
if (isset($_POST['update'])) {
    if (empty($_FILES['img']['name'])) {
        $img = $result['img'];
    } else {
        unlink($result['img']);
        $extension = new SplFileInfo($_FILES['img']['name']);
        $_FILES['img']['name'] = $name . '.' . $extension->getExtension();
        $img = "assets/image/" . time() . $_FILES['img']['name'];
        move_uploaded_file($_FILES['img']['tmp_name'], $img);
    }
    $sql = "UPDATE `product` SET 
    `name`='$name',
    `price`='$price',
    `img`='$img',
    `about`='$about' 
    WHERE `id`='$id'";
    $connect->query($sql);
    header('Location:?page=catalog');
    exit;
}
?>