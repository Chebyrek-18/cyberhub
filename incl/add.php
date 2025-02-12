<?php
if (isset($_POST["add"])) {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $img = $_POST["img"];
    $about = $_POST["about"];
    $extension = new SplFileInfo($_FILES['img']['name']);
    $_FILES['img']['name'] = $name . '.' . $extension->getExtension();
    $img = "assets/image/" . time() . $_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'], $img);

    $flag = true;

    $errors = [
        '<p class="error">Введите данные</p>'
    ];
}
?>
<div class="product_block container">
    <h2>Добавление товара</h2>
    <form method="post" name="add" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Название товара">
        <?
        if (isset($_POST['add'])) {
            if (empty($name)) {
                $flag = false;
                echo $errors[0];
            }
        }
        ?>
        <input type="text" name="price" placeholder="цена">
        <?
        if (isset($_POST['add'])) {
            if (empty($price)) {
                $flag = false;
                echo $errors[0];
            }
        }
        ?>
        <input type="file" name="img">
        <input type="text" name="about" placeholder="о товаре">
        <?
        if (isset($_POST['add'])) {
            if (empty($about)) {
                $flag = false;
                echo $errors[0];
            }
        }
        ?>
        <input type="submit" value="Добавить" name="add">
    </form>
</div>

<?
if (isset($_POST['add'])) {
    if ($flag) {
        $sql = "INSERT INTO `product` (`name`, `price`, `img`, `about`)
            VALUES ('$name','$price','$img','$about')";
        $result = $connect->query($sql);
        header('Location:?page=catalog');
        exit;
    }
}
?>