<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inventario;
use Carbon\Carbon;

class inventory_rotation extends Controller
{
    public static function inventory_rotation_register(){
        self::list_inventory();
    }

    private static function list_inventory(){
        $listInventory= inventario::all();

        $now = Carbon::now()->format('Y-m-d');
        \Log::info($now);
        
        foreach ($listInventory as $inventory) {
            if($inventory->fecha_vencimiento == $now){
                self::update_inventory($inventory->id);
            }
        }

    }

    private static function update_inventory($id){
        inventario::where('id','=',$id)->update([
            'id_estado' => 2
        ]);
    }
}
