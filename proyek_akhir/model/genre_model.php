<?php

function get_connection() {
    return mysqli_connect("localhost", "root", "", "movie_rating");
}

function get_blocked_genres() {
    if (isset($_SESSION['id_origin']) && $_SESSION['id_origin'] == 2) {
        return "4,5"; 
    }

    return ""; 
}

function get_all_genres() {
    $conn = get_connection();
    $blocked = get_blocked_genres();

    $filter = "";
    if ($blocked != "") {
        $filter = "WHERE id_genre NOT IN ($blocked)";
    }

    $query = "SELECT * FROM genres $filter ORDER BY id_genre ASC";
    $result = mysqli_query($conn, $query);
    
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    mysqli_close($conn);
    
    return $rows;
}


function get_films_by_genre($id_genre) {
    $conn = get_connection();
    $blocked = get_blocked_genres();

    if ($blocked != "" && in_array($id_genre, explode(",", $blocked))) {
        return [];
    }

    $query = "
        SELECT f.*, g.name_genre, COALESCE(AVG(r.rating), 0) AS avg_rating
        FROM films f
        JOIN genres g ON f.id_genre = g.id_genre
        LEFT JOIN ratings r ON f.id_film = r.id_film
        WHERE f.id_genre = $id_genre
        GROUP BY f.id_film
        ORDER BY avg_rating DESC
    ";
    $result = mysqli_query($conn, $query);
    
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    mysqli_close($conn);
    
    return $rows;
}

function get_all_films_grouped_by_genre() {
    $genres = get_all_genres(); 
    $result = [];
    
    foreach($genres as $genre) {
        $result[] = [
            'genre' => $genre,
            'films' => get_films_by_genre($genre['id_genre'])
        ];
    }
    
    return $result;
}

?>

