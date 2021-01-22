<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProjectValidation;
use App\Http\Requests\ProjectDeleveryValidation;
use Illuminate\Support\Facades\Auth;
use App\Model\Project;
use App\Model\Products;
use App\Model\ProjectSell;
use App\Model\ProjectDelevery;
use App\Model\ProjectBills;
use App\Model\ProjectAdvance;
use Dates;

class ProjectController extends Controller
{
    function __construct()
    {
        return $this->middleware('auth');
    }
    
    public function index(){
        return view('pages.project.index');
    }
    
    public function DeleveryIndex(){
        return view('pages.project.delevery');
    }
    
    public function StoreProject(ProjectValidation $request){
      $project = Project::create([
          'title'         => $request['title'],
          'location'      => $request['location'],
          'owner'         => $request['owner'],
          'phone'         => $request['phone'],
          'email'         => $request['email'],
          //'advance'       => $request['advance'],
          'date'          => Dates::Today(),
          'user_id'       => Auth::user()->id,
      ]);
      
      if($request['advance'] > 0){
          ProjectAdvance::create([
              'project_id' => $project->id,
              'amount'     => $request['advance'],
              'date'       => Dates::Today(),
              'user_id'    => Auth::user()->id
          ]);
      }
      
        
        $output = array(
            't' => 'Successfull',
            'm' => 'Project store successfull id = '.$project->id,
            's' => 'success'
        );
        return response()->json($output);
    }
    
    public function ProjectList(){
        $table = '<table class="table table-bordered table-hover table-striped"><thead><tr><th>#</th><th>Title</th><th>Location</th><th>Owner</th><th>Phone</th><th>Email</th><th>Advance</th><th>Remaining Advance</th><th>Action</th></tr></tbody>';
        $count = Project::count();
        if($count > 0){
            $data = Project::get();
            $i = 1;
            foreach ($data as $key) {
                $table .= '<tr>';
                $table .= '<td>'.$i.'</td>';
                $table .= '<td>'.$key["title"].'</td>';
                $table .= '<td>'.$key["location"].'</td>';
                $table .= '<td>'.$key["owner"].'</td>';
                $table .= '<td>'.$key["phone"].'</td>';
                $table .= '<td>'.$key["email"].'</td>';
                $table .= '<td>'.$this->TotalAdvance($key["id"]).'</td>';
                $table .= '<td>'.$this->rAdvance($key["id"]).'</td>';
                $table .= '<td>
                    <a href="#" class="edit" data-id="'.$key["id"].'">Edit</a>
                    <a href="#" class="sell" data-id="'.$key["id"].'">Sell</a>
                    <a href="'.route('project.account', $key['id']).'" data-id="'.$key["id"].'">Account</a>
                </td>';
                $table .= '</tr>';
                $i++;
            }
            $table .= '</tbody></table>';
            
        }else{
            $table .= "<tr><td colspan='8' style='text-align:center;'>". __('tbl.not_found') ."</td></tr></tbody></table>";
        }


        return response()->json($table);
    }
    
    public function InfoById(Request $request){
        $id = $request['id'];
        $data = Project::where('id', $id)->first();
        
        $output = array(
            'title'  =>  $data['title'],
            'location'  =>  $data['location'],
            'owner'  =>  $data['owner'],
            'phone'  =>  $data['phone'],
            'email'  =>  $data['email'],
        );
        return response()->json($output);
    }
    
    public function UpdateProject(Request $request){
        $id = $request['id'];
        
        Project::where('id', $id)
            ->update([
                  'title'          => $request['title'],
                  'location'       => $request['location'],
                  'owner'          => $request['owner'],
                  'phone'          => $request['phone'],
                  'email'          => $request['email'],
            ]);
            
            $output = array(
                't'  =>  'Successfull',    
                'm'  =>  'Record update successfull.',    
                's'  =>  'success',    
            );
            return response()->json($output);
        
    }
    
