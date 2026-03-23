<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MGB-XI Online Time In/Out System')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in {
            animation: fadeIn 0.3s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Logo Fade Animation */
        .logo-text {
            display: inline-block;
            animation: logoFadeIn 2s ease-in-out infinite;
        }
        
        @keyframes logoFadeIn {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        /* Elegant Button Hover Effects */
        .btn-elegant {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .btn-elegant::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-elegant:hover::before {
            left: 100%;
        }

        .btn-elegant:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-elegant:active {
            transform: translateY(0);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        /* Glow Effect on Hover */
        .btn-glow-green:hover {
            box-shadow: 0 0 20px rgba(34, 197, 94, 0.5), 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-glow-blue:hover {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.5), 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-glow-purple:hover {
            box-shadow: 0 0 20px rgba(168, 85, 247, 0.5), 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-glow-yellow:hover {
            box-shadow: 0 0 20px rgba(250, 204, 21, 0.5), 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-glow-red:hover {
            box-shadow: 0 0 20px rgba(239, 68, 68, 0.5), 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .btn-glow-orange:hover {
            box-shadow: 0 0 20px rgba(249, 115, 22, 0.5), 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        /* Gradient Animation */
        .btn-gradient {
            background-size: 200% 200%;
            animation: gradient 3s ease infinite;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Pulse Animation for Active State */
        .btn-pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(34, 197, 94, 0); }
            100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
        }

        /* Shimmer Effect */
        .shimmer {
            position: relative;
            overflow: hidden;
        }

        .shimmer::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to right,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.3) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: rotate(30deg);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%) rotate(30deg); }
            100% { transform: translateX(100%) rotate(30deg); }
        }

        /* Button Ripple Effect */
        .ripple {
            position: relative;
            overflow: hidden;
        }

        .ripple::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            background-image: radial-gradient(circle, rgba(255,255,255,0.3) 10%, transparent 10%);
            background-repeat: no-repeat;
            background-position: 50%;
            transform: scale(10);
            opacity: 0;
            transition: transform 0.5s, opacity 0.5s;
        }

        .ripple:active::after {
            transform: scale(0);
            opacity: 1;
            transition: 0s;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Overlay -->
    <div id="menuOverlay" class="fixed inset-0 bg-black/50 z-40 hidden"></div>
    
    <!-- Slide-out Menu -->
    <div id="mobileMenu" class="fixed top-0 right-0 h-full w-80 bg-gradient-to-b from-blue-700 to-blue-800 shadow-2xl z-50 transform translate-x-full transition-transform duration-300">
        <div class="p-4">
            <!-- Menu Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-white font-bold text-lg flex items-center">
                    <div class="bg-white/20 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span>
                        <span class="logo-text">MGB-XI</span>
                        <span class="text-yellow-300"> TimeIN/OUT</span>
                    </span>
                </h2>
                <button id="closeMenuBtn" class="p-2 text-white hover:bg-white/20 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Menu Items -->
            <nav class="space-y-2">
            @guest
                <a href="{{ route('login') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-white/10 hover:bg-white/20 text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="font-medium">Login</span>
                </a>
                <a href="{{ route('register') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-blue-500 hover:bg-blue-600 text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    <span class="font-medium">Register</span>
                </a>
            @else
                <div class="px-4 py-3 border-b border-white/20 mb-2">
                    <p class="text-xs text-blue-200">Signed in as</p>
                    <p class="font-bold text-white">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-blue-300">{{ auth()->user()->position ?? 'User' }}</p>
                </div>
                <a href="{{ route('time-records.form') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-green-500/30 hover:bg-green-500/50 text-white transition-colors {{ request()->routeIs('time-records.form') ? 'bg-green-500/50 border-l-4 border-green-400' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">Time In/Out</span>
                </a>
                <a href="{{ route('user.time-records') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-blue-500/30 hover:bg-blue-500/50 text-white transition-colors {{ request()->routeIs('user.time-records') ? 'bg-blue-500/50 border-l-4 border-blue-400' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="font-medium">My Records</span>
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-purple-500/30 hover:bg-purple-500/50 text-white transition-colors {{ request()->routeIs('profile.edit') ? 'bg-purple-500/50 border-l-4 border-purple-400' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="font-medium">Profile</span>
                </a>
                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-yellow-500/30 hover:bg-yellow-500/50 text-white transition-colors {{ request()->routeIs('admin.*') ? 'bg-yellow-500/50 border-l-4 border-yellow-400' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="font-medium">Admin Dashboard</span>
                </a>
                @endif
                <div class="pt-4 border-t border-white/20 mt-4">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg bg-red-500/30 hover:bg-red-500/50 text-white transition-colors cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="font-medium">Logout</span>
                        </button>
                    </form>
                </div>
            @endguest
            </nav>
            
            <!-- Menu Footer -->
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-white/20 bg-blue-800">
                <p class="text-center text-xs text-blue-300">&copy; {{ date('Y') }} MGB-XI Time Tracking</p>
            </div>
        </div>
    </div>
    
    <!-- Header -->
    <nav class="bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-lg sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <a href="{{ route('time-records.form') }}" class="flex items-center flex-shrink-0">
                    <div class="bg-white/20 p-2 rounded-lg mr-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h1 class="text-lg sm:text-xl font-bold">
                        <span class="logo-text">MGB-XI Online</span>
                        <span class="text-yellow-300"> TimeIN/OUT</span>
                    </h1>
                </a>
                
                <!-- Menu Button (All Devices) -->
                <div class="flex items-center">
                    <button type="button" id="mobileMenuBtn" class="p-2 rounded-lg text-white hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white transition-colors">
                        <svg id="menuIcon" class="h-6 w-6 block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg id="closeIcon" class="h-6 w-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-6">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded fade-in">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded fade-in">
                {{ session('error') }}
            </div>
        @endif

        @if(isset($errors) && $errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
    @stack('scripts')
    
    <!-- Mobile Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const closeMenuBtn = document.getElementById('closeMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            const menuOverlay = document.getElementById('menuOverlay');
            const menuIcon = document.getElementById('menuIcon');
            const closeIcon = document.getElementById('closeIcon');
            
            function openMenu() {
                mobileMenu.classList.remove('translate-x-full');
                menuOverlay.classList.remove('hidden');
                menuIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }
            
            function closeMenu() {
                mobileMenu.classList.add('translate-x-full');
                menuOverlay.classList.add('hidden');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
            
            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', function() {
                    if (mobileMenu.classList.contains('translate-x-full')) {
                        openMenu();
                    } else {
                        closeMenu();
                    }
                });
            }
            
            if (closeMenuBtn) {
                closeMenuBtn.addEventListener('click', closeMenu);
            }
            
            if (menuOverlay) {
                menuOverlay.addEventListener('click', closeMenu);
            }
            
            // Close menu on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !mobileMenu.classList.contains('translate-x-full')) {
                    closeMenu();
                }
            });
            
            // Auto-refresh page if CSRF token is invalid (419 error prevention)
            function checkSessionValidity() {
                fetch('/csrf-token')
                    .then(response => {
                        if (!response.ok) {
                            // Session expired, reload the page
                            console.log('Session expired, reloading page...');
                            location.reload();
                        }
                    })
                    .catch(() => {
                        // Network error or session invalid, reload
                        console.log('Session check failed, reloading page...');
                        location.reload();
                    });
            }
            
            // Check session validity every 30 minutes (1800000ms)
            // This prevents 419 errors by reloading before token expires
            setInterval(checkSessionValidity, 30 * 60 * 1000);
            
            // Also check on page visibility change (when user comes back to tab)
            document.addEventListener('visibilitychange', function() {
                if (document.visibilityState === 'visible') {
                    // Check if page was hidden for more than 5 minutes
                    const lastHidden = localStorage.getItem('lastHiddenTime');
                    if (lastHidden) {
                        const timeDiff = Date.now() - parseInt(lastHidden);
                        if (timeDiff > 5 * 60 * 1000) { // 5 minutes
                            checkSessionValidity();
                        }
                    }
                } else {
                    localStorage.setItem('lastHiddenTime', Date.now().toString());
                }
            });
        });
    </script>
</body>
</html>
