<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\Http\Requests\ExpenseRequest;
use App\Supplier;
use App\Http\Requests\ConfirmRequest;

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