    public function StoreSell(Request $request){
        if($this->CheckProjectProduct($request->project_id, $request->product_id)){
            ProjectSell::create([
                'project_id'        =>    $request['project_id'],
                'product_id'        =>    $request['product_id'],
                'rate'              =>    $request['rate'],
                'date'              =>    Dates::Today(),
                'user_id'           =>    Auth::user()->id,
            ]);
            $output = array(
                't' => 'Successfull',
                'm' => 'Product store successfull',
                's' => 'success'
            );
        }else{
            $output = array(
                't' => 'Error',
                'm' => 'Product already exist in this account.',
                's' => 'error'
            );
        }
        return response()->json($output);
        
    }
    
    private function CheckProjectProduct($project_id, $product_id){
        $pro = ProjectSell::where('project_id', $project_id)->get();
        foreach ($pro as $key){
            if($key['product_id'] == $product_id){
                return false;
                exit;
            }
        }
        return true;
    }
    
    public function CheckProject(Request $request){
        $id = $request['id'];
        $project = Project::where('id', $id)->first();
        if($project['status'] == 'Active'){
            $response = array(
                'isValid' => true,
            );
        }else{
            $response = array(
                'isValid' => false,
                'msg' => 'This project has been closed!'
            );
        }

        return response()->json($response);
    }
    
    public function ProjectInfo(Request $request){
        $project = Project::where('id', $request['id'])->first();
        $products = ProjectSell::where('project_id', $request['id'])->get();
        $table = '';
        foreach ($products as $key){
            
            $table .= "<tr>
                <td> ".$this->ProductName($key['product_id'])."</td>
                <td> ".$this->TotalDelevery($request['id'], $key['product_id'])."</td>
                <td> ".$this->DeleveryAfterBill($request['id'], $key['product_id'])."</td>
            </tr>";
            
        }
        
        $output = array(
            'name'      =>  $project['title'],    
            'owner'     =>  $project['owner'],    
            'locations' =>  $project['location'],    
            'table'     =>  $table,
        );
        return response()->json($output);
    }
    
