<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Exibir a listagem de tarefas
    public function index(Request $request)
    {
        // Inicializa a consulta
        $query = Task::query();
        
        // Filtrando por status, se fornecido
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Ordenação por data de criação
        if ($request->has('order_created') && $request->order_created != '') {
            $orderCreated = $request->order_created === 'desc' ? 'desc' : 'asc';
            $query->orderBy('created_at', $orderCreated);
        }

        // Ordenação por data de atualização
        if ($request->has('order_updated') && $request->order_updated != '') {
            $orderUpdated = $request->order_updated === 'desc' ? 'desc' : 'asc';
            $query->orderBy('updated_at', $orderUpdated);
        }

        // Paginação com 10 tarefas por página
        $tasks = $query->paginate(10);

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

        Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
        ]);

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
