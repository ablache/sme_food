<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use \Carbon\Carbon;
use App\ExportExpense;
use App\ExportOrder;
use DB;

class ReportController extends Controller
{
  protected $types;

  public function __construct() {
    $this->types = ['expense', 'order'];
  }

  public function download(Request $request, $type) {
    if(!in_array($type, $this->types)) {
      abort(404);
    }
    $title = 'Download ' . ucfirst($type) . ' Report';

    return view('reports.download', compact('title'));
  }

  public function export(Request $request, $type) {
    if(!in_array($type, $this->types)) {
      abort(404);
    }

    if($request->has('start')) {
      $request->validate([
        'start' => 'required|date',
        'end' => 'required|date|after_or_equal:start',
      ]);
    }

    $start = Carbon::create($request->start);
    $end = Carbon::create($request->end)->endOfDay();

    if($type == 'expense') {
      $filename = 'expenses' . $start->format('Y-m-d') . '__' . $end->format('Y-m-d') . '.csv';

      return Excel::download(new ExportExpense($start, $end), $filename);
    }
    else if($type == 'order') {
      $filename = 'orders' . $start->format('Y-m-d') . '__' . $end->format('Y-m-d') . '.csv';

      return Excel::download(new ExportOrder($start, $end), $filename);
    }

    return redirect()->back()->withInput();
  }
}
