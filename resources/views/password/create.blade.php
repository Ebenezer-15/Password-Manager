<x-app-layout>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <form action="{{ route('soc.store') }}" method="POST"
            class="w-full max-w-md space-y-6 bg-white p-6 rounded-lg shadow">
            @csrf

            <!-- Logo Section -->
            <div class="text-center mb-4">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="mx-auto h-16">
            </div>

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="title" id="title" required
                    class="block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    autocomplete="title" placeholder="e.g. Facebook">
            </div>

            <!-- User Name -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">User Name</label>
                <input type="text" name="username" id="username" required
                    class="block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    autocomplete="username" placeholder="e.g. username@gmail.com">
            </div>

            <!-- Link -->
            <div>
                <label for="link" class="block text-sm font-medium text-gray-700 mb-1">Website link</label>
                <input type="link" name="link" id="link" required
                    class="block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    autocomplete="link" placeholder="e.g. Facebook.com">
            </div>

            <!-- Password + Generate -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <div class="flex gap-2">
                    <input type="text" name="password" id="password" required
                        class="flex-grow border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        autocomplete="off" placeholder="Click 'Generate' for a secure password">
                    <button type="button" onclick="generatePassword()"
                        class="bg-gray-200 hover:bg-gray-300 text-sm px-3 py-2 rounded-md text-gray-700 font-medium">
                        Generate
                    </button>
                </div>
            </div>

            <!-- Save Button -->
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-md transition-colors duration-200">
                Save Password
            </button>
        </form>
    </div>

    <!-- Password Generator Script -->
   <!-- Password Generator Script + Toast -->
<script>
    function generatePassword(length = 16) {
        const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-+=<>?";
        let password = "";

        for (let i = 0; i < length; i++) {
            const randomIndex = Math.floor(Math.random() * charset.length);
            password += charset[randomIndex];
        }

        // Insert generated password
        document.getElementById('password').value = password;

        // Copy to clipboard
        navigator.clipboard.writeText(password).then(() => {
            showToast("Secure password generated and copied!");
        });
    }

    function showToast(message) {
        const toast = document.createElement('div');
        toast.textContent = message;
        toast.className = "fixed bottom-6 right-6 bg-green-600 text-white px-4 py-2 rounded shadow-md animate-fade-in-out z-50";
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, 3000);
    }
</script>

<!-- Toast Animation -->
<style>
    @keyframes fadeInOut {
        0% { opacity: 0; transform: translateY(20px); }
        10% { opacity: 1; transform: translateY(0); }
        90% { opacity: 1; transform: translateY(0); }
        100% { opacity: 0; transform: translateY(20px); }
    }

    .animate-fade-in-out {
        animation: fadeInOut 3s ease forwards;
    }
</style>

</x-app-layout>
