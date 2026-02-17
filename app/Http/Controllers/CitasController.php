<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Citas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CitasController extends Controller
{
    public static function create(array $data){
    try {
        DB::beginTransaction();
        // Cambiado de User::create a Citas::create
        $cita = Citas::create($data); 
        DB::commit();
        return true;
    } catch (\Throwable $th) {
        DB::rollBack();
        return false;
    }
}

    public static function edit($id, array $data){
        try {
            DB::beginTransaction();
            $cita = Citas::findOrFail($id);
            $cita->update($data);
            DB::commit();
            return true;     

        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }
    public static function destroy($id){
        $cita = Citas::findOrFail($id);
        try {
            DB::beginTransaction();
            $cita->delete();
            DB::commit();
            return true;
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }

}





