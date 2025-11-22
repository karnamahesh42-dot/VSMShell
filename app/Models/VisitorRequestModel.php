<?php namespace App\Models;

use CodeIgniter\Model;

class VisitorRequestModel extends Model
{
    protected $table = 'visitors';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'visitor_name','visitor_email','visitor_phone','purpose','visit_date',
        'expected_from','expected_to','host_user_id','status','created_by', 'proof_id_type','proof_id_number'
    ];
}
