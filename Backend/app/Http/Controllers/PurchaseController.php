<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Fee;
use App\Models\Post;
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

    public function delete($id, Request $request)
    {
        $purchase = Purchase::findOrFail($id);

        if ($request->user()->id !== $purchase->user_id) {
            abort(403);
        }

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
        $fee = Fee::findOrFail(1);
        $post = Post::findOrFail($request->post_id);


        $purchase = new Purchase();

        $purchase->is_outstanding = true;
        $purchase->post_id = $post->id;
        $purchase->user_id = $user->id;
        $purchase->fee_id = $fee->id;

        // calculate the actual price of the transaction

        $purchase->amount = $request->amount * ($fee->amount / 100) + $request->amount;
        $purchase->save();

        return response()->json([
            'message' => 'The transaction has been created',
            'purchase' => $purchase,
        ]);
    }

    public function GetTotal(Request $request)
    {
        $user = $request->user();
        $purchasetotal = Purchase::where('user_id', $user->id)->sum('amount');
        return response(['data'=> $purchasetotal]);
    }

    public function update(UpdatePurchaseRequest $request, $id)
    {
        $request->validated();

        $user = $request->user();

        $purchase = Purchase::findOrFail($id);

        if ($request->user()->id !== $purchase->user_id) {
            abort(403);
        }

        $purchase->fill($request->validated());
        $purchase->save();

        // recalculate the avg of the ratings

        $avgrepair = Purchase::where('user_id', $user->id)->avg('repair_rating');
        $avggeneral = Purchase::where('user_id', $user->id)->avg('general_rating');

        $user->repair_rating = $avgrepair;
        $user->general_rating = $avggeneral;

        $user->save();

        return response()->json([
            'message' => 'The transaction has been edited',
            'purchase' => $purchase,
            'user' => $user
        ]);

    }

}
