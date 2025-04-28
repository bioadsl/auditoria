<?php

namespace Database\Seeders;

use App\Models\Call;
use Illuminate\Database\Seeder;

class CallSeeder extends Seeder
{
    public function run(): void
    {
        $calls = [
            [
                'agent_id' => 1,
                'client_id' => 1,
                'server_id' => 1,
                'ticket_number' => 'TICKET-001',
                'problem_description' => 'Problema com acesso ao sistema',
                'action_type' => 'Suporte',
                'final_status' => 'Resolvido',
                'call_result' => 'Sucesso',
                'observation' => 'Usuário conseguiu acessar o sistema',
                'wait_time' => 5,
                'remote_access' => true,
                'call_date' => now(),
            ],
            [
                'agent_id' => 2,
                'client_id' => 2,
                'server_id' => 2,
                'ticket_number' => 'TICKET-002',
                'problem_description' => 'Erro ao imprimir documento',
                'action_type' => 'Suporte',
                'final_status' => 'Resolvido',
                'call_result' => 'Sucesso',
                'observation' => 'Impressora foi reiniciada',
                'wait_time' => 10,
                'remote_access' => true,
                'call_date' => now(),
            ],
            [
                'agent_id' => 3,
                'client_id' => 3,
                'server_id' => 3,
                'ticket_number' => 'TICKET-003',
                'problem_description' => 'Sistema lento',
                'action_type' => 'Manutenção',
                'final_status' => 'Em andamento',
                'call_result' => 'Pendente',
                'observation' => 'Aguardando análise do servidor',
                'wait_time' => 15,
                'remote_access' => false,
                'call_date' => now(),
            ],
        ];

        foreach ($calls as $call) {
            Call::create($call);
        }
    }
} 