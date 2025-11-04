<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ManaEvent.bn • Settings </title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
    :root{
      --brand:#f5c518;
      --brand-light:#fff3a1;
      --ink:#0f172a;
      --paper:#fffbea;
      --panel:#fffef6;
      --soft:#fff9c4;
      --border:#e5d84a;
    }
    body{ font-family:'Poppins',sans-serif; background:var(--paper); color:var(--ink); }
    .card{ background:var(--panel); border:1px solid var(--border); box-shadow:0 3px 10px rgba(0,0,0,.05); }
    .nav-btn{ display:flex; align-items:center; gap:.6rem; width:100%; text-align:left; padding:.8rem 1rem; border-radius:.8rem; transition:.25s; }
    .nav-btn:hover{ background:var(--brand-light); }
    .nav-btn.active{ background:var(--brand); color:#000; font-weight:600; }
    .input{ width:100%; border:1px solid #e0c400; border-radius:.75rem; padding:.7rem .95rem; background:white; }
    .input:focus{ outline:none; box-shadow:0 0 0 3px rgba(245,197,24,.4); border-color:var(--brand); }
    .btn{ display:inline-flex; align-items:center; gap:.5rem; padding:.65rem 1rem; border-radius:.8rem; font-weight:600; transition:.25s; }
    .btn-ghost{ border:1px solid var(--border); background:#fff }
    .btn-ghost:hover{ background:var(--brand-light) }
    .btn-brand{ background:var(--brand); color:#111827 }
    .btn-brand:hover{ background:#f2cc05; }
    .btn-danger{ background:#ef4444; color:#fff }
    .btn-danger:hover{ filter:brightness(.95) }
    .toggle{--h:30px;--w:54px; position:relative; width:var(--w); height:var(--h)}
    .toggle input{position:absolute; inset:0; opacity:0}
    .toggle .track{position:absolute; inset:0; background:#e5e7eb; border-radius:999px; transition:.2s}
    .toggle .knob{position:absolute; top:3px; left:3px; width:24px; height:24px; background:#fff; border-radius:999px; box-shadow:0 1px 2px rgba(0,0,0,.25); transition:.2s}
    .toggle input:checked + .track{ background:var(--brand) }
    .toggle input:checked + .track + .knob{ transform:translateX(24px) }
  </style>
</head>
<body>
  <header class="sticky top-0 z-30 w-full bg-[var(--brand)] shadow-md">
  <div class="max-w-7xl mx-auto h-16 px-4 sm:px-6 lg:px-8 flex items-center justify-end">
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="btn btn-ghost" type="submit">
        <i data-feather="log-out" class="w-4 h-4"></i> Log out
      </button>
    </form>
  </div>
</header>

  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
    <div class="mt-3 bg-[var(--soft)] p-4 rounded-xl">
      <h1 class="text-xl font-semibold text-[var(--ink)]">Settings</h1>
      <p class="text-sm text-slate-700">Manage profile, password & notifications</p>
    </div>
  </section>

  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-[280px,1fr] gap-6">
      <aside class="card rounded-2xl p-3 h-max sticky top-24">
        <nav id="tabs" class="space-y-1">
          <button class="nav-btn active" data-tab="profile"><i data-feather="user" class="w-4 h-4"></i><span>Profile</span></button>
          <button class="nav-btn" data-tab="password"><i data-feather="lock" class="w-4 h-4"></i><span>Password</span></button>
          <button class="nav-btn" data-tab="notifications"><i data-feather="bell" class="w-4 h-4"></i><span>Notifications</span></button>
        </nav>
      </aside>

      <section class="space-y-6">
        <!-- Profile -->
        <div id="panel-profile" class="card rounded-2xl overflow-hidden">
          <div class="px-6 py-5 border-b bg-[var(--brand-light)]"><h2 class="text-lg font-semibold">Profile</h2><p class="text-sm text-slate-700">Update your personal information</p></div>
          <form class="px-6 py-6 grid gap-5 max-w-2xl">
            <div class="flex items-center gap-5">
              <div class="h-16 w-16 rounded-full bg-slate-200 grid place-items-center relative">
                <i data-feather="user" class="w-7 h-7 text-slate-400"></i>
              </div>
              <div>
                <label class="btn btn-ghost cursor-pointer">
                  <input type="file" class="hidden" accept="image/*">
                  <i data-feather="upload" class="w-4 h-4"></i> Edit Picture
                </label>
              </div>
            </div>

            <div>
              <label class="text-sm font-medium">Name</label>
              <input class="input mt-1" placeholder="Name" value="">
            </div>
            <div>
              <label class="text-sm font-medium">Username</label>
              <input class="input mt-1" placeholder="Username" value="">
            </div>
            <div>
              <label class="text-sm font-medium">Email</label>
              <input class="input mt-1" type="email" placeholder="Email" value="">
            </div>
            <div class="flex gap-2 pt-1">
              <button class="btn btn-brand" type="button"><i data-feather="save" class="w-4 h-4"></i> Save</button>
              <button class="btn btn-ghost" type="button"><i data-feather="rotate-ccw" class="w-4 h-4"></i> Reset</button>
            </div>
          </form>
          <div class="px-6 py-5 border-t bg-[var(--brand-light)]/50">
            <h3 class="text-sm font-semibold text-red-600">Delete account</h3>
            <p class="text-sm text-slate-700 mb-3">This will remove your data permanently.</p>
            <button id="deleteOpen" class="btn btn-danger"><i data-feather="trash-2" class="w-4 h-4"></i> Delete account</button>
          </div>
        </div>

        <!-- Password -->
        <div id="panel-password" class="card rounded-2xl overflow-hidden hidden">
          <div class="px-6 py-5 border-b bg-[var(--brand-light)]"><h2 class="text-lg font-semibold">Password</h2><p class="text-sm text-slate-700">Change your password</p></div>
          <form class="px-6 py-6 grid gap-5 max-w-xl">
            <div>
              <label class="text-sm font-medium">Current password</label>
              <input class="input mt-1" type="password" placeholder="••••••••">
            </div>
            <div>
              <label class="text-sm font-medium">New password</label>
              <input class="input mt-1" type="password" placeholder="New strong password">
            </div>
            <div>
              <label class="text-sm font-medium">Retype new password</label>
              <input class="input mt-1" type="password" placeholder="Repeat new password">
            </div>
            <button class="btn btn-brand w-max" type="button"><i data-feather="check-circle" class="w-4 h-4"></i> Update password</button>
          </form>
        </div>

        <!-- Notifications -->
        <div id="panel-notifications" class="card rounded-2xl overflow-hidden hidden">
          <div class="px-6 py-5 border-b bg-[var(--brand-light)]"><h2 class="text-lg font-semibold">Notifications</h2><p class="text-sm text-slate-700">Choose how you want to be notified</p></div>
          <div class="px-6 py-6 space-y-6 max-w-2xl">
            <div class="flex items-center justify-between">
              <div>
                <p class="font-medium text-base">Upcoming Events</p>
                <p class="text-sm text-slate-700">Get notified about upcoming events</p>
              </div>
              <label class="toggle"><input type="checkbox" checked><span class="track"></span><span class="knob"></span></label>
            </div>
            <div class="flex items-center justify-between">
              <div>
                <p class="font-medium text-base">New Events Posted</p>
                <p class="text-sm text-slate-700">Receive alerts when new events are posted</p>
              </div>
              <label class="toggle"><input type="checkbox" checked><span class="track"></span><span class="knob"></span></label>
            </div>
            <div class="flex items-center justify-between">
              <div>
                <p class="font-medium text-base">Email Notifications</p>
                <p class="text-sm text-slate-700">Receive notifications via email</p>
              </div>
              <label class="toggle"><input type="checkbox" checked><span class="track"></span><span class="knob"></span></label>
            </div>
            <button class="btn btn-brand mt-4"><i data-feather="save" class="w-4 h-4"></i> Save preferences</button>
          </div>
        </div>
      </section>
    </div>
  </main>

    <!-- ... your entire settings HTML above ... -->

  <!-- JS for tab switching -->
  <script>
    feather.replace();

    const tabs = document.querySelectorAll('#tabs .nav-btn');
    const panels = {
      profile: document.getElementById('panel-profile'),
      password: document.getElementById('panel-password'),
      notifications: document.getElementById('panel-notifications'),
    };

    function show(tab){
      tabs.forEach(t => t.classList.remove('active'));
      Object.values(panels).forEach(p => p.classList.add('hidden'));
      document.querySelector(`[data-tab="${tab}"]`)?.classList.add('active');
      panels[tab]?.classList.remove('hidden');
    }

    // Click -> change tab + update hash (but keep URL as /settings)
    tabs.forEach(t => t.addEventListener('click', () => {
      const tab = t.dataset.tab;
      show(tab);
      history.replaceState(null, '', '#'+tab); // silently updates the hash
    }));

    // On load, respect hash; default to profile
    const initial = location.hash?.replace('#','') || 'profile';
    show(initial);
  </script>
</body>
</html>
