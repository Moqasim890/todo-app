@extends('layouts.bootstrap')

@section('title', 'Taak bewerken')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('tasks.update', $task) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Titel</label>
                    <input type="text" name="title" value="{{ old('title', $task->title) }}" class="form-control">
                    @error('title')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Categorie</label>
                    <select name="category_id" class="form-select">
                        <option value="">Geen</option>
                        @php($cats = \App\Models\Category::where('user_id', auth()->id())->orderBy('name')->get())
                        @foreach($cats as $cat)
                            <option value="{{ $cat->id }}" @selected(old('category_id', $task->category_id) == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="open" @selected(old('status', $task->status) === 'open')>🔵 Open</option>
                        <option value="in_progress" @selected(old('status', $task->status) === 'in_progress')>🟡 Bezig</option>
                        <option value="completed" @selected(old('status', $task->status) === 'completed')>🟢 Afgerond</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Te doen op (Datum & Tijd)</label>
                    <input type="datetime-local" name="due_at" value="{{ old('due_at', $task->due_at?->format('Y-m-d H:i')) }}" class="form-control">
                    @error('due_at')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Beschrijving</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description', $task->description) }}</textarea>
                    @error('description')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary me-2">Annuleren</a>
                    <button type="submit" class="btn btn-primary">Opslaan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
