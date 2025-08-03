<x-app-layout>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center py-12 px-6">
        <div class="bg-white w-full max-w-6xl rounded-3xl shadow-xl flex relative overflow-hidden">

            <!-- Sidebar kanan -->
            <div class="absolute top-10 right-5 flex flex-col items-center gap-6 text-gray-400">
                <a href="#" title="Profile" class="hover:text-blue-500">👤</a>
                <a href="#" title="Stats" class="hover:text-blue-500">📊</a>
                <a href="#" title="Help" class="hover:text-blue-500">❓</a>
                <a href="#" title="Settings" class="hover:text-blue-500">⚙</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="hover:text-red-500" title="Logout">⏻</button>
                </form>
            </div>

            <!-- Avatar dan sosial -->
            <div class="w-1/3 bg-white px-10 py-12 border-r border-gray-200 flex flex-col items-center">
                <h2 class="text-lg font-bold text-gray-800 mb-6 self-start">PROFILE</h2>
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}"
                     class="w-28 h-28 rounded-full border shadow mb-3 object-cover" alt="Avatar">
                <button class="text-sm text-blue-600 hover:underline mb-8">Upload Picture</button>

                <div class="space-y-4 w-full">
                    <a href="#" class="flex items-center gap-2 text-gray-600 hover:text-blue-600 text-sm">🔵 Add Facebook</a>
                    <a href="#" class="flex items-center gap-2 text-gray-600 hover:text-blue-600 text-sm">🐦 Add Twitter</a>
                    <a href="#" class="flex items-center gap-2 text-gray-600 hover:text-blue-600 text-sm">📸 Add Instagram</a>
                    <a href="#" class="flex items-center gap-2 text-gray-600 hover:text-blue-600 text-sm">➕ Add Google+</a>
                </div>
            </div>

            <!-- Form -->
            <div class="w-2/3 bg-gray-50 px-10 py-12">
                <form method="POST" action="{{ route('profile.update') }}" class="space-y-8">
                    @csrf
                    @method('PATCH')

                    <!-- Grid 2 kolom -->
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                            <input name="name" value="{{ old('name', auth()->user()->name) }}" type="text"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" value="{{ auth()->user()->email }}" readonly
                                   class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg text-gray-600 cursor-not-allowed">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input name="password" type="password"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Repeat Password</label>
                            <input name="password_confirmation" type="password"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- About -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">About Me</label>
                        <textarea name="about" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg resize-none focus:ring-blue-500 focus:border-blue-500 text-sm">{{ old('about', 'I am ' . auth()->user()->name . ' and I love this app!') }}</textarea>
                    </div>

                    <!-- Tombol -->
                    <div class="text-right">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                            💾 Update Information
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>