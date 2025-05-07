@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl mb-4">Tarefas</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-4">Nova Tarefa</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="min-w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2">Título</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td class="border px-4 py-2">{{ $task->title }}</td>
                    <td class="border px-4 py-2">{{ $task->status }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
