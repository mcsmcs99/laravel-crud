<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nova Tarefa') }}
        </h2>
    </x-slot>

    @section('content')
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    <form action="{{ route('tasks.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                            <input type="text" name="title" id="title" required maxlength="50"
                                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500" />
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                            <textarea name="description" id="description" rows="4"  required maxlength="1000"
                                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status"
                                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="pending">Pendente</option>
                                <option value="in_progress">Em andamento</option>
                                <option value="completed">Concluída</option>
                            </select>
                        </div>

                        <div class="flex justify-end gap-4">
                            <a href="{{ route('tasks.index') }}" class="inline-flex items-end bg-white hover:bg-gray-100 text-3xl font-bold text-gray-800 font-semibold px-4 py-2 rounded-lg shadow transition duration-300 ease-in-out">
                                Voltar
                            </a>
                            <button type="submit"
                                class="inline-flex items-end bg-white hover:bg-gray-100 text-3xl font-bold text-gray-800 font-semibold px-4 py-2 rounded-lg shadow transition duration-300 ease-in-out">
                                Criar Tarefa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
