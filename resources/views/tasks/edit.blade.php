@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl mb-4">Editar Tarefa</h1>

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block">Título</label>
            <input type="text" id="title" name="title" value="{{ $task->title }}" class="w-full p-2 border" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block">Descrição</label>
            <textarea id="description" name="description" class="w-full p-2 border" required>{{ $task->description }}</textarea>
        </div>

        <div class="mb-4">
            <label for="status" class="block">Status</label>
            <select id="status" name="status" class="w-full p-2 border" required>
                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pendente</option>
                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>Em Andamento</option>
                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Concluída</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>
@endsection
