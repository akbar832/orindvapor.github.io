<?php
@ob_start();
session_start();
if (isset($_POST['proses'])) {
    require 'config.php';

    $user = strip_tags($_POST['user']);
    $pass = strip_tags($_POST['pass']);

    $sql = 'SELECT member.*, login.user, login.pass
            FROM member INNER JOIN login ON member.id_member = login.id_member
            WHERE user =? AND pass = ?';
    $row = $config->prepare($sql);
    $row->execute(array($user, $pass));
    $jum = $row->rowCount();
    if ($jum > 0) {
        $hasil = $row->fetch();
        $_SESSION['admin'] = $hasil;
        echo json_encode(['status' => 'success', 'message' => 'Login Sukses']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Login Gagal']);
    }
}
?>
