<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\Http\Requests\ExpenseRequest;
use App\Supplier;

class ExpenseController extends Controller
{
  public function index() {
    $title = 'Expenses';
    $expenses = Expense::orderBy('created_at', 'desc')->paginate(10);

    return view('expenses.manage', compact('title', 'expenses'));
  }

  public function create() {
    $title = 'Add Expenditure';
    $suppliers = Supplier::all();

    return view('expenses.add', compact('title', 'suppliers'));
  }

  public function store(ExpenseRequest $request) {
    $expense = Expense::create($request->validated());

    return redirect()->route('expenses')->with(['success' => 'Expenditure stored successfully']);
  }
}
