<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use SoftDeletes;

class Call extends Model
{
    protected $fillable = [
        'client_id',
        'agent_id',
        'server_id',
        'ticket_number',
        'action_type_id',
        'final_status_id',
        'call_result_id',
        'call_date',
        'remote_access',
        'problem_description_id', // Alterado para usar o ID ao invés da descrição
        'observation'
    ];

    protected $casts = [
        'call_date' => 'datetime',
        'remote_access' => 'boolean'
    ];

    protected $dates = ['deleted_at'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    public function problemDescription()
    {
        return $this->belongsTo(ProblemDescription::class);
    }

    public function actionType()
    {
        return $this->belongsTo(ActionType::class);
    }

    public function finalStatus()
    {
        return $this->belongsTo(FinalStatus::class);
    }

    public function callResult()
    {
        return $this->belongsTo(CallResult::class);
    }

    // Acessor para formatar a data de chamado
    public function getFormattedCallDateAttribute()
    {
        return $this->call_date ? Carbon::parse($this->call_date)->format('d/m/Y H:i:s') : null;
    }

    // Mutator para converter a data do formato brasileiro para o formato do banco
    public function setCallDateAttribute($value)
    {
        $this->attributes['call_date'] = $value ? Carbon::createFromFormat('d/m/Y H:i:s', $value)->format('Y-m-d H:i:s') : null;
    }
}
