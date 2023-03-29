@extends('layouts.base')
<!-- Start wrapper-->
@section('content')






<div class="container-xxl position-relative bg-white d-flex p-0">
  <!-- Spinner Start -->
  <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
      <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
          <span class="sr-only">Loading...</span>
      </div>
  </div>
  <!-- Spinner End -->



  <!-- Content Start -->
  <div class="content">
      <!-- Navbar Start -->
  @include('layouts.header')
      <!-- Navbar End -->


      <!-- Sale & Revenue Start -->
      <div class="container-fluid pt-4 px-4">
          <div class="row g-4">
              <div class="col-sm-6 col-xl-3">
                  <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                      <i class="fa fa-chart-line fa-3x text-primary"></i>
                      <div class="ms-3">
                          <p class="mb-2">Today Sale</p>
                          <h6 class="mb-0">$1234</h6>
                      </div>
                  </div>
              </div>
              <div class="col-sm-6 col-xl-3">
                  <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                      <i class="fa fa-chart-bar fa-3x text-primary"></i>
                      <div class="ms-3">
                          <p class="mb-2">Total Sale</p>
                          <h6 class="mb-0">$1234</h6>
                      </div>
                  </div>
              </div>
              <div class="col-sm-6 col-xl-3">
                  <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                      <i class="fa fa-chart-area fa-3x text-primary"></i>
                      <div class="ms-3">
                          <p class="mb-2">Today Revenue</p>
                          <h6 class="mb-0">$1234</h6>
                      </div>
                  </div>
              </div>
              <div class="col-sm-6 col-xl-3">
                  <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                      <i class="fa fa-chart-pie fa-3x text-primary"></i>
                      <div class="ms-3">
                          <p class="mb-2">Total Revenue</p>
                          <h6 class="mb-0">$1234</h6>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Sale & Revenue End -->
      <!-- Footer Start -->
      <div class="container-fluid pt-4 px-4">
          <div class="bg-light rounded-top p-4">
              <div class="row">
                  <div class="col-12 col-sm-6 text-center text-sm-start">
                      &copy; <a href="#">Your Site Name</a>, All Right Reserved. 
                  </div>
                  <div class="col-12 col-sm-6 text-center text-sm-end">
                      <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                      Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                  </br>
                  Distributed By <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a>
                  </div>
              </div>
          </div>
      </div>
      <!-- Footer End -->
  </div>
  <!-- Content End -->


  <!-- Back to Top -->
  <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

@endsection
<!--End wrapper-->