<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorRequestHeaderModel extends Model
{
    protected $table            = 'visitor_request_header';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields = [
        'header_code',
        'requested_by',
        'description',
        'purpose',
        'requested_date',
        'requested_time',
        'department',
        'email',
        'company',
        'total_visitors',
        'status',
        'remarks'
    ];

    // Optional timestamps if table has created_at / updated_at
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


     /* ============================================================
       JOIN HEADER + VISITORS TABLE
       visitors.request_header_id = visitor_request_header.id
    ============================================================ */
   
  public function getHeaderWithVisitors($headerId)
{
    return $this->select("
            visitor_request_header.*,
            visitors.*,
            users.name AS visitor_created_by_name,
            users.email AS visitor_created_by_email
        ")
        ->join('visitors', 'visitors.request_header_id = visitor_request_header.id', 'left')
        ->join('users', 'users.id = visitors.created_by', 'left') // 👈 corrected
        ->where('visitor_request_header.id', $headerId)
        ->findAll();
}



public function getHeaderWithVisitorsMailData($headerId)
{
    return $this->select("
            visitor_request_header.*,
            visitors.visitor_name,
            visitors.visitor_email,
            visitors.visitor_phone,
            visitors.proof_id_type, 
            visitors.proof_id_number, 
            visitors.v_code, 
            visitors.qr_code, 
            visitors.vehicle_no,
            visitors.visit_date,
            visitors.visit_time, 
            visitors.vehicle_type,    
            users.name AS created_by_name,
            users.email AS created_by_email,
            departments.department_name
        ")
        ->join('visitors', 'visitors.request_header_id = visitor_request_header.id', 'left')
        ->join('users', 'users.id = visitors.created_by', 'left')
        ->join('departments', 'departments.id = users.department_id', 'left')
        ->where('visitor_request_header.id', $headerId)
        ->findAll();
}
}
