<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Todo App') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="antialiased" style="background: linear-gradient(135deg, #ecfeff 0%, #cffafe 100%); min-height: 100vh;">
    <div class="container mx-auto px-4 py-8 flex items-center justify-center min-h-screen">
        <div class="grid lg:grid-cols-2 gap-8 w-full max-w-6xl">
            <!-- Left Card - Features -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 lg:p-12" style="box-shadow: 0 15px 40px rgba(6, 182, 212, 0.15);">
                <h1 class="text-4xl lg:text-5xl font-bold mb-4" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Todo App</h1>
                <p class="text-gray-600 text-lg mb-10">Organize your tasks, boost your productivity, and achieve your goals efficiently.</p>
                
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <div class="w-14 h-14 rounded-full mx-auto mb-4 flex items-center justify-center" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);">
                            <span class="text-2xl">✓</span>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2 text-center">Easy to Use</h3>
                        <p class="text-sm text-gray-600 text-center">Intuitive interface designed for everyone</p>
                    </div>
                    <div>
                        <div class="w-14 h-14 rounded-full mx-auto mb-4 flex items-center justify-center" style="background: linear-gradient(135deg, #0891b2 0%, #0e7490 100%); box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);">
                            <span class="text-2xl">📁</span>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2 text-center">Organize</h3>
                        <p class="text-sm text-gray-600 text-center">Categorize tasks for better management</p>
                    </div>
                    <div>
                        <div class="w-14 h-14 rounded-full mx-auto mb-4 flex items-center justify-center" style="background: linear-gradient(135deg, #0e7490 0%, #06b6d4 100%); box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);">
                            <span class="text-2xl">🔒</span>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2 text-center">Secure</h3>
                        <p class="text-sm text-gray-600 text-center">Your data is protected and private</p>
                    </div>
                    <div>
                        <div class="w-14 h-14 rounded-full mx-auto mb-4 flex items-center justify-center" style="background: linear-gradient(135deg, #06b6d4 0%, #0e7490 100%); box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);">
                            <span class="text-2xl">⚡</span>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2 text-center">Fast</h3>
                        <p class="text-sm text-gray-600 text-center">Lightning-quick performance</p>
                    </div>
                </div>
            </div>

            <!-- Right Card - Auth -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 lg:p-12 flex flex-col justify-center" style="box-shadow: 0 15px 40px rgba(6, 182, 212, 0.15);">
                @auth
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Welcome back! 👋</h2>
                    <p class="text-gray-600 mb-8">Ready to get productive? Let's dive in.</p>
                    <a href="{{ route('dashboard') }}" class="w-full text-white rounded-lg px-6 py-4 font-semibold transition transform hover:-translate-y-1 text-center shadow-lg" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);">
                        Go to Dashboard →
                    </a>
                @else
                    <h2 class="text-3xl font-bold text-gray-900 mb-3">Get Started</h2>
                    <p class="text-gray-600 mb-8">Join thousands of users managing their tasks efficiently</p>
                    
                    <div class="space-y-4 mb-8">
                        <a href="{{ route('register') }}" class="w-full text-white rounded-lg px-6 py-4 font-bold transition transform hover:-translate-y-1 block text-center shadow-lg" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);">
                            Create Account
                        </a>
                        <a href="{{ route('login') }}" class="w-full rounded-lg px-6 py-4 font-bold transition block text-center" style="background: #e0f2fe; color: #0e7490; border: 2px solid #06b6d4;">
                            Sign In
                        </a>
                    </div>

                    <p class="text-sm text-gray-500 text-center">
                        No credit card required • Free to start • Cancel anytime
                    </p>
                @endauth
            </div>
        </div>
    </div>
</body>
</html>
