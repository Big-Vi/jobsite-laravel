<!DOCTYPE html>
<html>
  <head>
    <title>Welcome Email</title>
  </head>
  <body>
    <h2>Welcome to the site {{$jobseeker['name']}}</h2>
    <br/>
    Your registered email-id is {{$jobseeker['email']}} , Please click on the below link to verify your email account
    <br/>
    <a href="{{url('jobseeker/verify', $jobseeker->verifyJobseeker->token)}}">Verify Email</a>
  </body>
</html>