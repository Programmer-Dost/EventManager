<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}
 // Retrieve user_id from the session
 $userId = $_SESSION['id'];
require_once "config.php";

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Assuming you have received the event data via POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the input data (you might want to enhance this part)
    $eventTitle = mysqli_real_escape_string($conn, $_POST['eventTitle']);
    $eventDescription = mysqli_real_escape_string($conn, $_POST['eventDescription']);
    $eventTiming = mysqli_real_escape_string($conn, date('Y-m-d H:i:s', strtotime($_POST['eventTiming'])));

   

    // Insert data into the events table
    $insertQuery = "INSERT INTO events (event_title, event_desc, event_timings, user_id) 
                    VALUES ('$eventTitle', '$eventDescription', '$eventTiming', '$userId')";

    if (mysqli_query($conn, $insertQuery)) {
        echo "Event data inserted successfully!";
        header("location: login.php");
    } else {
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="logo.png" type="image/icon">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
    />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>PHP login system!</title>
  </head>
  <body>
  <<?php include 'header.php'; ?>

<!-- <div class="container mt-4"> -->

<!-- <hr> -->
<!-- <form action="" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="eventTitle">Event Title</label>
      <input type="text" class="form-control" name="eventTitle" id="eventTitle" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="eventDescription">Event Description</label>
      <input type="text" class="form-control" name ="eventDescription" id="eventDescription" placeholder="Event Description">
    </div>
  </div>
  <div class="form-group">
    <label for="eventTiming">Event Timings</label>
    <input type="datetime" class="form-control" name ="eventTiming" id="eventTiming" placeholder="Event Timing">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="userId">Hosted By</label>
      <input type="number" class="form-control" id="userId" name="userId" value=$user_id>
    </div> -->
    <!-- <div class="form-group col-md-4">
      <label for="inputState">Hosted By</label>
      <select id="inputState" class="form-control">
        <option selected>Hosts...</option>
        <option>1st User</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
  </div>
  <div class="form-group"> -->
  <div class="flex flex-col justify-center items-center min-h-screen bg-gray-100">
  <h3 class="text-2xl font-semibold mb-8 mx-12 text-blue-500">Host an event</h3>
    <!-- <ToastContainer
      position="bottom-center"
      autoClose={5000}
      hideProgressBar={false}
      newestOnTop={false}
      closeOnClick
      rtl={false}
      pauseOnFocusLoss
      draggable
      pauseOnHover
      theme="dark"
    /> -->
    <div class="flex flex-row items-center justify-center">
      <img class="w-20 h-20"
        src="logo.png"
        alt="Logo"
        class="mx-auto mb-4"
      />
      <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17 10H7v2h10v-2zm2-7h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zm-5-5H7v2h7v-2z"/></svg> -->
      <h1 class="text-[27px] align-center font-bold mt-2 mb-2 text-black ml-4">
        Event Manager
      </h1>
    </div>
    <div class="w-full max-w-md">
      <form
       
        action=""
        method="POST"
        class="bg-white rounded-lg px-8 pt-6 pb-8 mb-4"
      >
        <div class="mb-6">
          <label
            class="block text-gray-700 font-bold mb-2"
            htmlFor="username"
          >
            Event Title
          </label>
          <input
            class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
            id="ueventTitle"
            type="text"
            name="eventTitle"
            placeholder="******************"
          />
          <p class="text-red-500 text-xs italic">   Please enter an Event Title
        </p>
      </div>
              

        <div class="mb-6">
          <label
            class="block text-gray-700 font-bold mb-2"
            htmlFor="description"
          >
            Event Description
          </label>
          <input
            class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
            id="eventDescription"
            type="text"
            placeholder="******************"
            name="eventDescription"
          />
      
            <p class="text-red-500 text-xs italic">What you are gonna talk about?</p>
          
        </div>
        <div class="mb-6">
          <label
            class="block text-gray-700 font-bold mb-2"
            htmlFor="eventTiming"
          >
            Event Timing
          </label>
          <input
            class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
            id="event timing"
            type="datetime-local"
            placeholder="YY-MM-DD HH:mm:ss"
            name="eventTiming"
            step="1"
          />
      
            <p class="text-red-500 text-xs italic">DateTime should be in YY-MM-DD HH:mm:ss format</p>
          
        </div>
        <div class="flex justify-between">
          <div class="flex">
            <input
              id="remember-me"
              type="checkbox"
              class="form-checkbox h-5 w-5 "
              name="checked"
            />
            <label
              htmlFor="remember-me"
              class="ml-2 text-sm text-gray-700"
            >
              Remember me
            </label>
          </div>
          <a
            href="/forgot-password"
            class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
          >
            Forgot Password?
          </a>
        </div>

        <button
          class="bg-blue-500 hover:bg-blue-800 w-full mt-4 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline"
          type="submit"
        >
          Create Event
        </button>
      </form>
      <div class="text-center">
        <p class="text-gray-500 text-xs">
          Already created an Event?
          <a
            href="/events/events.php"
            class="ml-1 text-blue-500 hover:text-blue-800"
          >
            View it here
          </a>
        </p>
      </div>
      <p class="text-center text-gray-500 text-xs">
        &copy;2023 Abhijeet. All rights reserved.
      </p>
    </div>
  </div>
<!-- </div> -->
    <!-- <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Sign in</button>
</form>
</div> -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
