<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ManaEvent.bn • Login (Enhanced Light)</title>

  <!-- ✅ Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- ✅ Tailwind Config -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Poppins', 'ui-sans-serif', 'system-ui'],
          },
        },
      },
    }
  </script>
</head>

<body class="font-sans min-h-screen bg-[#FBF7E6] text-slate-900 flex items-center justify-center p-6">
  <div class="w-full max-w-lg rounded-3xl bg-white/95 backdrop-blur shadow-[0_10px_30px_rgba(0,0,0,0.08)] border border-amber-50 p-10">

    <!-- Header -->
    <div class="text-center mb-4">
      <h3 class="text-xl font-semibold">Log in to your account</h3>
      <p class="text-sm text-slate-500">Enter your email or username and password below to log in</p>
    </div>

    <!-- Form -->
    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5 text-left" novalidate>
      @csrf

      <!-- Email -->
      <div class="flex flex-col gap-1">
        <label for="email" class="text-sm font-medium text-slate-700">Email Address or Username</label>
        <input
          id="email"
          name="email"
          type="email"
          inputmode="email"
          autocomplete="email"
          value="{{ old('email') }}"
          required
          autofocus
          class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 outline-none ring-0 focus:border-amber-400 focus:ring-2 focus:ring-amber-300/60 transition" />
      </div>

      <!-- Password with Eye Icon -->
      <div class="flex flex-col gap-1 relative">
        <label for="password" class="text-sm font-medium text-slate-700">Password</label>
        <div class="relative">
          <input
            id="password"
            name="password"
            type="password"
            autocomplete="current-password"
            required
            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 pr-10 outline-none ring-0 focus:border-amber-400 focus:ring-2 focus:ring-amber-300/60 transition" />

          <!-- eye icon -->
          <button type="button" id="togglePassword"
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

      <!-- Forgot password (moved RIGHT) -->
      <div class="flex justify-end">
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}" class="text-sm font-medium text-amber-700 hover:text-amber-600 underline underline-offset-2">
            Forgot your password?
          </a>
        @endif
      </div>

      <!-- Remember + Submit -->
      <div class="flex flex-col gap-4">
        <label class="inline-flex items-center gap-2 text-sm text-slate-700">
          <input name="remember" type="checkbox" class="h-4 w-4 rounded border-slate-300 focus:ring-2 focus:ring-amber-300/60" />
          Remember me
        </label>

        <button type="submit"
          class="group w-full rounded-xl bg-amber-400 text-slate-900 font-semibold py-2 shadow-sm border border-amber-300/60 hover:bg-amber-500 active:bg-amber-600 transition transform hover:-translate-y-0.5">
          Log in
        </button>
      </div>
    </form>

    <!-- Footer -->
    <div class="mt-6 text-center text-sm text-slate-600">
      <span>Don't have an account?</span>
      <a href="{{ Route::has('register') ? route('register') : '/register' }}" class="ms-1 font-medium text-amber-700 underline underline-offset-2 hover:text-amber-600">
        Sign up
      </a>
    </div>
  </div>

  <!-- 👁 Password toggle script -->
  <script>
    const toggleBtn = document.getElementById('togglePassword');
    const pwField = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    toggleBtn.addEventListener('click', () => {
      if (pwField.type === 'password') {
        pwField.type = 'text';
        eyeIcon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M3 3l18 18M9.88 9.88A3 3 0 0012 15a3 3 0 002.12-.88M15.88 15.88A9.969 9.969 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.003 10.003 0 012.977-4.263" />
        `;
      } else {
        pwField.type = 'password';
        eyeIcon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
          <circle cx="12" cy="12" r="3" />
        `;
      }
    });
  </script>
</body>
</html>
