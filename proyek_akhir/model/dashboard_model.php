<?php

function get_connection() {
    return mysqli_connect("localhost", "root", "", "movie_rating");
}

function get_all_dashboard() {
    $conn = get_connection();
    $blocked_genres = "4,5"; 

    $filter = "";
    if (isset($_SESSION['id_origin']) && $_SESSION['id_origin'] == 2) {
        $filter = "WHERE f.id_genre NOT IN ($blocked_genres)";
    }

    $query = "
        SELECT f.*, g.name_genre, COALESCE(AVG(r.rating), 0) AS avg_rating
        FROM films f
        JOIN genres g ON f.id_genre = g.id_genre
        LEFT JOIN ratings r ON f.id_film = r.id_film
        $filter
        GROUP BY f.id_film
        ORDER BY f.id_film ASC
    ";

    $result = mysqli_query($conn, $query);

    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    mysqli_close($conn);

    return $rows;
}


function get_top_films($limit = 10) {
    $conn = get_connection();

    // Genre terblokir untuk id_origin = 2
    $blocked_genres = "4,5";

    $filter = "";
    if (isset($_SESSION['id_origin']) && $_SESSION['id_origin'] == 2) {
        $filter = "WHERE f.id_genre NOT IN ($blocked_genres)";
    }

    $query = "
        SELECT f.*, g.name_genre, COALESCE(AVG(r.rating),0) AS avg_rating
        FROM films f
        JOIN genres g ON f.id_genre = g.id_genre
        LEFT JOIN ratings r ON f.id_film = r.id_film
        $filter
        GROUP BY f.id_film
        ORDER BY avg_rating DESC
        LIMIT $limit
    ";

    $result = mysqli_query($conn, $query);

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    mysqli_close($conn);

    return $rows;
}

function get_all_films() {
    $conn = get_connection();
    $blocked_genres = "4,5"; 

    $filter = "";
    if (isset($_SESSION['id_origin']) && $_SESSION['id_origin'] == 2) {
        $filter = "WHERE f.id_genre NOT IN ($blocked_genres)";
    }

    $query = "
        SELECT f.*, g.name_genre, COALESCE(AVG(r.rating), 0) AS avg_rating
        FROM films f
        JOIN genres g ON f.id_genre = g.id_genre
        LEFT JOIN ratings r ON f.id_film = r.id_film
        $filter
        GROUP BY f.id_film
        ORDER BY f.id_film ASC
    ";

    $result = mysqli_query($conn, $query);

    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    mysqli_close($conn);

    return $rows;
}

?>

