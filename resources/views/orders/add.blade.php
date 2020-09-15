@extends('layouts.main')

@section('content')

<div class="fade-in">
  <div class="row">
    <div class="col-sm-12">
      <h3>{{ $title }}</h3>
    </div>
  </div>
  {!! Form::open(['id' => 'order_form']) !!}
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <strong>Ordered By</strong>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                  <label for="customer_srch">Customer</label>
                  {!! Form::text('customer_srch', null, ['class' => 'form-control', 'id' => 'customer_srch', 'placeholder' => 'Search Customers']) !!}
                  {!! Form::hidden('customer_id', null, ['id' => 'customer_id']) !!}
                  <div class="list-group" id="customer_list"></div>
                  <div class="alert alert-primary" id="selected_customer" style="display: none;"></div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <strong>Items</strong>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="item_search">Product</label>
                {!! Form::text('item_search', null, ['class' => 'form-control', 'id' => 'item_search', 'placeholder' => 'Search Products']) !!}
                <div id="products"></div>
                <div class="list-group" id="product_list"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <table class="table table-responsive-lg">
                <thead>
                  <tr>
                    <th>Qty</th>
                    <th>Item</th>
                    <th>Type</th>
                    <th>Preferences</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                    <th>Remove</th>
                  </tr>
                </thead>
                <tbody id="products_table">

                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <strong>Delivery Details</strong>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="form-group col-sm-8">
              <label for="delivery_date">Date</label>
              <input class="form-control" id="delivery_date" type="date" name="delivery_date" placeholder="Date">
            </div>
            <div class="form-group col-sm-4">
              <label for="delivery_time">Time</label>
              <div class="row">
                <select class="form-control col-sm-5" name="hr" id="hr">
                  @for ($i = 0; $i < 24; $i++)
                    <option value="{{ ($i < 10) ? '0' . $i : $i }}">{{ ($i < 10) ? '0' . $i : $i }}</option>
                  @endfor
                </select>
                <select class="form-control col-sm-5" name="mn" id="mn">
                  @for ($i = 0; $i < 59; $i++)
                    <option value="{{ ($i < 10) ? '0' . $i : $i }}">{{ ($i < 10) ? '0' . $i : $i }}</option>
                  @endfor
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="del_status">Delivery Status</label>
                <select name="del" id="del_status" class="form-control">
                  <option value="not delivered">Not Delivered</option>
                  <option value="delivered">Delivered</option>
                  <option value="not answering">Not Answering</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <strong>Payment</strong>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="sub_total">Sub Total</label>
                <input type="text" name="sub_total" id="sub_total" class="form-control" disabled>
              </div>
              <div class="form-group">
                <label for="discount">Discount (In Percent)</label>
                <input type="text" name="discount" id="discount" class="form-control">
              </div>
              <div class="form-group">
                <label for="grand_total">Grand Total</label>
                <input type="text" name="grand_total" id="grand_total" class="form-control" disabled>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="">Payment Method</label>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" name="pay_method" class="form-check-input pay_method" rel="cash" checked>
                      <label for="">Cash</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" name="pay_method" class="form-check-input pay_method" rel="transfer">
                      <label for="">Transfer</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="">Payment Status</label>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" name="pay_status" class="form-check-input pay_status" rel="not paid" checked>
                      <label for="">Not Paid</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" name="pay_status" class="form-check-input pay_status" rel="paid">
                      <label for="">Paid</label>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="alert alert-danger" id="err" style="display: none;">
        
      </div>
    </div>
    <div class="col-sm-12 pb-4">
        {!! Form::submit('Place Order', ['class' => 'btn btn-success btn-lg', 'id' => 'submit']) !!}
    </div>
  </div>
  {!! Form::close() !!}
</div>
    
@endsection

@section('scripts')

<script type="text/javascript">

