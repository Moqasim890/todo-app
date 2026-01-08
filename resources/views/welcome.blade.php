<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Todo App') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="antialiased" style="background: radial-gradient(circle at 30% 20%, #f0f9ff 0, #f8fbff 45%, #eef2ff 100%); min-height: 100vh;">
    <div class="max-w-6xl mx-auto px-4 lg:px-8 py-12">
        <div class="grid lg:grid-cols-2 gap-8 items-start">
            <!-- Left: Hero & features -->
            <div class="space-y-8">
                <p class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white shadow-sm shadow-indigo-100 text-sm font-semibold text-indigo-700">
                    {{ config('app.name', 'Todo App') }} · Focus first
                </p>

                <div class="space-y-3">
                    <h1 class="text-4xl lg:text-5xl font-black leading-tight text-slate-900">
                        Minder ruis,
                        <span class="inline-block bg-gradient-to-r from-indigo-500 via-blue-500 to-cyan-400 bg-clip-text text-transparent">meer gedaan.</span>
                    </h1>
                    <p class="text-lg text-slate-600 max-w-2xl">
                        Plan taken, stel deadlines en switch tussen dag, week of maand. Alles blijft licht en overzichtelijk.
                    </p>
                </div>

                <div class="grid sm:grid-cols-3 gap-4">
                    <div class="p-4 rounded-2xl bg-white border border-slate-100 shadow-sm">
                        <p class="text-sm text-slate-500">Dag / week / maand</p>
                        <p class="text-xl font-bold text-indigo-600">Agenda views</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-white border border-slate-100 shadow-sm">
                        <p class="text-sm text-slate-500">Categorie + status</p>
                        <p class="text-xl font-bold text-indigo-600">Filters</p>
                    </div>
                    <div class="p-4 rounded-2xl bg-white border border-slate-100 shadow-sm">
                        <p class="text-sm text-slate-500">Eigen account</p>
                        <p class="text-xl font-bold text-indigo-600">Veilig</p>
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="p-5 rounded-2xl bg-white border border-slate-100 shadow-sm flex gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-blue-500 text-white flex items-center justify-center">✓</div>
                        <div>
                            <p class="font-semibold text-slate-900">Snel starten</p>
                            <p class="text-sm text-slate-600">Binnen 2 minuten je eerste lijst klaar.</p>
                        </div>
                    </div>
                    <div class="p-5 rounded-2xl bg-white border border-slate-100 shadow-sm flex gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-500 to-indigo-500 text-white flex items-center justify-center">📁</div>
                        <div>
                            <p class="font-semibold text-slate-900">Slim ordenen</p>
                            <p class="text-sm text-slate-600">Categorieën, status en duidelijke labels.</p>
                        </div>
                    </div>
                    <div class="p-5 rounded-2xl bg-white border border-slate-100 shadow-sm flex gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500 to-teal-500 text-white flex items-center justify-center">🔒</div>
                        <div>
                            <p class="font-semibold text-slate-900">Alleen jij</p>
                            <p class="text-sm text-slate-600">Data afgeschermd per gebruiker.</p>
                        </div>
                    </div>
                    <div class="p-5 rounded-2xl bg-white border border-slate-100 shadow-sm flex gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-500 to-orange-500 text-white flex items-center justify-center">⚡</div>
                        <div>
                            <p class="font-semibold text-slate-900">Licht & vlot</p>
                            <p class="text-sm text-slate-600">Direct inzicht zonder trage schermen.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Auth card -->
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 lg:p-10 space-y-6">
                @auth
                    <div class="space-y-2">
                        <p class="text-sm font-semibold text-indigo-600">Welkom terug</p>
                        <h2 class="text-3xl font-bold text-slate-900">Ga verder met je taken</h2>
                        <p class="text-slate-600">Dashboard open, filters en agenda staan klaar.</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-indigo-500 to-cyan-500 text-white rounded-xl px-6 py-3.5 font-semibold hover:from-indigo-600 hover:to-cyan-600 transition shadow-lg">
                        <span>Ga naar dashboard</span>
                        <span>→</span>
                    </a>
                @else
                    <div class="space-y-2">
                        <p class="text-sm font-semibold text-indigo-600">Gratis beginnen</p>
                        <h2 class="text-3xl font-bold text-slate-900">Bouw je flow op</h2>
                        <p class="text-slate-600">Maak een account of log in en start meteen.</p>
                    </div>

                    <div class="space-y-3">
                        <a href="{{ route('register') }}" class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-indigo-500 to-cyan-500 text-white rounded-xl px-6 py-3.5 font-semibold hover:from-indigo-600 hover:to-cyan-600 transition shadow-lg">
                            <span>Account aanmaken</span>
                            <span>🚀</span>
                        </a>
                        <a href="{{ route('login') }}" class="w-full inline-flex items-center justify-center gap-2 border-2 border-slate-200 text-slate-800 rounded-xl px-6 py-3.5 font-semibold hover:border-indigo-300 hover:text-indigo-800 transition bg-white">
                            <span>Inloggen</span>
                            <span>→</span>
                        </a>
                    </div>

                    <p class="text-sm text-slate-500 text-center">
                        Geen creditcard nodig · Gratis starten · Altijd opzegbaar
                    </p>
                @endauth
            </div>
        </div>
    </div>
</body>
</html>
