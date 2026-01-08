<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo App Pro</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        :root {
            --gradient-start: #06b6d4;
            --gradient-mid: #0891b2;
            --gradient-end: #0e7490;
            --sidebar-bg: linear-gradient(135deg, #06b6d4 0%, #0891b2 50%, #0e7490 100%);
        }
        body {
            background: linear-gradient(135deg, #ecfeff 0%, #cffafe 100%);
            min-height: 100vh;
        }
        .sidebar-gradient {
            background: var(--sidebar-bg);
            box-shadow: 2px 0 15px rgba(6, 182, 212, 0.2);
        }
        .nav-link:hover {
            background: rgba(255,255,255,0.15);
            border-radius: 8px;
        }
        .nav-link.active {
            background: rgba(255,255,255,0.25);
            border-radius: 8px;
        }
        .card {
            border: none;
            border-radius: 15px;
            transition: transform 0.2s, box-shadow 0.2s;
            background: white;
        }
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(6, 182, 212, 0.15);
        }
        .btn-primary {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            border: none;
            padding: 10px 24px;
            font-weight: 600;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #0891b2 0%, #0e7490 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
        }
        .form-control:focus, .form-select:focus {
            border-color: #06b6d4;
            box-shadow: 0 0 0 0.25rem rgba(6, 182, 212, 0.15);
        }
        .form-label {
            font-weight: 600;
            color: #0e7490;
            margin-bottom: 0.5rem;
        }
        .form-control, .form-select {
            border: 2px solid #e0f2fe;
            border-radius: 8px;
            padding: 10px 14px;
        }
        .card-header {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: white;
            font-weight: 600;
            border-radius: 15px 15px 0 0 !important;
        }
    </style>
    @stack('head')
</head>
<body>
<div class="d-flex" style="min-height: 100vh;">
    <!-- Sidebar -->
    <aside class="sidebar-gradient text-white p-3" style="width: 280px;">
        <div class="d-flex align-items-center mb-4">
            <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center me-2 fw-bold" style="width: 40px; height: 40px; color: #06b6d4;">T</div>
            <div>
                <div class="fw-bold fs-5">TODO APP</div>
                <small style="opacity: 0.9;">Student dashboard</small>
            </div>
        </div>

        <nav class="nav nav-pills flex-column">
            <a class="nav-link text-white" href="{{ route('dashboard') }}">Dashboard</a>
            <a class="nav-link text-white" href="{{ route('tasks.index') }}">Taken</a>
            <a class="nav-link text-white" href="{{ route('categories.index') }}">Categorieën</a>
            
            @if(isset($categories) && $categories->count() > 0)
                <hr class="border-secondary my-2">
                <small class="text-white-50 px-3">Jouw categorieën</small>
                @foreach($categories as $category)
                    <a class="nav-link text-white small" href="{{ route('tasks.index', ['category' => $category->id]) }}">
                        📁 {{ $category->name }}
                        @if($category->tasks_count > 0)
                            <span class="badge bg-primary rounded-pill float-end">{{ $category->tasks_count }}</span>
                        @endif
                    </a>
                @endforeach
            @endif
            
            <hr class="border-secondary my-2">
            <small class="text-white-50 px-3">Status</small>
            <a class="nav-link text-white small" href="{{ route('tasks.index', ['status' => 'open']) }}">
                🔵 Open
                @if(isset($openCount) && $openCount > 0)
                    <span class="badge bg-info rounded-pill float-end">{{ $openCount }}</span>
                @endif
            </a>
            <a class="nav-link text-white small" href="{{ route('tasks.index', ['status' => 'in_progress']) }}">
                🟡 Bezig
                @if(isset($inProgressCount) && $inProgressCount > 0)
                    <span class="badge bg-warning rounded-pill float-end">{{ $inProgressCount }}</span>
                @endif
            </a>
            <a class="nav-link text-white small" href="{{ route('tasks.index', ['status' => 'completed']) }}">
                🟢 Afgerond
                @if(isset($completedCount) && $completedCount > 0)
                    <span class="badge bg-success rounded-pill float-end">{{ $completedCount }}</span>
                @endif
            </a>
            
            <hr class="border-secondary my-2">
            <small class="text-white-50 px-3">Agenda weergave</small>
            <a class="nav-link text-white small" href="{{ route('dashboard', ['view' => 'day']) }}">📅 Dag</a>
            <a class="nav-link text-white small" href="{{ route('dashboard', ['view' => 'week']) }}">📅 Week</a>
            <a class="nav-link text-white small" href="{{ route('dashboard', ['view' => 'month']) }}">📅 Maand</a>
            <a class="nav-link text-white small" href="{{ route('dashboard', ['view' => 'full']) }}">📅 Volledige agenda</a>
        </nav>

        <div class="mt-auto pt-3 small text-white-50">
            @auth
                <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-light w-100 mb-2">⚙️ Profiel</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-sm btn-outline-light w-100" type="submit">Uitloggen</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-sm btn-light w-100 mb-2">Inloggen</a>
                <a href="{{ route('register') }}" class="btn btn-sm btn-outline-light w-100">Registreren</a>
            @endauth
        </div>
    </aside>

    <!-- Main content -->
    <main class="flex-grow-1 p-4" style="background: transparent;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4">@yield('title', 'Dashboard')</h1>
            <div>@stack('actions')</div>
        </div>
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @yield('content')
    </main>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@stack('scripts')
</body>
</html>
