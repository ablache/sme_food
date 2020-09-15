<?php

namespace App;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ExportExpense implements FromCollection, WithHeadings
{
  protected $start;
  protected $end;

  public function __construct($start, $end) {
    $this->start = $start;
    $this->end = $end;
  }

  public function headings(): array {
    return [
      'Date',
      'Supplier',
      'Description',
      'Price'
    ];
  }

  public function collection() {
    $records = DB::table('expenses')
                    ->join('suppliers', 'expenses.supplier_id', '=', 'suppliers.id')
                    ->where('expenses.created_at', '>=', $this->start)
                    ->where('expenses.created_at', '<=', $this->end)
                    ->select(
                      DB::raw('DATE_FORMAT(expenses.created_at, "%d-%b-%Y") AS Date'),
                      'suppliers.name AS Supplier',
                      'expenses.description AS Description',
                      'expenses.price AS Price'
                    )
                    ->orderBy('expenses.created_at', 'ASC')
                    ->get();

    return $records;
  }
}
