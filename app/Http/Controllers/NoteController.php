<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Note;

class NoteController extends Controller
{
    public function index()
    {
        return view('pages.notes.index');
    }
    
    public function Store(Request $req){
        Note::create([
            'user_id' => Auth::user()->id,
            'note'    => $req->note
        ]);
        
        $res = array(
            't' => 'Successfull',
            'm' => 'Note added successfull',
            's' => 'success'
        );
        
        return response()->json($res);
    }
    
    public function NotesTable(){
        $notes = Note::where('user_id', Auth::user()->id)->get();
        $table = '<table class="table table-bordered table-hover table-striped"><thead><tr><th>#</th><th>Note</th><th>Time</th><th>Action</th></tr></thead><tbody>';
        
        if($notes->count() > 0){
            $i = 1;
            foreach ($notes as $n){
                $table .= '<tr>';
                $table .= '<td>'.$i.'</td>';
                $table .= '<td>'.$n->note.'</td>';
                $table .= '<td>'.$n->created_at.'</td>';
                $table .= '<td>
                    <a href="#" class="edit" data-id="'.$n["id"].'">Edit</a>
                    <a href="#" class="delete" data-id="'.$n["id"].'">Delete</a>
                </td>';
                $table .= '</tr>';
                
                $i++;
            }
        }
        
        $table .= '</tbody></table>';
        
        return response()->json($table);
    }
    
    public function getNote(Request $r){
        $data = Note::where('id', $r->id)->first();
        $res = [
            'note' => $data->note
        ];
        
        return response()->json($res);
    }
    
    public function update(Request $req){
        Note::where('id', $req->id)
            ->update([
                  'note'          => $req->note
            ]);
            
            $output = array(
                't'  =>  'Successfull',    
                'm'  =>  'Record update successfull.',    
                's'  =>  'success',    
            );
            return response()->json($output);
        
    }
}
