@extends('layouts.bootstrap')

@section('title', 'Categorie bewerken')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Naam</label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control">
                    @error('name')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary me-2">Annuleren</a>
                    <button type="submit" class="btn btn-primary">Opslaan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
