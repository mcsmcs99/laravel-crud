@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl mb-4">Criar Tarefa</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="title" class="block">Título</label>
            <input type="text" id="title" name="title" class="w-full p-2 border" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block">Descrição</label>
            <textarea id="description" name="description" class="w-full p-2 border" required></textarea>
        </div>

        <div class="mb-4">
            <label for="status" class="block">Status</label>
            <select id="status" name="status" class="w-full p-2 border" required>
                <option value="pending">Pendente</option>
                <option value="in_progress">Em Andamento</option>
                <option value="completed">Concluída</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Criar Tarefa</button>
    </form>
</div>
@endsection
