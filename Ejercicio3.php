<?php
$db = mysqli_connect('localhost', 'root', 'root') or die('No se puede conectar');
mysqli_select_db($db, 'moviesite') or die(mysqli_error($db));

// Consulta SQL para obtener el nombre del director y el actor principal para cada película
$query = "SELECT m.movie_name, p1.people_fullname AS director_name, p2.people_fullname AS lead_actor_name
          FROM movie AS m
          LEFT JOIN people AS p1 ON m.movie_director = p1.people_id
          LEFT JOIN people AS p2 ON m.movie_leadactor = p2.people_id";

$result = mysqli_query($db, $query) or die(mysqli_error($db));

// Imprimir los resultados
echo '<h1>Relaciones entre películas y personas:</h1>';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<p><strong>Película:</strong> ' . $row['movie_name'] . '</p>';
    echo '<p><strong>Director:</strong> ' . $row['director_name'] . '</p>';
    echo '<p><strong>Actor Principal:</strong> ' . $row['lead_actor_name'] . '</p>';
    echo '<hr>';
}

// Cerrar la conexión a la base de datos
mysqli_close($db);
?>

