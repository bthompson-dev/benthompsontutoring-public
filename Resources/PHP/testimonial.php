<?php
  
if($_POST) {
    
    $visitor_name = "";
    $visitor_message = "";
    $email_body = "<div>";
    
    if(isset($_POST['visitor_name'])) {
        $visitor_name = filter_var($_POST['visitor_name'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Visitor Name:</b></label>&nbsp;<span>".$visitor_name."</span>
                        </div>";
    }
    
      
    if(isset($_POST['visitor_message'])) {
        $visitor_message = htmlspecialchars($_POST['visitor_message']);
        $email_body .= "<div>
                           <label><b>Visitor Message:</b></label>
                           <div>".$visitor_message."</div>
                        </div>";
    }
     
    // reCAPTCHA checkbox validation
    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){ 
        // Google reCAPTCHA API secret key 
        $secret_key = 'fake-key'; 
         
        // reCAPTCHA response verification
        $verify_captcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']); 
         
        // Decode reCAPTCHA response 
        $verify_response = json_decode($verify_captcha); 
         
        // Check if reCAPTCHA response returns success 
        if($verify_response->success){ 
            
            $recipient = "ben@benthompsontutoring.co.uk";

            
            $email_body .= "</div>";
            $email_title = "Testimonial";
        
            $headers  = 'MIME-Version: 1.0' . "\r\n"
            .'Content-type: text/html; charset=utf-8' . "\r\n";
            
            if(mail($recipient, $email_title, $email_body, $headers)) {
                echo "<p>Testimonial submitted - thanks!</p>";
            } else {
                echo '<p>Error - your testimonial did not go through. Please contact me at ben@benthompsontutoring.co.uk</p>';
            }
        } else {
            echo '<p>CAPTCHA failed. Please retry.</p>';
        }

    } else {
        echo '<p> Please check the CAPTCHA box.</p>';
    }

      
} else {
    echo '<p>Something went wrong</p>';
}
?>
