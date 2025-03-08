<?php
include 'php/utils/db.php';
include 'php/utils/functions.php';
session_start();
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php include 'php/pages/meta.php' ?>
    <?php
    $meta_title = "Contact Us - CollegeNew.com | Get Expert Admission Guidance";
    $meta_dec = "Have questions about college admissions? Contact CollegeNew.com for expert guidance, support, and assistance in finding the best colleges and courses.";
    $meta_keywords = "contact CollegeNew, college admissions help, education guidance, admission support, career counseling, best colleges, study programs";
    $meta_img = $domain . "assets/img/og-img.png";
?>

    <title><?= $meta_title ?></title>
    <meta name="title" content="<?= $meta_title ?>">
    <meta name="description" content=<?= $meta_dec ?>>
    <meta name="keywords" content=<?= $meta_keywords ?>>

    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $domain ?>">
    <meta property="og:title" content="<?= $meta_title ?>">
    <meta property="og:description" content="<?= $meta_dec ?>">
    <meta property="og:image" content="<?= $meta_img ?>">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= $domain ?>">
    <meta property="twitter:title" content="<?= $meta_title ?>">
    <meta property="twitter:description" content=<?= $meta_dec ?>>
    <meta property="twitter:image" content="<?= $meta_img ?>">
    <link rel="canonical" href="<?= $domain ?>/contact.php">
</head>

<body>


    <?php include 'php/pages/header.php' ?>

    <main>

        <!--contact-us-area start-->
        <section class="contact-us-area pb-120 pt-md-100 pt-xs-100 pb-md-70 pb-xs-70">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col">
                        <div class="contact-wrapper pl-75 mb-30">
                            <div class="section-title mb-30 text-center">
                                <h2>Contact Us</h2>
                                <br>
                                <p class="text-start">Have questions or need assistance? We're here to help! Reach out to us for inquiries, partnerships, or support, and our team will get back to you promptly.</p>
                            </div>


                            <div class="single-contact-box cb-2 mb-30">
                                <div class="contact__iocn">
                                    <img src="assets/img/icon/phone-alt.svg" alt="">
                                </div>
                                <div class="contact__text">
                                    <h5>+000 (125) 3654 34</h5>
                                    <h5>+000 (125) 3654 34</h5>
                                </div>
                            </div>
                            <div class="single-contact-box cb-3 mb-30">
                                <div class="contact__iocn">
                                    <img src="assets/img/icon/feather-mail.svg" alt="">
                                </div>
                                <div class="contact__text" id="form">
                                    <h5>info@example.com</h5>
                                    <h5>info2@example.com</h5>
                                </div>
                            </div>
                            <div class="social-media footer__social mt-30 text-center">
                               <?php include 'php/pages/social-icons.php'?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--contact-us-area end-->
        <!--contact-map-area start-->
        <!-- <section class="contact-map-area">
          <div class="container-fluid px-0">
              <div class="row gx-0">
                  <div class="col-lg-12">
                        <div class="conatct-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d10019.512355675912!2d90.3779420697561!3d23.95217349394493!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1625130888507!5m2!1sen!2sbd" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                  </div>
              </div>
          </div>
      </section> -->
        <!--contact-map-area end-->


        <!--contact-form-area start-->
        <section class="contact-form-area  pb-120 pt-md-100 pt-xs-100 pb-md-70 pb-xs-70">
            <div class="container">
                <div class="align-items-center">
                    <div class="contact-form-wrapper mb-30">
                        <h2 class="mb-45">Contact Us</h2>

                        <form action="#" method="post" class="row gx-3 comments-form contact-form">
                            <div class="col-lg-6 col-md-6 mb-30">
                                <input type="text" name="full_name" placeholder="Full Name">
                            </div>
                            <div class="col-lg-6 col-md-6 mb-30">
                                <input type="tel" name="phone_number" placeholder="Phone Number">
                            </div>
                            <div class="col-lg-6 col-md-6 mb-30">
                                <input type="text" name="email" placeholder="Email Name">
                            </div>
                            <div class="col-lg-6 col-md-6 mb-30">
                                <input type="text" name="city" placeholder="City">
                            </div>

                            <style>
                                .nice-select .list {
                                    width: 100% !important;
                                }

                                .nice-select {
                                    width: 100% !important;
                                }
                            </style>
                            <div class="col-lg-12 mb-30">
                                <select name="topic" id="select" class="nice-select">
                                    <option value="" selected disabled>Select a Topic</option>
                                    <optgroup label="General Inquiries">
                                        <option value="admissions">College Admissions</option>
                                        <option value="counseling">Career Counseling</option>
                                    </optgroup>

                                    <optgroup label="Business & Partnerships">
                                        <option value="partnership">Become a Partner</option>

                                    </optgroup>
                                    <optgroup label="Legal & Copyright">
                                        <option value="copyright">Legal & Copyright</option>
                                    </optgroup>
                                    <optgroup label="Other">
                                        <option value="support">Technical Support</option>
                                        <option value="developer">Contact Developer</option>
                                        <option value="feedback">Feedback & Suggestions</option>
                                        <option value="other">Other</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-6 mb-30" id="other" style="display: none;">
                                <input type="text" name="other_topic" placeholder="Other Topic">
                            </div>
                            <div class="col-lg-12 col-md-6 mb-30" id="developer" style="display: none;">
                                <input type="text" readonly value="Click Here to Direct Contact" onclick="window.location.href='developer.php'">
                            </div>
                            <div class="col-lg-12 mb-30">
                                <textarea name="message" id="commnent" cols="30" rows="10" placeholder="Write a Message"></textarea>
                            </div>
                            <div class="response_container container">

                            </div>
                            <button type="submit" class="theme_btn message_btn mt-20">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!--contact-form-area end-->
        <!-- bootstrap alert message  -->

    </main>
    <?php include 'php/pages/footer.php' ?>
    <script src="assets/js/contact-form.js"></script>
    <script>
        $(document).ready(function() {
            $('select.nice-select').niceSelect();

            $("select.nice-select").on("change", function() {
                let selectedValue = $(this).val();
                console.log(selectedValue);

                if (selectedValue === "other") {
                    $("#other").show();
                } else {
                    $("#other").hide();
                }
                if (selectedValue === "developer") {
                    $("#developer").show();
                } else {
                    $("#developer").hide();
                }
            });
        });
    </script>
</body>

</html>