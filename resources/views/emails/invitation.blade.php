<!DOCTYPE html>
<html>
<head>
    <title>Event Invitation</title>
</head>
<body>
    <p>Hello {{ $guest->name }},</p>
    
    <p>You have been invited to an event.</p>
    
    <p>Please login to this link to accept invitation:</p>
    
    <p><a href="{{ url('/guest/login') }}">Click here to respond to the invitation</a></p>
    
    <p>Thank you!</p>
</body>
</html> 