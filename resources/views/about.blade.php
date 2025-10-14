@extends('layouts.app')

@section('content')
<section class="about">
  <a href="/" class="back-btn"><i class="fas fa-arrow-left"></i></a>
  <h1>ABOUT US</h1>
  <p>
    Tired of missing out on events in Brunei? <strong>ManaEvent.bn</strong> is your one-stop
    platform for discovering what’s happening — from concerts and pop-up markets to
    religious events and business expos. <br><br>
    No more scrolling through social media. Just real-time updates, all in one place.
    Built for Bruneians, by Bruneians.
  </p>
</section>

<style>
  body {
    background: url('/images/lights-bg.jpg') no-repeat center center/cover;
    min-height: 100vh;
  }
  .about {
    background: rgba(255, 255, 255, 0.85);
    margin: 40px;
    padding: 30px;
    border-radius: 12px;
    position: relative;
  }
  .back-btn {
    position: absolute;
    top: 20px;
    left: 20px;
    color: #000;
    font-size: 20px;
    text-decoration: none;
  }
  h1 {
    text-align: center;
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 15px;
  }
  p {
    font-size: 16px;
    line-height: 1.6;
    text-align: justify;
  }
</style>
@endsection
