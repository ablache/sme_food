<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\Http\Requests\ExpenseRequest;
use App\Supplier;
use App\Http\Requests\ConfirmRequest;
use \Carbon\Carbon;

class ExpenseController extends Controller
{
  public function index(Request $request) {
    $title = 'Expenses';
    $start = null;
    $end = null;
    $expenses = collect();

    if($request->has('start')) {
      $request->validate([
        'start' => 'required|date',
        'end' => 'required|date|after_or_equal:start',
      ]);
    }

    if($request->has('start') && $request->has('end')) {
      $start = Carbon::create($request->start);
      $end = Carbon::create($request->end)->endOfDay();

      $expenses = Expense::where('created_at', '>=', $start)->where('created_at', '<=', $end)->orderBy('created_at', 'desc')->paginate(10);
    }
    else {
      $expenses = Expense::orderBy('created_at', 'desc')->paginate(10);
    }

    return view('expenses.manage', compact('title', 'expenses', 'start', 'end'));
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

  public function edit($id) {
    $title = 'Edit Expense Details';
    $model = Expense::findOrFail($id);
    $suppliers = Supplier::all();

    return view('expenses.edit', compact('title', 'model', 'suppliers'));
  }

  public function update(ExpenseRequest $request, $id) {
    $expense = Expense::findOrFail($id);
    $expense->update($request->all());

    return redirect()->route('expenses')->with(['success' => 'Expense details updated successfully']);
  }

  public function destroy(ConfirmRequest $request, $id) {
    $expense = Expense::findOrFail($id);
    $expense->delete();

    return redirect()->route('expenses')->with(['success' => 'Expense details removed successfully']);
  }
}
