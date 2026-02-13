<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\Status;
use App\Http\Requests\TableUsers;

class UsersController extends Controller
{
    public function profile( User $user){
        
        return view('profile', compact('user'));
    }

    public function index()
    {
        $users = User::all();
        return view('datatable.users', compact('users'));
    }

    
    public function find($id){
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public  static function create(array $data){
        
        try {
            DB::beginTransaction();
            // Aquí agregas lo genérico antes de crear
                $data['status_id'] = $data['status_id'] ?? 1;
                $data['rol_id']    = $data['rol_id'] ?? 2;
                $data['password']  = bcrypt('123456789');
            $user = User::create($data);

            DB::commit();
            return true;
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }

    public static function update( $id, array $data){
        $user = User::findOrFail($id);
        try {
            DB::beginTransaction();
            $user->update($data);
            DB::commit();
            return true;            
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }

    }

    public function destroy($id){
        $user = User::findOrFail($id);
        try {
            DB::beginTransaction();
            $user->delete();
            DB::commit();
            return redirect()->route()->with('success', 'Usuario eliminado exitosamente');
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route()->with('error', 'Error al eliminar el usuario');
        }
    }
}