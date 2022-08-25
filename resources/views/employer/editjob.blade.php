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
    <div class="row editjob-form-employer justify-content-center">
        <div class="col-md-8">
            <span><a href='/employer'>Go Back</a></span>
            <h1>Edit a job</h1>
            <form method='POST' action="/employer/job/{{$job->id}}/edit" enctype="multipart/form-data">
                @csrf
                <div style="overflow:auto;">
                    <div style="float:right;">
                        <a id="prevBtn" class="waves-effect waves-light btn black" onclick="nextPrev(-1)">Previous</a>
                        <a class="waves-effect waves-light btn black" id="nextBtn" onclick="nextPrev(1)">Next</a>

                    </div>
                    <div class='tab'>
                        <div class='form-group'>
                            <label>Job Title</label>
                            <?php $value = strpos($job->title, '-'); ?>
                            <input class='form-control' required type='text' name='title'
                                value='{{substr($job->title,0,$value)}}'>
                        </div>
                        <div class='form-group'>
                            <label>Description</label>
                            <textarea required type='textarea' name='description'>{!!$job->description!!}</textarea>
                        </div>
                        <div class='input-field'>
                            <label>Pitch(140 Words)</label>
                            <textarea id='pitch' class='pitch' type='textarea' name='pitch'>{!!$job->pitch!!}</textarea>
                        </div>
                        <div class='input-field'>
                            <select id='worktype' name='worktype'>
                                <option value=''>Work Type</option>
                                <option {{ $job->worktype == 'Full time' ? 'selected' : '' }}>Full time</option>
                                <option {{ $job->worktype == 'Part time' ? 'selected' : '' }}>Part time</option>
                                <option {{ $job->worktype == 'Contract/Temp' ? 'selected' : '' }}>Contract/Temp</option>
                                <option {{ $job->worktype == 'Casual/Vacation' ? 'selected' : '' }}>Casual/Vacation
                                </option>
                            </select>
                        </div>
                    </div>
                    <editjobcategory :cate='{{$job}}'></editjobcategory>
                    <div class='tab form-group'>
                        <label>Location</label>
                        <input value='{{$job->location}}' class='form-control' type='text' name='location'><br>
                        <label>Pay range - Enter max amount</label>
                        <input value='{{$job->payrange}}' class='form-control' type='text' name='payrange'><br>
                        <div class='form-group'>
                            <input hidden class="form-control-file" id='img_upload' type='file' name='logo'>
                            <img id="preview" style='width:150px;height:150px;'
                                src='/storage/jobs/{{$job->title}}/logo_images/{{$job->logo}}'>
                            <a href='#' id='change'>Change</a> |
                            <a style="color: red" href='#' id='remove'>Remove</a>
                            <input type="hidden" style="display: none" value="0" name="remove" id="remove">
                        </div>
                    </div>
                    <div style="text-align:center;margin-top:40px;">
                        <span class="step"></span>
                        <span class="step"></span>
                    </div>
                    <button type='submit' class='btn btn-primary'>Update</button>
            </form>
        </div>
        @include('inc.errors')
    </div>
</div>
@endsection

<script>
    window.onload = function() {
  //YOUR JQUERY CODE

$('#remove').click(function() {
            $('#preview').attr('src', '{{url('noimage.jpg')}}');
            $('#img_upload').val('');
        });
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.readAsDataURL(input.files[0]);
            reader.onload = function (e) {
                console.log("File contents: " + e.target.result);
                $('#preview').attr('src', e.target.result);
                $('#remove').val(0);
            }
            
        }
    }
$('#img_upload').on('change',function(e){
        var imgPath = $(this)[0].value;
            var ext = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "gif" || ext == "png" || ext == "jpg" || ext == "jpeg")
                readURL(this);
            else
                alert("Please select image file (jpg, jpeg, png).")
    });
$('#change').click(function() {
            $('#img_upload').click();
        });
 }
</script>