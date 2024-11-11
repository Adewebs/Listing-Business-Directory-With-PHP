    <!-- footer section start -->
    <div class="footer">
          <div class="container">
              <div class="row">
                  <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                      <!-- footer widget  -->
                      <div class="footer-widget mb-5 mb-lg-0">
                          <div class="mb-4"> <img src="office/uploads/<?php echo basename($row['directory_logo']); ?>" 
     class="card-img-top directory-logo-img" 
     alt="<?php echo $row['directory_logo']; ?>" >
</div>
                          <p class="mb-3"><?php echo isset($row['directory_name']) ? $row['directory_name'] : 'Default Description'; ?> </p>
                          <div class="mb-2">
                              <p class="mb-1 font-weight-bold"><?php echo isset($row['directory_contact_phone_one']) ? $row['directory_contact_phone_one'] : 'Default Phone Number'; ?></p>
                              <p class=""><?php echo isset($row['directory_address']) ? $row['directory_address'] : 'Default Address'; ?></p>
                          </div>
                          <div class="social-links">
                              <a href="#!"><i class="fab fa-facebook-square  mr-2 "></i></a>
                              <a href="#!"><i class="fab fa-twitter-square  mr-2"></i></a>
                              <a href="#!"><i class="fab fa-linkedin  mr-2 "></i></a>
                              <a href="#!"><i class="fab fa-pinterest-square   mr-2"></i></a>
                              <a href="#!"><i class="fab fa-instagram "></i></a>
                          </div>
                      </div>
                  </div>
                  <!-- footer widget  -->
                  <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-6">
                      <div class="footer-widget mb-5 mb-lg-0">
                          <h3 class="footer-widget-title">Quick Links</h3>
                          <div class="footer-links">
                              <ul class="list-group list-unstyled">
                                  <li class="list-group-item"><a href="#!" class="list-group-link">Coworking space</a></li>
                                  <li class="list-group-item"><a href="#!" class="list-group-link">Meeting space</a></li>
                                  <li class="list-group-item"><a href="#!" class="list-group-link">Office space</a></li>
                                  <li class="list-group-item"><a href="#!" class="list-group-link">Retail Space</a></li>
                                  <li class="list-group-item"><a href="#!" class="list-group-link">Event space</a></li>
                                  <li class="list-group-item"><a href="#!" class="list-group-link">Virtual Space</a></li>
                              </ul>
                          </div>
                      </div>
                  </div>
                  <!-- footer widget  -->
                  <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-6">
                      <div class="footer-widget mb-5 mb-lg-0">
                          <h3 class="footer-widget-title">Company</h3>
                          <div class="footer-links">
                              <ul class="list-group list-unstyled">
                                  <li class="list-group-item"><a href="#!" class="list-group-link">About us</a></li>
                                  <li class="list-group-item"><a href="#!" class="list-group-link">Careers</a></li>
                                  <li class="list-group-item"><a href="#!" class="list-group-link">Clients</a></li>
                                  <li class="list-group-item"><a href="#!" class="list-group-link">Team</a> </li>
                                  <li class="list-group-item"><a href="#!" class="list-group-link">Help Center</a></li>
                                  <li class="list-group-item"><a href="#!" class="list-group-link">Press</a></li>
                              </ul>
                          </div>
                      </div>
                  </div>
                  <!-- footer widget  -->
                  <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                      <div class="footer-widget mb-5 mb-lg-0">
                          <h3 class="footer-widget-title">Newsletter</h3>
                          <form>
                              <div class="form-group mb-2">
                                  <label for="email" class="sr-only"> </label>
                                  <input type="password" class="form-control border-0" id="email" placeholder="Email address here">
                              </div>
                              <button type="submit" class="btn btn-primary">Subscribe</button>
                          </form>
                      </div>
                      <!-- footer widget  -->
                  </div>
              </div>
          </div>
          <!-- tiny footer  -->
          <div class="tiny-footer">
              <div class="container">
                  <div class="row">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                          <p class="mb-0">Copyright © 2024 <?php echo isset($row['directory_name']) ? $row['directory_name'] : 'Default Name'; ?>  Companies Inc. All rights reserved</p>
                      </div>
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                          <div class="tiny-footer-links">
                              <a href="#!">Privacy</a>
                                  <a href="#!">Terms</a>
                                 <a href="#!">Cookies</a>
                                 <a href="#!">FAQ</a>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- footer section close  -->
      </div>
      <!-- footer section close -->

    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Libs JS -->
        <script src="assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/select2/dist/js/select2.full.min.js"></script>
        <script src="assets/libs/select2/dist/js/select2.min.js"></script>
        <script src="assets/libs/jquery-raty-js/lib/jquery.raty.js"></script>
        <script src="assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/dataTables.net-bs4/js/dataTables.bootstrap4.min.html"></script>
        <script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/libs/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/libs/jquery.easing/jquery.easing.min.js"></script>
        <script src="assets/libs/prismjs/prism.js"></script>
        <script src="assets/libs/owl.carousel/dist/owl.carousel.min.js"></script>
        <script src="assets/libs/slick-carousel/slick/slick.min.js"></script>
        <script src="assets/libs/dropzone/dist/min/dropzone.min.js"></script>
        <script src="assets/libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
        <script src="assets/libs/leaflet/dist/leaflet.js"></script>
        <script src="../../../cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.12/clipboard.min.js"></script>
        <script src="../../../cdn.tiny.cloud/1/no-api-key/tinymce/5.10.9-138/tinymce.min.js"></script>



    <!-- Theme JS -->
    <script src="assets/js/theme.min.js"></script>