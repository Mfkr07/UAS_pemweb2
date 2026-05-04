<x-guest-layout>
    <!-- Right side elements from image: Logo, Title, Form Card -->
    <div class="w-full max-w-md flex flex-col items-center">
        
        <!-- Logo -->
        <div class="w-16 h-16 rounded-full bg-indigo-600 flex items-center justify-center mb-6 shadow-lg shadow-indigo-600/50">
            <span class="text-white font-bold text-xl">SP</span>
        </div>

        <h2 class="text-2xl font-bold text-white mb-1 text-center">Sistem Manajemen<br>Sarana Prasarana</h2>
        <p class="text-gray-400 text-sm mb-8 text-center">Masuk ke akun Anda</p>

        <!-- Form Card -->
        <div class="w-full bg-[#1e2330] rounded-2xl p-6 shadow-xl border border-gray-800">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-xs font-medium text-gray-400 mb-1.5">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@email.com"
                               class="pl-10 block w-full rounded-xl border border-gray-700 bg-[#161a24] text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors py-2.5 sm:text-sm placeholder-gray-600" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs font-medium text-gray-400 mb-1.5">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••"
                               class="pl-10 pr-10 block w-full rounded-xl border border-gray-700 bg-[#161a24] text-white focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors py-2.5 sm:text-sm placeholder-gray-600" />
                        
                        <!-- Eye Icon (Decorative) -->
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                            <svg class="h-4 w-4 text-gray-500 hover:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs" />
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center items-center py-2.5 px-4 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-indigo-500 transition-colors">
                        Masuk
                    </button>
                </div>

                <input type="hidden" name="remember" value="on">
            </form>
        </div>
    </div>
</x-guest-layout>
