<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Project;
use App\Model\Products;
use App\Model\ProjectSell;
use App\Model\ProjectDelevery;
use App\Model\ProjectBills;
use App\Model\ProjectAdvance;
use App\Model\ProjectPayment;
use Dates;
use ProjectHelper;
use PartyHelper;
// validations
use App\Http\Requests\ProjectDeleveryValidation;
use App\Http\Requests\ProjectBillValidation;
use App\Http\Requests\ProjectPaymentValidation;
use App\Http\Requests\ProjectAdvanceValidation;

class ProjectAccount extends Controller
{
    function __construct()
    {
        return $this->middleware('auth');
    }
    
    public function StoreBill(ProjectBillValidation $request){
        $project_id = $request['project_id'];
        $first_date = $request['first_date'];
        $last_date = $request['last_date'];
        if($request['sub_total'] > 0){
            if(ProjectHelper::rAdvance($project_id) >= $request['advance_cutting']){
                ProjectBills::create([
                    'project_id'    => $project_id,
                    'first_date'    => $first_date,
                    'last_date'     => $last_date,
                    'quantity'      => $this->QuantityJson($project_id, $first_date, $last_date),
                    'sub_total'     => $request['sub_total'],
                    'advance_cutting'  => $request['advance_cutting'],
                    'transport'     => $request['transport'],
                    'previous_due'  => $request['previous_due'],
                    'total'         => $request['total'],
                    'date'          => Dates::Today(),
                    'user_id'       => Auth::user()->id,
                ]);
                
                $output = array(
                    't' => 'Successfull',
                    'm' => 'Bill store Successfull.',
                    's' => 'success',
                );
            }else{
                $output = array(
                    't' => 'Error with advance cutting.',
                    'm' => 'This project have '.ProjectHelper::rAdvance($project_id).' taka advance to be adjusted.',
                    's' => 'error'
                );
            }
        }else{
            $output = array(
                't' => 'Can not create bill',
                'm' => 'Can not create bill on zero delivery.',
                's' => 'error'
            );
        }
        
        return response()->json($output);
        
    }
    
    public function StorePayment(ProjectPaymentValidation $r){
        if(ProjectHelper::PreviousDue($r['project_id']) < $r['amount']){
            $output = array(
                't' => 'Fail to store payment',
                'm' => 'Amount is more then last bill due. You can submit rest money though advance option.',
                's' => 'error'
            );
        }else{
            if(ProjectHelper::LastBillId($r['project_id']) !== null){
                ProjectPayment::create([
                    'project_id' => $r['project_id'],
                    'project_bill_id' => $this->LastBillId($r['project_id']),
                    'description' => $r['description'],
                    'amount' => $r['amount'],
                    'date' => Dates::Today(),
                    'user_id' => Auth::user()->id,
                ]);
                $output = array(
                    't' => 'Successfull',
                    'm' => 'Payment store successfull.',
                    's' => 'success'
                );
            }else{
                $output = array(
                    't' => 'Error',
                    'm' => 'To store project payment make a bill first. Or submit the money in advance option',
                    's' => 'success'
                );
            }
        }
        return response()->json($output);
    }
    
    public function storeAdvance(ProjectAdvanceValidation $r){
        ProjectAdvance::create([
            'project_id' => $r['project_id'],
            'amount' => $r['amount'],
            'description' => $r['description'],
            'date' => Dates::Today(),
            'user_id' => Auth::user()->id,
        ]);
        $output = array(
            't' => 'Successfull',
            'm' => 'Advance store successfull.',
            's' => 'success'
        );
        return response()->json($output);
    }
    
    public function BillDetail($id){
        $bill = ProjectBills::where('id', $id)->with('Payment')->first();
        $project = Project::where('id', $bill['project_id'])->with(['Sells'])->first();
        $delevery = ProjectDelevery::where('project_id', $bill['project_id'])->whereBetween('date', [$bill->first_date, $bill->last_date])->get();
        $total = 0;
        foreach ($bill->Payment as $key){
            $total += $key->amount;
        }
        return view('pages.project.bill', ['id' => $id, 'project' => $project, 'bill' => $bill, 'delevery' => $delevery, 'total_payment' => $total]);
    }
    
