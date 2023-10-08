<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(): \Inertia\Response
    {
        $user = Auth::user();
        $categories = Category::where('user_id', $user->id)->get();

        return Inertia::render('Dashboard', [
            'categories' => $categories
        ]);
    }

    public function show(Category $category): \Inertia\Response
    {
        $category->load('taskColumns');

        $category->taskColumns->each(function ($taskColumn) {
            $taskIds = json_decode($taskColumn->task_ids);

            // Получаем задачи и сортируем их с помощью массива идентификаторов
            $tasks = Task::whereIn('id', $taskIds)->get();
            $tasks = $tasks->sortBy(function ($task) use ($taskIds) {
                return array_search($task->id, $taskIds);
            })->values(); // Преобразуем коллекцию в индексированный массив

            $taskColumn->tasks = $tasks;
        });

        return Inertia::render('Categories/Show', [
            'category' => $category
        ]);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $request->merge(['user_id' => $user->id]);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'user_id' => 'required|integer'
        ]);

        Category::create($validatedData);

        return redirect()->route('dashboard')
            ->with('success', 'Category created successfully');
    }

    public function destroy(Category $category): \Illuminate\Http\RedirectResponse
    {
        $category->delete();

        return Redirect::to('/dashboard');
    }
}
