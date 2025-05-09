<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tarefas') }}
            </h2>
            <a href="{{ route('tasks.create') }}" 
                class="inline-flex items-end bg-white hover:bg-gray-100 text-3xl font-bold text-gray-800 font-semibold px-4 py-2 rounded-lg shadow transition duration-300 ease-in-out">
                + Nova Tarefa
            </a>
        </div>
    </x-slot>

    @section('content')
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <form action="{{ route('tasks.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center gap-4" id="filterForm">
                {{-- Filtro por status --}}
                <select name="status" class="w-full md:w-auto border-gray-300 rounded-lg px-4 py-2" onchange="document.getElementById('filterForm').submit();">
                    <option value="">Todos</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pendente</option>
                    <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>Em andamento</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Concluída</option>
                </select>

                {{-- Ordenação por data de criação --}}
                <select name="order_created" class="w-full md:w-auto border-gray-300 rounded-lg px-4 py-2" onchange="document.getElementById('filterForm').submit();">
                    <option value="">Ordenar por criação</option>
                    <option value="asc" {{ request('order_created') === 'asc' ? 'selected' : '' }}>Mais antigas</option>
                    <option value="desc" {{ request('order_created') === 'desc' ? 'selected' : '' }}>Mais recentes</option>
                </select>

                {{-- Ordenação por data de atualização --}}
                <select name="order_updated" class="w-full md:w-auto border-gray-300 rounded-lg px-4 py-2" onchange="document.getElementById('filterForm').submit();">
                    <option value="">Ordenar por atualização</option>
                    <option value="asc" {{ request('order_updated') === 'asc' ? 'selected' : '' }}>Mais antigas</option>
                    <option value="desc" {{ request('order_updated') === 'desc' ? 'selected' : '' }}>Mais recentes</option>
                </select>
            </form>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-visible mb-4">
            <div class="bg-white sm:rounded-lg shadow overflow-hidden">
                <ul class="divide-y divide-gray-200">
                    @forelse ($tasks as $task)
                    <li class="p-4 flex gap-4 items-center justify-between hover:bg-gray-50 transition duration-300 ease-in-out">
                        <!-- Conteúdo da tarefa -->
                        <div class="justify-between flex items-center gap-4 flex-grow">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">{{ $task->title }}</h3>
                                <p class="text-sm text-gray-500">
                                    {{ Str::limit($task->description, 100, '...') }}
                                </p>
                                
                                <p class="text-xs text-gray-400 mt-1">
                                    Criado em {{ $task->created_at->format('d/m/Y H:i') }} · Atualizado em {{ $task->updated_at->format('d/m/Y H:i') }}
                                </p>
                            </div>

                            <!-- Status -->
                            <span class="text-3xl text-gray-800 px-4 py-2 rounded-lg shadow status-{{ $task->status }}">
                                @if($task->status === 'pending')
                                    Pendente
                                @elseif($task->status === 'in_progress')
                                    Em andamento
                                @else
                                    Concluída
                                @endif
                            </span>
                        </div>

                        <!-- Botão de ações -->
                        <div class="group ml-4">
                            <button class="bg-white hover:bg-gray-100 text-3xl font-bold text-gray-800 px-4 py-2 rounded-lg shadow transition duration-300 ease-in-out">
                                Ações
                            </button>

                            <!-- Menu -->
                            <div class="absolute top-full w-36 bg-white shadow-lg rounded-lg border border-gray-200 
                                        opacity-0 pointer-events-none transition-all duration-200 
                                        group-hover:opacity-100 group-hover:pointer-events-auto z-50">
                                <ul class="py-1">
                                    <li>
                                        <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:bg-gray-100 px-4 py-2 text-sm block">Editar</a>
                                    </li>
                                    <li>
                                        <button onclick="openDeleteModal({{ $task->id }})" class="text-red-600 hover:bg-gray-100 px-4 py-2 text-sm block w-full text-left">Excluir</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    @empty
                        <li class="p-4 text-center text-gray-500">Nenhuma tarefa encontrada.</li>
                    @endforelse
                </ul>
            </div>

            {{-- Paginação --}}
            <div class="mt-6">
                {{ $tasks->links() }}
            </div>
        </div>

        <!-- Modal de Confirmação -->
        <div id="deleteModal" class="deleteModal fixed inset-0 bg-black bg-opacity-50 items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-80">
                <h3 class="text-xl font-semibold text-gray-800">Tem certeza que deseja excluir essa tarefa?</h3>
                <div class="flex mt-4 gap-4 justify-end">
                    <button class="bg-white hover:bg-gray-100 text-3xl font-bold text-gray-800 px-4 py-2 rounded-lg shadow transition duration-300 ease-in-out" onclick="closeDeleteModal()">
                        Cancelar
                    </button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-white hover:bg-gray-100 text-3xl font-bold text-gray-800 px-4 py-2 rounded-lg shadow transition duration-300 ease-in-out">
                            Excluir
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            // Função para abrir o modal
            function openDeleteModal(taskId) {
                const form = document.getElementById('deleteForm');
                form.action = '/tasks/' + taskId;  // Define a ação para o formulário de exclusão

                document.getElementById('deleteModal').classList.remove('hidden');
                document.getElementById('deleteModal').classList.add('flex');
            }

            // Função para fechar o modal
            function closeDeleteModal() {
                document.getElementById('deleteModal').classList.add('hidden');  // Oculta o modal
            }
        </script>

        <style>
            /* Menu de ações */
            .group .absolute {
                visibility: hidden;
                opacity: 0;
                pointer-events: none;
                z-index: 9999;
                transition: opacity 0.3s ease;
            }
        
            /* Exibe o menu de opções quando o mouse está sobre o botão ou o menu */
            .group:hover .absolute {
                visibility: visible;
                opacity: 1;
                pointer-events: auto;
            }

            .status-pending {
                background-color: #fef08a; /* bg-yellow-200 */
                color: #92400e;            /* text-yellow-800 */
            }
            
            .status-in_progress {
                background-color: #fed7aa; /* bg-orange-200 */
                color: #9a3412;            /* text-orange-800 */
            }
            
            .status-completed {
                background-color: #bbf7d0; /* bg-green-200 */
                color: #065f46;            /* text-green-800 */
            }

            /* Estilos do Modal */
            .deleteModal {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                justify-content: center;
                align-items: center;
                z-index: 1000;
            }

        </style>
    @endsection
</x-app-layout>
