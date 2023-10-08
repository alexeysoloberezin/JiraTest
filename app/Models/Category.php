<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Inertia\Inertia;

class Category extends Model
{
    protected $fillable = [
        'title',
        'text',
        'user_id'
    ];

    public function tasks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function taskColumns(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TaskColumn::class, 'category_id');
    }
}
