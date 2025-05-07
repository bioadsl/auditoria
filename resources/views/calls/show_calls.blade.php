<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalhes do Chamado') }}
            </h2>
            <div>
                <a href="{{ route('calls.edit', $call) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Editar
                </a>
                <form action="{{ route('calls.destroy', $call) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Tem certeza que deseja excluir este chamado?')">
                        Excluir
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Informações Básicas</h3>
                            <dl class="mt-4 space-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Cliente</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $call->client->name }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Agente</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $call->agent->name }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Servidor</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $call->server ? $call->server->name : 'Não informado' }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Número do Ticket</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $call->ticket_number ?: 'Não informado' }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Data do Chamado</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $call->call_date->format('d/m/Y H:i') }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Status e Resultado</h3>
                            <dl class="mt-4 space-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Tipo de Ação</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $call->action_type }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Status Final</dt>
                                    <dd class="mt-1">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $call->final_status === 'Resolvido' ? 'bg-green-100 text-green-800' : 
                                               ($call->final_status === 'Em andamento' ? 'bg-yellow-100 text-yellow-800' : 
                                               'bg-red-100 text-red-800') }}">
                                            {{ $call->final_status }}
                                        </span>
                                    </dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Resultado</dt>
                                    <dd class="mt-1">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $call->call_result === 'Sucesso' ? 'bg-green-100 text-green-800' : 
                                               ($call->call_result === 'Pendente' ? 'bg-yellow-100 text-yellow-800' : 
                                               'bg-red-100 text-red-800') }}">
                                            {{ $call->call_result }}
                                        </span>
                                    </dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Tempo de Espera</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $call->wait_time }} minutos</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Acesso Remoto</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $call->remote_access ? 'Sim' : 'Não' }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900">Descrição do Problema</h3>
                            <div class="mt-4 text-sm text-gray-900">
                                {{ $call->problem_description ?: 'Não informado' }}
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900">Observação</h3>
                            <div class="mt-4 text-sm text-gray-900">
                                {{ $call->observation ?: 'Não informado' }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('calls.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Voltar para Lista
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 