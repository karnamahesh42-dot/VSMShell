<?php

namespace App\Models;

use CodeIgniter\Model;

class SecurityGateLogModel extends Model
{
    protected $table = 'security_gate_logs';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'visitor_request_id',
        'v_code',
        'check_in_time',
        'check_out_time',
        'verified_by'
    ];

    protected $useTimestamps = false; // We are manually storing times
}
