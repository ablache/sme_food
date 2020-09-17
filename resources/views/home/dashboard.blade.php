@extends('layouts.main')

@section('content')

<div class="fade-in">
  <div class="row">
    <div class="col-sm-6 col-lg-4">
      <div class="card text-white bg-gradient-success pb-4">
        <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
          <div>
            <div class="text-value-lg">{{ $counts['total_items'] }}</div>
            <div>Items Ordered</div>
          </div>
        </div>
      </div> 
    </div>
    <div class="col-sm-6 col-lg-4">
      <div class="card text-white bg-gradient-primary pb-4">
        <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
          <div>
            <div class="text-value-lg">{{ $counts['total_orders'] }}</div>
            <div>Total Orders</div>
          </div>
        </div>
      </div> 
    </div>
    <div class="col-sm-6 col-lg-4">
      <div class="card text-white bg-gradient-info pb-4">
        <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
          <div>
            <div class="text-value-lg">{{ $counts['pending_orders'] }}</div>
            <div>Pending Orders</div>
          </div>
        </div>
      </div> 
    </div>
    <div class="col-sm-6 col-lg-6">
      <div class="card text-white bg-gradient-warning pb-4">
        <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
          <div>
            <div class="text-value-lg">{{ $counts['total_customers'] }}</div>
            <div>Total Customers</div>
          </div>
        </div>
      </div> 
    </div>
    <div class="col-sm-6 col-lg-6">
      <div class="card text-white bg-gradient-danger pb-4">
        <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
          <div>
            <div class="text-value-lg">{{ $counts['total_suppliers'] }}</div>
            <div>Total Suppliers</div>
          </div>
        </div>
      </div> 
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Weekly Order Details
        </div>
        <div class="card-body">

          @foreach ($weeklyOrders as $wOrder)
          
            <div class="progress-group">
              <div class="progress-group-header">
                <div>{{ \Carbon\Carbon::create($wOrder->date)->format('l') }}</div>
                <div class="mfs-auto font-weight-bold">{{ $wOrder->orders }} Orders</div>
              </div>
              <div class="progress-group-bars">
                <div class="progress progress-xs">
                  <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: {{ (100 * $wOrder->orders) / $weeklyMax }}%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>

          @endforeach

        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          Daily Expense
        </div>
        <div class="card-body">
          <canvas id="daily-expense"></canvas>
        </div>
      </div>
    </div>
  </div>


</div>
    
@endsection

@section('scripts')

<script type="text/javascript">
  var dailyExData = '{!! $dailyExpenses !!}';
  var dDays = Array();
  var dAmnts = Array();
  
  $.each(JSON.parse(dailyExData), function(k, v) {
    dDays.push(v.date);
    dAmnts.push(v.amount);  
  })
  
  var config = {
    type: 'line',
    data: {
      labels: dDays,
      datasets: [{
        label: 'Daily Expense',
        backgroundColor: '#1d5b9a',
        borderColor: '#1d5b9a',
        data: dAmnts,
        fill: false,
      }]
    },
    options: {
      responsive: true,
      tooltips: {
        mode: 'index',
        intersect: false,
      },
      hover: {
        mode: 'nearest',
        intersect: true
      },
      scales: {
        xAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Day'
          }
        }],
        yAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Amount'
          }
        }]
      }
    }
  };
    
  $(document).ready(function() {
    var ctx = document.getElementById('daily-expense').getContext('2d');
		var mExChart = new Chart(ctx, config);
  });


</script>
    
@endsection