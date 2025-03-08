  <!--footer-area start-->
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
                          <li><a href="privacy.php">Privacy Policy</a></li>
                          <li><a href="copyright.php">Copyright</a></li>
                          <li><a href="developer.php">Developer</a></li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>

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



  <button id="contact_btn" style="position: fixed; z-index: 2147483647;"><i class="fas fa-comments"></i></button>
  <!-- Popup Modal -->


  <!-- Custom Popup Modal -->
  <div id="contactModal" class="custom-modal">
      <div class="modal-overlay"></div>
      <div class="modal-content">
          <div class="modal-header">
              <h5 style="color:#fff">Need Help?</h5>
              <button id="close_modal" class="close-btn">&times;</button>
          </div>
          <div class="modal-body">
              <div class="contact-item">
                  <i class="fas fa-phone"></i>
                  <div class="text-start">
                      <h6>Call Us</h6>
                      <p>+91 98765 43210</p>
                  </div>
              </div>
              <div class="contact-item">
                  <i class="fas fa-envelope"></i>
                  <div class="text-start">
                      <h6>Email Us</h6>
                      <p>support@example.com</p>
                  </div>
              </div>
              <div class="contact-item" onclick="window.location.href ='php/utils/actions.php?live_chat=true'">
                  <i class="fas fa-comment-dots"></i>
                  <div class="text-start">
                      <h6>Live Chat</h6>
                      <p>Chat with our team</p>
                  </div>
              </div>
              <div class="social-media footer__social mt-30">
                  <?php include 'php/pages/social-icons.php' ?>

              </div>
          </div>
      </div>
  </div>

  <!-- Custom CSS for Modern Popup -->
  <style>
      /* Modal Styling */
      .custom-modal {
          display: none;
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          z-index: 1000;
          align-items: center;
          justify-content: center;
      }

      /* Blurred Background */
      .modal-overlay {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: rgba(0, 0, 0, 0.5);
          backdrop-filter: blur(8px);
          z-index: -1;
      }

      /* Modal Content */
      .modal-content {
          background: white;
          border-radius: 15px;
          padding: 20px;
          width: 350px;
          max-width: 90%;
          text-align: center;
          box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.2);
          transform: scale(0.8);
          opacity: 0;
          transition: all 0.3s ease-in-out;
      }

      /* Show Animation */
      .custom-modal.show .modal-content {
          transform: scale(1);
          opacity: 1;
      }

      /* Modal Header */
      .modal-header {
          display: flex;
          justify-content: space-between;
          align-items: center;
          background-color: #FF723A;
          color: white;
          padding: 15px;
          border-radius: 12px 12px 0 0;
      }

      /* Close Button */
      .close-btn {
          background: none;
          border: none;
          font-size: 24px;
          color: white;
          cursor: pointer;
      }

      /* Contact Options */
      .contact-item {
          display: flex;
          align-items: center;
          gap: 15px;
          background: #f9f9f9;
          padding: 15px;
          border-radius: 10px;
          margin-top: 10px;
          transition: all 0.3s ease-in-out;
          cursor: pointer;

      }

      .contact-item:hover {
          background: #FF723A;
          color: white;
      }

      .contact-item:hover h6,
      .contact-item:hover p {
          color: #fff;
      }

      .contact-item i {
          font-size: 20px;
          color: #FF723A;
      }

      .contact-item:hover i {
          color: white;
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
      document.getElementById("contact_btn").addEventListener("click", function() {
          document.getElementById("contactModal").classList.add("show");
          document.getElementById("contactModal").style.display = "flex";
      });
      document.getElementById("close_modal").addEventListener("click", function() {
          document.getElementById("contactModal").classList.remove("show");
          setTimeout(() => {
              document.getElementById("contactModal").style.display = "none";
          }, 300);
      });
  </script>