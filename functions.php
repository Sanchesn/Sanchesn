<?php
require('./config.php');
function get_header($title = '') {
    if ($title != '') $title = ' | '.$title;
    $head = <<<HEAD
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="/assets/css/theme.css">
        <link rel="stylesheet" href="/assets/css/all.min.css">
        <title>{$GLOBALS['config']['base']['siteName']}{$title}</title>
    </head>
    <body>

HEAD;
    return $head;
}

function get_footer() {
    $footer = <<<FOOTER


    <footer class="text-center">
        Магазин компьютерных акссесуаров PRO
    </footer>
    </body>
    </html>
FOOTER;
    return $footer;
}

function get_nav() {
    $nav = '
    <header class="container-fluid">
    <div class="row align-items-center justify-content-around">
        <div class="col-1">
            <a href="/">
                <img src="/assets/imgs/pro.png" alt="'.$GLOBALS['config']['base']['siteName'].'-'.$GLOBALS['config']['base']['description'].'">
            </a>
        </div>
        <nav class="col-6">
            <a href="/" class="nav-item">Главная</a>
            <a href="/products.php" class="nav-item">Продукция</a>
            <a href="/contacts.php" class="nav-item">Контакты</a>
        </nav>
        <div class="col-2 text-center">';
        if (is_login())
        {
            $user = get_user($_SESSION['auth']);
            $nav .= '</h3>Здравствуйте, '.$user['name'].'</h3>';
            $nav .= '<a href="/logout.php" class="d-block">Выйти</a>';
        }
        else{
            $nav .= '<a href="/enter.php">Войти</a>
            <a href="/register.php">Зарегистрироваться</a>';
        }
        $nav .= '</div>
        <div class="col-3 consult">
            <a href="tel:89099970372" class="call"><i class="fas fa-phone mr-1 text-success"></i>+7 (909) 997-03-72</a>
            <span>Консультация</span>
        </div>
    </div>
</header>';
return $nav;
}

function init() {
    $GLOBALS['config']['dbSession'] = mysqli_connect($GLOBALS['config']['db']['host'],
                        $GLOBALS['config']['db']['user'],
                        $GLOBALS['config']['db']['password'],
                        $GLOBALS['config']['db']['dbName'],
                        $GLOBALS['config']['db']['port']);

    session_start();
}

function is_login() {
    if (isset($_SESSION['auth'])) return true;
    return false;
}

function get_products() {
    $result = mysqli_query($GLOBALS['config']['dbSession'], "SELECT * FROM Tovar ORDER BY Naim_Tovar");
    return $result;
}

function get_comments() {
    $result = mysqli_query($GLOBALS['config']['dbSession'],
    "SELECT com.*, acc.name as author FROM comments com LEFT JOIN accounts acc ON (com.user_id = acc.id) ORDER BY com.date DESC"
    );
    return $result;
}

function isset_user($login) {
    return mysqli_query($GLOBALS['config']['dbSession'], "SELECT * FROM accounts WHERE login='".trim($login)."'")->num_rows > 0;
}

function enter($login, $password) {
    $result = mysqli_query($GLOBALS['config']['dbSession'], "SELECT * FROM accounts WHERE login='".trim($login)."' AND password='".md5(trim($password))."'");
    if ($result->num_rows > 0) {
        $result = mysqli_fetch_assoc($result);
        $_SESSION['auth'] = $result['id'];
        return true;
    } else {
        unset($_SESSION['id']);
        return false;
    }
}

function register($login, $password, $name) {
    if (isset_user($login)) return false;
    $result = mysqli_query($GLOBALS['config']['dbSession'], "INSERT INTO accounts SET login='".trim($login)."', password='".md5(trim($password))."', name='".trim($name)."'");
    if ($result) {
        $_SESSION['auth'] = mysqli_insert_id($GLOBALS['config']['dbSession']);
        return true;
    } else {
        unset($_SESSION['id']);
        return false;
    }
}

function get_user($id) {
    return mysqli_fetch_assoc(mysqli_query($GLOBALS['config']['dbSession'], "SELECT * FROM accounts WHERE id='{$id}'"));
}

function create_comment($id, $text) {
    $result = mysqli_query($GLOBALS['config']['dbSession'], "INSERT INTO comments SET text='".trim($text)."', user_id='".$id."'");
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function is_admin() {
    if (!is_login()) return false;
    if (get_user($_SESSION['auth'])['permissions'] == 1) return true;
    return false;
}

function create_product($name, $kol, $summ, $id, $file) {
    $filename = mysqli_real_escape_string($GLOBALS['config']['dbSession'],file_get_contents($file['tmp_name']));
    $result = mysqli_query($GLOBALS['config']['dbSession'],
     "INSERT INTO Tovar SET Naim_tovar='".trim($name)."', Kol_tovar='".trim($kol)."', Summ='".trim($summ)."', Sklad_id='".trim($id)."', image='".$filename."'");
    if ($result) {
        return true;
    } else {
        return false;
    }
}
