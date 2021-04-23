<?php

/**
 * Liefert eine Verbindung zu der Datenbank 'sakila', 
 * die auf dem lokalen Gerät läuft.
 */
function getDatabaseConnection(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "sakila";

    // Verbindung zur Datenbank herstellen
    $conn = new mysqli($servername, $username, $password, $database);

    return $conn;
}

/**
 * Liefert alle Filme, die in der film-Tabelle der Datenbank existieren.
 * Das zurückgelieferte Array beinhaltet Movie-Objekte, 
 * die jeweils einen Film aus der Datenbank repräsentieren.
 * Diese Movie-Objekte beinhalten allerdings lediglich nur die film_id und den title.
 */
function getAllMoviesFromDatabase(){
    $data = array();
    $conn = getDatabaseConnection();

    if($conn->connect_error){
        die("Connection failed " . $conn->connect_error);
        return $data;
    }

    $sql = "select film_id, title from film";
    $result = $conn->query($sql);

    if($result){
        while($row = $result->fetch_array()){
            $movie = new Movie();
            $movie->film_id = intval($row[0]);
            $movie->title = trim($row[1]);

            $data[] = $movie;
        }
    }

    return $data;
}

/**
 * Liefert den zu der gegebenen id passenden Film. 
 * Das zurückgegebene Objekt ist vom Typ Movie und 
 * beinhaltet die Informationen über:
 * - film_id, title, description, release_year und length
 */
function getMovieFromDatabase($id){
    $data = array();
    $conn = getDatabaseConnection();

    if($conn->connect_error){
        die("Connection failed " . $conn->connect_error);
        return $data;
    }

    $sql = "select film_id, title, description, release_year, length from film where film_id = " . $id;
    $result = $conn->query($sql);

    if($result){
        while($row = $result->fetch_array()){
            $movie = new Movie();
            $movie->film_id = intval($row[0]);
            $movie->title = trim($row[1]);
            $movie->description = trim($row[2]);
            $movie->release_year = intval($row[3]);
            $movie->length = intval($row[4]);

            $data[] = $movie;
        }
    }

    return $data;
}
