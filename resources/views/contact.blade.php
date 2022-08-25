@extends('layouts.app')

@section('content')
@include('flash-message')
<div class="row">
    <form method='POST' action="/contact" class="col s12">
        @csrf
      <div class="row">
        <div class="input-field col s6 m6 offset-m3">
          <i class="material-icons prefix">account_circle</i>
          <input id="icon_prefix" type="text" name='fullname' required class="validate">
          <label for="icon_prefix">Full Name</label>
        </div>
        <div class="input-field col s6 m6 offset-m3">
          <i class="material-icons prefix">email</i>
          <input id="icon_email" name='email' type="email" required class="validate">
          <label for="icon_email">Email</label>
        </div>
        <div class="input-field col s6 m6 offset-m3">
          <i class="material-icons prefix">phone</i>
          <input id="icon_telephone" name='mobile' type="tel" class="validate">
          <label for="icon_telephone">Mobile No</label>
        </div>
        <div class="input-field col s12 m6 offset-m3">
          <textarea name='message' id="textarea1" required class="materialize-textarea"></textarea>
          <label for="textarea1">Textarea</label>
        </div>
        <div class="input-field col s12 m6 offset-m3">
          <button type='submit' class='btn waves-effect'>Submit</button>
        </div>
    </form>
  </div>
@endsection