    public function Account($id){
        
        return view('pages.project.account', ['id' => $id]);
    }
    
    public function test(){
        echo PartyHelper::test();
    }
    
    public function BillsTable(Request $request){
        $id = $request['project_id'];
        $bill = ProjectBills::where('project_id', $id)->orderby('id', 'desc')->count();
        $table = '';
        if($bill > 0){
            $bills = ProjectBills::where('project_id', $id)->orderby('id', 'desc')->get();
            foreach ($bills as $key){
                $due = $key["total"] - $this->BillPay($key["id"]);
                $table .= '<tr>';
                $table .= '<td>'.$key["date"].'</td>';
                $table .= '<td>'.$key["first_date"].' to '.$key["last_date"].'</td>';
                $table .= '<td>'.$key["total"].'</td>';
                $table .= '<td>'.$this->BillPay($key["id"]).'</td>';
                $table .= '<td>'.$due.'</td>';
                $table .= '<td>
                    <a class="btn-delete btn btn-danger btn-sm" href="#" data-id="'.$key['id'].'">Delete</a>
                    <a class="btn btn-success btn-sm" href="'. route("project.bill.detail", $key['id']) .'" data-id="'.$key['id'].'">Detail</a>
                </td>';
                $table .= '</tr>';
            }
        }else{
            $table .= '<tr><td colspan="6"><center>No bill yet</center></td></tr>';
        }
        
        $output = array('table' => $table);
        return response()->json($output);
    }
    
    public function PaymentTable(Request $r){
        $table = '';
        $total = 0;
        $count = ProjectPayment::where('project_id', $r['project_id'])->count();
        if($count > 0){
            $pay = ProjectPayment::where('project_id', $r['project_id'])->get();
            foreach ($pay as $key){
                $bill = ProjectBills::where('id', $key['project_bill_id'])->first();
                $table .= '<tr>';
                $table .= '<td>'.$key['date'].'</td>';
                $table .= '<td>'.$bill['date'].'</td>';
                $table .= '<td>'.$key['description'].'</td>';
                $table .= '<td>'.$key['amount'].'</td>';
                $table .= '<td>
                    <a class="btn-edit btn btn-info btn-sm" data-id="'.$key->id.'" href="$">Edit</a>
                    <a class="btn-delete btn btn-danger btn-sm" data-id="'.$key->id.'" href="$">Delete</a>
                </td>';
                $table .= '</tr>';
                $total += $key['amount'];
            }
        }else{
                $table .= '<tr>';
                $table .= '<td collspan="3">Data not found</td>';
                $table .= '</tr>';
        }
        
        $output = array(
            'table' => $table,
            'total' => $total
        );
        return response()->json($output);
    }
    
    public function AdvanceTable(Request $r){
        $table = '';
        $total = 0;
        $count = ProjectAdvance::where('project_id', $r['project_id'])->count();
        if($count > 0){
            $pay = ProjectAdvance::where('project_id', $r['project_id'])->get();
            foreach ($pay as $key){
                $table .= '<tr>';
                $table .= '<td>'.$key['date'].'</td>';
                $table .= '<td>'.$key['description'].'</td>';
                $table .= '<td>'.$key['amount'].'</td>';
                $table .= '<td>
                        <a class="btn-edit btn btn-info btn-sm" href="#" data-id="'.$key["id"].'">Edit</a>
                        <a class="btn-delete btn btn-danger btn-sm" href="#" data-id="'.$key["id"].'">Delete</a>
                    </td>';
                $table .= '</tr>';
                $total += $key['amount'];
            }
        }else{
                $table .= '<tr>';
                $table .= '<td collspan="3">Data not found</td>';
                $table .= '</tr>';
        }
        
        $output = array(
            'table' => $table,
            'total' => $total
        );
        return response()->json($output);
    }
    
    
    public function SuggestDate(Request $request){
        $id = $request['project_id'];
        if($this->countBill($id) > 0){
            $bill = ProjectBills::where('project_id', $id)->orderby('id', 'desc')->first();
            $day = $bill['last_date'];
        }else{
            $del = ProjectDelevery::where('project_id', $id)->orderby('id', 'asc')->first();
            $day = $del['date'] ?? '';
        }
        $delevery = ProjectDelevery::where('project_id', $id)->orderby('id', 'desc')->first();
        $output = array(
            'first_date' => Dates::Next($day),
            'last_date' => $delevery['date'] ?? ''
        );
        return response()->json($output);
    }
    
