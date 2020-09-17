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
      'Ordered By',
      'Contact',
      'Qty',
      'Item',
      'Price',
      'Discount',
      'Total',
    ];
  }

  public function collection() {
    $records = DB::table('orders')
                    ->join('order_product', 'order_product.order_id', '=', 'orders.id')
                    ->join('products', 'order_product.product_id', '=', 'products.id')
                    ->join('customers', 'orders.customer_id', '=', 'customers.id')
                    ->where('orders.deliver_at', '>=', $this->start)
                    ->where('orders.deliver_at', '<=', $this->end)
                    ->select(
                      DB::raw('DATE_FORMAT(orders.deliver_at, "%d-%b-%Y") AS Date'),
                      'customers.name AS "Ordered By"',
                      'customers.contact AS Contact',
                      'order_product.quantity AS Qty',
                      'products.name AS Item',
                      'products.price AS Price',
                      'orders.discount AS Discount',
                      DB::raw('ROUND((order_product.quantity * products.price) - (order_product.quantity * products.price) * (orders.discount / 100), 2) AS Total')
                    )
                    ->orderBy('orders.deliver_at', 'ASC')
                    ->get();

    return $records;
  }
}
