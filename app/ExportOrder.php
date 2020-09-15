<?php

namespace App;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ExportOrder implements FromCollection, WithHeadings
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
      'Qty',
      'Item',
      'Price'
    ];
  }

  public function collection() {
    $records = DB::table('orders')
                    ->join('order_product', 'order_product.order_id', '=', 'orders.id')
                    ->join('products', 'order_product.product_id', '=', 'products.id')
                    ->where('orders.created_at', '>=', $this->start)
                    ->where('orders.created_at', '<=', $this->end)
                    ->select(
                      DB::raw('DATE_FORMAT(orders.created_at, "%d-%b-%Y") AS Date'),
                      'order_product.quantity AS Qty',
                      'products.name AS Item',
                      'products.price AS Price'
                    )
                    ->orderBy('orders.created_at', 'ASC')
                    ->get();

    return $records;
  }
}