    public function checkdate(Request $request){
        $id = $request['project_id'];
        $first_date = $request['first_date'];
        $last_date = $request['last_date'];
        $output = array();
        if($this->countBill($id) > 0){
            if($this->lastBillDate($id) >= $first_date || $this->lastBillDate($id) >= $last_date ){
                $output['valid'] = false;
                $output['t'] = 'Date Error!';
                $output['m'] = 'First date or last date already exit in previous bill!';
                $output['s'] = 'error';
            }else{
                $array = $this->processData($id, $first_date, $last_date);
                $output['valid'] = true;
                $output['table'] = $array['table'];
                $output['total_amount'] = $array['total_amount'];
                $output['remaining_advance'] = $array['remaining_advance'];
                $output['previous_due'] = $array['previous_due'];
            }
        }else{
            $array = $this->processData($id, $first_date, $last_date);
            $output['table'] = $array['table'];
                $output['valid'] = true;
                $output['total_amount'] = $array['total_amount'];
                $output['remaining_advance'] = $array['remaining_advance'];
                $output['previous_due'] = $array['previous_due'];
        }
        
        return response()->json($output);
    }
    
    
    public function deleteBill(Request $req){
        $id = $req['id'];
        $payments = ProjectPayment::where('project_bill_id', $id)->count();
        if($payments == 0){
            ProjectBills::find($id)->delete();
            $output = array(
                't' => 'Delete Successfull',
                'm' => 'Bill delete successfull',
                's' => 'success'
            );
        }else{
            $output = array(
                't' => 'Error',
                'm' => $payments .' Payment found. Can not delete bill.',
                's' => 'error'
            );
        }
        return response()->json($output);
    }
    
    
    
    // helper functions
    private function BillPay($bill_id){
        return ProjectPayment::where('project_bill_id', $bill_id)->sum('amount');
    }
    
    private function TotalAdvance($project_id){
        return ProjectAdvance::where('project_id', $project_id)->sum('amount');
    }
    
    private function AdvanceCut($project_id){
        return ProjectBills::where('project_id', $project_id)->sum('advance_cutting');
    }
    
    private function rAdvance($id){
        return $this->TotalAdvance($id) - $this->AdvanceCut($id);
    }
    
    private function countBill($project_id){
        return ProjectBills::where('project_id', $project_id)->count();
    }
    
    private function lastBillDate($project_id){
        if($this->countBill($project_id) > 0){
            $project = ProjectBills::where('project_id', $project_id)->orderby('id', 'desc')->first();
            return $project['last_date'];
        }else{
            return null;
        }
    }
    
    private function LastBillId($project_id){
        if($this->countBill($project_id) > 0){
            $bill = ProjectBills::where('project_id', $project_id)->orderby('id', 'desc')->first();
            return $bill['id'];
        }else{
            return null;
        }
    }
    
    private function processData($project_id, $first_date, $last_date){
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
    
    private function PreviousDue($project_id){
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
    
    
    private function PName($id){
        $product = Products::where('id', $id)->first();
        return $product['name'];
    }
    private function PUnit($id){
        $product = Products::where('id', $id)->first();
        return $product['unit'];
    }
    
    private function TotalDelevery($project_id, $product_id){
        $delevery = ProjectDelevery::where([['project_id', $project_id], ['product_id', $product_id]])->sum('quantity');
        return $delevery;
    }
    
    private function DeleveryByDate($project_id, $product_id, $first_date, $last_date){
        $delevery = ProjectDelevery::where([['project_id', $project_id], ['product_id', $product_id]])
                  ->whereBetween('date', [$first_date, $last_date])
                  ->sum('quantity');
        return $delevery;
    }
    
    private function QuantityJson($project_id, $first_date, $last_date){
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
