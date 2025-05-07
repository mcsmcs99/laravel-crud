<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Exibir a listagem de tarefas
    public function index()
    {
        $tasks = Task::all();  // Pegando todas as tarefas
        return view('tasks.index', compact('tasks'));
    }

    // Exibir o formulário para criar uma nova tarefa
    public function create()
    {
        return view('tasks.create');
    }

    // Armazenar uma nova tarefa
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        Task::create($request->all());  // Criação da tarefa

        return redirect()->route('tasks.index')->with('success', 'Tarefa criada com sucesso!');
    }

    // Exibir uma tarefa específica
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    // Exibir o formulário de edição de tarefa
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // Atualizar a tarefa
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task->update($request->all());  // Atualiza a tarefa

        return redirect()->route('tasks.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

    // Excluir uma tarefa
    public function destroy(Task $task)
    {
        $task->delete();  // Deleta a tarefa

        return redirect()->route('tasks.index')->with('success', 'Tarefa excluída com sucesso!');
    }
}
