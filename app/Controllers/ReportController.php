<?php

namespace App\Controllers;

class ReportController extends BaseController
{
        public function dailyVisitorReport()
        {
            $db = \Config\Database::connect();

            $fromDate = $this->request->getGet('from_date');
            $toDate   = $this->request->getGet('to_date');

            $builder = $db->table('visitors vr');      
            $builder->select("
                vr.visitor_name,
                vr.group_code,
                vr.v_code,
                vrh.department,
                vrh.company,
                sgl.check_in_time,
                sgl.check_out_time,
                vr.spendTime,
                CASE 
                    WHEN sgl.check_out_time IS NULL THEN 'IN'
                    ELSE 'OUT'
                END AS visit_status
            ");

            $builder->join(
                'visitor_request_header vrh',
                'vrh.id = vr.request_header_id',
                'left'
            );

            $builder->join(
                'security_gate_logs sgl',
                'vr.id = sgl.visitor_request_id',
                'left'
            );
            if ($fromDate && $toDate) {
                $builder->where("DATE(sgl.check_in_time) >=", $fromDate);
                $builder->where("DATE(sgl.check_in_time) <=", $toDate);
            }

            $builder->orderBy('sgl.check_in_time', 'DESC');

            $data['report'] = $builder->get()->getResultArray();

            return view('dashboard/reports/daily_visitor_report', $data);
        }

        

public function requestToCheckoutReport()
{
    $db = \Config\Database::connect();

    $builder = $db->table('visitors vr');

    $builder->select("
        vr.*, 
        vrh.department,
        vrh.company,
        vrh.total_visitors,
        ref_user.name AS referred_by,
        sgl.check_in_time,
        sgl.check_out_time,
        rqst_created_by.name AS rqst_created_by,
        rqst_Approved_by.name AS rqst_Approved_by,
        s_checkin_by.name AS s_checkin_by,
        s_checkout_by.name AS s_checkout_by
    ");

    $builder->join('visitor_request_header vrh', 'vrh.id = vr.request_header_id', 'left');
    $builder->join('users ref_user', 'ref_user.id = vrh.referred_by', 'left');
    $builder->join('users rqst_created_by', 'rqst_created_by.id = vrh.requested_by', 'left');
    $builder->join('users rqst_Approved_by', 'rqst_Approved_by.id = vrh.updated_by', 'left');
    $builder->join('security_gate_logs sgl', 'sgl.visitor_request_id = vr.id', 'left');
    $builder->join('users s_checkin_by', 's_checkin_by.id = sgl.verified_by', 'left');
    $builder->join('users s_checkout_by', 's_checkout_by.id = sgl.updated_by', 'left');

    // ❌ DO NOT filter on sgl.check_in_time
    // $builder->where('sgl.check_in_time IS NOT NULL');

    $builder->orderBy('vr.created_at', 'DESC');

    $data['report'] = $builder->get()->getResultArray();

    return view('dashboard/reports/request_to_checkout_report', $data);
}

}
