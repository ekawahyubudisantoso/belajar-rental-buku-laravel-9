<?php

namespace App\Http\Controllers;

use App\Models\RentLogs;
use Illuminate\Http\Request;

class RentLogController extends Controller
{
    public function index(){
        $rentlogs = RentLogs::with(['user', 'book'])->get();
        
        return view('dashboard.rentlogs.index',[
            'rentlogs' => $rentlogs,
        ]);
    }
}
