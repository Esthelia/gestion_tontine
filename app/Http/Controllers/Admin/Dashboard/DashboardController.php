<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Contribution;
use App\Models\User;
use App\Models\Versement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function getShow(Contribution $contribution) {

      return view('pages.admin.dashboard.show');  
    }

}
