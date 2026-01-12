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
    </style>
</head>
<body class="bg-gray-50">
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold">MGB-XI Online Time In/Out System</h1>
                </div>
                <div class="flex items-center space-x-4">
            @guest
                <a href="{{ route('login') }}" class="hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                    Login
                </a>
                <a href="{{ route('register') }}" class="hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                    Register
                </a>
            @else
                <span class="text-white mr-4">{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        Logout
                    </button>
                </form>
                <a href="{{ route('time-records.form') }}" class="hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                    Time In/Out
                </a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        Admin Dashboard
                    </a>
                @endif
            @endguest
        </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
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

    <footer class="bg-gray-800 text-white mt-12">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} Time In/Out System. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
