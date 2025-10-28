<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ManaEvent.bn</title>
  <style>
    :root {
      --primary: #fbbf24;
      --primary-dark: #f59e0b;
      --text-dark: #333;
      --text-light: #666;
      --bg-light: #fff;
      --shadow: 0 2px 10px rgba(0,0,0,0.08);
    }

    body {
      font-family: 'Poppins', Arial, sans-serif;
      margin: 0;
      background: var(--bg-light);
      color: var(--text-dark);
      line-height: 1.6;
    }

    /* ---------- Header ---------- */
    .header {
      position: sticky;
      top: 0;
      z-index: 1000;
      background: var(--primary);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0.8rem 1.2rem;
      box-shadow: var(--shadow);
    }

    .header img {
      max-width: 120px;
      height: auto;
    }

    .menu-btn {
      font-size: 1.8rem;
      color: white;
      background: none;
      border: none;
      cursor: pointer;
    }

    /* ---------- Hero Slider ---------- */
    .hero-slider {
      position: relative;
      max-width: 100%;
      margin: 1.5rem auto;
      overflow: hidden;
      border-radius: 14px;
      box-shadow: var(--shadow);
    }

    .hero-slide {
      display: none;
      width: 100%;
      transition: 0.5s;
    }

    .hero-slide img {
      width: 100%;
      display: block;
      border-radius: 14px;
    }

    .hero-slide.active {
      display: block;
    }

    .hero-slider .prev, .hero-slider .next {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(0,0,0,0.4);
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      cursor: pointer;
      border-radius: 50%;
      font-size: 1.5rem;
    }

    .hero-slider .prev { left: 10px; }
    .hero-slider .next { right: 10px; }

    /* ---------- Submit Button ---------- */
    .btn-submit {
      display: inline-block;
      background: var(--primary);
      color: white;
      font-weight: 600;
      padding: 0.8rem 1.6rem;
      border-radius: 25px;
      text-decoration: none;
      margin: 1.5rem auto;
      transition: all 0.3s ease;
      box-shadow: 0 3px 6px rgba(0,0,0,0.15);
    }

    .btn-submit:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
    }

    /* ---------- Section Titles ---------- */
    .section-title {
      background: var(--primary);
      color: white;
      font-weight: 600;
      padding: 0.7rem;
      margin: 2rem auto 1rem;
      text-align: center;
      border-radius: 10px;
      width: fit-content;
      min-width: 250px;
      box-shadow: var(--shadow);
    }

    /* ---------- Event Cards ---------- */
    .events {
      display: flex;
      justify-content: center;
      gap: 1.5rem;
      padding: 0 1rem 2rem;
      flex-wrap: wrap;
    }

    .event-card {
      width: 280px;
      background: var(--bg-light);
      border-radius: 10px;
      overflow: hidden;
      box-shadow: var(--shadow);
      transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .event-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }

    .event-card img {
      width: 100%;
      height: 160px;
      object-fit: cover;
    }

    .event-card p {
      margin: 0.8rem 1rem 0.2rem;
      font-size: 1rem;
      font-weight: 600;
    }

    .event-info {
      font-size: 0.85rem;
      color: var(--text-light);
      margin: 0 1rem 0.5rem;
    }

    .event-info span {
      display: inline-block;
      margin-right: 0.5rem;
    }

    .view-more {
      text-align: right;
      margin: 0 1rem 1rem;
    }

    .view-more a {
      font-size: 0.85rem;
      text-decoration: none;
      color: #2563eb;
      transition: color 0.3s;
    }

    .view-more a:hover {
      color: #1d4ed8;
    }

    /* ---------- Footer ---------- */
    footer {
      background: #f3f4f6;
      text-align: center;
      padding: 1.2rem;
      font-size: 0.85rem;
      color: var(--text-light);
      margin-top: 2rem;
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 768px) {
      .hero-slide img {
        max-width: 95%;
      }

      .btn-submit {
        width: 80%;
      }

      .events {
        flex-direction: column;
        align-items: center;
      }

      .event-card {
        width: 90%;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <div class="header">
    <button class="menu-btn">&#9776;</button>
    <img src="/images/manaevent-logo.svg" alt="ManaEvent Logo">
    <div style="width:32px;"></div>
  </div>

  <!-- Hero Slider -->
  <div class="hero-slider">
    <div class="hero-slide active">
      <img src="/images/NationalDay.png" alt="National Day">
    </div>
    <div class="hero-slide">
      <img src="/images/FoodFestivalBanner.png" alt="Food Festival Banner">
    </div>
    <div class="hero-slide">
      <img src="/images/FireworksBanner.png" alt="Fireworks Show Banner">
    </div>

    <button class="prev">&#10094;</button>
    <button class="next">&#10095;</button>
  </div>

  <!-- Submit Button -->
  <div style="text-align:center;">
    <a href="{{ route('submit.event') }}" class="btn-submit">+ Submit Your Event</a>
  </div>

  <!-- What's New -->
  <div class="section-title">WHAT’S NEW THIS WEEK 🎉</div>
  <div class="events">
    <div class="event-card">
      <img src="/images/foodfestival.svg" alt="Food Festival">
      <p>Food Festival</p>
      <div class="event-info">
        <span>📅 28 Oct 2025</span> • <span>📍 Brunei City Center</span>
      </div>
      <div class="view-more"><a href="{{ route('events.food-festival') }}">View more →</a></div>
    </div>

    <div class="event-card">
      <img src="/images/donation.svg" alt="Donation">
      <p>Donation Drive</p>
      <div class="event-info">
        <span>📅 30 Oct 2025</span> • <span>📍 Kampong Ayer</span>
      </div>
      <div class="view-more"><a href="{{ route('events.donation') }}">View more →</a></div>
    </div>
  </div>

  <!-- Upcoming Events -->
  <div class="section-title">UPCOMING EVENTS 🔥</div>
  <div class="events">
    <div class="event-card">
      <img src="/images/theatre.svg" alt="Theatre Performance">
      <p>Theatre Performance</p>
      <div class="event-info">
        <span>📅 5 Nov 2025</span> • <span>📍 Royal Theatre</span>
      </div>
      <div class="view-more"><a href="{{ route('events.theatre-performance') }}">View more →</a></div>
    </div>

    <div class="event-card">
      <img src="/images/fireworks.svg" alt="Fireworks Show">
      <p>Fireworks Show</p>
      <div class="event-info">
        <span>📅 10 Nov 2025</span> • <span>📍 Waterfront</span>
      </div>
      <div class="view-more"><a href="{{ route('events.firework-show') }}">View more →</a></div>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    © 2025 ManaEvent.bn — Bringing Brunei’s events together.
  </footer>

  <!-- Hero Slider JS -->
  <script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.hero-slide');
    const totalSlides = slides.length;

    function showSlide(index) {
      slides.forEach(slide => slide.classList.remove('active'));
      slides[index].classList.add('active');
    }

    document.querySelector('.next').addEventListener('click', () => {
      currentSlide = (currentSlide + 1) % totalSlides;
      showSlide(currentSlide);
    });

    document.querySelector('.prev').addEventListener('click', () => {
      currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
      showSlide(currentSlide);
    });

    setInterval(() => {
      currentSlide = (currentSlide + 1) % totalSlides;
      showSlide(currentSlide);
    }, 5000);
  </script>

</body>
</html>
