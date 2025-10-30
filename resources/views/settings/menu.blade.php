<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ManaEvent Settings</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #fffaf3;
    }

    .brand-gradient {
      background: linear-gradient(135deg, #ffb84d 0%, #ff9d00 100%);
    }

    .brand-text {
      color: #ff9d00;
    }

    .glow-card {
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
      transition: all 0.3s ease;
    }

    .glow-card:hover {
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      transform: translateY(-2px);
    }

    .settings-tab.active {
      background-color: #fff7e5;
      border-left: 4px solid #ff9d00;
      color: #ff9d00;
      font-weight: 600;
    }

    .toggle-bg {
      background-color: #e2e8f0;
    }

    .toggle-checked-bg {
      background-color: #ffb84d;
    }
  </style>
</head>

<body class="bg-[#fffaf3]">
  <div class="min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm">
      <div
        class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <div class="flex items-center space-x-2">
          <i data-feather="settings" class="brand-text"></i>
          <h1 class="text-xl font-semibold text-gray-900">Settings</h1>
        </div>
        <button
          class="flex items-center space-x-1 brand-gradient text-white px-4 py-2 rounded-lg hover:opacity-90 transition">
          <i data-feather="save" class="w-4 h-4"></i>
          <span>Save Changes</span>
        </button>
      </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="flex flex-col md:flex-row gap-6">
        <!-- Sidebar -->
        <div class="w-full md:w-64 flex-shrink-0">
          <div
            class="bg-white rounded-xl shadow-sm overflow-hidden glow-card">
            <div class="px-4 pt-5 pb-2 border-b border-gray-100">
              <h2 class="text-lg font-medium text-gray-900">Configuration</h2>
            </div>
            <nav class="p-2">
              <a
                href="#"
                class="settings-tab active flex items-center space-x-3 px-3 py-3 rounded-lg text-gray-700 hover:bg-[#fff7e5] hover:text-[#ff9d00] transition">
                <i data-feather="user" class="w-5 h-5"></i>
                <span>Account</span>
              </a>
              <a
                href="#"
                class="settings-tab flex items-center space-x-3 px-3 py-3 rounded-lg text-gray-700 hover:bg-[#fff7e5] hover:text-[#ff9d00] transition">
                <i data-feather="bell" class="w-5 h-5"></i>
                <span>Notifications</span>
              </a>
              <a
                href="#"
                class="settings-tab flex items-center space-x-3 px-3 py-3 rounded-lg text-gray-700 hover:bg-[#fff7e5] hover:text-[#ff9d00] transition">
                <i data-feather="lock" class="w-5 h-5"></i>
                <span>Security</span>
              </a>
              <a
                href="#"
                class="settings-tab flex items-center space-x-3 px-3 py-3 rounded-lg text-gray-700 hover:bg-[#fff7e5] hover:text-[#ff9d00] transition">
                <i data-feather="credit-card" class="w-5 h-5"></i>
                <span>Payments</span>
              </a>
              <a
                href="#"
                class="settings-tab flex items-center space-x-3 px-3 py-3 rounded-lg text-gray-700 hover:bg-[#fff7e5] hover:text-[#ff9d00] transition">
                <i data-feather="database" class="w-5 h-5"></i>
                <span>Data</span>
              </a>
            </nav>
          </div>
        </div>

        <!-- Content -->
        <div class="flex-1">
          <div class="bg-white rounded-xl shadow-sm overflow-hidden glow-card">
            <div class="px-6 py-5 border-b border-gray-100">
              <h2 class="text-xl font-semibold text-gray-900">
                Account Settings
              </h2>
              <p class="mt-1 text-sm text-gray-500">
                Manage your personal information and preferences
              </p>
            </div>

            <!-- Profile Section -->
            <div class="px-6 py-5 border-b border-gray-100">
              <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900">Profile</h3>
                <button
                  class="text-[#ff9d00] hover:text-[#e78b00] text-sm font-medium">
                  Edit
                </button>
              </div>

              <div
                class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                <div class="sm:col-span-3">
                  <label class="block text-sm font-medium text-gray-700"
                    >First name</label
                  >
                  <div class="mt-1">
                    <input
                      type="text"
                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#ff9d00] focus:ring-[#ff9d00] sm:text-sm p-2 border"
                      value="John" />
                  </div>
                </div>

                <div class="sm:col-span-3">
                  <label class="block text-sm font-medium text-gray-700"
                    >Last name</label
                  >
                  <div class="mt-1">
                    <input
                      type="text"
                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#ff9d00] focus:ring-[#ff9d00] sm:text-sm p-2 border"
                      value="Doe" />
                  </div>
                </div>

                <div class="sm:col-span-4">
                  <label class="block text-sm font-medium text-gray-700"
                    >Email address</label
                  >
                  <div class="mt-1">
                    <input
                      type="email"
                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#ff9d00] focus:ring-[#ff9d00] sm:text-sm p-2 border"
                      value="john@example.com" />
                  </div>
                </div>

                <div class="sm:col-span-4">
                  <label class="block text-sm font-medium text-gray-700"
                    >Timezone</label
                  >
                  <div class="mt-1">
                    <select
                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#ff9d00] focus:ring-[#ff9d00] sm:text-sm p-2 border">
                      <option>(GMT-12:00) International Date Line West</option>
                      <option selected>
                        (GMT+08:00) Kuala Lumpur, Singapore
                      </option>
                      <option>(GMT+09:00) Tokyo</option>
                    </select>
                  </div>
                </div>

                <div class="sm:col-span-6">
                  <label class="block text-sm font-medium text-gray-700"
                    >Profile photo</label
                  >
                  <div class="mt-2 flex items-center">
                    <span
                      class="inline-block h-12 w-12 overflow-hidden rounded-full bg-gray-100">
                      <i
                        data-feather="user"
                        class="h-full w-full text-gray-300"></i>
                    </span>
                    <button
                      type="button"
                      class="ml-5 rounded-md border border-gray-300 bg-white py-1.5 px-3 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-[#fff7e5] focus:outline-none focus:ring-2 focus:ring-[#ff9d00] focus:ring-offset-2">
                      Change
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Preferences Section -->
            <div class="px-6 py-5 border-b border-gray-100">
              <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-gray-900">Preferences</h3>
                <button
                  class="text-[#ff9d00] hover:text-[#e78b00] text-sm font-medium">
                  Edit
                </button>
              </div>

              <div class="mt-6 space-y-4">
                <div class="flex items-center justify-between">
                  <div>
                    <h4 class="text-sm font-medium text-gray-900">Dark Mode</h4>
                    <p class="text-sm text-gray-500">
                      Toggle between light and dark theme
                    </p>
                  </div>
                  <button
                    type="button"
                    class="toggle-bg relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#ff9d00] focus:ring-offset-2">
                    <span class="sr-only">Dark Mode</span>
                    <span
                      class="translate-x-5 inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                  </button>
                </div>

                <div class="flex items-center justify-between">
                  <div>
                    <h4 class="text-sm font-medium text-gray-900">
                      Email Notifications
                    </h4>
                    <p class="text-sm text-gray-500">
                      Receive email updates
                    </p>
                  </div>
                  <button
                    type="button"
                    class="toggle-checked-bg relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#ff9d00] focus:ring-offset-2">
                    <span class="sr-only">Email Notifications</span>
                    <span
                      class="translate-x-5 inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                  </button>
                </div>

                <div class="flex items-center justify-between">
                  <div>
                    <h4 class="text-sm font-medium text-gray-900">
                      SMS Notifications
                    </h4>
                    <p class="text-sm text-gray-500">
                      Receive text message updates
                    </p>
                  </div>
                  <button
                    type="button"
                    class="toggle-bg relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#ff9d00] focus:ring-offset-2">
                    <span class="sr-only">SMS Notifications</span>
                    <span
                      class="translate-x-0 inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                  </button>
                </div>
              </div>
            </div>

            <!-- Danger Zone -->
            <div class="px-6 py-5">
              <h3 class="text-lg font-medium text-red-600">Danger Zone</h3>
              <div class="mt-6">
                <div class="flex justify-between items-center">
                  <div>
                    <h4 class="text-sm font-medium text-gray-900">
                      Delete account
                    </h4>
                    <p class="text-sm text-gray-500">
                      Once deleted, you can't recover your account
                    </p>
                  </div>
                  <button
                    class="inline-flex items-center px-3 py-2 border border-red-300 text-sm leading-4 font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Delete Account
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script>
    feather.replace();

    document.querySelectorAll(".settings-tab").forEach((tab) => {
      tab.addEventListener("click", function (e) {
        e.preventDefault();
        document.querySelector(".settings-tab.active").classList.remove("active");
        this.classList.add("active");
      });
    });

    document.querySelectorAll('[type="button"]').forEach((toggle) => {
      if (toggle.classList.contains("toggle-bg") || toggle.classList.contains("toggle-checked-bg")) {
        toggle.addEventListener("click", function () {
          this.classList.toggle("toggle-bg");
          this.classList.toggle("toggle-checked-bg");

          const span = this.querySelector("span:not(.sr-only)");
          if (this.classList.contains("toggle-checked-bg")) {
            span.classList.add("translate-x-5");
            span.classList.remove("translate-x-0");
          } else {
            span.classList.add("translate-x-0");
            span.classList.remove("translate-x-5");
          }
        });
      }
    });
  </script>
</body>
</html>

