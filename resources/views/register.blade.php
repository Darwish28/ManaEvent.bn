<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ManaEvent.bn • Register</title>

  <!-- Tailwind & Font -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    body {
      background-color: #FBF7E6;
      font-family: 'Poppins', sans-serif;
      color: #1E293B;
    }
    .card {
      background-color: #fffdf7;
      border: 1px solid #f3e9c7;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }
    input:focus {
      border-color: #f5c518;
      box-shadow: 0 0 0 3px rgba(245, 197, 24, 0.2);
      outline: none;
    }
  </style>
</head>

<body class="min-h-screen bg-[#FBF7E6] text-slate-900 flex items-center justify-center p-6">
  <div class="w-full max-w-xl rounded-3xl bg-white/95 backdrop-blur shadow-[0_10px_30px_rgba(0,0,0,0.08)] border border-amber-50 p-10">

    <!-- Header (same style as your login) -->
    <div class="text-center mb-4">
      <h3 class="text-xl font-semibold">Create your account</h3>
      <p class="text-sm text-slate-500">Enter your details below to create your account</p>
    </div>

    <!-- Global errors -->
    @if ($errors->any())
      <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5 text-left" novalidate>
      @csrf

      <!-- Full name -->
      <div class="flex flex-col gap-1">
        <label for="name" class="text-sm font-medium text-slate-700">Full name</label>
        <input id="name" name="name" type="text" autocomplete="name" required
               value="{{ old('name') }}"
               placeholder=""
               class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 outline-none ring-0 focus:border-amber-400 focus:ring-2 focus:ring-amber-300/60 transition" />
        @error('name') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Username -->
      <div class="flex flex-col gap-1">
        <label for="username" class="text-sm font-medium text-slate-700">Username</label>
        <input id="username" name="username" type="text" autocomplete="username" required
               value="{{ old('username') }}"
               placeholder=""
               class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 outline-none ring-0 focus:border-amber-400 focus:ring-2 focus:ring-amber-300/60 transition" />
        @error('username') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Email -->
      <div class="flex flex-col gap-1">
        <label for="email" class="text-sm font-medium text-slate-700">Email Address</label>
        <input id="email" name="email" type="email" inputmode="email" autocomplete="email" required
               value="{{ old('email') }}"
               placeholder=""
               class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 outline-none ring-0 focus:border-amber-400 focus:ring-2 focus:ring-amber-300/60 transition" />
        @error('email') <p class="text-xs text-rose-600 mt-1">{{ $message }}</p> @enderror
      </div>

<!-- Password -->
<div class="flex flex-col gap-1">
  <label for="password" class="text-sm font-medium text-slate-700">Password</label>
  <div class="relative w-full">
    <input
      id="password"
      name="password"
      type="password"
      autocomplete="new-password"
      required
      placeholder=""
      class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 pr-10 outline-none ring-0 focus:border-amber-400 focus:ring-2 focus:ring-amber-300/60 transition"
    />
    <!-- eye icon -->
    <button type="button" id="togglePass"
      class="absolute right-3 top-1/2 -translate-y-1/2 text-amber-600 hover:text-amber-500">
      <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        <circle cx="12" cy="12" r="3" />
      </svg>
    </button>
  </div>
</div>

<!-- Confirm password -->
<div class="flex flex-col gap-1">
  <label for="password_confirmation" class="text-sm font-medium text-slate-700">Confirm Password</label>
  <div class="relative w-full">
    <input
      id="password_confirmation"
      name="password_confirmation"
      type="password"
      autocomplete="new-password"
      required
      placeholder=""
      class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 pr-10 outline-none ring-0 focus:border-amber-400 focus:ring-2 focus:ring-amber-300/60 transition"
    />
    <!-- eye icon -->
    <button type="button" id="toggleConfirmPass"
      class="absolute right-3 top-1/2 -translate-y-1/2 text-amber-600 hover:text-amber-500">
      <svg id="eyeConfirmIcon" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        <circle cx="12" cy="12" r="3" />
      </svg>
    </button>
  </div>
</div>

<script>
  // eye toggle for password
  const passBtn = document.getElementById('togglePass');
  const passInput = document.getElementById('password');
  const eyeIcon = document.getElementById('eyeIcon');

  passBtn.addEventListener('click', () => {
    const show = passInput.type === 'password';
    passInput.type = show ? 'text' : 'password';
    eyeIcon.innerHTML = show
      ? `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.258-3.94M9.88 9.88A3 3 0 0114.12 14.12M3 3l18 18"/>`
      : `<path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/><circle cx="12" cy="12" r="3"/>`;
  });

  // eye toggle for confirm password
  const confirmBtn = document.getElementById('toggleConfirmPass');
  const confirmInput = document.getElementById('password_confirmation');
  const eyeConfirmIcon = document.getElementById('eyeConfirmIcon');

  confirmBtn.addEventListener('click', () => {
    const show = confirmInput.type === 'password';
    confirmInput.type = show ? 'text' : 'password';
    eyeConfirmIcon.innerHTML = show
      ? `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.258-3.94M9.88 9.88A3 3 0 0114.12 14.12M3 3l18 18"/>`
      : `<path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/><circle cx="12" cy="12" r="3"/>`;
  });
</script>

      <!-- Terms -->
      <label class="inline-flex items-start gap-2 text-sm text-slate-700">
        <input type="checkbox" name="terms" required class="mt-1 h-4 w-4 rounded border-slate-300 focus:ring-2 focus:ring-amber-300/60" />
        <span>I agree to the
          <a href="#" class="text-amber-700 hover:text-amber-600 underline underline-offset-2">Terms</a>
          and
          <a href="#" class="text-amber-700 hover:text-amber-600 underline underline-offset-2">Privacy</a>.
        </span>
      </label>

      <!-- Submit -->
      <button type="submit"
              class="w-full rounded-2xl bg-amber-400 text-slate-900 font-semibold py-2 shadow-sm border border-amber-300/60 hover:bg-amber-500 active:bg-amber-600 transition">
        Create Account
      </button>
    </form>

    <!-- Footer -->
    <div class="mt-6 text-center text-sm text-slate-600">
      <span>Already have an account?</span>
      <a href="{{ Route::has('login') ? route('login') : '/login' }}" class="ms-1 font-medium text-amber-700 underline underline-offset-2 hover:text-amber-600">Log in</a>
    </div>
  </div>

  <script>
    // eye toggle for password
  const passBtn = document.getElementById('togglePass');
  const passInput = document.getElementById('password');
  const eyeIcon = document.getElementById('eyeIcon');

  passBtn.addEventListener('click', () => {
    const show = passInput.type === 'password';
    passInput.type = show ? 'text' : 'password';
    eyeIcon.innerHTML = show
      ? `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.258-3.94M9.88 9.88A3 3 0 0114.12 14.12M3 3l18 18"/>`
      : `<path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/><circle cx="12" cy="12" r="3"/>`;
  });

  // sucess login message
  @if (session('success'))
  <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-3 text-sm text-green-700 text-center">
    {{ session('success') }}
  </div>
@endif


  // eye toggle for confirm password
  const confirmBtn = document.getElementById('toggleConfirmPass');
  const confirmInput = document.getElementById('password_confirmation');
  const eyeConfirmIcon = document.getElementById('eyeConfirmIcon');

  confirmBtn.addEventListener('click', () => {
    const show = confirmInput.type === 'password';
    confirmInput.type = show ? 'text' : 'password';
    eyeConfirmIcon.innerHTML = show
      ? `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 012.258-3.94M9.88 9.88A3 3 0 0114.12 14.12M3 3l18 18"/>`
      : `<path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/><circle cx="12" cy="12" r="3"/>`;
  });

    const passBtn = document.getElementById('togglePass');
    const pass = document.getElementById('password');
    passBtn?.addEventListener('click', () => {
      const show = pass.type === 'password';
      pass.type = show ? 'text' : 'password';
      passBtn.textContent = show ? 'Hide' : 'Show';
    });

    const confirmBtn = document.getElementById('toggleConfirmPass');
    const confirm = document.getElementById('password_confirmation');
    confirmBtn?.addEventListener('click', () => {
      const show = confirm.type === 'password';
      confirm.type = show ? 'text' : 'password';
      confirmBtn.textContent = show ? 'Hide' : 'Show';
    });
  </script>
</body>
</html>
