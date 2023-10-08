<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskColumn;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string|max:700',
            'task_column_id' => 'required|integer',
            'category_id' => 'required|integer'
        ]);


        $taskColumn = TaskColumn::find($validatedData['task_column_id']);

        if($taskColumn){
            $task =  Task::create([
                'title' => $validatedData['title'],
                'text' => $validatedData['text'],
                'category_id' => $validatedData['category_id'],
            ]);

            $taskIds = json_decode($taskColumn->task_ids) ?: [];
            $taskIds[] = $task->id;

            $taskColumn->update(['task_ids' => json_encode($taskIds)]);
        }else{
            dd('Error, column not found');
        }

        return redirect()->route('categories.show', ['category' => $validatedData['category_id']]);
    }
}
