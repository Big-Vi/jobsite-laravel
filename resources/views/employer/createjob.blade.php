@extends('layouts.app')
@section('stylesheets')
    <script src="https://cloud.tinymce.com/4.4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector:"[name='description']",
            plugins: 'link',
        });
    </script>
@endsection
@section('content')
<div class="container">
    <div class="row createJob">
        <div>
        <form method='POST' class="require-validation" 
            data-cc-on-file="false"
            data-stripe-publishable-key="pk_test_qczoJOy0ehozQf5h2PuFwFwE"
            id="payment-form"
            id='createJob' 
            action="{{route('employer.job.create')}}" 
            enctype="multipart/form-data">
            @csrf
            <div>
                <div class='mb-2' style="float:right;">
                    <a id="prevBtn" class="waves-effect waves-light btn black" onclick="nextPrev(-1)">Previous</a>
                    <a class="waves-effect waves-light btn black" id="nextBtn" onclick="nextPrev(1)">Next</a>
                </div> 
            <div class='tab'>
                <div class='form-group'>
                    <label>Job Title</label>
                    <input class='form-control' required type='text' name='title'>
                </div> 
                <div class='form-group'>
                    <label>Description</label>
                    <textarea required type='textarea' name='description'><input type=hidden value="No description to show"></textarea>
                </div> 
                <div class='input-field'>
                    <label>Pitch(140 Words)</label>
                    <textarea id='pitch' class='pitch' type='textarea' name='pitch'></textarea>
                </div>
                <div class='input-field'>
                    <select id='worktype' name='worktype'>
                    <option value=''>Work Type</option>
                    <option>Full time</option>
                    <option>Part time</option>
                    <option>Contract/Temp</option>
                    <option>Casual/Vacation</option>
                </select>
                </div>
                <createjobcategory></createjobcategory>
                <div class='form-group'>
                    <input class="file" type='file' name='logo'>
                </div>
            </div>
            <div class='tab form-group'> 
                <label>Location</label>
                <input class='form-control' type='text' name='location'><br>
                <label>Pay range - Enter max amount</label>
                <input class='form-control' type='text' name='payrange'><br>
            </div>
            <input hidden name='active' value='1'>
            <div class='tab'> 
                    <h1>Payment</h1>
                    <div class='form-group'>
                        <label class='control-label'>Name on Card</label> 
                        <input class='form-control' size='4' type='text' value='vignesh'>
                    </div>
                    <div class='form-group'>
                        <label class='control-label'>Card Number</label> 
                        <input autocomplete='off' class='form-control card-number' size='20'     type='text' value='4242424242424242'>
                    </div>
                    <div class='row'>
                        <div class='col-xs-12 col-md-4 cvc required'>
                            <label class='control-label'>CVC</label> 
                            <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text' value='211'>
                        </div>
                        <div class='col-xs-12 col-md-4 expiration required'>
                            <label class='control-label'>Expiration Month</label> 
                            <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text' value='12'>
                        </div>
                        <div class='col-xs-12 col-md-4 expiration required'>
                            <label class='control-label'>Expiration Year</label> 
                            <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text' value='24'>
                        </div>
                    </div><br>
                    <button class="col-xs-12 col-md-6 btn btn-primary btn-lg btn-block" type="submit">Pay Now ($100)</button>
 
            </div>
            <div style="text-align:center;margin-top:40px;">
                <span class="step"></span>
                <span class="step"></span>
            </div>
        </form>
        </div>
        @include('inc.errors')
    </div>
</div>
@endsection
