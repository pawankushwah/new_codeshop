<?php
    // error_reporting(0);

    //  connection details
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "codeshop";

    // connects to database
    try{
        $conn = mysqli_connect($hostname,$username,$password,$database);
    }
    catch(Exception $e) {
        // echo 'Message: ' .$e->getMessage();
    }
    if(!$conn){
        echo '
            <div class="alert alert-error shadow-lg z-10 absolute w-fit right-4 top-4">
                <div class="bg-red-400">
                    <span class="text-bold">Unable to Connect! '. mysqli_connect_error().'</span>
                    <span class="float float-right text-2xl text-white cursor-pointer rounded-lg p-1">&times;</span>
                </div>
            </div>
      ';
    }
    session_start();
?>