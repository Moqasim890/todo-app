<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query()->latest();

        // Filter op categorie
        if ($request->filled('category')) {
            $query->where('category_id', $request->integer('category'));
        }

        // Filter op status
        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        // Alleen eigen taken als ingelogd
        if (Auth::check()) {
            $query->where('user_id', Auth::id());
        }

        $tasks = $query->paginate(10)->withQueryString();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'status' => ['nullable', 'in:open,in_progress,completed'],
            'due_at' => ['nullable', 'date_format:Y-m-d\TH:i'],
        ]);

        $validated['user_id'] = Auth::id();

        Task::create($validated);

        return redirect()->route('tasks.index')->with('status', 'Taak aangemaakt.');
    }

    public function show(Task $task)
    {
        Gate::authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        Gate::authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        Gate::authorize('update', $task);
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'status' => ['nullable', 'in:open,in_progress,completed'],
            'due_at' => ['nullable', 'date_format:Y-m-d\TH:i'],
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('status', 'Taak bijgewerkt.');
    }

    public function destroy(Task $task)
    {
        Gate::authorize('delete', $task);
        $task->delete();
        return redirect()->route('tasks.index')->with('status', 'Taak verwijderd.');
    }

    public function updateStatus(Request $request, Task $task)
    {
        Gate::authorize('update', $task);
        $validated = $request->validate([
            'status' => ['required', 'in:open,in_progress,completed'],
        ]);

        $task->update($validated);

        return back()->with('status', 'Status bijgewerkt.');
    }
}
