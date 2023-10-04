<?php
// Conectar a MySQL
$db = mysqli_connect('localhost', 'root', 'root', 'moviesite') or 
    die ('No se puede conectar. Verifica los parámetros de conexión.');

// Insertar datos en la tabla "movie"
$query = "INSERT INTO movie (movie_name, movie_type, movie_year, movie_leadactor, movie_director)
          VALUES ('Torrente 1', 1, 2021, 1, 2),
                 ('Torrente 2', 2, 2022, 2, 1),
                 ('Torrente 3', 3, 2023, 3, 3)";
mysqli_query($db, $query) or die(mysqli_error($db));

// Insertar datos en la tabla "movietype"
$query = "INSERT INTO movietype (movietype_label)
          VALUES ('Comedia'),
                 ('Thriller'),
                 ('Aventura')";
mysqli_query($db, $query) or die(mysqli_error($db));

// Insertar datos en la tabla "people"
$query = "INSERT INTO people (people_fullname, people_isactor, people_isdirector)
          VALUES ('Lionel Messi', 1, 0),
                 ('Luis Rubiales', 1, 0),
                 ('Camarón de la isla', 0, 1)";
mysqli_query($db, $query) or die(mysqli_error($db));

echo 'Datos insertados correctamente en las tablas.';
?>
