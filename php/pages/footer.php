  <!--footer-area start-->
  <?php
     $insta_q = mysqli_query($con, "SELECT `id`,`data1` FROM `settings` WHERE `id` = 5");
    $insta_data = mysqli_fetch_array($insta_q);
                        ?>
  <footer class="footer-area pt-70 pb-40">
      <div class="container">
          <div class="row">
              <!-- Column 1: About & Social Media -->
              <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp2 animated" data-wow-delay=".1s">
                  <div class="footer__widget">
                      <div class="footer-logo mb-20">
                          <a href="index.php" class="logo">
                              <img src="assets/img/logo/header_logo_one.png" alt="College Logo">
                          </a>
                      </div>
                      <p>Find the best colleges and courses to shape your future. Get expert guidance and make informed decisions.</p>
                      <div class="social-media footer__social mt-20">
                          <?php include 'php/pages/social-icons.php' ?>
                      </div>
                  </div>
              </div>

              <!-- Column 2: Quick Links & Contact -->
              <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp2 animated" data-wow-delay=".3s">
                  <div class="footer__widget">
                      <h6 class="widget-title mb-20">Quick Links</h6>
                      <ul class="fot-list">
                          <li><a href="about.php">About Us</a></li>
                          <li><a href="register.php">Register</a></li>
                          <li><a href="login.php">Login</a></li>
                          <li><a href="profile.php">My Profile</a></li>
                          <li><a href="contact.php#form">Contact Us</a></li>
                      </ul>
                  </div>
              </div>

              <!-- Column 3: Legal & Developer -->
              <div class="col-lg-4 col-md-12 wow fadeInUp2 animated" data-wow-delay=".5s">
                  <div class="footer__widget">
                      <h6 class="widget-title mb-20">Legal & Resources</h6>
                      <ul class="fot-list">
                          <li><a href="terms.php">Terms & Conditions</a></li>
                          <li><a href="policy.php">Privacy Policy</a></li>

                          <li><a href="developer.php">Developer</a></li>
                      </ul>
                  </div>
              </div>
              <div class="whatsapp-banner wow fadeInUp2 animated" data-wow-delay=".6s">
                  <span class="text">Join Our <span class="whatsapp-text">Whatsapp</span> Community</span>
                  <a href="https://chat.whatsapp.com/EJvhZDPkSgYDNm7Vyr5M8g"> <button class="follow-btn">Follow</button></a>
              </div>

          </div>
      </div>
      <style>
          .whatsapp-banner {
              display: flex;
              align-items: center;
              justify-content: space-between;
              background-color: #2A4D9E;
              /* Adjust based on exact color */
              padding: 10px 20px;
              border-radius: 8px;
              max-width: 600px;
              margin: auto;
          }

          .text {
              color: white;
              font-size: 18px;
              font-weight: bold;
          }

          .whatsapp-text {
              color: #25D366;
              /* WhatsApp green */
              text-decoration: underline;
              font-weight: bold;
          }

          .follow-btn {
              background-color: #25D366;
              color: white;
              font-size: 16px;
              font-weight: bold;
              padding: 8px 16px;
              border: none;
              border-radius: 5px;
              cursor: pointer;
          }

          .follow-btn:hover {
              background-color: rgb(56, 173, 99);
          }
      </style>
      <!-- Copyright Section -->
      <div class="copy-right-area pt-30">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12 text-center">
                      <p class="copyright">© 2025 <a href="index.php">collegenew.com</a>. All Rights Reserved.</p>
                  </div>
              </div>
          </div>
      </div>
  </footer>

  <!--footer-area end-->



  <!-- <button id="contact_btn" style="position: fixed; z-index: 2147483647;"><i class="fas fa-comments"></i></button>
  Popup Modal -->


  <div class="floating-menu">
      <!-- Main Button -->
      <button id="main-btn" class="main-btn">
          <i class="fas fa-comments"></i>
      </button>

      <!-- Floating Buttons -->
      <div id="menu-items" class="menu-items">
        <?php 
        if (isset($_SESSION['Auth'])) { ?>
            <a href="profile.php" target="_blank" class="menu-item"><i class="fas fa-user-graduate theme-bg" ></i> 
            <p class="menu-text">My Profile</p>
        </a>
        <?php }else{?>
  <a href="register.php" target="_blank" class="menu-item"><i class="fas fa-user-graduate theme-bg" ></i> 
              <p class="menu-text">Register Now</p>
          </a>
       <?php }
        ?>
          <a href="tel:+918460042040" target="_blank" class="menu-item"><i class="fas fa-phone-volume" style="background-color:skyblue;"></i>
              <p class="menu-text">Make a Call</p>
          </a>
          <a href="https://www.facebook.com/share/194hqXJfod/" target="_blank" class="menu-item "><i class="fab fa-facebook-f facebook"></i>
              <p class="menu-text">Facebook</p>
          </a>
          <a href="<?= $insta_data ['data1']?>" target="_blank" class="menu-item "><i class="fab fa-instagram instagram"></i>
              <p class="menu-text">Instagram</p>
          </a>
          <a href="php/utils/actions.php?live_chat=true" target="_blank" class="menu-item "><i class="fab fa-whatsapp whatsapp"></i>
              <p class="menu-text">Whatsapp Chat</p>
          </a>
          <a href="https://youtube.com/@collegenew01?si=qL7jEP2AG-akMeJT" class="menu-item "><i class="fab fa-youtube gmail"></i>
              <p class="menu-text">Youtube</p>
          </a>
      </div>
  </div>

  <!-- Background Blur Effect -->
  <div id="overlay" class="overlay"></div>

  <style>
      /* Floating Menu */
      .floating-menu {
          position: fixed;
          bottom: 60px;
          right: 20px;
          z-index: 1001;
      }



      .main-btn {
          width: 60px;
          height: 60px;
          background: #FF723A;
          /* Company Color */
          color: white;
          border: none;
          border-radius: 50%;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
          font-size: 24px;
          display: flex;
          justify-content: center;
          align-items: center;
          cursor: pointer;
          transition: transform 0.3s ease-in-out;
      }

      .menu-text {
          color: #000;

      }

      .main-btn:active {
          transform: scale(1.1);
      }

      /* Floating Menu Items */
      .menu-items {
          display: flex;
          flex-direction: column;
          align-items: flex-end;
          gap: 10px;
          position: absolute;
          bottom: 70px;
          right: 0;
          transform: scale(0);
          transition: transform 0.3s ease-in-out, opacity 0.2s ease-in-out;
          opacity: 0;
      }

      /* Individual Buttons */
      .menu-item {
          display: flex;
          align-items: center;
          gap: 10px;
          padding: 10px 15px;
          background: white;
          width: max-content;
          border-radius: 25px;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
          cursor: pointer;
          transition: all 0.3s ease-in-out;
          text-decoration: none;
          color: black;
          font-weight: bold;
      }

      .menu-item i {
          /* Icon Background */
          color: white;
          width: 40px;
          height: 40px;
          display: flex;
          justify-content: center;
          align-items: center;
          border-radius: 50%;
          font-size: 18px;
      }

      .menu-item:hover {
          transform: scale(1.1);
      }

      /* Show Floating Items */
      .menu-items.show {
          transform: scale(1);
          opacity: 1;
      }

      /* Blur Background When Open */
      .overlay {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: rgba(0, 0, 0, 0.2);
          backdrop-filter: blur(5px);
          z-index: 1000;
          opacity: 0;
          pointer-events: none;
          transition: opacity 0.3s ease-in-out;
      }

      .overlay.show {
          opacity: 1;
          pointer-events: all;
      }
  </style>



  <script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
  <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
  <script src="assets/js/isotope.pkgd.min.js"></script>
  <script src="assets/js/slick.min.js"></script>
  <script src="assets/js/metisMenu.min.js"></script>
  <script src="assets/js/jquery.nice-select.js"></script>

  <script src="assets/js/wow.min.js"></script>

  <script src="assets/js/jquery.counterup.min.js"></script>
  <script src="assets/js/waypoints.min.js"></script>
  <script src="assets/js/jquery.scrollUp.min.js"></script>
  <script src="assets/js/imagesloaded.pkgd.min.js"></script>
  <script src="assets/js/jquery.magnific-popup.min.js"></script>
  <script src="assets/js/jquery.easypiechart.js"></script>
  <script src="assets/js/plugins.js"></script>
  <script src="assets/js/main.js"></script>


  <script>
      document.getElementById("main-btn").addEventListener("click", function() {
          document.getElementById("menu-items").classList.toggle("show");
          document.getElementById("overlay").classList.toggle("show");
      });
  </script>