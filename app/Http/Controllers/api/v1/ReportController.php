<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;


class ReportController extends Controller
{

    public function reports()
    {
        $totalLoans = Loan::count();
        $borrowedLoans = Loan::where('status', 'borrowed')->count();
        $returnedLoans = Loan::where('status', 'returned')->count();
        $lateLoans = Loan::where('status', 'late')->count();

        $topBooks = Book::withCount('loans')
            ->orderBy('loans_count', 'desc')
            ->take(5)
            ->get(['id', 'title']);

        $topUsers = User::withCount('loans')
            ->orderBy('loans_count', 'desc')
            ->take(5)
            ->get(['id', 'name']);

        return response()->json([
            'total_loans' => $totalLoans,
            'borrowed_loans' => $borrowedLoans,
            'returned_loans' => $returnedLoans,
            'late_loans' => $lateLoans,
            'top_books' => $topBooks,
            'top_users' => $topUsers,
        ], 200);
    }


}
