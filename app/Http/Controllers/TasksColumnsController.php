<?php

namespace App\Http\Controllers;

use App\Models\TaskColumn;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TasksColumnsController extends Controller
{
    public function store(Request $request)
    {
        // Валидация данных, если необходимо
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'task_ids' => 'json',
            'category_id' => 'required|integer'
        ]);

        // Создание новой задачи

         TaskColumn::create([
            'title' => $validatedData['title'],
            'task_ids' => $validatedData['task_ids'], // Здесь можно сохранить массив идентификаторов задач
            'category_id' => $validatedData['category_id'], // Здесь предполагается, что вы передаете ID категории через запрос
        ]);

        return redirect()->route('categories.show', ['category' => $validatedData['category_id']]);
    }

    public function update(Request $request)
    {
        $taskColumnsData = $request->json('task_columns');

        foreach ($taskColumnsData['task_columns'] as &$taskColumnData) {
            // Получаем экземпляр модели TaskColumn по его ID или каким-либо другим способом
            $taskColumn = TaskColumn::find($taskColumnData['id']);

            if ($taskColumn) {
                // Обновляем поля модели
                $taskColumn->update([
                    'title' => $taskColumnData['title'],
                    'task_ids' => $taskColumnData['task_ids'],
                ]);
            }
        }

        return redirect()->route('categories.show', ['category' => $taskColumnsData['id']]);
    }

    public function destroy(TaskColumn $taskColumn)
    {
        $taskColumn->delete();
    }
}
