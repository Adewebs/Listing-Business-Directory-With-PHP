<?php 
$page_title = "Office | Business Reviews";
$activePage = 'reviews.php';

include 'head.php';?>

  <body class="bg-light">
    <div class="db-wrapper">
      <div class="db-header">
        <!-- header start -->
        <!-- navigation start -->
        <?php include 'nav.php';?>
        <!-- navigation close -->
        <!-- header close -->
      </div>
      <!-- content start -->
      <div class="db-content py-lg-15 py-11">
        <div class="container">
          <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <?php include 'sidenav.php';?>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                  <div
                    class="db-pageheader d-xl-flex justify-content-between mb-4"
                  >
                    <div class="">
                      <h2 class="h3 mb-0">Reviews</h2>
                      <p class="db-pageheader-text">
                        All Businesses Reviews.
                      </p>
                    </div>
                    <div class="d-xl-flex align-items-center">
                      <a href="#" class="btn btn-primary"> Ask Reviews</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3 mb-lg-0">
                  <div class="card db-overview-widget h-100">
                    <div class="card-body">
                      <h3 class="h6 mb-3">Reviews</h3>
                      <div
                        class="d-flex justify-content-between align-items-center"
                      >
                        <h3 class="font-weight-bold h2 mb-0">
                          5
                        </h3>
                        <span class="db-overview-widget-body-icon">
                          <i
                            class="fas fa-star icon-shape icon-lg bg-light rounded-circle text-primary"
                          ></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3 mb-lg-0">
                  <div class="card db-overview-widget h-100">
                    <div class="card-body">
                      <h3 class="h6 mb-3">Average Rating</h3>
                      <div
                        class="d-flex justify-content-between align-items-center"
                      >
                        <h3 class="font-weight-bold h2 mb-0">
                          4.9
                        </h3>
                        <div class="review-content-rating small pt-2">
                          <i class="fas fa-star text-warning"></i>
                          <i class="fas fa-star text-warning"></i>
                          <i class="fas fa-star text-warning"></i>
                          <i class="fas fa-star text-warning"></i>
                          <i class="fas fa-star text-light"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                  <div class="review-form mt-4">
                    <h5 class="mb-3">All Reviews</h5>
                    <form>
                      <div class="form-row">
                        <div class="col-md-5 mb-2 mb-lg-0 ">
                          <select
                            class="select2 custom-select mb-1"
                            id="reviewlist"
                          >
                            <option selected>Listing Name</option>
                            <option value="1">Heading title of name</option>
                            <option value="2">Heading title of name</option>
                            <option value="3">Heading title of name</option>
                          </select>
                        </div>
                        <div class="col-md-5 mb-2 mb-lg-0 ">
                          <select
                            class="select2 custom-select mb-1"
                            id="reviewsort"
                          >
                            <option selected>Sort</option>
                            <option value="1">Sort by Date</option>
                            <option value="2">Sort by High Review</option>
                            <option value="3">Sort by Low Review</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <button
                            class="btn btn-primary btn-block btn-lg"
                            type="submit"
                          >
                            Search
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-xl-flex justify-content-between">
                        <div class="review-content-head">
                          <h3 class="h4">Doris Knapp</h3>
                          <div class="mb-3 font-12">
                            <span class="fas fa-star text-warning"></span>
                            <span class="fas fa-star text-warning"></span>
                            <span class="fas fa-star text-warning"></span>
                            <span class="fas fa-star text-warning"></span>
                            <span class="fas fa-star-half text-warning"></span>
                            <a
                              href="listing-single.html"
                              class="badge badge-success ml-2"
                              >4.5</a
                            >
                          </div>
                        </div>
                        <div class="d-xl-flex align-items-center">
                          <div
                            class="custom-control custom-checkbox custom-control-inline"
                          >
                            <input
                              type="checkbox"
                              class="custom-control-input"
                              id="customCheck1"
                            />
                            <label
                              class="custom-control-label"
                              for="customCheck1"
                              >Hidden</label
                            >
                          </div>
                          <div
                            class="custom-control custom-checkbox custom-control-inline"
                          >
                            <input
                              type="checkbox"
                              class="custom-control-input"
                              id="customCheck2"
                            />
                            <label
                              class="custom-control-label"
                              for="customCheck2"
                              >Featured</label
                            >
                          </div>
                        </div>
                      </div>
                      <h5 class="mb-2">
                        Good budget workspacer
                      </h5>
                      <p class="review-content-text">
                        I highly recommend this places lorem dignissim at. Nunc
                        quis mag na non miquis magna eleifend vestibulum quis
                        magna. Aliquam aliquam viverra nisl, id malesuada urna
                        finibus at. Cras tristique felis risus, eget auctor mi
                        sagittis quis. Nulla placerat ultrices metus a commodo.
                      </p>
                      <a
                        class="btn btn-primary btn-sm"
                        data-toggle="collapse"
                        href="#collapseExample"
                        role="button"
                        aria-expanded="false"
                        aria-controls="collapseExample"
                        >Respond</a
                      >
                    </div>
                  </div>
                </div>
                <div
                  class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3"
                >
                  <div class="collapse" id="collapseExample">
                    <div class="card">
                      <h5 class="card-header bg-white h6">Respond to review</h5>

                      <div class="card-body">
                        <div class="review-content-head">
                          <h3 class="h4">Doris Knapp</h3>
                          <div class="mb-3 font-12">
                            <span class="fas fa-star text-warning"></span>
                            <span class="fas fa-star text-warning"></span>
                            <span class="fas fa-star text-warning"></span>
                            <span class="fas fa-star text-warning"></span>
                            <span class="fas fa-star-half text-light"></span>
                            <a
                              href="listing-single.html"
                              class="badge badge-success ml-2"
                              >4.0</a
                            >
                          </div>
                        </div>
                        <form class="">
                          <div class="form-group">
                            <label for="exampleFormControlTextarea1"
                              >Write Your Response</label
                            >
                            <textarea
                              class="form-control"
                              id="exampleFormControlTextarea1"
                              rows="3"
                              placeholder="Thanks Doris, Great"
                            ></textarea>
                          </div>
                          <button
                            type="submit"
                            class="btn btn-primary btn-sm btn-sm save"
                          >
                            Save
                          </button>
                          <a
                            class="btn btn-outline-primary btn-sm"
                            data-toggle="collapse"
                            href="#collapseExample"
                            role="button"
                            aria-expanded="false"
                            aria-controls="collapseExample"
                            >close</a
                          >
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
               
          
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content close -->
      <!-- footer start -->

      <!-- footer close -->
    </div>
    <?php include 'foot.php'; ?>