{{-- resources/views/emails/recordatorio-pago.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recordatorio de pago - Convocatoria de Admisión</title>
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
                            Convocatoria de Admisión<br>
                            <span style="font-size:16px;">Educación a Distancia</span>
                        </h1>
                    </td>
                </tr>
                
                <!-- BODY -->
                <tr>
                    <td style="padding:30px; color:#333333; font-size:14px; line-height:1.6;">
                        <p>Estimado(a) aspirante <strong>{{ $nombre_completo }}</strong>:</p>
                        
                        <p>
                            Por medio de la presente, le informamos que el periodo de la convocatoria de admisión está próximo a cerrar. 
                            Por tal motivo, es indispensable realizar el pago de <strong>{{ $concepto }}</strong> en tiempo y forma 
                            para poder participar en el curso propedéutico de selección, el cual se llevará a cabo del 
                            <strong>25 de Mayo al 12 de junio del presente año</strong>.
                        </p>
                        
                        <table width="100%" cellpadding="10" cellspacing="0"
                               style="background:#e8f4fd; border-radius:6px; margin:15px 0; border-left:4px solid #0b5ed7;">
                            <tr>
                                <td style="font-weight:bold; width:40%;">Concepto a pagar:</td>
                                <td>{{ $concepto }}</td>
                            </tr>
                             <tr>
                                <td style="font-weight:bold; width:40%;">Carrera a ingresar:</td>
                                <td>{{ $carrera }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight:bold;">Monto:</td>
                                <td><strong style="color:#0b5ed7; font-size:16px;">${{ number_format($monto, 2) }}</strong> MXN</td>
                            </tr>
                            <tr>
                                <td style="font-weight:bold;">📅 Fecha límite de pago:</td>
                                <td><strong style="color:#dc2626;">{{ \Carbon\Carbon::parse($fecha_limite)->format('d \d\e F \d\e Y') }}</strong> (sin excepción)</td>
                            </tr>
                        </table>
                        
                        <p style="margin-top:20px;">
                            <strong>📌 Nota importante:</strong><br>
                            En caso de tener algún inconveniente para descargar su ficha de pago, 
                            le solicitamos responder a este correo indicando su <strong>CURP: {{ $curp ?? 'No especificado' }}</strong>, 
                            para poder brindarle el apoyo correspondiente.
                        </p>
                        
                        <p style="margin-top:20px; text-align:center; background:#e8f4fd; padding:15px; border-radius:8px;">
                            <strong>📎 Si usted ya realizó su pago</strong><br>
                            Le pedimos amablemente enviar una captura del comprobante como respuesta a este mismo correo.
                        </p>
                        
                        <p style="margin-top:20px;">
                            Finalmente, le solicitamos <strong>confirmar de recibido este mensaje</strong> para llevar un mejor seguimiento de su proceso.
                        </p>
                        
                        <p style="margin-top:20px;">
                            Sin más por el momento, quedamos atentos a cualquier duda o aclaración.
                        </p>
                        
                        <hr style="border:none; border-top:1px solid #e5e7eb; margin:30px 0;">
                        
                        <p style="margin-top:25px;">
                            Saludos cordiales,<br>
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