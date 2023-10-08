<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskColumn extends Model
{
    protected $table = 'tasks_columns';

    protected $fillable = [
        'title',
        'task_ids',
        'category_id',
        'id',
    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
