<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php include 'php/pages/meta.php' ?>
</head>

<body>


    <?php include 'php/pages/header.php' ?>

    <!-- slide-bar start -->
    <aside class="slide-bar">
        <div class="close-mobile-menu">
            <a href="javascript:void(0);"><i class="fas fa-times"></i></a>
        </div>

        <!-- offset-sidebar start -->
        <div class="offset-sidebar">
            <div class="offset-widget offset-logo mb-30">
                <a href="index.html">
                    <img src="assets/img/logo/header_logo_one.svg" alt="logo">
                </a>
            </div>
            <div class="offset-widget mb-40">
                <div class="info-widget">
                    <h4 class="offset-title mb-20">About Us</h4>
                    <p class="mb-30">
                        But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain
                        was born and will give you a complete account of the system and expound the actual teachings of
                        the great explore
                    </p>
                    <a class="theme_btn theme_btn_bg" href="contact.html">Contact Us</a>
                </div>
            </div>
            <div class="offset-widget mb-30 pr-10">
                <div class="info-widget info-widget2">
                    <h4 class="offset-title mb-20">Contact Info</h4>
                    <p> <i class="fal fa-address-book"></i> 23/A, Miranda City Likaoli Prikano, Dope</p>
                    <p> <i class="fal fa-phone"></i> +0989 7876 9865 9 </p>
                    <p> <i class="fal fa-envelope-open"></i> info@example.com </p>
                </div>
            </div>
        </div>
        <!-- offset-sidebar end -->

        <!-- side-mobile-menu start -->
         <nav class="side-mobile-menu">
            <ul id="mobile-menu-active">
                <li class="has-dropdown">
                    <a href="index.html">Home</a>
                    <ul class="sub-menu">
                        <li><a href="index.html">Home Style 1</a></li>
                        <li><a href="index-2.html">Home Style 2</a></li>
                        <li><a href="index-3.html">Home Style 3</a></li>
                    </ul>
                </li>
                <li><a href="about.html">About</a></li>
                <li class="has-dropdown">
                    <a href="#">Pages</a>
                    <ul class="sub-menu">
                        <li><a href="courses.html">Course One</a></li>
                        <li><a href="courses-2.html">Course Two</a></li>
                        <li><a href="course-details.html">Courses Details</a></li>
                        <li><a href="price.html">Price</a></li>
                        <li><a href="instructor.html">Instructor</a></li>
                        <li><a href="instructor-profile.html">Instructor Profile</a></li>
                        <li><a href="faq.html">FAQ</a></li>
                    </ul>
                </li>
                <li class="has-dropdown"><a href="#">Blogs</a>
                    <ul class="sub-menu">
                        <li><a href="blog.html">Blog Grid</a></li>
                        <li><a href="blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="contact.html">Contacts Us</a></li>
            </ul>
        </nav>
        <!-- side-mobile-menu end -->
    </aside>
    <div class="body-overlay"></div>
    <!-- slide-bar end -->
    

    <main>
     <!--page-title-area start-->
      <section class="page-title-area d-flex align-items-end" style="background-image: url(assets/img/page-title-bg/01.jpg);">
          <div class="container">
              <div class="row align-items-end">
                  <div class="col-lg-12">
                      <div class="page-title-wrapper mb-50">
                         <h1 class="page-title mb-25">Login</h1>
                         <div class="breadcrumb-list">
                            <ul class="breadcrumb">
                                <li><a href="index.html">Home -</a></li>
                                <li><a href="#">Login</a></li>
                            </ul>
                         </div>
                    </div>
                  </div>
              </div>
          </div>
      </section>
      <!--page-title-area end-->
      <!--contact-form-area start-->
      <section class="contact-form-area pt-150 pb-120 pt-md-100 pt-xs-100 pb-md-70 pb-xs-70">
          <div class="container">
              <div class="row justify-content-center align-items-center">
                  <div class="col-lg-6">
                    <div class="contact-form-wrapper text-center mb-30">
                        <h2 class="mb-45">Login</h2>
                        <form action="#" class="row gx-3 comments-form contact-form">
                            <div class="col-lg-12 mb-30">
                                <input type="text" placeholder="Username">
                            </div>
                            <div class="col-lg-12 mb-30">
                                <input type="password" placeholder="******">
                            </div>
                        </form>
                        <button class="theme_btn message_btn mt-20">Login</button>
                    </div>
                  </div>
              </div>
          </div>
      </section>
      <!--contact-form-area end-->
       <!-- subscribe-area start -->
       <section class="subscribe-area footer-bg border-bot pt-145 pb-50 pt-md-90 pt-xs-90">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="subscribe-wrapper text-center mb-30">
                            <h2>Subscribe our Newsletter & Get every updates.</h2>
                           <div class="subscribe-form-box pos-rel">
                                <form class="subscribe-form">
                                    <input type="text" placeholder="Write Your E-mail">
                                </form>
                                <button class="sub_btn">Subscribe Now</button>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
       </section>
       <!-- subscribe-area end -->
    </main>
    
    <?php include 'php/pages/footer.php'?>
</body>

</html>
