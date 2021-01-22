<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Sells;
use App\Model\DeleveryProduct;
use App\Model\Products;
use Money; 
use Dates;
use DB;

class DashboardController extends Controller
{
    
    
    public function Balance(){
        $table = '';
		
		$table .= '<div class="row"><div class="col-lg-6 col-md-6 col-sm-12"><div class="panel">';
        $table .= '<div class="panel-heading bg-success">';
        $table .= 'Income Details';
        $table .= '</div><div class="panel-body"><table class="table table-bordered" width="100%">';
        $table .= '<tr><th>#</th><th>'.__('tbl.description').'</th><th>'.__('tbl.amount').'</th></tr>';
        if(Money::PreviousCash() != 0){
        	$table .= '<tr><th>##</th> <th>'.__('str.previous_cash').'</th><th>'.Money::PreviousCash().'</th></tr>';
    	}
    	if(Money::PaidSell() != 0){
        	$table .= '<tr><th>##</th><th>'.__('str.paid_sell').'</th><th>'.Money::PaidSell().'</th></tr>';
        }
        if(Money::DuePay() != 0){
        	$table .= '<tr><th>##</th><th>'.__('str.due_pay').'</th><th>'.Money::DuePay().'</th></tr>';
        }
        if(Money::Outcash() != 0){
        	$table .= '<tr><th>##</th><th>'.__('str.outcash').'</th><th>'.Money::Outcash().'</th></tr>';
        }
        if(Money::ProjectPayments() != 0){
        	$table .= '<tr><th>##</th><th>Project Payments</th><th>'.Money::ProjectPayments().'</th></tr>';
        }
        if(Money::ProjectAdvances() != 0){
        	$table .= '<tr><th>##</th><th>Project Advance</th><th>'.Money::ProjectAdvances().'</th></tr>';
        }

        $table .= '<tr><th colspan="2">'.__('tbl.total').'</th><th><span style="color:green;">'.Money::NetIncomeWPA().'</span></th></tr>';
        $table .= '</table> </div></div></div>';
        $table .= '<div class="col-lg-6 col-md-6 col-sm-12"><div class="panel"><div class="panel-heading bg-danger">';
        $table .= __('str.cost_detail');
        $table .= '</div><div class="panel-body"> <table class="table table-bordered" width="100%">';
        $table .= '<tr><th>#</th><th>'.__('tbl.description').'</th><th>'.__('tbl.amount').'</th></tr>';
        if(Money::Cost() != 0){
        	$table .= '<tr><th>##</th><th>'.__('str.cost').'</th> <th>'.Money::Cost().'</th></tr>';
        }
        if(Money::SubmitCash() != 0){
        	$table .= '<tr><th>##</th><th>'.__('str.submit_cash').'</th><th>'.Money::SubmitCash().'</th></tr>';
        }
        if(Money::StaffPayment() != 0){
        	$table .= '<tr><th>##</th><th>Staff Payment</th><th>'.Money::StaffPayment().'</th></tr>';
        }
        
        if(Money::PartyDailyAdvance() != 0){
        	$table .= '<tr><th>##</th><th>Party Payment</th><th>'.Money::PartyDailyAdvance().'</th></tr>';
        }
        
        if(Money::DealerPayment() != 0){
        	$table .= '<tr><th>##</th><th>Dealer Payment</th><th>'.Money::DealerPayment().'</th></tr>';
        }
        
        if(Money::WorkerPayment() != 0){
        	$table .= '<tr><th>##</th><th>Worker Payment</th><th>'.Money::WorkerPayment().'</th></tr>';
        }
        
        if(Money::Cost() != 0){
        	$table .= '<tr><th>##</th><th>'.__('str.outcash_pay').'</th><th>123</th></tr>';
        }
        $table .= '<tr><th colspan="2">'.__('tbl.total').'</th><th><span style="color:red;">'.Money::NetCost().'</span></th></tr>';
        $table .= '</table> </div></div></div>';   
        $table .= '<div class="col-lg-12 col-md-12 col-sm-12"><div class="panel"><div class="panel-body"><table class="table table-bordered" width="100%">';
        $table .= '<tr><th>'.__('str.total_income').'</th><th><span style="color:green;">'. Money::IncomeWithPreviousCash() .'</span></th></tr>';
        $table .= '<tr><th>'.__('str.total_cost').'</th><th><span style="color:red;">'.Money::NetCost().'</span></th></tr>';
        $table .= '<tr><th>'.__('str.cash').'</th><th><span style="color: blue;">'.Money::Cash().'</span></th></tr>';
        $table .= '</table></div></div></div></div>';
        
        return response($table);
    }
    
