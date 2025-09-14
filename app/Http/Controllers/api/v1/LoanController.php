<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;

use App\Models\Loan;
use App\Models\Book;
use App\Models\User;

use App\Http\Requests\StoreLoanRequest;
use App\Http\Requests\UpdateLoanRequest;

class LoanController extends Controller
{
    public function index()
    {
        return Loan::with(['user', 'book'])->get();
    }

    public function store(StoreLoanRequest $request)
    {
        $data = $request->all();
        $data['loan_date'] = now(); 

        $book = Book::findOrFail($data['book_id']);

        if ($book->available_copies < 1) {
            return response()->json(['message' => 'کتاب موجود نیست'], 400);
        }

        $loan = Loan::create([
            'user_id'   => $data['user_id'],
            'book_id'   => $data['book_id'],
            'loan_date' => now(),
            'status'    => 'borrowed',
        ]);

        $book->decrement('available_copies');

        return response()->json($loan->load(['user', 'book']), 201);
    }

    public function show(Loan $loan)
    {
        return $loan->load(['user', 'book']);
    }

    public function update(UpdateLoanRequest $request, Loan $loan)
    {
        if ($loan->status !== 'borrowed') {
            return response()->json(['message' => 'این کتاب قبلاً برگشت داده شده'], 400);
        }

        $loan->update([
            'return_date' => now(),
            'status'      => now()->greaterThan($loan->loan_date->addDays(14))
                                ? 'late'
                                : 'returned',
        ]);

        $loan->book->increment('available_copies');

        return response()->json($loan->load(['user', 'book']));
    }

    public function destroy(Loan $loan)
    {
        $loan->delete();
        return response()->json(null, 204);
    }

}
