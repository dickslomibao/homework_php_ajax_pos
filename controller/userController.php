<?php
require_once '../db/connection.php';
require_once '../model/users.php';

if (isset($_POST['add-user'])) {
    try {
        $user = new Users;
        $user->setName($_POST['name']);
        $user->setEmail($_POST['email']);
        $user->setUsername($_POST['username']);
        $user->setPassword($_POST['password']);
        if ($user->insert()) {
            echo '200';
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
if (isset($_POST['gmail'])) {
    try {
        $user = new Users;
        $user->setEmail($_POST['email']);
        if ($user->emailIsUsed()[0]['count'] === 0) {
            $user->setName($_POST['name']);
            $user->setEmail($_POST['email']);
            $user->insertGmail();
        }
        $_SESSION['name'] = $_POST['name'];
        echo '200';
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
if (isset($_POST['checkEmail'])) {
    try {
        $user = new Users;
        $user->setEmail($_POST['checkEmail']);
        echo $user->emailIsUsed()[0]['count'];
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
if (isset($_POST['checkUsername'])) {
    try {
        $user = new Users;
        $user->setUsername($_POST['checkUsername']);
        echo $user->usernameIsUsed()[0]['count'];
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
if (isset($_POST['login'])) {
    $data = array(
        'secret' => '6LcQzjYlAAAAAGbdMfwmy1dNIsRFzaM3JeiPoZ6b',
        'response' => $_POST['login'],
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($response, true);
    try {
        if ($result['success']) {
            $user = new Users;
            $user->setUsername($_POST['username']);
            $user->setPassword($_POST['password']);
            $result = $user->validateAccount();
            if (count($result) === 1) {
                $_SESSION['name'] = $result[0]['name'];
                echo "valid";
            } else {
                echo 'invalid';
            }
        } else {
            echo 'captcharequired';
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
