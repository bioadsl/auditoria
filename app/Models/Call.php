<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{
    protected $fillable = [
        'client_id',
        'agent_id',
        'server_id',
        'ticket_number',
        'problem_description_id',
        'action_type_id',
        'final_status_id',
        'call_result_id',
        'observation',
        'remote_access',
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
