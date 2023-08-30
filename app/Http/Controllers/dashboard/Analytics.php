<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Ticketing\Ticket;
use Illuminate\Http\Request;

class Analytics extends Controller
{
  public function index()
  {
    $totalTickets = Ticket::count();
    $openTickets = Ticket::whereHas('status', function($query) {
      $query->whereName('Open');
    })->count();
    $closedTickets = Ticket::whereHas('status', function($query) {
      $query->whereName('Closed');
    })->count();

    return view('content.dashboard.dashboards-analytics', compact('totalTickets', 'openTickets', 'closedTickets'));
  }
}
