<!DOCTYPE html>
<html>
<head>
<title>
    User Request New Password
</title>
<body>
    <div>
    <p>
    Hi {{$first_name}},
    </p>
    <p>
    You're receiving this email because you requested a password reset for your user account at (Business Name) Blinds.
    <br/>
    Please go to the following page and choose a new password:
    </p>
    <a target="_blank" href="{{env('FSWB_URL')}}/reset-password/{{$user_id}}/{{$current_time_stamp}}">
        {{env('FSWB_URL')}}/reset-password/{{$user_id}}/{{$current_time_stamp}}
    </a>
    <p>
    If the above link does not work, copy and paste the link manually into your browser.
    </p>
    Thanks for using our site!
    <br/>
    Thanks,
    <p>
    <p>
    (Business Name) Blinds Team
    </p>    
    </div>
</body>
</head>
</html>