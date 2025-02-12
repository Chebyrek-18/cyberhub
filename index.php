<?
include_once('./database/connect.php')
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Строймаг</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>

<body>
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
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        switch ($_GET['page']) {
            case 'auth':
                include_once('./page/authorization.php');
                exit;

            case 'register':
                include_once('./page/register.php');
                exit;

            case 'profile':
                include_once('./incl/header.php');
                include_once('./incl/profile.php');
                exit;

            case 'add':
                switch ($user_role) {
                    case 'admin':
                        include_once('./incl/header.php');
                        include_once('./incl/add.php');
                        exit;
                    case 'user':
                        header('Location:?page=home');
                        exit;
                    default:
                        break;
                }
                break;

            case 'exit':
                setcookie("user_id", "", time() - 3600);
                header('Location:?page=home');
                exit;

            case 'catalog':
                include_once('./incl/header.php');
                include_once('./incl/catalog.php');
                break;

            case 'edit_page':
                switch ($user_role) {
                    case 'admin':
                        include_once('./incl/header.php');
                        include_once('./incl/EditPage.php');
                        exit;
                    case 'user':
                        header('Location:?page=home');
                        exit;
                    default:
                        break;
                }
                break;

            case 'home':
                include_once('./incl/header.php');
                include_once('./incl/home.php');
                break;

            default:
                break;
        }
    } else {
        include_once('./incl/header.php');
        include_once('./incl/home.php');
    }
    include_once('./incl/footer.php');
    ?>
</body>

</html>