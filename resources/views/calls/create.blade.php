<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Chamado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('calls.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="client_id" :value="__('Cliente')" />
                                <select id="client_id" name="client_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">Selecione um cliente</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                            {{ $client->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="agent_id" :value="__('Agente')" />
                                <select id="agent_id" name="agent_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">Selecione um agente</option>
                                    @foreach($agents as $agent)
                                        <option value="{{ $agent->id }}" {{ old('agent_id') == $agent->id ? 'selected' : '' }}>
                                            {{ $agent->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('agent_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="server_id" :value="__('Servidor')" />
                                <select id="server_id" name="server_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">Selecione um servidor</option>
                                    @foreach($servers as $server)
                                        <option value="{{ $server->id }}" {{ old('server_id') == $server->id ? 'selected' : '' }}>
                                            {{ $server->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('server_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="ticket_number" :value="__('Número do Ticket')" />
                                <x-text-input id="ticket_number" name="ticket_number" type="text" class="mt-1 block w-full" :value="old('ticket_number')" />
                                <x-input-error :messages="$errors->get('ticket_number')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="action_type_id" :value="__('Tipo de Ação')" />
                                <select id="action_type_id" name="action_type_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">Selecione o tipo de ação</option>
                                    @foreach($actionTypes as $type)
                                        <option value="{{ $type->id }}" {{ old('action_type_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('action_type_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="final_status_id" :value="__('Status Final')" />
                                <select id="final_status_id" name="final_status_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">Selecione o status</option>
                                    @foreach($finalStatuses as $status)
                                        <option value="{{ $status->id }}" {{ old('final_status_id') == $status->id ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('final_status_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="call_result_id" :value="__('Resultado')" />
                                <select id="call_result_id" name="call_result_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">Selecione o resultado</option>
                                    @foreach($callResults as $result)
                                        <option value="{{ $result->id }}" {{ old('call_result_id') == $result->id ? 'selected' : '' }}>
                                            {{ $result->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('call_result_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="wait_time" :value="__('Tempo de Espera (minutos)')" />
                                <x-text-input id="wait_time" name="wait_time" type="number" class="mt-1 block w-full" :value="old('wait_time', 0)" required min="0" />
                                <x-input-error :messages="$errors->get('wait_time')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="remote_access" :value="__('Acesso Remoto')" />
                                <select id="remote_access" name="remote_access" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="1" {{ old('remote_access') == '1' ? 'selected' : '' }}>Sim</option>
                                    <option value="0" {{ old('remote_access') == '0' ? 'selected' : '' }}>Não</option>
                                </select>
                                <x-input-error :messages="$errors->get('remote_access')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="call_date" :value="__('Data do Chamado')" />
                                <x-text-input id="call_date" name="call_date" type="datetime-local" class="mt-1 block w-full" :value="old('call_date', now()->format('Y-m-d\TH:i'))" required />
                                <x-input-error :messages="$errors->get('call_date')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-6">
                            <x-input-label for="problem_description" :value="__('Descrição do Problema')" />
                            <textarea id="problem_description" name="problem_description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3">{{ old('problem_description') }}</textarea>
                            <x-input-error :messages="$errors->get('problem_description')" class="mt-2" />
                        </div>

                        <div class="mt-6">
                            <x-input-label for="observation" :value="__('Observação')" />
                            <textarea id="observation" name="observation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="3">{{ old('observation') }}</textarea>
                            <x-input-error :messages="$errors->get('observation')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4 mt-6">
                            <x-primary-button>{{ __('Salvar') }}</x-primary-button>
                            <a href="{{ route('calls.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                {{ __('Cancelar') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
