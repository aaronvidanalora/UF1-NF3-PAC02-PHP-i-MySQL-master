<?php
// Connect to MySQL
$db = mysqli_connect('localhost', 'root', 'root') or die('Unable to connect. Check your connection parameters.');

// Make sure you're using the correct database
mysqli_select_db($db, 'moviesite') or die(mysqli_error($db));

// Determine the current page number
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$itemsPerPage = 5; // Number of items to display per page

// Calculate the offset for the LIMIT clause
$offset = ($page - 1) * $itemsPerPage;

// Define the SQL query to fetch movie information along with director and lead actor names with pagination
$query = "SELECT 
    movie.movie_name AS movie_name,
    director.people_fullname AS director_name,
    lead_actor.people_fullname AS lead_actor_name
FROM 
    movie
LEFT JOIN 
    people AS director ON movie.movie_director = director.people_id
LEFT JOIN 
    people AS lead_actor ON movie.movie_leadactor = lead_actor.people_id
LIMIT $offset, $itemsPerPage";

// Execute the query
$result = mysqli_query($db, $query) or die(mysqli_error($db));

// Count the total number of rows for pagination
$totalRowsQuery = "SELECT COUNT(*) AS total FROM movie";
$totalRowsResult = mysqli_query($db, $totalRowsQuery);
$totalRows = mysqli_fetch_assoc($totalRowsResult)['total'];

// Calculate the total number of pages
$totalPages = ceil($totalRows / $itemsPerPage);

// Print the results
echo '<table border="1">';
echo '<tr><th>Movie</th><th>Director</th><th>Lead Actor</th></tr>';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['movie_name'] . '</td>';
    echo '<td>' . $row['director_name'] . '</td>';
    echo '<td>' . $row['lead_actor_name'] . '</td>';
    echo '</tr>';
}
echo '</table>';

// Display pagination links
echo '<div>';
for ($i = 1; $i <= $totalPages; $i++) {
    echo '<a href="?page=' . $i . '">Page ' . $i . '</a> ';
}
echo '</div>';

// Close the database connection
mysqli_close($db);
?>