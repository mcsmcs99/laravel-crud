@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-semibold text-gray-800 mb-4">Listagem de Tarefas</h2>

        <div class="mb-4 flex justify-between items-center">
            <a href="{{ route('tasks.create') }}" class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md">Nova Tarefa</a>
            <div class="flex space-x-4">
                <form action="{{ route('tasks.index') }}" method="GET">
                    <select name="status" class="border-gray-300 p-2 rounded-md">
                        <option value="">Filtrar por status</option>
                        <option value="pendente">Pendente</option>
                        <option value="em andamento">Em andamento</option>
                        <option value="concluída">Concluída</option>
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Filtrar</button>
                </form>
            </div>
        </div>

        <div class="bg-white shadow sm:rounded-lg overflow-hidden">
            <div class="p-6">
                <ul>
                    @foreach ($tasks as $task)
                        <li class="flex justify-between items-center py-2 border-b">
                            <div>
                                <span class="font-medium text-gray-600">{{ $task->title }}</span>
                                <p class="text-sm text-gray-500">{{ $task->description }}</p>
                            </div>
                            <span class="text-sm {{ $task->status == 'concluída' ? 'text-green-600' : 'text-yellow-600' }}">{{ ucfirst($task->status) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
