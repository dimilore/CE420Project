<?php
    /********* WE HAVE TO PUT THE PROJECT'S MAIL in variable to******/
    //to is our pharmaceutical store email 
    $to='stf@stf.gr';
    $from=$_POST['email'];
    $subject=$_POST['subject'];
    $message=$_POST['user_text'];
    
    $headers='From:'.$from . "\r\n" .
    'Reply-To:'.$from. "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    
    if(mail($to, $subject, $message,$headers)){
        echo '<p>Mail sent successfully</p>';
    }
    
    else{
        echo '<p>Mail could not be sent</p>';
    }
    


?>

