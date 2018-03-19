@extends('layouts.master')
@include('layouts.navigation')
<div class="container col-md-4">
    <h2>Exchange</h2><br>
    <div class="form-group">
      <label for="currency">Select currency:</label>
      <select class="form-control calculate-amount" id="currency" onchange="calculateAmount(event)">
        <option value="">Select</option>
        @foreach($currencies as $currency)
            <option value="{{ $currency->id }}">
                {{ $currency->name.' ('.$currency->short_name.')' }}
            </option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="amount">Amount:</label>
      <input type="text" class="form-control calculate-amount" id="amount" onkeypress='checkIfNumber(event)' onkeyup="calculateAmount(event)">
    </div>
    <div class="form-group payment-div">
    </div>
</div>
<div id="purchaseModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">You have successfully purchased:</h4>
              <button type="button" class="close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="modal-text"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
            </div>
        </div>

    </div>
</div>
