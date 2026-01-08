@extends('layouts.bootstrap')

@section('title', 'Taak')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <h2 class="h4">{{ $task->title }}</h2>
                @if($task->status === 'completed')
                    <span class="badge bg-success">Afgerond</span>
                @elseif($task->status === 'in_progress')
                    <span class="badge bg-warning">Bezig</span>
                @else
                    <span class="badge bg-secondary">Open</span>
                @endif
            </div>
            <p class="mt-2">{{ $task->description }}</p>
            <p class="mt-2 text-muted">Categorie: {{ optional($task->category)->name ?? '-' }}</p>            @if($task->due_at)
                <p class=\"mt-2\" style=\"color: #0e7490; font-weight: 500;\">
                    📅 <strong>Te doen op:</strong> {{ $task->due_at->format('d M Y') }} om {{ $task->due_at->format('H:i') }}
                </p>
            @endif
            <hr>
            <div class="mb-3">
                <small class="text-muted d-block mb-2">Status wijzigen:</small>
                <form action="{{ route('tasks.updateStatus', $task) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="open">
                    <button type="submit" class="btn btn-sm btn-outline-secondary" @disabled($task->status === 'open')>🔵 Open</button>
                </form>
                <form action="{{ route('tasks.updateStatus', $task) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="in_progress">
                    <button type="submit" class="btn btn-sm btn-outline-warning" @disabled($task->status === 'in_progress')>🟡 Bezig</button>
                </form>
                <form action="{{ route('tasks.updateStatus', $task) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="completed">
                    <button type="submit" class="btn btn-sm btn-outline-success" @disabled($task->status === 'completed')>🟢 Afgerond</button>
                </form>
            </div>

            <div class="mt-3">
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning me-2">Bewerken</a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Verwijder deze taak?')">Verwijderen</button>
                </form>
                <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary ms-2">Terug</a>
            </div>
        </div>
    </div>
@endsection