var token = "{{ csrf_token() }}";
var custSrchUrl = "{{ route('customers.search') }}";
var prodSrchUrl = "{{ route('products.search') }}";
var prodAddUrl = "{{ route('orders.add') }}";
var successUrl = "{{ route('orders') }}";

$(document).ready(function() {
  clearCustomer();

  var items = Array();
  var selectedCustomer = null;
  var selectedItems = Array();
  var selectedDate = null;
  var discount;
  var data = {};

  $('#customer_srch').on('input', function() {
    var ckw = $(this).val();

    if(ckw.length >= 3) {
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': token
        }
      });
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: custSrchUrl,
        data: {keyword: ckw},
        success: function(response) {
          var html = '';
          var cList = $('#customer_list');
          $.each(response.data, function(k, v) {
            html += '<button type="button" class="list-group-item list-group-item-action customer_selector" rel="' + v.id + '">' + v.name + ' (' + v.contact + ')</button>';
          });

          cList.empty();
          cList.html('');
          cList.html(html);
          cList.css('display', 'block');
        },
        error: function(e) {
          console.log(e);
        }
      });
    }
  });

  $('#item_search').on('input', function() {
    var pkw = $(this).val();
    
    if(pkw.length >= 3) {
      $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': token
        }
      });
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: prodSrchUrl,
        data: {keyword: pkw},
        success: function(response) {
          var html = '<table class="table table-responsive-lg">';
          var pList = $('#product_list');
          items = Array();
          $.each(response.data, function(k, v) {
            items.push(v);
            var pref = '<div class="custom-control custom-radio custom-control-inline">';
            $.each(v.preferences, function(key, value) {
              pref += '<input type="checkbox" rel="' + value.id + '" class="gitem-prefs-' + v.id + ' mr-2 ml-2" name="p[' + value.id + ']"/><label for="" style="margin-top: -4px;" id="gitem-prefs-name-' + value.id + '">' + value.name + '</label>';
            });
            pref += '</div>';

            html += '<tr>' +
                    '<td><span id="gitem-name-'+ v.id +'">' + v.name + ' (' + v.type.name + ')</span></td>' +
                    '<td><span><input type="text" id="gitem-qty-' + v.id + '" class="form-control col-sm-6" style="display: inline; margin-left: 40px;" placeholder="Quantity" min=1></span></td>' +
                    '<td><span>' + pref + '</span></td>' +
                    '<td><button class="btn btn-success float-right item-add" rel="' + v.id + '">Add</button></td>'+
                    '</tr>';
          });
          html += '</table>';
          pList.empty();
          pList.html('');
          pList.html(html);
        },
        error: function(e) {
          console.log(e);
        }
      });
    }
    if(pkw.length == 0) {
      clearProductList();
    }
  });

  $('#product_list').on('click', '.item-add', function(e) {
    e.preventDefault();
    var id = $(this).attr('rel');
    var item = items.filter(i => { return i.id == id})[0];
    var qty = $('#gitem-qty-' + id).val();
    var prefs = Array();

    $('.gitem-prefs-' + id).each(function() {
      if(this.checked) {
        var p = {id: $(this).attr('rel'),name: $('#gitem-prefs-name-' + $(this).attr('rel')).html()}
        prefs.push(p);
      }
    });

    if(qty === '') {
      qty = 1;
    }
    
    var i = {id: id, item: item, qty: qty, prefs: prefs}
    selectedItems.push(i);
 
    clearProductList();

    items = Array();
    
    generateProducts(selectedItems, $('#products_table'));
    calculate(selectedItems);
  });

  $('#customer_list').on('click', '.customer_selector', function(e) { 
    e.preventDefault();
    showCustomer($(this).html());
    $(this).html('');
    $(this).empty();
    $(this).css('display', 'none');
    $('#customer_srch').val('');
    $('#customer_id').val($(this).attr('rel'));
    selectedCustomer = $(this).attr('rel');
    $('#customer_list').html('');
    $('#customer_list').empty();
  });

  $('#discount').on('input', function(e) {
    e.preventDefault();
    discount = $(this).val();

    calculate(selectedItems);
  });

  $('#order_form').on('submit', function(e) {
    e.preventDefault();
    var date = $('#delivery_date').val();
    var dateTime = null;
    var h = $('#hr').val();
    var m = $('#mn').val();
    var deliveryStatus = $('#del_status').val();
    var payMethod = 'cash';
    var payStatus = 'not paid';
    discount = $('#discount').val();

    if(discount === '') {
      discount = 0;
    }
    

    if(date !== null && date !== '') {
      dateTime = date + ' ' + h + ':' + m + ':00';
    }
    
    $('.pay_method').each(function() {
      if(this.checked) {
        payMethod = $(this).attr('rel');
      }
    });

    $('.pay_status').each(function() {
      if(this.checked) {
        payStatus = $(this).attr('rel');
      }
    });
    
    data = {
      customer_id: selectedCustomer,
      deliver_at: dateTime,
      products: selectedItems,
      delivery_status: deliveryStatus,
      discount: discount,
      payment_method: payMethod,
      payment_status: payStatus
    };


    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': token
        }
      });
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: prodAddUrl,
        data: data,
        success: function(response) {
          location.replace(successUrl);
        },
        error: function(e) {
          var errors = JSON.parse(e.responseText);
          showErrors($('#err'), errors);
        }
      });
  })

  $(document).on('click', 'span.remove-item', function(e) {
    e.preventDefault();
    var key = $(this).attr('rel');

    selectedItems.splice(key, 1);

    generateProducts(selectedItems, $('#products_table'));
    calculate(selectedItems);
  });

});

