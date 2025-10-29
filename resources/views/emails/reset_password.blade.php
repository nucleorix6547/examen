<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Restablecer contraseña</title>
</head>
<body style="font-family: Arial, sans-serif; line-height:1.6; color:#333;">
    <div style="max-width:600px; margin:2 auto; padding:20px;">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:20px; height:20px; border-radius:50%;">
        <h2>Hola {{ $nombre }},</h2>

        <p>Recibimos una solicitud para restablecer la contraseña de tu cuenta. Haz clic en el botón de abajo para crear una nueva contraseña. Si no solicitaste este cambio, ignora este correo.</p>

        <p style="text-align:center; margin:30px 0;">
            <a href="{{ $link }}" style="background:#2563EB; color:#fff; padding:12px 22px; border-radius:8px; text-decoration:none; font-weight:600;">Restablecer contraseña</a>
        </p>

        <p>Si el botón no funciona, copia y pega este enlace en tu navegador:</p>
        <p><small>{{ $link }}</small></p>

        <hr>
        <p style="color:#666; font-size:12px;">Si no solicitaste restablecer la contraseña, puedes ignorar este correo.</p>
    </div>
</body>
</html>