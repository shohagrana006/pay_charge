<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * constract a method
     */
    public $user;
    public function __construct( )
    {
        $this->middleware(function ($request, $next) {
            $this->user = authUser();
            return $next($request);
        });
    }


    /**
     * List of all category
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('purchase.log.index')) {
            abort(403, UnauthorizedMessage());
        }
        $purchases = Purchase::with('user')->latest()->get();
        $totalPurchases = Purchase::count();
        return view('admin.pages.purchase_log.index', compact('purchases', 'totalPurchases'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (is_null($this->user) || !$this->user->can('purchase.log.edit')) {
            abort(403, UnauthorizedMessage());
        }
        return view('admin.pages.purchase_log.show', [
            'purchase'  => Purchase::where('id', $id)->firstOrFail(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('purchase.log.edit')) {
            abort(403, UnauthorizedMessage());
        }
        
        $request->validate([
            'id' => 'required',
            'status' => 'required|in:1,2,3'
        ]);
        Purchase::where('id', $request->id)->update([
            'status' => $request->status
        ]);        
        return back()->with('success', decode('Status Update Successfully'));
    }



}
