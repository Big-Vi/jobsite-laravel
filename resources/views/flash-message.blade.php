@if ($message = Session::get('success'))
<div class='container'>
<div div='row'>
<div class="green-text center-align col m6 offset-m3">
    <strong>{{ $message }}</strong>
</div>
</div>
</div>


@endif