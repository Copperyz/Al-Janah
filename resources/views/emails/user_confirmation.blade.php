<!DOCTYPE html>
<html>
<head>
    <title>{{__('Account Confirmation')}}</title>
</head>
<body>
    <p>{{__('Hello')}} {{ $user->name }},</p>
    <p>{{__('Thank you for registering! Please click the link below to confirm your account')}}:</p>
    <a href="{{ route('confirm-account', $token) }}">Confirm Account</a>
    <p>{{__('If you did not register on our site, please ignore this email')}}.</p>
</body>
</html>