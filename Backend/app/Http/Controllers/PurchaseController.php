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
        ]);
    }

    public function store(CreatePurchaseRequest $request)
    {
        $purchase = new Purchase();

        $request->validated();

        $purchase->amount = $request->amount;
        $purchase->timestamp = date('h:i:s');
        $purchase->date = date('d.m.Y');
        $purchase->is_outstanding = true;
        $purchase->repair_rating = $request->repair_rating;
        $purchase->general_rating = $request->general_rating;
        $purchase->rating_comment = $request->rating_comment;
        $purchase->post_id = $request->post()->id;
        $purchase->user_id = $request->user()->id;
        $purchase->fee_id = $request->fee()->id;

        $purchase->save();

        return response()->json([
            'message' => 'The transaction has been created',
            'purchase' => $purchase
        ]);
    }
}
