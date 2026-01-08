@extends('layouts.bootstrap')

@section('title', 'Student dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 mb-0">Agenda</h2>
        <div class="btn-group" role="group">
            <a href="{{ route('dashboard', ['view' => 'day']) }}" class="btn btn-sm {{ request('view') === 'day' ? 'btn-primary' : 'btn-outline-primary' }}">📅 Dag</a>
            <a href="{{ route('dashboard', ['view' => 'week']) }}" class="btn btn-sm {{ request('view') === 'week' ? 'btn-primary' : 'btn-outline-primary' }}">📅 Week</a>
            <a href="{{ route('dashboard', ['view' => 'month']) }}" class="btn btn-sm {{ request('view') === 'month' ? 'btn-primary' : 'btn-outline-primary' }}">📅 Maand</a>
            <a href="{{ route('dashboard', ['view' => 'full']) }}" class="btn btn-sm {{ request('view') !== 'day' && request('view') !== 'week' && request('view') !== 'month' ? 'btn-primary' : 'btn-outline-primary' }}">📅 Alles</a>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body" style="border-left: 4px solid #10b981;">
                    <div class="text-muted small">Deze week af</div>
                    <div class="h2 mb-0 fw-bold" style="color: #06b6d4;">{{ $weekCount }}</div>
                    <small class="text-success fw-semibold">Goed bezig! 🚀</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body" style="border-left: 4px solid #f59e0b;">
                    <div class="text-muted small">Openstaande taken</div>
                    <div class="h2 mb-0 fw-bold" style="color: #0891b2;">{{ $openCount }}</div>
                    <small class="text-muted">Focus op deze week</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body" style="border-left: 4px solid #06b6d4;">
                    <div class="text-muted small">Bezig</div>
                    <div class="h2 mb-0 fw-bold" style="color: #0e7490;">{{ $inProgressCount }}</div>
                    <small class="text-muted">Actieve taken</small>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            @forelse($tasks as $task)
                <div class="mb-3 p-3" style="background: #f8fbfd; border-radius: 10px; border-left: 4px solid #06b6d4; display: flex; justify-content: space-between; align-items: center; gap: 20px;">
                    <div style="flex: 1;">
                        <h5 class="mb-1">
                            <a href="{{ route('tasks.show', $task) }}" class="link-primary fw-bold" style="font-size: 16px;">{{ $task->title }}</a>
                        </h5>
                        <p class="mb-2 text-muted" style="font-size: 13px;">{{ Str::limit($task->description, 100) }}</p>
                        
                        <div class="d-flex gap-3 flex-wrap" style="font-size: 13px;">
                            @if($task->due_at)
                                <div style="color: #0e7490; font-weight: 600;">
                                    📅 Te doen: {{ $task->due_at->format('d M Y') }} om {{ $task->due_at->format('H:i') }}
                                </div>
                            @endif
                            
                            <div style="color: #0e7490; font-weight: 600;">
                                📝 Aangemaakt: {{ $task->created_at->format('d M Y') }}
                            </div>
                            
                            @if($task->category)
                                <div style="background: #e0f2fe; color: #0e7490; padding: 3px 8px; border-radius: 5px; font-weight: 600;">
                                    📁 {{ $task->category->name }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div style="display: flex; align-items: center; gap: 15px; white-space: nowrap;">
                        <div>
                            @if($task->status === 'completed')
                                <span class="badge bg-success" style="padding: 10px 15px; font-size: 12px; font-weight: 600;">✓ Afgerond</span>
                            @elseif($task->status === 'in_progress')
                                <span class="badge bg-warning text-dark" style="padding: 10px 15px; font-size: 12px; font-weight: 600;">⟳ Bezig</span>
                            @else
                                <span class="badge" style="background: #e0f2fe; color: #0e7490; padding: 10px 15px; font-size: 12px; font-weight: 600;">○ Open</span>
                            @endif
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-primary" style="font-weight: 600; padding: 8px 16px;">Bewerken</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" style="font-weight: 600; padding: 8px 16px;" onclick="return confirm('Verwijder deze taak?')">Verwijderen</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted p-5">
                    <p style="font-size: 16px;">Geen taken in deze periode</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
