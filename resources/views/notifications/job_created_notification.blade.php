<a onclick='readNotification(this)' 
href='/employer/job/{{$notification->data['jobinfo']['id']}}' 
data-notifid="{{$notification->id}}">
    you created <strong>{{$notification->data['jobinfo']['title']}}</strong> a job
</a>