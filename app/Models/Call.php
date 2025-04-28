<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    protected $fillable = [
        'ticket_number',
        'agent_id',
        'client_id',
        'server_id',
        'action_type_id',
        'final_status_id',
        'call_result_id',
        'problem_description_id',
        'call_date',
        'observation',
        'wait_time',
        'remote_access',
        'call_number'
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function server()
    {
        return $this->belongsTo(Server::class);
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

    public function problemDescription()
    {
        return $this->belongsTo(ProblemDescription::class);
    }
}
