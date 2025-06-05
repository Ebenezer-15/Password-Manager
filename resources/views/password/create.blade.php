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

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="title" id="title" required
                    class="block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    autocomplete="title" placeholder="e.g. Facebook">
            </div>

            <div>
                <label for="link" class="block text-sm font-medium text-gray-700 mb-1">Website link</label>
                <input type="link" name="link" id="link" required
                    class="block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    autocomplete="link" placeholder="e.g. Facebook.com">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" required
                    class="block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    autocomplete="password">
            </div>
            <button type="submit"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-md transition-colors duration-200">
                Generate Password
            </button>
            <button type="submit"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2 rounded-md transition-colors duration-200">
                Save Password
            </button>
        </form>
    </div>


</x-app-layout>
