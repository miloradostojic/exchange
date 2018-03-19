@extends('layouts.master')
@include('layouts.navigation')
@if (Session::has('message'))
   <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="container col-md-4">
    <h2>Settings</h2><br>
    {{ Form::open(array('url' => 'settings/edit')) }}
        <div class="form-group">
          <label for="email">Email address:</label>
          <input type="text" class="form-control" name="email" value="{{ $settings->email }}">
        </div>
        <p>Discounts (%):</p>
        @foreach($currencies as $currency)
            <div class="form-group">
              <label for="{{ $currency->name }}">{{ $currency->name }}:</label>
              <input type="text" class="form-control" name="currencies[{{ $currency->id }}]" value="{{ $currency->discount_percent }}">
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Change</button>
    {{ Form::close() }}
</div>
