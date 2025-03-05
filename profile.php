<?php
include 'php/utils/db.php';
include 'php/utils/functions.php';
session_start();
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php include 'php/pages/meta.php' ?>
</head>

<body>


    <?php include 'php/pages/header.php' ?>

    <main>

        <!--instructor-details-area start-->
        <section class="instructor-details-area  pb-110 pt-md-95 pb-md-60 pt-xs-95 pb-xs-60">
            <div class="container">
                <div class="row">

                    <div class="col-xl-6 col-lg-12">
                        <div class="instructor-profile">
                            <h2>Instructor Profile</h2>
                            <ul class="profile-list mb-50">
                                <li>Name : <span>Chris Jordan</span></li>
                                <li>Mobile Num: <span>+(123) 125-856-23</span></li>
                                <li>Address : <span>24/7 Street Road , NY, USA</span></li>
                                <li>Email : <span>info@example.com</span></li>
                                <li>Website : <span>Chrisjordan.com</span></li>
                               
                            </ul>

                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="instructor-profile">
                            <h2>Courses Info</h2>
                         
                      </div>
                    </div>
                </div>
            </div>
        </section>
        <!--instructor-details-area end-->


    </main>

    <?php include 'php/pages/footer.php' ?>
</body>

</html>