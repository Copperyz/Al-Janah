<!DOCTYPE html>
<html>

<head>
    <title>Shipment Status Update</title>
</head>

<body>
    <p>Hello {{ $user->name }},</p>
    <p>We're reaching out to inform you about an update regarding your order shipment.</p>
    <p>The status of your shipment has been changed to <strong>{{ __($status) }}</strong></p>
</body>

</html>
