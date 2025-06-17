<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with Steller landing page.">
    <meta name="author" content="Devcrud">
    <title>Smoker</title>
    <!-- font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + Steller main styles -->
	<link rel="stylesheet" href="assets/css/steller.css">
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <!-- Page navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" data-spy="affix" data-offset-top="0">
        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="logoo-removebg-preview.png" alt="" style="width: 300px; height: 70px;"alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>

                </ul>
            </div>
        </div>          
    </nav>
    <!-- End of page navibation -->

    <!-- Page Header -->
    <header class="header" id="home">
        <div class="container">
            <div class="infos">
                <h6 class="subtitle">  </h6>
                <h6 class="title">  </h6>
                <p>  </p>

            </div>              
            <div class="img-holder">
                <img src=" .jpeg" alt="">
            </div>      
        </div>  

        <!-- Header-widget -->
        <div class="widget">
            <div class="widget-item">
                <h2>124</h2>
                <p>Happy Clients</p>
            </div>
            <div class="widget-item">
                <h2>456</h2>
                <p>Users Completed</p>
            </div>
            <div class="widget-item">
                <h2>789</h2>
                <p>Awards Won</p>
            </div>
        </div>
    </header>
    <!-- End of Page Header -->

    <!-- Blog Section -->
    <section id="blog" class="section">
        <div class="container text-center">
            <h6 class="subtitle">all Category</h6>
            <p class="mb-5 pb-4">Browse our library of help to quit smoking.</p>

            <div style="direction: rtl; text-align: left;">
                <?php
                Include "config.php";

                $cName = $_GET['cName'];

                $query = mysqli_query($conn,"SELECT * FROM `support` WHERE cId = '$cName'");

                if(mysqli_num_rows($query) > 0){
                    while($row = mysqli_fetch_array($query)){
                    ?>
                        <div>
                            <p style="font-weight: bold;"><?php echo $row['cId']; ?></p>
                            <p><?php echo $row['supported']; ?></p>

                        </div>
                    <?php
                    }
                }
                    
                ?>
                
            </div>
        </div>
    </section>

    
	<!-- core  -->
    <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>
    <!-- bootstrap 3 affix -->
	<script src="assets/vendors/bootstrap/bootstrap.affix.js"></script>

    <!-- steller js -->
    <script src="assets/js/steller.js"></script>
<style>
    .header {
    background-image: url('2.jpeg'); /* تعيين الصورة كخلفية */
    background-size: cover; /* تغطية كامل المساحة */
    background-position: center; /* تمركز الصورة في الوسط */
    background-repeat: no-repeat; /* منع تكرار الصورة */
    height: 10vh; /* جعل الـ header يمتد ليغطي كامل الشاشة */
}</style>
</body>
</html>
