<!DOCTYPE html>
<html>
<head>
    <title>{{ $data['title'] }}</title>
</head>
<body>
    <h1>{{ $data['title'] }}</h1>
    <p>Hi {{ $data['name'] }},</p>
    <p>{{ $data['message'] }}</p>
    <p>
        <a href="{{ $data['reset_link'] }}" style="padding: 10px 15px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">
            Reset Password
        </a>
    </p>
    <p>If you did not request a password reset, you can ignore this email.</p>
</body>
</html>
