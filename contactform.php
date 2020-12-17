<?php

if (isset($_POST['submit'])){

    $naam = $_POST['naam'];
    $mailFrom = $_POST['email'];
    $telefoon = $_POST['telefoon'];
    $bericht = $_POST['bericht'];

    $mailTo = "hello@homate.be";
    $headers = "From: " .$mailFrom; 

    mail($mailTo, $naam, $bericht);
    header("Location: index.php?mailsend");
}