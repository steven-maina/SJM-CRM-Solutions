@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Pricing - Pages')

<!-- Page -->
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-pricing.css')}}" />
@endsection

@section('page-script')
<script src="{{asset('assets/js/pages-pricing.js')}}"></script>
@endsection

@section('content')
<div class="card">
  @if($user_role->name=='super user' || $user_role->name=='Dev')
  <div class="row mt-2">
    <div class="col-md-9"></div>
    <div class="col-md-3">
      <a href="{{route('pricing.create')}}" type="button" class="btn btn-primary">
        <span class="ti-xs ti ti-plus me-1"></span>Create New Plan
      </a>
    </div>
  </div>
  @endif
  <!-- Pricing Plans -->
  <div class="pb-sm-5 pb-2 rounded-top">
    <div class="container py-5">
      <h2 class="text-center mb-2 mt-0 mt-md-4">Available Pricing Plans</h2>
      <p class="text-center"> Get started with us - it's perfect for individuals and teams. Choose a subscription plan that meets your needs. </p>
      <div class="d-flex align-items-center justify-content-center flex-wrap gap-2 pb-5 pt-3 mb-0 mb-md-4">
        <label class="switch switch-primary ms-3 ms-sm-0 mt-2">
          <span class="switch-label">Monthly</span>
          <input type="checkbox" class="switch-input price-duration-toggler" checked />
          <span class="switch-toggle-slider">
            <span class="switch-on"></span>
            <span class="switch-off"></span>
          </span>
          <span class="switch-label">Annual</span>
        </label>
        <div class="mt-n5 ms-n5 d-none d-sm-block">
          <i class="ti ti-corner-left-down ti-sm text-muted me-1 scaleX-n1-rtl"></i>
          <span class="badge badge-sm bg-label-primary">Save up to 10%</span>
        </div>
      </div>

      <div class="row mx-0 gy-3 px-lg-5">
        @foreach($prices as $pricing)
        <div class="col-lg mb-md-0 mb-4">
          <div class="card border rounded shadow-none">
            <div class="card-body">
              <div class="my-3 pt-2 text-center">
                <img src="{{ asset('assets/img/illustrations/page-pricing-basic.png')}}" alt="Basic Image" height="140">
              </div>
              <h3 class="card-title fw-semibold text-center text-capitalize mb-1">{{$pricing->name ?? ''}}</h3>
              <p class="text-center">{{$pricing->description}}</p>
              <div class="text-center">
                <div class="d-flex justify-content-center">
                  <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary">KES</sup>
                  <h1 class="fw-semibold display-4 mb-0 text-primary">{{$pricing->price}}</h1>
                  <sub class="h6 pricing-duration mt-auto mb-2 text-muted fw-normal">{{$pricing->duration}}</sub>
                </div>
              </div>

              <ul class="ps-3 my-4 pt-2">
                <li class="mb-2">{{$pricing->feature1 ?? ""}}</li>
                <li class="mb-2">{{$pricing->feature2 ?? ""}}</li>
                <li class="mb-0">{{$pricing->feature3 ?? ""}}</li>
              </ul>
              @if($pricing->code === $current->code)
              <a href="#" class="btn btn-label-success d-grid w-100">Your Current Plan</a>
              @else
                <a href="#" class="btn btn-primary d-grid w-100">Upgrade</a>
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <!-- FAQS -->
  <div class="pricing-faqs bg-alt-pricing rounded-bottom">
    <div class="container py-5 px-lg-5">
      <div class="row mt-0 mt-md-4">
        <div class="col-12 text-center mb-4">
          <h2 class="mb-2">FAQs</h2>
          <p class="mb-2">Let us help answer the most common questions.</p>
        </div>
      </div>
      <div class="row mx-4">
        <div class="col-12">
          <div id="faq" class="accordion accordion-without-arrow">
            <div class="card accordion-item">
              <h6 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#faq-1" aria-controls="faq-1">
                  What counts towards the 100 responses limit?
                </button>
              </h6>

              <div id="faq-1" class="accordion-collapse collapse show" data-bs-parent="#faq">
                <div class="accordion-body">
                  We count all responses submitted through all your forms in a month.
                  If you already received 100 responses this month, you won’t be able to receive any more of them until next
                  month when the counter resets.
                </div>
              </div>
            </div>

            <div class="card accordion-item">
              <h6 class="accordion-header">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-2" aria-expanded="false" aria-controls="faq-2">
                  How do you process payments?
                </button>
              </h6>
              <div id="faq-2" class="accordion-collapse collapse" data-bs-parent="#faq">
                <div class="accordion-body">
                  We accept Mpesa, Credit Cards and PayPal®.
                  So you can be confident that your credit card information will be kept
                  safe and secure.
                </div>
              </div>
            </div>

            <div class="card accordion-item">
              <h6 class="accordion-header">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-3" aria-expanded="false" aria-controls="faq-3">
                  What payment methods do you accept?
                </button>
              </h6>
              <div id="faq-3" class="accordion-collapse collapse" data-bs-parent="#faq">
                <div class="accordion-body">
                  We accept all types of credit and debit cards.
                </div>
              </div>
            </div>

            <div class="card accordion-item">
              <h6 class="accordion-header">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-4" aria-expanded="false" aria-controls="faq-4">
                  Do you have a money-back guarantee?
                </button>
              </h6>
              <div id="faq-4" class="accordion-collapse collapse" data-bs-parent="#faq">
                <div class="accordion-body">
                  Yes. You may request a refund within 30 days of your purchase without any additional explanations.
                </div>
              </div>
            </div>

            <div class="card accordion-item mb-0 mb-md-4">
              <h6 class="accordion-header">
                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq-5" aria-expanded="false" aria-controls="faq-5">
                  I have more questions. Where can I get help?
                </button>
              </h6>
              <div id="faq-5" class="accordion-collapse collapse" data-bs-parent="#faq">
                <div class="accordion-body">
                  Please <a href="javascript:void(0);">contact</a> us if you have any other questions or concerns. We’re
                  here to help!
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ FAQS -->
</div>
@endsection
