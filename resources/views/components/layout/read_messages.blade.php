<?php
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

if(Route::is('orders.view')){

    $id  = request()->route('orders');
    DB::table('qc_order_messages')
    ->where('order_id', $id)
    ->where('receivertable_type', User::class)
    ->where('receivertable_id', Auth::user()->id)
    ->update(array('read' => 1));

    DB::table('student_order_messages')
        ->where('order_id', $id)
        ->where('receivertable_type', User::class)
        ->where('receivertable_id', Auth::user()->id)
        ->update(array('read' => 1));

    DB::table('teacher_order_messages')
        ->where('order_id', $id)
        ->where('receivertable_type', User::class)
        ->where('receivertable_id', Auth::user()->id)
        ->update(array('read' => 1));

}


?>
