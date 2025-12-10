<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../proyek_akhir/controller/login_controller.php");
    exit();
}

include '../model/dashboard_model.php';

$action = $_GET['action'] ?? 'index';

switch($action) {
    case 'index':
        dashboard_index();
        break;
    case 'all_films':
        dashboard_all_films();
        break;
    default:
        echo "Action tidak ditemukan";
        break;
}

function dashboard_index() {
    $top_films = get_top_films(10); 
    $data = get_all_dashboard();
    include '../view/dashboard/dashboard_view.php';
}

function dashboard_all_films() {
    $data = get_all_films();
    include '../view/dashboard/all_films.php';
}

dashboard_index();


?>
