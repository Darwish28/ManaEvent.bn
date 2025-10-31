<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reset your password • ManaEvent</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            base:  '#FFF9EC',
            panel: '#ffffff',
            ink:   '#0f172a',
            sub:   '#6b7280',
            amberBrand: '#f5c518'
          },
          boxShadow: {
            soft: '0 10px 30px rgba(15, 23, 42, .08)'
          },
          borderRadius: { xl2: '1rem' }
        }
      }
    }
  </script>
  <style>
    :root { color-scheme: light; }
    html, body { height: 100%; }
  </style>
</head>
<body class="min-h-screen bg-base text-ink antialiased">
  <main class="mx-auto max-w-lg px-6 py-20 md:py-28">
    <section class="rounded-2xl bg-panel border border-slate-200 shadow-soft px-8 md:px-10 py-14 md:py-16">
      <h1 class="text-3xl font-semibold text-slate-900 text-center">Reset your password</h1>
      <p class="mt-2 text-base text-sub text-center max-w-lg mx-auto">
        Enter your user account's verified email address and we will send you a password reset link.
      </p>

      <!-- Status / Errors (hidden placeholders) -->
      <div class="hidden mt-7 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">Success</div>
      <div class="hidden mt-7 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">Error</div>

      <form class="mt-8 space-y-6">
        <div class="text-left">
          <label for="email" class="text-sm font-medium text-slate-800">Email</label>
          <input id="email" name="email" type="email" inputmode="email" autocomplete="email" required
                 placeholder="Enter your email address"
                 class="mt-2 w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-[16px]
                        placeholder:text-slate-400 outline-none transition
                        focus:border-amberBrand focus:ring-2 focus:ring-amber-300/60" />
        </div>

        <button type="submit"
                class="mt-3 w-full rounded-2xl h-12 font-semibold text-slate-900 text-[16px] bg-amberBrand hover:bg-[#ffd54a]
                       active:translate-y-[1px] transition">
          Send Password Reset Email
        </button>
      </form>
    </section>
  </main>
</body>
</html>