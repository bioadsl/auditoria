<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\Client;
use App\Models\Agent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function calls(): JsonResponse
    {
        $total = Call::count();
        $attended = Call::where('call_result', 'Atendida')->count();
        $interrupted = Call::where('call_result', 'Interrompida')->count();
        $notAttended = Call::where('call_result', 'Não atendida')->count();
        $test = Call::where('call_result', 'Teste')->count();
        $abandoned = Call::where('call_result', 'Abandono')->count();
        $wrongNumber = Call::where('call_result', 'Engano')->count();

        return response()->json([
            'total' => $total,
            'attended' => $attended,
            'interrupted' => $interrupted,
            'not_attended' => $notAttended,
            'test' => $test,
            'abandoned' => $abandoned,
            'wrong_number' => $wrongNumber
        ]);
    }

    public function actions(): JsonResponse
    {
        $actions = Call::select('action_type', DB::raw('count(*) as total'))
            ->groupBy('action_type')
            ->get();

        return response()->json($actions);
    }

    public function status(): JsonResponse
    {
        $status = Call::select('final_status', DB::raw('count(*) as total'))
            ->groupBy('final_status')
            ->get();

        return response()->json($status);
    }

    public function remoteAccess(): JsonResponse
    {
        $total = Call::count();
        $ana = Call::whereHas('client', fn($q) => $q->where('name', 'ANA'))->count();
        $treCe = Call::whereHas('client', fn($q) => $q->where('name', 'TRE-CE'))->count();
        $sgg = Call::whereHas('client', fn($q) => $q->where('name', 'SGG'))->count();
        $mre = Call::whereHas('client', fn($q) => $q->where('name', 'MRE'))->count();
        $remote = Call::where('remote_access', true)->count();

        return response()->json([
            'total' => $total,
            'ana' => $ana,
            'tre_ce' => $treCe,
            'sgg' => $sgg,
            'mre' => $mre,
            'remote' => $remote
        ]);
    }

    public function monthly(): JsonResponse
    {
        $monthly = Call::select(
            DB::raw('MONTH(call_date) as month'),
            DB::raw('YEAR(call_date) as year'),
            'action_type',
            DB::raw('count(*) as total')
        )
            ->groupBy('year', 'month', 'action_type')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        return response()->json($monthly);
    }

    public function byAgent(): JsonResponse
    {
        $byAgent = Call::select(
            'agent_id',
            DB::raw('count(*) as total'),
            DB::raw('sum(case when final_status = "Fechado OK" then 1 else 0 end) as closed_ok')
        )
            ->with('agent:id,name,code')
            ->groupBy('agent_id')
            ->get();

        return response()->json($byAgent);
    }

    public function byUser(): JsonResponse
    {
        $byUser = Call::select(
            'server_id',
            DB::raw('count(*) as total')
        )
            ->with('server:id,name')
            ->groupBy('server_id')
            ->orderByDesc('total')
            ->get();

        return response()->json($byUser);
    }

    public function byTime(): JsonResponse
    {
        $byTime = Call::select(
            DB::raw('HOUR(call_date) as hour'),
            DB::raw('count(*) as total')
        )
            ->groupBy('hour')
            ->get()
            ->groupBy(function ($item) {
                $hour = $item->hour;
                if ($hour >= 6 && $hour < 12) return 'manha';
                if ($hour >= 12 && $hour < 18) return 'tarde';
                if ($hour >= 18 && $hour < 24) return 'noite';
                return 'madrugada';
            })
            ->map(function ($group) {
                return $group->sum('total');
            });

        return response()->json($byTime);
    }

    public function longWait(): JsonResponse
    {
        $longWait = Call::where('wait_time', '>', 15)
            ->with(['agent:id,name,code', 'client:id,name'])
            ->get();

        return response()->json($longWait);
    }

    public function qualityMetrics(): JsonResponse
    {
        // Meta: 90% dos chamados do MRE atendidos
        $mreTotal = Call::whereHas('client', fn($q) => $q->where('name', 'MRE'))->count();
        $mreAttended = Call::whereHas('client', fn($q) => $q->where('name', 'MRE'))
            ->where('call_result', 'Atendida')
            ->count();
        $mrePercentage = $mreTotal > 0 ? ($mreAttended / $mreTotal) * 100 : 0;

        // Meta: 60% de chamados atendidos no N1
        $n1Total = Call::count();
        $n1Attended = Call::where('call_result', 'Atendida')->count();
        $n1Percentage = $n1Total > 0 ? ($n1Attended / $n1Total) * 100 : 0;

        // Distribuição de chamados entre agentes
        $agentDistribution = Call::select(
            'agent_id',
            DB::raw('count(*) as total')
        )
            ->with('agent:id,name,code')
            ->groupBy('agent_id')
            ->get();

        $avgCalls = $agentDistribution->avg('total');
        $distribution = $agentDistribution->map(function ($item) use ($avgCalls) {
            return [
                'agent' => $item->agent->name,
                'code' => $item->agent->code,
                'total' => $item->total,
                'difference' => $item->total - $avgCalls
            ];
        });

        return response()->json([
            'mre_attendance' => [
                'total' => $mreTotal,
                'attended' => $mreAttended,
                'percentage' => $mrePercentage,
                'target' => 90,
                'status' => $mrePercentage >= 90 ? 'ok' : 'warning'
            ],
            'n1_attendance' => [
                'total' => $n1Total,
                'attended' => $n1Attended,
                'percentage' => $n1Percentage,
                'target' => 60,
                'status' => $n1Percentage >= 60 ? 'ok' : 'warning'
            ],
            'agent_distribution' => $distribution
        ]);
    }
} 