<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Password Manager
            </h2>
            {{-- <a href="{{ route('password.create') }}"
                class="inline-block px-4 py-2 border border-blue-600 text-blue-600 text-sm font-medium rounded hover:bg-blue-600 hover:text-white transition-colors duration-200">
                Create New Password.
            </a> --}}
            <a href="{{ route('password.create') }}"
                class="inline-block px-4 py-2 border border-blue-600 text-blue-600 text-sm font-medium rounded hover:bg-blue-600 hover:text-white transition-colors duration-200">
                Add New Password
            </a>
        </div>
    </x-slot>

    {{-- {{ __('Dashboard') }} --}}

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">{{ $users->name }}'s Passwords</h1>

            @if ($passwords->isEmpty())
                <div class="bg-[#b5b5b5] p-6 rounded-lg shadow text-gray-600 text-center">
                    <p>No passwords saved yet.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($passwords as $password)
                        <div
                            class="bg-yellow-50 rounded-xl shadow-md p-4  flex flex-col justify-between hover:shadow-lg transition duration-300">

                            <div>
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg font-bold text-gray-800">{{ $password->title }}</h3>
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" class="text-gray-500 hover:text-gray-700">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z">
                                                </path>
                                            </svg>
                                        </button>
                                        <div x-show="open" @click.away="open = false"
                                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">


                                            <button
                                                onclick="openEditModal({{ $password->id }}, '{{ addslashes($password->title) }}', '{{ addslashes($password->link) }}', '{{ addslashes($password->password) }}')"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <i class="fas fa-pencil mr-2"></i>
                                                Edit
                                            </button>



                                            <form action="{{ route('password.destroy', $password->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this password?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                                    <i class="fas fa-trash mr-2"></i>
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-700 break-words flex-1">{{ $password->username }}</p>
                                <div class="flex items-center gap-2 mt-2">
                                    @if ($password->favicon)
                                        <img src="{{ $password->favicon }}" alt=" icon" class="w-4 h-4">
                                    @endif
                                    <a href="{{ $password->link }}" target="_blank"
                                        class="text-sm text-blue-700 break-words underline cursor-pointer hover:text-blue-900">
                                        {{ !empty($password->link) ? $password->link : 'No link provided' }}
                                    </a>
                                </div>
                                <div class="flex items-center gap-2 mt-2">
                                    <p class="text-sm text-gray-700 break-words flex-1"
                                        id="password-{{ $password->id }}">
                                        <span class="password-text">••••••••••</span>
                                        <span class="password-actual hidden">{{ $password->password }}</span>
                                    </p>
                                    <button onclick="togglePassword({{ $password->id }})"
                                        class="text-gray-500 hover:text-gray-700">
                                        <svg class="w-5 h-5 eye-icon-closed" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                                            </path>
                                        </svg>
                                        <svg class="w-5 h-5 eye-icon-open hidden" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="flex justify-between items-center mt-3">
                                <div class="flex gap-3 items-center">
                                    <p class="text-[#5B5B5B] text-sm font-medium">
                                        {{ $password->created_at ? $password->created_at->format('m-d-y') : 'No date' }}
                                    </p>
                                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full"></span>
                                    <p class="text-[#5B5B5B] text-sm font-medium">
                                        {{ $password->updated_at ? $password->updated_at->diffForHumans() : 'Never updated' }}
                                    </p>
                                </div>
                                <button onclick="copyToClipboard('{{ $password->password }}')"
                                    class="text-[#5B5B5B] text-sm font-medium hover:underline">
                                    Copy
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div id="toast" class="toast">Password copied to clipboard!</div>
    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden  items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-full max-w-md">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <h2 class="text-lg font-semibold mb-4">Edit Password</h2>
                <input type="hidden" id="editId" name="id">

                <div class="mb-3">
                    <label for="editTitle" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="editTitle" name="title"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-3">
                    <label for="editLink" class="block text-sm font-medium text-gray-700">Link</label>
                    <input type="text" id="editLink" name="link"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="editPassword" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="text" id="editPassword" name="password"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                // Show toast notification
                const toast = document.getElementById('toast');
                toast.classList.add('show');

                // Hide toast after 2 seconds
                setTimeout(() => {
                    toast.classList.remove('show');
                }, 2000);

                // Update button text
                const button = event.target;
                const originalText = button.textContent;
                button.textContent = 'Copied!';
                setTimeout(() => {
                    button.textContent = originalText;
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        }

        function togglePassword(id) {
            const passwordContainer = document.getElementById(`password-${id}`);
            const passwordText = passwordContainer.querySelector('.password-text');
            const passwordActual = passwordContainer.querySelector('.password-actual');
            const button = event.currentTarget;
            const eyeIconClosed = button.querySelector('.eye-icon-closed');
            const eyeIconOpen = button.querySelector('.eye-icon-open');

            if (passwordText.classList.contains('hidden')) {
                // Hide password
                passwordText.classList.remove('hidden');
                passwordActual.classList.add('hidden');
                eyeIconClosed.classList.remove('hidden');
                eyeIconOpen.classList.add('hidden');
            } else {
                // Show password
                passwordText.classList.add('hidden');
                passwordActual.classList.remove('hidden');
                eyeIconClosed.classList.add('hidden');
                eyeIconOpen.classList.remove('hidden');
            }
        }

        function openEditModal(id, title, link, password) {
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editTitle').value = title;
            document.getElementById('editLink').value = link;
            document.getElementById('editPassword').value = password;
            document.getElementById('editForm').action = `/passwords/${id}`;
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>

    <style>
        .toast {
            visibility: hidden;
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #333;
            color: white;
            padding: 1rem 2rem;
            border-radius: 0.375rem;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .toast.show {
            visibility: visible;
            opacity: 1;
        }
    </style>
</x-app-layout>
