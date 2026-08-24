<!DOCTYPE html>
<html lang="en">
    <?php include("utility/header.php");?>
<body>
    <!-- navbar -->
    <?php include("utility/navbars/selectNavbar.php");?>

    <!-- Contact sec -->
    <div class="container-fluid about-top">
        <div class="container about-top-cont ">
            <h1 class="h1 text-center fs-large fw-bold">Contact</h1>
            <div class="btm-link d-flex justify-content-center">
                <a href="home.php" class="text-decoration-none">Home</a>
                <p> / Contact</p>
            </div>
        </div>
    </div>

    <!-- Contactcards -->
     <div class="contact-cont">
        <div class="container sec-cont">
            <div class="row mx-auto">
                <div class="col-lg-4 col-sm-12 p-0">
                    <div class="con-card text-center p-5 bg-1">
                        <h4 class="h4">Our Location</h4>
                        <p class="p-txt fs-large">3481 Melrose Place, Beverly Hills CA 90210</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12 p-0">
                    <div class="con-card text-center p-5 bg-2">
                        <h4 class="h4">Telephone</h4>
                        <p class="p-txt m-0 d-block">(+1) 517 397 7100 </p>
                        <p class="p-txt">(+1) 411 315 81380</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12 p-0">
                    <div class="con-card text-center p-5 bg-3">
                        <h4 class="h4">Send email</h4>
                        <p class="p-txt m-0 d-block">Info@example.com </p>
                        <p class="p-txt">admin@example.com</p>
                    </div>
                </div>

            </div>
        </div>
     </div>

     <!-- Contact Form -->
     <div class="contact-form">
        <div class="container sec-cont">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <form action="#">
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <label for="contact-name" class="form-label">Name</label>
                                <input type="text" id="contact-name" class="form-control f-bg">
                            </div>
                            <div class="col-6">
                                <label for="contact-email" class="form-label">You Email</label>
                                <input type="email" id="contact-email" class="form-control f-bg">
                            </div>
                        </div>
                        <div>
                            <label for="sub" class="form-label">Your Subject</label>
                            <input type="text" name="sub" id="sub" class="form-control f-bg">
                        </div>
                        <div>
                            <label for="mess" class="form-label">Your Message</label>
                            <textarea class="form-control f-bg" name="mess" id="mess"></textarea>
                        </div>
                        <input class="form-control w-25 btn blue-btn rounded-0 my-3" type="submit" value="Submit">
                    </form>
                </div>
                <div class="col-lg-4 col-sm-12 col-md-12">
                    <iframe class="h-100 w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3023.957183635167!2d-74.00402768559431!3d40.71895904512855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2598a1316e7a7%3A0x47bb20eb6074b3f0!2sNew%20Work%20City%20-%20(CLOSED)!5e0!3m2!1sbn!2sbd!4v1600305497356!5m2!1sbn!2sbd" frameborder="0"></iframe>
                </div>
            </div>
        </div>
     </div>

    <!-- footer -->
        <?php include("utility/footer.php");?>
</body>
</html>