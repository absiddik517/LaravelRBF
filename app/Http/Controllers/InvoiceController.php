<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Project;
use App\Model\Products;
use App\Model\ProjectSell;
use App\Model\ProjectDelevery;
use App\Model\ProjectBills;
use App\Model\ProjectAdvance;
use App\Model\ProjectPayment;
use App\Model\Sells;
use ProjectHelper;
class InvoiceController extends Controller
{
    function __construct()
    {
        return $this->middleware('auth');
    }
    
    public function ProjectBill($id){
        $bill = ProjectBills::where('id', $id)->first();
        $project = Project::where('id', $bill->project_id)->first();
        $paid = ProjectPayment::where('project_bill_id', $id)->sum('amount');
        return view('pages.invoice.projectbill', ['bill' => $bill, 'project' => $project, 'paid' => $paid]);
    }
    
    public function SellInvoice($ref){
        $sell = Sells::where('ref', $ref)->with(['duePay'])->first();
        return view('pages.invoice.sellsBill', ['sell' => $sell]);
    }
}