    public function ProcessModal(Request $request){
        return response($this->CallFunction($request));
    }
    
    private function CallFunction($r){
        switch($r->all()['query']){
            case 'paid_sell' :
                return $this->SellsDetail();
                break;
                
            case 'delevery' :
                return $this->DeleveryDetail($r);
                break;
                
            default :
                return "We receive you query '".$r->all()['query']."' but no function is created for that request ".Dates::Today();
                break;
        }
    }
    
    private function SellsDetail(){
        $sells = Sells::where('date', Dates::Today())->get();
		$table = '';
		$table = '<div class="table-responsive"><table class="table table-bordered table-striped table-hover"><thead><tr><th>#</th><th>'.__('tbl.ref').'</th><th>'.__('tbl.name').'</th><th>'.__('tbl.product').'</th><th>'.__('tbl.quantity').'</th><th>'.__('tbl.total').'</th> <th>'.__('tbl.paid').'</th><th>'.__('tbl.due').'</th></tr></thead><tbody>';

		$totalPaid = 0;
		$totalDue = 0;
		$cnt = 1;
		foreach($sells as $key){
			$table .= '<tr>';
			$table .= '<td>'.$cnt.'</td>';
			$table .= '<td>'.$key['ref'].'</td>';
			$table .= '<td><b>'.$key['name'].'</b> | '.$key['address'].'</td>';
			$table .= '<td>'.$key['product']['name'].'</td>';
			$table .= '<td>'.$key['quantity'].' &times; '.$key['rate'].'</td>';
			$table .= '<td>'.$key['total'].'</td>';
			$table .= '<td>'.$key['paid'].'</td>';
			$table .= '<td>'.$key['due'].'</td>';

			$totalPaid = $totalPaid + $key['paid'];
			$totalDue = $totalDue + $key['due'];
			$cnt++;
		}
                      
        $table .= '</tbody><tfoot>';
        $table .= '<tr><th colspan="6">'.__('tbl.total').'</th><th>'.$totalPaid.'</th><th>'.$totalDue.'</th></tr>';
        $table .= '</tfoot></table></div>';
        
        return response($table);    
    }
    
    private function DeleveryDetail($request){
        $id = $request->all()['id'];
        $p = Products::where('id', $id)->first();
        
        $del = DB::table('delevery_products')
            ->join('sells', 'delevery_products.ref', '=', 'sells.ref')
            ->join('products', 'sells.product_id', '=', 'products.id')
            ->select('sells.ref','sells.name', 'sells.address', 'delevery_products.quantity', 'delevery_products.driver', 'delevery_products.d_ref', 'delevery_products.destination', 'products.name as product_name')
            //->select('products.name as product_name')
            ->where('sells.product_id', $id)
            ->where('delevery_products.date', Dates::Today())
            ->get();
        
        $table = '<div class="table-responsive"><table class="table table-border table-hover"><thead><tr><th>'.__('tbl.ref').'</th><th>'.__('tbl.d_ref').'</th><th>'.__('tbl.name').'</th><th>'.__('tbl.address').'</th><th>'.__('tbl.product').'</th><th>'.__('tbl.quantity').'</th><th>'.__('tbl.driver').'</th><th>'.__('tbl.destination').'</th></tr></thead><tbody>';
        $total = 0;
        foreach ($del as $key){
            $table .= '<tr>';
            $table .= '<td>'.$key->ref.'</td>';
            $table .= '<td>'.$key->d_ref.'</td>';
            $table .= '<td>'.$key->name.'</td>';
            $table .= '<td>'.$key->address.'</td>';
            $table .= '<td>'.$key->product_name.'</td>';
            $table .= '<td>'.$key->quantity.' '. $p->unit .'</td>';
            $table .= '<td>'.$key->driver.'</td>';
            $table .= '<td>'.$key->destination.'</td>';
            $table .= '</tr>';
            $total += $key->quantity;
        }
        $table .= '</tbody><tfoot><tr><th colspan="5">'.__('tbl.total').'<th><th colspan="3">'.$total. ' '.$p->unit.'</th></tr><tfoot></table></div>';
        return response($table);
    }
}
