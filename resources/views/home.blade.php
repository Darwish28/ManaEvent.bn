<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ManaEvent.bn</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #fff;
      color: #333;
    }
    /* Header */
    .header {
      background: #fbbf24; /* orange */
      text-align: center;
      padding: 1rem;
    }
    .header img {
      max-width: 120px;
    }
    /* Hero */
    .hero {
      text-align: center;
      margin: 1rem 0;
    }
    .hero img {
      max-width: 90%;
      border-radius: 10px;
    }
    /* Button */
    .btn-submit {
      display: inline-block;
      background: #fbbf24;
      color: white;
      font-weight: bold;
      padding: 0.6rem 1.2rem;
      border-radius: 20px;
      text-decoration: none;
      margin: 1rem auto;
    }
    /* Section Titles */
    .section-title {
      background: #fbbf24;
      color: white;
      font-weight: bold;
      padding: 0.5rem;
      margin: 1.5rem 0 1rem;
      text-align: center;
      border-radius: 8px;
    }
    /* Event cards */
    .events {
      display: flex;
      justify-content: space-around;
      gap: 1rem;
      padding: 0 1rem;
      flex-wrap: wrap;
    }
    .event-card {
      width: 45%;
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .event-card img {
      width: 100%;
      height: 120px;
      object-fit: cover;
    }
    .event-card p {
      margin: 0.5rem;
      font-size: 0.9rem;
      font-weight: bold;
    }
    .view-more {
      text-align: right;
      margin: 0.5rem;
    }
    .view-more a {
      font-size: 0.8rem;
      text-decoration: none;
      color: #2563eb;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .events {
        flex-direction: column;
        align-items: center;
      }

      .event-card {
        width: 90%;   /* stack cards on mobile */
      }

      .hero img {
        max-width: 100%;
      }

      .btn-submit {
        width: 80%;
        text-align: center;
      }
    }

    @media (min-width: 1024px) {
      body {
        padding: 0 10%;
      }

      .events {
        justify-content: space-between;
      }

      .event-card {
        width: 30%;   /* allow 3 cards per row if needed */
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <div class="header">
    <img src="/images/manaevent-logo.svg" alt="ManaEvent Logo">
  </div>

  <!-- Hero -->
  <div class="hero">
    <img src="/images/hero-banner.png" alt="Hero illustration">
  </div>

  <!-- Submit Event -->
  <div style="text-align:center;">
    <a href="#" class="btn-submit">+ Submit Your Event</a>
  </div>

  <!-- What’s New This Week -->
  <div class="section-title">WHAT’S NEW THIS WEEK ?</div>
  <div class="events">
    <div class="event-card">
      <img src="/images/foodfestival.svg" alt="Food Festival">
      <p>FOOD FESTIVAL</p>
      <div class="view-more"><a href="#">View more</a></div>
    </div>
    <div class="event-card">
      <img src="/images/donation.svg" alt="Donation">
      <p>DONATION</p>
      <div class="view-more"><a href="#">View more</a></div>
    </div>
  </div>

  <!-- Upcoming Events -->
  <div class="section-title">UPCOMING EVENTS !</div>
  <div class="events">
    <div class="event-card">
      <img src="/images/theatre.svg" alt="Theatre">
      <p>THEATRE PERFORMANCE</p>
      <div class="view-more"><a href="#">View more</a></div>
    </div>
    <div class="event-card">
      <img src="/images/fireworks.svg" alt="Fireworks">
      <p>FIREWORKS SHOW</p>
      <div class="view-more"><a href="#">View more</a></div>
    </div>
  </div>

</body>
</html>
