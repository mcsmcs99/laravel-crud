@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-semibold text-gray-800 mb-4">Editar Tarefa</h2>

        <div class="bg-white shadow sm:rounded-lg overflow-hidden">
            <div class="p-6">
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-600">Título</label>
                        <input type="text" name="title" id="title" value="{{ $task->title }}" class="mt-1 block w-full border-gray-300 rounded-md p-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-600">Descrição</label>
                        <textarea name="description" id="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md p-2">{{ $task->description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-600">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md p-2">
                            <option value="pendente" {{ $task->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
                            <option value="em andamento" {{ $task->status == 'em andamento' ? 'selected' : '' }}>Em andamento</option>
                            <option value="concluída" {{ $task->status == 'concluída' ? 'selected' : '' }}>Concluída</option>
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">Salvar Tarefa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
