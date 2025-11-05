{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ManaEvent.bn — Home</title>

  {{-- Icons for hamburger/close --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

  <style>
    :root{
      --yellow:#f4b61a;
      --yellow-600:#e1a514;
      --text:#1f2937;
      --muted:#6b7280;
      --card:#ffffff;
      --shadow:0 10px 30px rgba(0,0,0,.08);
      --radius:14px;
    }
    *{box-sizing:border-box;margin:0;padding:0}
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Inter,Arial,sans-serif;background:#fff;color:var(--text)}

    /* ---------- Body (Background Image + Opacity Overlay) ---------- */ 
    body { font-family: 'Poppins', Arial, sans-serif; 
      margin: 0; color: var(--text-dark); line-height: 1.6; background: 
      linear-gradient(rgba(255,255,255,0.7), rgba(255,255,255,0.7)), url('images/blackyellowwhite.jpg') 
      center top no-repeat; background-size: cover; background-attachment: fixed; }

    /* Header */
    .banner{background:var(--yellow); position:sticky; top:0; z-index:200}
    .bar{max-width:1200px;margin:auto;display:flex;align-items:center;justify-content:space-between;padding:14px 18px}
    #menuBtn{border:none;background:none;color:#fff;font-size:28px;cursor:pointer;line-height:1;display:flex;align-items:center}
    #menuBtn:hover{transform:scale(1.08)}
    .logo{width:70px}

    /* Sidebar + overlay */
    #overlay{position:fixed;inset:0;background:rgba(0,0,0,.4);display:none;z-index:900}
    #sidebar{
      position:fixed;top:0;left:0;height:100vh;width:290px;background:#fff;
      box-shadow:var(--shadow);transform:translateX(-100%);transition:transform .28s ease;z-index:1000;
      display:flex;flex-direction:column;border-right:1px solid #eee
    }
    #sidebar.open{transform:translateX(0)}
    .side-head{display:flex;align-items:center;justify-content:space-between;padding:14px 16px;border-bottom:1px solid #eee}
    .side-brand{display:flex;align-items:center;gap:.6rem}
    .side-brand img{width:28px;height:28px}
    #closeSidebar{border:none;background:none;font-size:22px;color:#6b7280;cursor:pointer}
    #closeSidebar:hover{color:#111}
    .side-links{padding:8px}
    .side-links a{
      display:flex;align-items:center;gap:.6rem;padding:10px 12px;margin:4px 6px;border-radius:10px;
      color:#374151;text-decoration:none
    }
    .side-links a:hover{background:#f7f7f7}
    .side-links i{color:var(--yellow)}

    /* Page container */
    .wrap{max-width:1200px;margin:24px auto;padding:0 16px}

    /* Hero */
    .hero{position:relative;background:#fff;border-radius:var(--radius);box-shadow:var(--shadow);overflow:hidden}
    .hero-slide{display:none}
    .hero-slide.active{display:block}
    .hero-slide img{width:100%;display:block}
    .hero-nav{
      position:absolute;inset:0;display:flex;align-items:center;justify-content:space-between;padding:0 10px;pointer-events:none
    }
    .hero-btn{
      pointer-events:auto;width:38px;height:38px;border-radius:9999px;border:none;background:rgba(255,255,255,.9);
      box-shadow:var(--shadow);cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:16px
    }

    /* CTA */
    .cta-row{display:flex;justify-content:center;margin:18px 0 26px}
    .cta{background:var(--yellow);color:#fff;border:none;border-radius:9999px;padding:10px 18px;font-weight:700;cursor:pointer}
    .cta:hover{background:var(--yellow-600)}

    /* Section title bar */
    .section-title{
      background:var(--yellow);color:#fff;border-radius:10px;
      padding:9px 14px;font-weight:800;letter-spacing:.5px;text-align:center;margin:16px 0
    }

    /* Cards */
    .grid{
  display:flex;
  flex-wrap:wrap;
  gap:18px;
  justify-content:flex-start;
}
.grid.single{
  justify-content:center;
}
.card{
  flex:1 1 calc(50% - 18px);
  max-width:calc(50% - 18px);
  background:var(--card);
  border-radius:12px;
  box-shadow:var(--shadow);
  overflow:hidden;
}
@media (max-width:1000px){
  .card{flex:1 1 100%;max-width:100%;}
}

    .card{grid-column:span 6;background:var(--card);border-radius:12px;box-shadow:var(--shadow);overflow:hidden}
    .card img{width:100%;height:160px;object-fit:cover;display:block}
    .card .body{padding:10px 12px;display:flex;align-items:center;justify-content:space-between}
    .kicker{font-size:12px;color:var(--muted);font-weight:700;letter-spacing:.4px}
    .viewmore{font-size:12px;color:#2563eb;text-decoration:none}
    .viewmore:hover{text-decoration:underline}

    @media (max-width:1000px){
      .card{grid-column:span 12}
    }
  </style>
</head>
<body>

  <!-- Header -->
  <div class="banner">
    <div class="bar">
      <button id="menuBtn" aria-label="Open menu"><i class="fa-solid fa-bars"></i></button>
      <img class="logo" src="/images/manaevent-logo.svg" alt="ManaEvent Logo">
      <div style="width:28px"></div>
    </div>
  </div>

  <!-- Overlay & Sidebar -->
  <div id="overlay"></div>
  <aside id="sidebar" aria-label="Sidebar Navigation">
    <div class="side-head">
      <div class="side-brand">
        <img src="/images/manaevent-logo.svg" alt="ManaEvent">
        <strong>ManaEvent.bn</strong>
      </div>
      <button id="closeSidebar" aria-label="Close menu"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <nav class="side-links">
      <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> <span>Home</span></a>
      <a href="{{ route('about') }}"><i class="fa-solid fa-circle-info"></i> <span>About Us</span></a>
      <a href="{{ route('submit-event') }}"><i class="fa-solid fa-plus"></i> <span>Submit Your Event</span></a>
      <a href="{{ route('faq') }}"><i class="fa-solid fa-question"></i> <span>FAQ</span></a>
      <a href="{{ route('contact') }}"><i class="fa-solid fa-envelope"></i> <span>Contact</span></a>
      <a href="{{ route('settings') }}"><i class="fa-solid fa-gear"></i> <span>Settings</span></a>
    </nav>
  </aside>

  <main class="wrap">

    <!-- Hero slider -->
    <section class="hero">
      <div class="hero-slide active"><img src="/images/NationalDay.png" alt="National Day"></div>
      <div class="hero-slide"><img src="/images/Havock.png" alt="Community Event"></div>
      <div class="hero-slide"><img src="/images/Suaseni.jpg" alt="Concert"></div>

      <div class="hero-nav">
        <button class="hero-btn" id="prev" aria-label="Previous slide"><i class="fa-solid fa-chevron-left"></i></button>
        <button class="hero-btn" id="next" aria-label="Next slide"><i class="fa-solid fa-chevron-right"></i></button>
      </div>
    </section>

    <!-- CTA -->
    <div class="cta-row">
      <a href="{{ route('submit-event') }}"><button class="cta">+ Submit Your Event</button></a>
    </div>

    <!-- What's new -->
    <div class="section-title">WHAT’S NEW THIS WEEK ?</div>

    <section class="grid" aria-label="What's new">
      <article class="card">
        <img src="/images/foodfestival.svg" alt="Food festival">
        <div class="body">
          <div>
            <div class="kicker">FOOD FESTIVAL</div>
          </div>
          <a class="viewmore" href="{{ url('/events/food-festival') }}">View more</a>
        </div>
      </article>

      <article class="card">
        <img src="/images/donation.svg" alt="Donation">
        <div class="body">
          <div><div class="kicker">DONATION</div></div>
          <a class="viewmore" href="{{ url('/events/donation') }}">View more</a>
        </div>
      </article>
    </section>

    <!-- Upcoming Events (reformatted to card layout) -->
    <div class="section-title">UPCOMING EVENTS 🎉</div>
    <section class="grid" aria-label="Upcoming Events">
      <article class="card">
        <img src="/images/theatre.svg" alt="Theatre Performance">
        <div class="body">
          <div class="kicker">THEATRE PERFORMANCE</div>
          <a class="viewmore" href="{{ url('/events/theatre-performance') }}">View more</a>
        </div>
      </article>

      <article class="card">
        <img src="/images/fireworks.svg" alt="Fireworks Show">
        <div class="body">
          <div class="kicker">FIREWORKS SHOW</div>
          <a class="viewmore" href="{{ route('events.firework-show') }}">View more</a>
        </div>
      </article>
    </section>

    <!-- ✅ Latest Approved Events -->
    @if(isset($upcoming) && $upcoming->count() > 0)
      <div class="section-title">LATEST APPROVED EVENTS 🌟</div>
      <section class="grid {{ $upcoming->count() === 1 ? 'single' : '' }}" aria-label="Latest Approved Events">
        @foreach($upcoming as $event)
          <article class="card">
            <img 
              src="{{ $event->file_path ? asset('storage/' . $event->file_path) : asset('images/default-event.jpg') }}" 
              alt="{{ $event->event_name }}" 
            >
            <div class="body">
              <div>
                <div class="kicker">{{ strtoupper($event->event_name) }}</div>
                <small class="text-gray-500">{{ \Carbon\Carbon::parse($event->start_time)->format('d M Y') }} — {{ $event->location ?? 'TBA' }}</small>
              </div>
              <a class="viewmore" href="{{ route('events.show', $event->id) }}">View more</a>
            </div>
          </article>
        @endforeach
      </section>
    @endif

  </main>

  <script>
    // ---------- Sidebar ----------
    document.addEventListener('DOMContentLoaded', () => {
      const menuBtn  = document.getElementById('menuBtn');
      const sidebar  = document.getElementById('sidebar');
      const overlay  = document.getElementById('overlay');
      const closeBtn = document.getElementById('closeSidebar');

      const openSidebar = () => {
        sidebar.classList.add('open');
        overlay.style.display = 'block';
        const firstLink = sidebar.querySelector('a'); if (firstLink) firstLink.focus();
      };
      const closeSidebar = () => {
        sidebar.classList.remove('open');
        overlay.style.display = 'none';
      };

      if (menuBtn)  menuBtn.addEventListener('click', openSidebar);
      if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
      if (overlay)  overlay.addEventListener('click', closeSidebar);
      document.addEventListener('keydown', (e)=>{ if(e.key==='Escape') closeSidebar(); });
    });

    // ---------- Hero slider ----------
    (function(){
      const slides = document.querySelectorAll('.hero-slide');
      if (!slides.length) return;

      let i = 0;
      const show = (n)=>{ slides.forEach(s=>s.classList.remove('active')); slides[n].classList.add('active'); };

      const next = ()=>{ i = (i+1) % slides.length; show(i); };
      const prev = ()=>{ i = (i-1+slides.length) % slides.length; show(i); };

      document.getElementById('next').addEventListener('click', next);
      document.getElementById('prev').addEventListener('click', prev);
      setInterval(next, 5000);
    })();
  </script>
</body>
</html>
