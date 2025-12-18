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
}
