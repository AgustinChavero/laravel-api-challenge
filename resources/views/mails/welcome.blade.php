<!DOCTYPE html>
<html>
<head>
    <title>{{ $data['title'] }}</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; margin: 0;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h1 style="font-size: 24px; color: #333333; text-align: center;">{{ $data['title'] }}</h1>
        <p style="font-size: 16px; color: #555555; line-height: 1.5; text-align: center;">
            Hola {{ $data['name'] }},
        </p>
        <p style="font-size: 16px; color: #555555; line-height: 1.5; text-align: center;">
            {{ $data['message'] }}
        </p>
        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ $data['verification_link'] ?? '#' }}" style="display: inline-block; background-color: #4CAF50; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-size: 16px;">
                Verificar correo
            </a>
        </div>
        <p style="font-size: 14px; color: #999999; text-align: center; margin-top: 20px;">
            Si no solicitaste esta cuenta, puedes ignorar este correo.
        </p>
    </div>
</body>
</html>
