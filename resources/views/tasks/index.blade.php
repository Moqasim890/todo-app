@extends('layouts.bootstrap')

@section('title', 'Taken')

@push('actions')
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Nieuwe taak</a>
@endpush

@section('content')
    <form class="row g-2 align-items-end mb-3" method="GET" action="{{ route('tasks.index') }}">
        <div class="col-auto">
            <label class="form-label">Categorie</label>
            <select name="category" class="form-select">
                <option value="">Alle</option>
                @php($cats = \App\Models\Category::where('user_id', auth()->id())->orderBy('name')->get())
                @foreach($cats as $cat)
                    <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-secondary" type="submit">Filter</button>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                <tr>
                    <th>Titel</th>
                    <th>Status</th>
                    <th>Te doen op</th>
                    <th>Categorie</th>
                    <th>Aangemaakt</th>
                    <th class="text-end">Acties</th>
                </tr>
                </thead>
                <tbody>
                @forelse($tasks as $task)
                    <tr>
                        <td>
                            <a href="{{ route('tasks.show', $task) }}" class="link-primary">{{ $task->title }}</a>
                            <div class="small text-muted">{{ Str::limit($task->description, 80) }}</div>
                        </td>
                        <td>
                            @if($task->status === 'completed')
                                <span class="badge bg-success">Afgerond</span>
                            @elseif($task->status === 'in_progress')
                                <span class="badge bg-warning">Bezig</span>
                            @else
                                <span class="badge bg-secondary">Open</span>
                            @endif
                        </td>
                        <td class="small" style="color: #0e7490; font-weight: 500;">
                            @if($task->due_at)
                                📅 {{ $task->due_at->format('d M') }}<br>
                                🕐 {{ $task->due_at->format('H:i') }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="small text-muted">{{ optional($task->category)->name ?? '-' }}</td>
                        <td class="small text-muted">{{ $task->created_at->diffForHumans() }}</td>
                        <td class="text-end">
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning me-2">Bewerken</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Verwijder deze taak?')">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-muted p-4">Nog geen taken. Maak je eerste taak!</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">{{ $tasks->links() }}</div>
@endsection
