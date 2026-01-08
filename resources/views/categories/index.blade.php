@extends('layouts.bootstrap')

@section('title', 'Categorieën')

@push('actions')
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Nieuwe categorie</a>
@endpush

@section('content')
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                <tr>
                    <th>Naam</th>
                    <th class="text-end">Acties</th>
                </tr>
                </thead>
                <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td class="text-end">
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning me-2">Bewerken</a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Verwijder deze categorie?')">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-muted p-4">Nog geen categorieën.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">{{ $categories->links() }}</div>
@endsection
