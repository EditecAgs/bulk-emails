<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Activación de correo institucional Microsoft 365</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0; padding:0; background-color:#f4f6f8; font-family: Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f8; padding:20px 0;">
    <tr>
        <td align="center">

            <table width="600" cellpadding="0" cellspacing="0"
                   style="background:#ffffff; border-radius:10px; overflow:hidden;
                   box-shadow:0 4px 10px rgba(0,0,0,0.08);">
                <!-- HEADER -->
                <tr>
                    <td style="background:#0b5ed7; color:#ffffff; padding:25px; text-align:center;">
                        <h1 style="margin:0; font-size:22px; line-height:1.3;">
                            Activación de correo institucional<br>
                            Microsoft 365
                        </h1>
                    </td>
                </tr>
                <!-- BODY -->
                <tr>
                    <td style="padding:30px; color:#333333; font-size:14px; line-height:1.6;">
                        <p>Estimado/a <strong>{{ $name }}</strong>:</p>
                        <p>
                            Te informamos que ya se encuentra disponible la activación de tu
                            <strong>correo institucional Microsoft Office 365</strong>.
                        </p>
                        <p>
                            A continuación, te compartimos tus datos de acceso iniciales:
                        </p>
                        <table width="100%" cellpadding="10" cellspacing="0"
                               style="background:#f8fafc; border-radius:6px; margin:15px 0;">
                            <tr>
                                <td style="font-weight:bold; width:40%;">Correo institucional:</td>
                                <td>{{ $email }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight:bold;">Contraseña inicial:</td>
                                <td>{{ $password }}</td>
                            </tr>
                        </table>
                        <p style="margin-top:20px; text-align:center;">
                            <a href="{{ $url }}"
                               style="background:#0b5ed7; color:#ffffff; text-decoration:none;
                               padding:14px 25px; border-radius:6px; font-weight:bold;
                               display:inline-block;">
                                Activar mi correo institucional
                            </a>
                        </p>
                        <p style="margin-top:25px;">
                            <strong>⚠️ Importante:</strong><br>
                            El enlace de activación estará disponible únicamente durante
                            <strong>7 días</strong>. Posterior a este periodo, la contraseña
                            inicial <strong>caducará automáticamente</strong>.
                        </p>
                        <hr style="border:none; border-top:1px solid #e5e7eb; margin:30px 0;">
                        <h3 style="margin-bottom:10px; color:#0b5ed7;">
                            Al ingresar por primera vez
                        </h3>
                        <ul style="padding-left:18px;">
                            <li>El sistema te solicitará cambiar tu contraseña.</li>
                            <li>
                                Se recomienda activar la
                                <strong>autenticación en dos pasos</strong>
                                para mayor seguridad de tu cuenta.
                            </li>
                        </ul>
                        <h3 style="margin-top:25px; margin-bottom:10px; color:#0b5ed7;">
                            Beneficios de tu cuenta Microsoft 365
                        </h3>
                        <ul style="padding-left:18px;">
                            <li>Correo institucional oficial.</li>
                            <li>Microsoft Teams para clases y comunicación académica.</li>
                            <li>OneDrive con almacenamiento en la nube.</li>
                            <li>Aplicaciones Office (Word, Excel, PowerPoint, entre otras).</li>
                            <li>Acceso a plataformas y servicios institucionales.</li>
                        </ul>
                        <hr style="border:none; border-top:1px solid #e5e7eb; margin:30px 0;">

                        <h3 style="margin-bottom:10px; color:#0b5ed7;">
                            Soporte y contacto
                        </h3>
                        <p>
                            En caso de presentar algún inconveniente durante el proceso de
                            activación, comunícate con el <strong>Centro de Cómputo</strong>:
                        </p>
                        <p>
                            📧
                            <a href="mailto:ccomputo@aguascalientes.tecnm.mx">
                                ccomputo@aguascalientes.tecnm.mx
                            </a><br>
                            ☎️ 910 50 02 ext. 145
                        </p>
                        <p style="margin-top:30px;">
                            Agradecemos tu atención y te exhortamos a realizar la activación
                            dentro del periodo establecido.
                        </p>
                        <p style="margin-top:25px;">
                            Atentamente,<br>
                            <strong>Coordinación de Educación a Distancia</strong><br>
                            Instituto Tecnológico de Aguascalientes
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
