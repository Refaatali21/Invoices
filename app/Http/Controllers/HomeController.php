<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\InvoicesController;
use App\Models\invoices;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {



//=================احصائية نسبة تنفيذ الحالات======================



$count_all =invoices::count();
$count_invoices1 = invoices::where('Value_Status', 1)->count();
$count_invoices2 = invoices::where('Value_Status', 2)->count();
$count_invoices3 = invoices::where('Value_Status', 3)->count();

if($count_invoices2 == 0){
    $nspainvoices2=0;
}
else{
    $nspainvoices2 = $count_invoices2/ $count_all*100;
}
    if($count_invoices1 == 0){
    $nspainvoices1=0;
    }
    else{
    $nspainvoices1 = $count_invoices1/ $count_all*100;
}
    if($count_invoices3 == 0){
    $nspainvoices3=0;
    }
    else{
    $nspainvoices3 = $count_invoices3/ $count_all*100;
}


$chartjs = app()->chartjs
        ->name('barChartTest')
        ->type('bar')
        ->size(['width' => 350, 'height' => 200])
        ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا', 'اجمالي الفواتير'])
        ->datasets([
            [
                "label" => "الفواتير الغير المدفوعة",
                'backgroundColor' => ['#DC0000'],
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$nspainvoices2],
            ],
            [
                "label" => "الفواتير المدفوعة",
                'backgroundColor' => ['#54B435'],
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$nspainvoices1],
            ],
            [
                "label" => "الفواتير المدفوعة جزئيا",
                'backgroundColor' => ['#FC7300'],
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$nspainvoices3],
            ],
            [
                "label" => "اجمالي الفواتير",
                'backgroundColor' => ['#301E67'],
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [100],
            ]
        ])
        ->options([]);

$chartjs_2 = app()->chartjs
    ->name('pieChartTest')
    ->type('pie')
    ->size(['width' => 350, 'height' => 300])
    ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
    ->datasets([[
        'backgroundColor' => ['#DC0000', '#54B435','#ff9642'],
        'data' => [$nspainvoices2, $nspainvoices1,$nspainvoices3]
    ]])->options([]);


        return view('home', compact('chartjs','chartjs_2'));
    }



}
