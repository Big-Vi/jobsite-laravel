<!DOCTYPE html>
<html>
  <head>
    <title>Welcome Email</title>
  </head>
  <body>
    <h2>Welcome to the site {{$employer['name']}}</h2>
    <br/>
    Your registered email-id is {{$employer['email']}} , Please click on the below link to verify your email account
    <br/>
    <a href="{{url('employer/verify', $employer->verifyEmployer->token)}}">Verify Email</a>
  </body>
</html>