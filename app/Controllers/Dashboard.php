<?php

namespace App\Controllers;

use App\Models\VisitorRequestModel;
use App\Models\VisitorLogModel;
use App\Models\SecurityGateLogModel;
use App\Models\VisitorRequestHeaderModel;


class Dashboard extends BaseController
{
    protected $visitorModel;
    protected $logModel;
    protected $SecurityGateLogModel;
    protected $VisitorRequestHeaderModel;

    

    public function __construct()
    {
        $this->visitorModel = new VisitorRequestModel();
        $this->logModel     = new VisitorLogModel();
        $this->SecurityGateLogModel     = new SecurityGateLogModel();
        $this->VisitorRequestHeaderModel     = new VisitorRequestHeaderModel();

    }

    public function index()
    {
        // Dynamic counts from DB
        $totalVisitors = $this->visitorModel->countAll(); // total rows

        $pendingIndents = $this->VisitorRequestHeaderModel
                            ->where('status', 'pending')
                            ->countAllResults();

        $approved = $this->VisitorRequestHeaderModel
                            ->where('status', 'approved')
                            ->countAllResults();

        $rejected = $this->VisitorRequestHeaderModel
                            ->where('status', 'rejected')
                            ->countAllResults();


        // Visits today
        $today = date('Y-m-d');
        $visitsToday = $this->VisitorRequestHeaderModel
                            ->where('requested_date', $today)
                            ->countAllResults();

        // Gate entries (from logs table?)
        $gateEntries = $this->SecurityGateLogModel->countAll();

        // Prepare card data
        $data['smallCards'] = [
            ['title'=>'Total Visitors','value'=>$totalVisitors,'icon'=>'fa-user','color'=>'c1'],
            ['title'=>'Pending Requests','value'=>$pendingIndents,'icon'=>'fa-file-alt','color'=>'c2'],
            ['title'=>'Approved','value'=>$approved,'icon'=>'fa-check-circle','color'=>'c3'],
            ['title'=>'Rejected','value'=>$rejected,'icon'=>'fa-times-circle','color'=>'c4'],
            ['title'=>'Gate Entries','value'=>$gateEntries,'icon'=>'fa-door-open','color'=>'c5'],
            ['title'=>'Visits Today','value'=>$visitsToday,'icon'=>'fa-calendar-day','color'=>'c6'],
        ];


            $pendingList = $this->VisitorRequestHeaderModel
                ->select("
                    id,
                    header_code,
                    purpose,
                    requested_date,
                    requested_time,
                    total_visitors,
                    description,
                    status
                ")
                ->where('status', 'pending')
                ->orderBy('id', 'DESC')
                ->limit(5)
                ->findAll();

            $data['pendingList'] = $pendingList;



        $recentAuthorized = $this->SecurityGateLogModel->getRecentAuthorized(10);

        // print_r ($recentAuthorized);
        // return;
$weekStart = date('Y-m-d 00:00:00', strtotime('monday this week'));
$weekEnd   = date('Y-m-d 23:59:59', strtotime('sunday this week'));

$weekVisitors = $this->SecurityGateLogModel
    ->where('check_in_time >=', $weekStart)
    ->where('check_in_time <=', $weekEnd)
    ->countAllResults();
 
$todayStart = date('Y-m-d 00:00:00');
$todayEnd   = date('Y-m-d 23:59:59');

$todayVisitors = $this->SecurityGateLogModel
    ->where('check_in_time >=', $todayStart)
    ->where('check_in_time <=', $todayEnd)
    ->countAllResults();

$monthStart = date('Y-m-01 00:00:00');  // First day of month start time
$monthEnd   = date('Y-m-t 23:59:59');   // Last day of month end time

$monthVisitors = $this->SecurityGateLogModel
    ->where('check_in_time >=', $monthStart)
    ->where('check_in_time <=', $monthEnd)
    ->countAllResults();
        // Security alerts — example (0 for now, or fetch from DB)
        $alerts = 0;

            $data['meds'] = [
            ['title' => 'Today Visitors', 'count' => $todayVisitors, 'icon' => 'fa-users', 'desc' => $todayVisitors . ' people visited today.'],
            ['title' => 'This Week', 'count' => $weekVisitors, 'icon' => 'fa-calendar-week', 'desc' => $weekVisitors . ' visitors this week.'],
            ['title' => 'This Month', 'count' => $monthVisitors, 'icon' => 'fa-calendar', 'desc' => $monthVisitors . ' visitors this month.'],
            ['title' => 'Alerts', 'count' => $alerts, 'icon' => 'fa-bell', 'desc' => $alerts == 0 ? 'No security alerts.' : $alerts . ' alerts pending.'],
        ];

    
        $data['recentAuthorized'] = $recentAuthorized;

        return view('dashboard/dashboard', $data);
    }
}
