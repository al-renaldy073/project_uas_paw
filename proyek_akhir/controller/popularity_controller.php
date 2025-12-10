<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../controller/login_controller.php");
    exit();
}

include "../model/popularity_model.php";

function get_index_popularity() {

    $user = $_SESSION['user'] ?? null;
    $user_punya_sekolah = !empty($user['id_origin']);

 
    if ($user_punya_sekolah) {

        $all_films = get_all_popularity_sorted() ;

        $all_films = array_filter($all_films, function($film) {
            return $film['name_genre'] !== 'Romance' &&
                   $film['name_genre'] !== 'Horror';
        });

        $all_films = array_values($all_films);

        $result = array_slice($all_films, 0, 10);

        include "../view/popularity/popularity_view.php";
        return;
    }


    $data_popular = get_popularity_data();
    $result       = $data_popular['top_films'] ?? [];

    $all_films = get_all_popularity_sorted() ;

    include "../view/popularity/popularity_view.php";
}

get_index_popularity();


?>


