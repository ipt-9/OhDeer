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
        $request->validated();

        $user = $request->user();
        $post = $request->post();
        $fee = $request->fee();

        $purchase = new Purchase();

        $purchase->amount = $request->amount;
        $purchase->timestamp = date('h:i:s');
        $purchase->date = date('d.m.Y');
        $purchase->is_outstanding = true;
        $purchase->repair_rating = $request->repair_rating;
        $purchase->general_rating = $request->general_rating;
        $purchase->rating_comment = $request->rating_comment;
        $purchase->post_id = $post->id;
        $purchase->user_id = $user->id;
        $purchase->fee_id = $fee->id;

        $purchase->save();

        // recalculate the avg of the ratings

        $avgrepair = Purchase::where('user_id', $user->id)->avg('repair_rating');
        $avggeneral = Purchase::where('user_id', $user->id)->avg('general_rating');

        $user->repair_rating = $avgrepair;
        $user->general_rating = $avggeneral;

        $user->save();

        return response()->json([
            'message' => 'The transaction has been created',
            'purchase' => $purchase
        ]);
    }

    public function GetTotal(Request $request)
    {
        $user = $request->user();
        $purchasetotal = Purchase::where('user_id', $user->id)->sum('amount');
        return response(['data'=> $purchasetotal]);
    }
}
