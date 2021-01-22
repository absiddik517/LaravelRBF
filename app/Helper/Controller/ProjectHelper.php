<?php
namespace App\Helper\Controller;

use App\Model\Project;
use App\Model\Products;
use App\Model\ProjectSell;
use App\Model\ProjectDelevery;
use App\Model\ProjectBills;
use App\Model\ProjectAdvance;
use App\Model\ProjectPayment;
use Dates;

/**
 * project helper class
 */
class ProjectHelper
{
    
     
    public $project_id;
    public function __construct()
    {
        
    }
    
    public function isUpdatableProjectPayment($payment_id){
        $pay = ProjectPayment::where('id', $payment_id)->first();
        $project_id = $pay['project_id'];
        $bill_id = $pay['project_bill_id'];
        $lastBillId = $this->LastBillId($project_id);
        if($lastBillId <= $bill_id){
            return true;
        }else{
            return false;
        }
    }
    
    public function isUpdatableProjectAdvance($payment_id){
        $pay = ProjectAdvance::where('id', $payment_id)->first();
        $project_id = $pay['project_id'];
        $date = $pay['date'];
        $lastBillDate = $this->lastBillDate($project_id);
        if($lastBillDate < $date){
            return true;
        }else{
            return false;
        }
    }
    
    public function BillPay($bill_id){
        return ProjectPayment::where('project_bill_id', $bill_id)->sum('amount');
    }
    
    public function TotalAdvance($project_id){
        return ProjectAdvance::where('project_id', $project_id)->sum('amount');
    }
    
    public function AdvanceCut($project_id){
        return ProjectBills::where('project_id', $project_id)->sum('advance_cutting');
    }
    
    public function rAdvance($id){
        return $this->TotalAdvance($id) - $this->AdvanceCut($id);
    }
    
    public function countBill($project_id){
        return ProjectBills::where('project_id', $project_id)->count();
    }
    
    public function lastBillDate($project_id){
        if($this->countBill($project_id) > 0){
            $project = ProjectBills::where('project_id', $project_id)->orderby('id', 'desc')->first();
            return $project['last_date'];
        }else{
            return null;
        }
    }
    
    public function LastBillId($project_id){
        if($this->countBill($project_id) > 0){
            $bill = ProjectBills::where('project_id', $project_id)->orderby('id', 'desc')->first();
            return $bill['id'];
        }else{
            return null;
        }
    }
    
    public function processData($project_id, $first_date, $last_date){
        $output = array();
        $project = Project::where('id', $project_id)->first();
        $bill = ProjectBills::where('project_id', $project_id)->first();
        $products = ProjectSell::where('project_id', $project_id)->get();
        $table = '';
        $total_amount = 0;
        foreach ($products as $key){
            $table .= "<tr>
                <td> ".$this->PName($key['product_id'])."</td>
                <td> ".$this->DeleveryByDate($project_id, $key['product_id'], $first_date, $last_date)."</td>
                <td> ".$key['rate']."</td>
                <td> ".$this->DeleveryByDate($project_id, $key['product_id'], $first_date, $last_date) * $key['rate']."</td>
            </tr>";
            $total_amount += $this->DeleveryByDate($project_id, $key['product_id'], $first_date, $last_date) * $key['rate'];
        }
        
        $output['table'] = $table;
        $output['total_amount'] = $total_amount;
        $output['remaining_advance'] = $this->rAdvance($project_id);
        $output['previous_due'] = $this->PreviousDue($project_id);
        
        return $output;
    }
    
    public function PreviousDue($project_id){
        $bill_id = $this->LastBillId($project_id);
        if($bill_id > 0){
            $bill = ProjectBills::where('id', $bill_id)->with('Payment')->first();
            $paid = 0;
            foreach ($bill->Payment as $key){
                $paid += $key['amount'];
            }
            
            return $bill['total'] - $paid;
            
        }else{
            return 0;
        }
    }
    
    
    public function PName($id){
        $product = Products::where('id', $id)->first();
        return $product['name'];
    }
    public function PUnit($id){
        $product = Products::where('id', $id)->first();
        return $product['unit'];
    }
    
    public function TotalDelevery($project_id, $product_id){
        $delevery = ProjectDelevery::where([['project_id', $project_id], ['product_id', $product_id]])->sum('quantity');
        return $delevery;
    }
    
    public function DeleveryByDate($project_id, $product_id, $first_date, $last_date){
        $delevery = ProjectDelevery::where([['project_id', $project_id], ['product_id', $product_id]])
                  ->whereBetween('date', [$first_date, $last_date])
                  ->sum('quantity');
        return $delevery;
    }
    
    public function QuantityJson($project_id, $first_date, $last_date){
        $output = array();
        $products = ProjectSell::where('project_id', $project_id)->get();
        foreach ($products as $key){
            $sub = array();
            $sub['product_id'] = $key['product_id'];
            $sub['rate'] = $key['rate'];
            $sub['quantity'] = $this->DeleveryByDate($project_id, $key['product_id'], $first_date, $last_date);
            
            $output[] = $sub;
        }
        return json_encode($output);
    }
    
    
}