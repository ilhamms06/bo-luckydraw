@extends('layouts.main')
@section('content')
@if (Auth::user()->status == 0)
<section class="section">
  <div class="section-header">
    <h1>Pricing</h1>
  </div>

  <div class="section-body">
    <h2 class="section-title">Pricing</h2>
    <p class="section-lead">Price components are very important for SaaS projects or other projects.</p>

    <div class="row">
      @foreach ($pricing as $item)
      <div class="col-12 col-md-4 col-lg-4">
        <div class="pricing pricing-highlight">
          <div class="pricing-title">
            {{ $item->name }}
          </div>
          <div class="pricing-padding">
            <div class="pricing-price pricing-higlight">
              <div>RP. {{ number_format($item->amount) }}</div>
              <div>/ {{ $item->expired_order }}</div>
            </div>
          </div>
          <div class="pricing-cta">
            <a href="#">Order <i class="fas fa-arrow-right"></i></a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@else
<section class="section">
  <div class="section-header">
    <h1>Dashboard</h1>
  </div>
  <div class="section-body">
    <h1 class="section-title">Welcome!, {{ Auth::user()->name }}</h1> 
  </div>
</section>
@endif
@endsection