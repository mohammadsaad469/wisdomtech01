
<?php
include 'admin/database.php';




session_start(); // Start the session at the beginning

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // If the form has been submitted and not previously processed, continue
    if (!isset($_SESSION['form_submitted'])) {
        // Sanitize and validate form inputs
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $message = trim($_POST['message']);

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Invalid email format");
        }

        // Prepare SQL statement using placeholders
        $sql = "INSERT INTO contact (name, email, phone, message) VALUES (?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters to the statement
            $stmt->bind_param("ssss", $name, $email, $phone, $message);

            // Execute the statement
            if ($stmt->execute()) {
                // Set session variable to prevent duplicate submissions
                $_SESSION['form_submitted'] = true;

                // Redirect to the same page to prevent resubmission on refresh
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Close the connection
$conn->close();

// Optional: Display a message if the form was successfully submitted
if (isset($_SESSION['form_submitted']) && $_SESSION['form_submitted'] === true) {
    echo "<p>Your message has been sent successfully!</p>";

    // Optionally, reset the session variable to allow for future submissions
    unset($_SESSION['form_submitted']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>WisdomTechnosoft</title>
    <style type="text/css">
        input::placeholder,textarea::placeholder {
            color: #fff;
            font-size: 17px;
        }
    </style>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="WisdomTechnoSoft" name="keywords">
    <meta content="WisdomTechnoSoft" name="description">

    <!-- Favicon -->
    <link href="/img/Logo-1.png" rel="icon">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <!-- Libraries CSS -->

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Main Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Nav Start -->
    <!-- Nav Start -->
    <nav class="navbar navbar-expand-custom navbar-mainbg">
        <a class="navbar-brand navbar-logo" href="#">
            <img src="./img/Logo-1.png" alt="" style="
                width: 100%;
                height: 100%;
                max-width: 47px;
            ">
        </a>
        <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <div class="hori-selector"><div class="left"></div><div class="right"></div></div>
                <li class="nav-item ">
                    <a class="nav-link"  href="index.php"><i class="far fa-solid fa-house"></i>Home</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="about.php"><i class="far fa-address-book"></i>About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="service.php"><i class="far fa-clone"></i>Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="portfolio.php"><i class="far fa-calendar-alt"></i>Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="career.php"><i class="far fa-chart-bar"></i>Career Page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php"><i class=" far fa-solid fa-phone-volume"></i>Contact</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Nav End -->


    <section class="section construct-section"  id="home" aria-label="home">
        <div class="container construct-container">
            <div class="row">
                <div class="overlay1 black"></div>
                <div class="construct-contant1">
                     <h1 class="section-title">Contact Us</h1>
                 <div class="crums d-flex text-white justify-content-center mt-3 fs-5">
                     <a href="index.php" class="mx-1 text-white">Home</a>| Contact
                </div> 
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Start -->
    <div class="contact-form-container">
    <span class="big-circle"></span>
    <img src="img/shape.png" class="contact-form-square" alt="" />
    <div class="portfoli-contact-form">
      <div class="contact-info">
        <h3 class="contact-form-title">Let's get in touch</h3>
        <p class="contact-form-text">
          Contact us to discuss your project needs, ask questions, or explore collaboration opportunities. We’re here to provide expert assistance and support.
        </p>

        <div class="info">
          <div class="information">
            <i class="fas fa-map-marker-alt"></i> &nbsp &nbsp

            <p>Opposite Muthoot Finance kalamna Road Kamptee Dis, Nagpur 441002</p>
          </div>
          <div class="information">
            <i class="fas fa-envelope"></i> &nbsp &nbsp
            <p>wisdomtechnosoft04@gmail.com</p>
          </div>
          <div class="information">
            <i class="fas fa-phone"></i>&nbsp&nbsp
            <p>9405613877</p>
          </div>
        </div>

        <div class="social-media">
          <p>Connect with us :</p>
          <div class="social-icons">
            <a href="#">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="contact-form">
        <span class="circle one"></span>
        <span class="circle two"></span>

        <form id="contactForm" method="post" autocomplete="off">
  <h3 class="contact-form-title">Contact us</h3>
  <div class="input-container">
    <input type="text" id="username" name="name"  placeholder="Username" class="contact-form-input" required />
  </div>
  <div class="input-container">
    <input type="email" id="email" name="email"  placeholder="Email" class="contact-form-input" required />
  </div>
  <div class="input-container">
    <input type="tel" id="phone" name="phone"  placeholder="Phone" class="contact-form-input" required />
  </div>
  <div class="input-container textarea">
    <textarea id="message" name="message"  placeholder="Message" class="contact-form-input" required></textarea>
  </div>
  <input type="submit" value="Send" class="contact-form-btn" />
</form>

<script>
 document.getElementById('contactForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form submission
    
    // Collect form data correctly from the form element
    const formData = new FormData(this);


 

    // Convert FormData to JSON object for sending
    const formObject = {};
    formData.forEach((value, key) => {
      formObject[key] = value;
    });

    console.log("formObject",formObject)

    // Send data via fetch
   let resp =await fetch('contact.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(formObject),
    })
      .then(response => response.json())
      .then(data => {
        console.log("Response data:", data);
        alert('Message sent successfully!');
      })
      .catch(error => {
        console.log("Error:", error);
        alert('An error occurred. Please try again later.');
      });

      console.log("respppppp",resp)
});

</script>


      </div>
    </div>
  </div><!-- Contact End -->
  <!-- map -->
    <section class="my-4">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d232.47207981558907!2d79.18579010814385!3d21.2098979851304!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bd4c7f54de92659%3A0xebea5df9148a36ad!2sBombay%20Kirana%20Stores!5e0!3m2!1sen!2sin!4v1729511393013!5m2!1sen!2sin" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
     <!-- Footer Start -->
     <div class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><i class="ion-ios-arrow-forward"></i> <a href="/">Home</a></li>
                            <li><i class="ion-ios-arrow-forward"></i> <a href="/about.php">About us</a></li>
                            <li><i class="ion-ios-arrow-forward"></i> <a href="/service.php">Our services</a></li>
                            <li><i class="ion-ios-arrow-forward"></i> <a href="/contact.php">Contact Us</a></li>
                            <li><i class="ion-ios-arrow-forward"></i> <a href="/pricing.php">Carrer</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Services</h4>
                        <ul>
                            <li><i class="ion-ios-arrow-forward"></i> <a href="#">Web Development</a></li>
                            <li><i class="ion-ios-arrow-forward"></i> <a href="#">Web Designing</a></li>
                            <li><i class="ion-ios-arrow-forward"></i> <a href="#">App Development</a></li>
                            <li><i class="ion-ios-arrow-forward"></i> <a href="#">SalesForce</a></li>
                            <li><i class="ion-ios-arrow-forward"></i> <a href="#">Bussiness Process Outsourcing (BPO)</a></li>
                            <li><i class="ion-ios-arrow-forward"></i> <a href="#">Ui/Ux Designing</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h4>Contact Us</h4>
                        <p>
                            Opposite Muthoot Finance<br>
                            Kalamna Road<br>
                            Kamptee <br>
                            <strong>Phone:</strong> <a href="tel:+917719911339">+91-77199-11339</a><br>
                            <strong>Email:</strong> wisdomtechnosoft@gmail.com<br>
                        </p>

                        <div class="social-links">
                            <a href="#"><i class="ion-logo-twitter"></i></a>
                            <a href="#"><i class="ion-logo-facebook"></i></a>
                            <a href="#"><i class="ion-logo-linkedin"></i></a>
                            <a href="#"><i class="ion-logo-instagram"></i></a>
                            <a href="#"><i class="ion-logo-googleplus"></i></a>
                        </div>

                    </div>

                    <div class="col-lg-3 col-md-6 footer-newsletter">
                        <h4>Stay Connected</h4>
                         <p>At Wisdom Technosoft, we are committed to delivering high-quality solutions tailored to your needs. 
       By following us, you'll receive updates on our latest projects, industry insights, and exclusive offers. 
       Join our community and be the first to know about our innovations and upcoming events!</p>
</div>
                <div class="row text-center">
                <div class="col-md-12 copyright" >
                    Copyright &copy; 2024 <a href="">wisdom technosoft</a>. All Rights Reserved
                </div>
            </div>
                        <!-- <form action="" method="post">
                            <input type="email" name="email"><input type="submit" value="Subscribe">
                        </form> -->
                    </div>

                </div>
            </div>
        </div>

            
    </div>
    <!-- Footer End -->
    <a href="#" class="back-to-top"><i class="ion-ios-arrow-up"></i></a>
    <div class="wp-in">
    <a href="https://wa.me/919405613877" target="_blank"><img src="img/download.png" width="50px" style="z-index: 99"></a> 
    </div>



    <!-- Libraries JS -->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Main Javascript -->
    <script src="js/main.js"></script>

</body>

</html>