    public function ProjectProducts(Request $request){
        $id = $request['id'];
        $data = ProjectSell::where('project_id', $id)->get();
        $options = '<option value="">Select One </option>';
        if($data->count() > 0){
            foreach ($data as $key){
                $options .= '<option value="'.$key['product_id'].'">'.$this->ProductName($key['product_id']).'</option>';
            }
        }
        $output = array(
            'options' => $options    
        );
        return response()->json($output);
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
    
    
    private function ProductName($id){
        $product = Products::where('id', $id)->first();
        return $product['name'] .' - '.$product['unit'];
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
    
    private function lastBillDate($project_id){
        if($this->countBill($project_id) > 0){
            $project = ProjectBills::where('project_id', $project_id)->orderby('id', 'desc')->first();
            return $project['last_date'];
        }else{
            $c = ProjectDelevery::where('project_id', $project_id)->count();
            if($c > 0){
                $delevery = ProjectDelevery::where('project_id', $project_id)->first();
                return $delevery['date'];
            }else{
                return '';
            }
        }
    }
    
    private function lastDateBill($project_id){
        if($this->countBill($project_id) > 0){
            $project = ProjectBills::where('project_id', $project_id)->orderby('id', 'desc')->first();
            return $project['last_date'];
        }else{
            return null;
        }
    }
    
    private function DeleveryAfterBill($project_id, $product_id){
        if($this->countBill($project_id) > 0){
            $delevery = ProjectDelevery::where([['project_id', $project_id], ['product_id', $product_id]])
                  ->where('date', '>', $this->lastBillDate($project_id))
                  ->sum('quantity');
        }else{
            $delevery = $this->TotalDelevery($project_id, $product_id);
        }
        return $delevery;
    }
    
    public function StoreDelevery(ProjectDeleveryValidation $request){
        if($this->countBill($request['project_id']) > 0){
        if($this->lastDateBill($request['project_id']) >= Dates::Today()){
            $output = array(
                't' => 'Problem with delivery',
                'm' => 'Can not delivery product after submiting a bill in the same date.',
                's' => 'error'
            );
        }else{
            $this->StoreDeleveryFn($request);
            $output = array(
                't' => 'Successfull',
                'm' => 'Product delivery successfull',
                's' => 'success'
            );
        }
        }else{
            $this->StoreDeleveryFn($request);
            $output = array(
                't' => 'Successfull',
                'm' => 'Product delivery successfull',
                's' => 'success'
            );
        }
        
        return response()->json($output);
    }
    
    public function UpdateDelevery(Request $req){
        $pro = ProjectDelevery::where('id', $req['id'])->first();
        $project_id = $pro['project_id'];
        if($this->lastDateBill($project_id) < $pro['date']){
            ProjectDelevery::find($req['id'])->update([
                'dref' => $req['dref'],
                'product_id' => $req['product_id'],
                'quantity' => $req['quantity'],
                'driver' => $req['driver'],
                'destination' => $req['destination'],
            ]);
            $output = array(
                't' => 'Successfull',
                'm' => 'Delivery update successfull',
                's' => 'success',
            );
        }else{
            $output = array(
                't' => 'Error',
                'm' => 'Can not update delivery after submiting it\'s bill',
                's' => 'error'
            );
        }
        
        return response()->json($output);
        
    }
    
    public function DeleteDelevery(Request $req){
        $pro = ProjectDelevery::where('id', $req['id'])->first();
        $project_id = $pro['project_id'];
        if($this->lastDateBill($project_id) < $pro['date']){
            ProjectDelevery::find($req['id'])->delete();
            $output = array(
                't' => 'Successfull',
                'm' => 'Delivery delete successfull',
                's' => 'success',
            );
        }else{
            $output = array(
                't' => 'Error',
                'm' => 'Can not delete delivery after submiting it\'s bill',
                's' => 'error'
            );
        }
        
        return response()->json($output);
        
    }
    
    private function StoreDeleveryFn($request){
        ProjectDelevery::create([
                'project_id'  =>     $request['project_id'],
                'dref'        =>     $request['dref'],
                'product_id'  =>     $request['product_id'],
                'quantity'    =>     $request['quantity'],
                'driver'      =>     $request['driver'],
                'destination' =>     $request['destination'],
                'date'        =>     Dates::Today(),
                'user_id'     =>     Auth::user()->id,
            ]);
    }
    
    public function DeleveryTable(Request $request){
        $id = $request['id'];
        $data = ProjectDelevery::where('project_id', $id)->orderby('id', 'desc')->get();
        $table = '';
        $i = 1;
        foreach ($data as $key){
           $table .= '
            <tr>
                <td>'.$i.'</td>
                <td>'.Dates::SR($key['date']).'</td>
                <td>'.$key['dref'].'</td>
                <td>'.$this->pName($key['product_id']).'</td>
                <td>'.$key['quantity'].' '.$this->pUnit($key['product_id']).'</td>
                <td>'.$key['destination'].'</td>
                <td>'.$key['driver'].'</td>
                <td>
                    <a href="#" class="btn-edit btn btn-info btn-sm" data-id="'.$key["id"].'">Edit</a>
                    <a href="#" class="btn-delete btn btn-danger btn-sm" data-id="'.$key["id"].'">Delete</a>
                </td>
            </tr>';
            $i++;
        }
        
        $output = array(
            'tbody' => $table  
        );
        return response()->json($output);
    }
    
    public function DeleveryInfo(Request $r){
        $data = ProjectDelevery::where('id', $r['id'])->first();
        $output = array(
            'dref' => $data->dref,
            'product_id' => $data->product_id,
            'quantity' => $data->quantity,
            'driver' => $data->driver,
            'destination' => $data->destination,
        );
        return response()->json($output);
    }
}
