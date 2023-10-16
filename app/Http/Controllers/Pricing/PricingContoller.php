<?php

namespace App\Http\Controllers\Pricing;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SubscriptionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PricingContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $account=Auth::user()->account_id;
      $current=Subscription::find($account);
      $prices=SubscriptionType::all();
      $user_role=Auth::user()->role;
      return view('app.pricing.index', compact('prices', 'current', 'user_role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.pricing.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
