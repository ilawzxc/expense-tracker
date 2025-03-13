<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use App\Models\Expense;

class BudgetController extends Controller
{
    public function index()
    {
        $total_budget = Session::get('total_budget', 0);
        $expenses = Expense::all();
        $total_expense = $expenses->sum('amount');
        $budget_left = $total_budget - $total_expense;

        return view('dashboard', compact('total_budget', 'total_expense', 'budget_left', 'expenses'));
    }

    public function addBudget(Request $request)
    {
        Session::put('total_budget', $request->budget);
        return redirect()->route('home');
    }

    public function addExpense(Request $request)
    {
        Expense::create([
            'title' => $request->title,
            'amount' => $request->amount
        ]);
        return redirect()->route('home');
    }

    public function deleteExpense($id)
    {
        Expense::destroy($id);
        return redirect()->route('home');
    }

    public function resetAll()
    {
        Session::forget('total_budget');
        Expense::truncate();
        return redirect()->route('home');
    }
}