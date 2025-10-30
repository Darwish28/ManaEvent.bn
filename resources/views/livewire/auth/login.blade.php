<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ManaEvent.bn • Login (Enhanced Light)</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[#FBF7E6] text-slate-900 flex items-center justify-center p-6">
  <div class="w-full max-w-lg rounded-3xl bg-white/95 backdrop-blur shadow-[0_10px_30px_rgba(0,0,0,0.08)] border border-amber-50 p-10">
    <div class="relative mb-6">
      <div class="absolute inset-0 rounded-2xl shadow-[0_30px_60px_-20px_rgba(0,0,0,0.08)]"></div>
      <div class="relative rounded-2xl">
        <div class="text-center mb-4">
          <h3 class="text-xl font-semibold">Log in to your account</h3>
          <p class="text-sm text-slate-500">Enter your email and password below to log in</p>
        </div>

        <!-- Divider -->
        <div class="my-4 flex items-center gap-3">
          <span class="h-px flex-1 bg-amber-100"></span>
          <span class="text-[11px] uppercase tracking-wide text-amber-600/70">secure access</span>
          <span class="h-px flex-1 bg-amber-100"></span>
        </div>

        <!-- Form -->
        <form class="flex flex-col gap-5 text-left">
          <!-- Email -->
          <div class="flex flex-col gap-1">
            <label for="email" class="text-sm font-medium text-slate-700 text-left">Email address</label>
            <input id="email" type="email" placeholder="email@example.com" required
                   class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 outline-none ring-0 focus:border-amber-400 focus:ring-2 focus:ring-amber-300/60 transition" />
          </div>

          <!-- Password -->
          <div class="flex flex-col gap-2">
            <label for="password" class="text-sm font-medium text-slate-700 text-left">Password</label>
            <input id="password" type="password" placeholder="Password" required
                   class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 pr-10 outline-none ring-0 focus:border-amber-400 focus:ring-2 focus:ring-amber-300/60 transition" />
          </div>

          <!-- Forgot password bottom-left -->
          <div class="flex justify-start">
            <a href="#" class="text-sm font-medium text-amber-700 hover:text-amber-600 underline underline-offset-2">
              Forgot your password?
            </a>
          </div>

          <!-- Remember + Submit -->
          <div class="flex flex-col gap-4">
            <label class="inline-flex items-center gap-2 text-sm text-slate-700">
              <input type="checkbox" class="h-4 w-4 rounded border-slate-300 focus:ring-2 focus:ring-amber-300/60" />
              Remember me
            </label>

            <button type="submit"
                    class="group w-full rounded-xl bg-amber-400 text-white font-semibold py-2 shadow-sm border border-amber-300/60 hover:bg-amber-500 active:bg-amber-600 transition transform hover:-translate-y-0.5">
              <span class="inline-block">Log in</span>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Footer -->
    <div class="mt-2 text-center text-sm text-slate-600">
      <span>Don't have an account?</span>
      <a href="#" class="ms-1 font-medium text-amber-700 underline underline-offset-2 hover:text-amber-600">Sign up</a>
    </div>
  </div>
</body>
</html>

