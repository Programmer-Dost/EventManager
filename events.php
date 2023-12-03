<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}
require_once "config.php";
// $result = mysqli_query($conn, "SELECT * FROM users");

// Check if there are rows in the result set
// if (mysqli_num_rows($result) > 0) {
//     // Fetch each row using a while loop
//     while ($row = mysqli_fetch_assoc($result)) {
//         // Process each row
//         echo "ID: " . $row['id'] . " - Name: " . $row['username'] . "<br>";
//     }
// } else {
//     echo "No results found.";
// }

// Assuming you have a query to fetch events with user information
$query = "SELECT events.event_id, events.event_title, events.event_desc, events.event_timings, users.username 
          FROM events 
          INNER JOIN users ON events.user_id = users.id";

$result = mysqli_query($conn, $query);

// Check if there are rows in the result set



?>


<!-- INSERT INTO `events` (`event_id`, `event_title`, `event_desc`, `event_timings`, `user_id`) VALUES (NULL, 'My first event', 'AI ML and deep learning.', '2023-12-06 19:00:00', '1'); -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">
    <title>Events</title>
    <link rel="icon" href="logo.png" type="image/icon">
    
</head>
<body>
<nav class="sticky top-0 z-10 bg-gray-100">
    <div class="max-w-5xl mx-auto px-4">
      <div class="flex items-center justify-between h-16">
      <a href="events.php"><img
          class="w-16 h-16"
          src="logo.png"
          alt="Logo"

        /></a>
        <div class="flex space-x-4 text-gray-900">
        <a class="text-blue-400 hover:text-blue-600" href="events.php">Events</a>
          <a class="text-blue-400 hover:text-blue-600" href="hostEvent.php">Host</a>
          <a  class="text-blue-400 hover:text-blue-600" href="register.php">Register</a>
          <a  class="text-blue-400 hover:text-blue-600" href="login.php">Login</a>
          <a class="text-blue-400 hover:text-blue-600" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </nav>
  <h1 class="text-3xl font-semibold mb-4 mt-8 mx-12 text-blue-500">Upcoming Events</h1>
<h3 class="text-sm font-semibold mb-4 ml-12 text-gray-600"><?php echo "Welcome ". $_SESSION['username']?>! You can now view the upcoming events</h3>
    <div class="grid grid-cols-3 h-fit w-fit">
            <?php 
            if (mysqli_num_rows($result) > 0) {
        // Fetch and display each event
                while ($row = mysqli_fetch_assoc($result)) {
            
            
            // echo "Event Name: " . $row['event_title'] . "<br>";
            // echo "Event Date: " . $row['event_timings'] . "<br>";
            // echo "Created by: " . $row['username'] . "<br>";
            // echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">';
            // echo '<div class="rounded border-4 border-gray-500 rounded-lg p-2 shadow-lg max-w-xs ">';
            ?>
            <div class="bg-white rounded-xl p-4 shadow-2xl shadow-cyan-500/50 m-8 opacity-100 transition-all duration-700 hover:scale-110 h-fit w-fit">
                <h2 class="text-lg font-bold text-blue-500 my-2"> <span class="text-black">Topic: </span><?= $row['event_title']  ?></h2>
                <p class="text-lg font-bold text-blue-500 h-fit w-fit my-2"> <span class="text-black">Description: </span><?=  $row['event_desc'] ?> </p>
                <p class="text-lg font-bold text-blue-500 my-2"> <span class="text-black">Event Timing: </span> <?=  $row['event_timings'] ?> </p>
                <p class="text-lg font-bold text-blue-500 my-2"><span class="text-black"> Host:  </span>  <?= $row['username'] ?> </p>
                <hr>
              </div>
        <?php
        // Store the generated HTML in a hidden element
        // echo '<div id="event-data" style="display: none;">' . $eventCardsHTML . '</div>';
                 }
        } else {
                    echo "No events found.";
                }
                ?>
        </div>
<!-- <div class="col-span-3 items-center ">
<img class=""
        src="logo.png"
        alt="Logo"

      />
</div>
</div> -->


<!-- <h1><?php echo "Welcome ". $_SESSION['username']?>Ongoing Events</h1> -->
<!-- </div> -->
<!-- <div class=" container mt-4 flex justify-center items-center width-6">
    <div class="rounded border-4 border-gray-500 rounded-lg p-2 shadow-lg transition-all duration-700 hover:scale-110 max-w-xs ">
        <div class="flex flex-col gap-2 ">
            <h2 class="text-lg font-bold text-blue-700">TailwindTap</h2>
            <p class="text-sm text-gray-600">Powerful Tailwind CSS Components & Templates</p>
        </div>
    </div>
</div> -->

</body>

</html>