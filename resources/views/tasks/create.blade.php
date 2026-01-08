@extends('layouts.bootstrap')

@section('title', 'Nieuwe taak')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Titel</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control">
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
                            <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="open" @selected(old('status', 'open') === 'open')>🔵 Open</option>
                        <option value="in_progress" @selected(old('status') === 'in_progress')>🟡 Bezig</option>
                        <option value="completed" @selected(old('status') === 'completed')>🟢 Afgerond</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Te doen op (Datum & Tijd)</label>
                    <input type="datetime-local" name="due_at" value="{{ old('due_at') }}" class="form-control">
                    @error('due_at')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Beschrijving</label>
                    <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
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
