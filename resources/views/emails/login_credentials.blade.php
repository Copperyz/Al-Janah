<!DOCTYPE html>
<html>
<head>
    <title>{{__('Login Credentials')}}</title>
</head>
<body>
    <p>{{__('Hello')}} {{ $user->name }},</p>
    <p>{{__('Thank you for Shipping with us! Bellow is your password for Log in you can change it later')}}:</p>
    <label>Password</label>
    <h2 style="background-color: #eee;">{{$customer->phone}}</h2>
    <p>{{__('If you did not register on our site, please ignore this email')}}.</p>
</body>
</html>