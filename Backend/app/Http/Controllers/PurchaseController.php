<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePurchaseRequest;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        return Purchase::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
    }
    public function show($id)
    {
        return Purchase::findOrFail($id);
    }

    public function delete($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();
        return response()->json([
            'message' => 'The transaction has been deleted',
            'purchase' => $purchase
        ]);    }

    public function store(CreatePurchaseRequest $request)
    {

    }
}