function calculate(sItems) {
  var subTotal = 0;
  var disc = 0;
  var grandTotal = 0;

  $.each(sItems, function(k, v) {
    subTotal += v.qty * v.item.price;
  });

  discount = $('#discount').val();
  grandTotal = subTotal - (subTotal * (discount / 100));

  $('#sub_total').val(toCurrency(subTotal));
  $('#grand_total').val(toCurrency(grandTotal));
}

function toCurrency(val) {
  var formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'MVR',
  });

  return formatter.format(val);
}

function generateProducts(items, container) {
  container.html = '';
  container.empty();
  var html = '';
  $.each(items, function(k, v) {
    html += '<tr>' +
            '<td>' + v.qty + '</td>' +
            '<td>' + v.item.name + '</td>' +
            '<td>' + v.item.type.name + '</td>' +
            '<td>';
    $.each(v.prefs, function(key, value) {
      html += value.name;
      if(key !== v.prefs.length-1) {
        html += ', ';
      }
    });

    html += '</td>' +
            '<td>' + toCurrency(v.item.price) + '</td>' +
            '<td>' + toCurrency(v.qty * v.item.price) + '</td>' +
            '<td><span class="btn btn-danger remove-item" rel="' + k + '"><span class="fas fa-times"></span></span></td>' +
            '</tr>';
  });
  container.append(html);
}


function clearProductList() {
  $('#product_list').html('');
  $('#product_list').empty();
  $('#item_search').val('');
}

function clearCustomer() {
  var c = $('#selected_customer');
  c.html('');
  c.empty();
  c.css('display', 'none');
}

function showCustomer(val) {
  var c = $('#selected_customer');
  c.html('');
  c.empty();
  c.html(val);
  c.css('display', 'block');
}

function showErrors(cont, errors) {
  clearErrors(cont);
  var html = '<ul>';
  $.each(errors.errors, function(field, errs) {
    $.each(errs, function(k, msg) {
      html += '<li>' + msg + '</li>';
    });
  });
  html += '</ul>';
  
  cont.css('display', 'block');
  cont.html(html);
}

function clearErrors(cont) {
  cont.html('');
  cont.empty();
  cont.css('display', 'none');
}

</script>
    
@endsection