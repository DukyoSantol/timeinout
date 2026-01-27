<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MGB-XI Mining Portal Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="m-0 p-0 overflow-hidden">
    <!-- Full Screen Background -->
    <div class="fixed inset-0 bg-gradient-to-br from-stone-900 via-stone-900 to-amber-900">
        <!-- Mining Background Elements - Shrunk for Mobile -->
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-10 left-10 text-white opacity-30">
                <svg class="w-3 h-3 transition-all duration-1000" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                </svg>
            </div>
            <div class="absolute bottom-10 right-10 text-white opacity-20">
                <svg class="w-8 h-8 transition-all duration-1500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M6 2v6h.01L6 8.01 10 12l-4 4 .01.01H6V22h12v-5.99h-.01L18 16l-4-4 4-3.99-.01-.01H18V2H6z"/>
                </svg>
            </div>
            <div class="absolute top-1/2 left-1/4 text-white opacity-20">
                <svg class="w-6 h-6 transition-all duration-2000" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </div>
            <div class="absolute top-20 right-1/4 text-white opacity-20">
                <svg class="w-7 h-7 transition-all duration-3000" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.11 0 2-.9 2-2V5c0-1.1-.89-2-2-2zm-9 14l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </div>
            <div class="absolute bottom-20 left-1/3 text-white opacity-20">
                <svg class="w-8 h-8 transition-all duration-2500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
            </div>
            <div class="absolute top-1/3 right-1/3 text-white opacity-20">
                <svg class="w-7 h-7 transition-all duration-1800" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </div>
            <div class="absolute bottom-1/4 right-1/2 text-white opacity-15">
                <svg class="w-8 h-8 transition-all duration-2200" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.11 0 2-.9 2-2V5c0-1.1-.89-2-2-2zm-9 14l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Navigation Overlay -->
    <nav class="fixed top-0 left-0 right-0 backdrop-blur-sm text-white shadow-lg z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold">Online Time In_Out System</h1>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('login') }}" class="hover:bg-amber-600/30 px-3 py-2 rounded text-sm font-medium transition-colors">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="hover:bg-amber-600/30 px-3 py-2 rounded text-sm font-medium transition-colors">
                        Register
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Login Form Overlay -->
    <div class="fixed inset-0 flex items-center justify-center pt-24 px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-md w-full space-y-8">
        <!-- Logo and Title -->
        <div class="text-center">
            <div class="mx-auto h-20 w-20 bg-gradient-to-br from-amber-500 to-amber-600 rounded-full flex items-center justify-center shadow-lg">
                <svg class="h-12 w-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                </svg>
            </div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-amber-100">
                MGB-XI Mining Portal
            </h2>
            <p class="mt-2 text-center text-sm text-amber-200">
                Enter your credentials to access the time tracking system
            </p>
        </div>

        <!-- Login Form -->
        <form class="mt-8 space-y-6 bg-stone-800/50 backdrop-blur-sm rounded-xl p-8 shadow-2xl border border-stone-700" action="{{ route('login') }}" method="POST">
            @csrf
            @if ($errors->any())
                <div class="rounded-md bg-red-900/50 border border-red-800 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h4a1 1 0 001-1V9a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-300">
                                Login Error
                            </h3>
                            <div class="mt-2 text-sm text-red-200">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('status'))
                <div class="rounded-md bg-green-900/50 border border-green-800 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-300">
                                {{ session('status') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-amber-200">Email Address</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="block w-full px-3 py-2 bg-stone-700/50 border border-stone-600 rounded-md shadow-sm placeholder-stone-400 text-amber-100 focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm"
                            value="{{ old('email') }}" placeholder="your.email@mgb.gov.ph">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-amber-200">Password</label>
                    <div class="mt-1 relative">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full px-3 py-2 pr-10 bg-stone-700/50 border border-stone-600 rounded-md shadow-sm placeholder-stone-400 text-amber-100 focus:outline-none focus:ring-amber-500 focus:border-amber-500 sm:text-sm"
                            placeholder="Enter your password">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-amber-400 hover:text-amber-300">
                            <svg id="eyeIcon" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.5C7 4.5 2.75 7.75 2.75S2 10.5 2 15.5 7.75 7.75 12 4.5zm0 6c-2.5 0-4.75-1.75-4.75-4.75S9.5 16.5 12 16.5s4.75-1.75 4.75-4.75 4.75zm0-7.5c.83 0 1.5.67 1.5 1.5s-.67.5-1.5.5-1.5.5z"/>
                            </svg>
                            <svg id="eyeOffIcon" class="h-5 w-5 hidden" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.5C7 4.5 2.75 7.75 2.75S2 10.5 2 15.5c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5S17 4.5 12 4.5zm-2.5 6c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5.67 1.5 1.5 1.5z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember-me" name="remember" type="checkbox"
                        class="h-4 w-4 text-amber-600 focus:ring-amber-500 border-stone-600 rounded bg-stone-700">
                    <label for="remember-me" class="ml-2 block text-sm text-amber-200">
                        Remember me
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <div class="text-sm">
                        <a href="{{ route('password.request') }}" class="font-medium text-amber-400 hover:text-amber-300">
                            Forgot your password?
                        </a>
                    </div>
                @endif
            </div>

            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-stone-900 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 shadow-lg transition-all duration-200">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-amber-800 group-hover:text-amber-900" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                        </svg>
                    </span>
                    Sign in to Mining Portal
                </button>
            </div>

            <div class="text-center">
                <p class="text-sm text-amber-300">
                    Department of Environment and Natural Resources
                </p>
                <p class="text-xs text-amber-400 mt-1">
                    Mines and Geosciences Bureau - Region XI
                </p>
            </div>
        </form>
    </div>
    </div>

    <!-- Footer Overlay -->
    <footer class="fixed bottom-0 left-0 right-0 bg-gray-800/80 backdrop-blur-sm text-white z-20">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} Time In/Out System. All rights reserved.</p>
            </div>
        </div>
    </footer>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Login page loaded - setting up password toggle');
    
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    const eyeOffIcon = document.getElementById('eyeOffIcon');

    console.log('Elements found:', {
        togglePassword: !!togglePassword,
        passwordInput: !!passwordInput,
        eyeIcon: !!eyeIcon,
        eyeOffIcon: !!eyeOffIcon
    });

    if (togglePassword && passwordInput && eyeIcon && eyeOffIcon) {
        togglePassword.addEventListener('click', function() {
            console.log('Toggle clicked, current type:', passwordInput.type);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
                console.log('Password shown');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
                console.log('Password hidden');
            }
        });
    } else {
        console.error('Password toggle elements not found');
    }
});
</script>
</body>
</html>
