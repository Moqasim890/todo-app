<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $view = request('view', 'full'); // day, week, month, full
        
        $query = Task::where('user_id', Auth::id());
        
        // Filter by view (based on due_at date)
        switch($view) {
            case 'day':
                $query->whereDate('due_at', now()->format('Y-m-d'));
                break;
            case 'week':
                $query->whereBetween('due_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereYear('due_at', now()->year)
                      ->whereMonth('due_at', now()->month);
                break;
            // case 'full' - no filter
        }
        
        $tasks = $query->orderBy('due_at', 'asc')->get();
        
        $total = Task::where('user_id', Auth::id())->count();
        $weekCount = Task::where('user_id', Auth::id())->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $categories = Category::where('user_id', Auth::id())->withCount('tasks')->get();
        
        $openCount = Task::where('user_id', Auth::id())->where('status', 'open')->count();
        $inProgressCount = Task::where('user_id', Auth::id())->where('status', 'in_progress')->count();
        $completedCount = Task::where('user_id', Auth::id())->where('status', 'completed')->count();

        return view('dashboard', [
            'total' => $total,
            'weekCount' => $weekCount,
            'openCount' => $openCount,
            'inProgressCount' => $inProgressCount,
            'completedCount' => $completedCount,
            'categories' => $categories,
            'tasks' => $tasks,
            'currentView' => $view,
        ]);
    }
}
