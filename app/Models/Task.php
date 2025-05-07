<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title', // Título da tarefa
        'description', // Descrição da tarefa
        'status', // Status da tarefa (pendente, em andamento, concluída)
    ];

    public $timestamps = true;
}
