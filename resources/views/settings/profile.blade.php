<div class="bg-white shadow-md rounded-2xl p-8 border border-amber-100">
    <h2 class="text-2xl font-semibold text-amber-700 mb-6">Profile Settings</h2>

    <form wire:submit.prevent="updateProfileInformation" class="space-y-5">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input
                type="text"
                id="name"
                wire:model="name"
                class="mt-1 w-full rounded-xl border-gray-300 shadow-sm focus:border-amber-400 focus:ring-2 focus:ring-amber-300/60 transition"
            />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input
                type="email"
                id="email"
                wire:model="email"
                class="mt-1 w-full rounded-xl border-gray-300 shadow-sm focus:border-amber-400 focus:ring-2 focus:ring-amber-300/60 transition"
            />
        </div>

        <button
            type="submit"
            class="w-full bg-amber-400 hover:bg-amber-500 text-white font-semibold py-2 rounded-xl shadow transition">
            Save Changes
        </button>
    </form>

    <div class="mt-8 border-t border-gray-200 pt-5">
        <h3 class="text-lg font-medium text-red-600">Delete Account</h3>
        <p class="text-sm text-gray-600 mb-3">This action cannot be undone.</p>
        <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-xl shadow">Delete Account</button>
    </div>
</div>
