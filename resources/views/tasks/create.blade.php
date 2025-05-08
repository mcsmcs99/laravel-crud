@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-semibold text-gray-800 mb-4">Nova Tarefa</h2>

        <div class="bg-white shadow sm:rounded-lg overflow-hidden">
            <div class="p-6">
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-600">Título</label>
                        <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md p-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-600">Descrição</label>
                        <textarea name="description" id="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md p-2"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-600">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md p-2">
                            <option value="pendente">Pendente</option>
                            <option value="em andamento">Em andamento</option>
                            <option value="concluída">Concluída</option>
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">Criar Tarefa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
