{{-- resources/views/emails/extension_pago.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extensión de pago | Instituto Tecnológico de Aguascalientes</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #f0f2f5; font-family: 'Segoe UI', Roboto, Arial, sans-serif; padding: 32px 16px; }
        .wrapper { max-width: 600px; margin: 0 auto; }

        .header {
            background: #0a2463;
            border-radius: 12px 12px 0 0;
            padding: 32px 40px;
            text-align: center;
        }
        .header-icon {
            width: 56px; height: 56px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
            font-size: 26px;
        }
        .header-badge {
            display: inline-block;
            font-size: 10px; font-weight: 700; letter-spacing: 2px;
            text-transform: uppercase; color: rgba(255,255,255,0.7);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 20px; padding: 4px 14px; margin-bottom: 14px;
            background: rgba(255,255,255,0.05);
        }
        .header h1 { font-size: 24px; font-weight: 700; color: #ffffff; line-height: 1.3; margin-bottom: 6px; }
        .header p { font-size: 13px; color: rgba(255,255,255,0.5); }

        .body { background: #ffffff; padding: 40px; border-left: 1px solid #e5e7eb; border-right: 1px solid #e5e7eb; }

        .greeting { font-size: 16px; font-weight: 700; color: #1f2937; margin-bottom: 12px; }
        .intro { font-size: 14px; color: #4b5563; line-height: 1.7; margin-bottom: 24px; }

        .info-box {
            background: #eef2ff;
            border-left: 4px solid #0a2463;
            border-radius: 0 8px 8px 0;
            padding: 16px 20px;
            margin-bottom: 24px;
        }
        .info-box p { font-size: 13.5px; color: #1e3a8a; line-height: 1.7; font-weight: 500; }

        .section-title {
            font-size: 11px; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; color: #0a2463;
            margin-bottom: 14px;
        }

        .details-table {
            width: 100%;
            background: #f9fafb;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            margin-bottom: 24px;
            border-collapse: collapse;
        }
        .details-table td {
            padding: 12px 16px;
            font-size: 13px;
            border-bottom: 1px solid #e5e7eb;
        }
        .details-table td:first-child {
            font-weight: 600;
            color: #374151;
            width: 40%;
        }
        .details-table td:last-child {
            color: #0a2463;
            font-weight: 500;
        }
        .details-table tr:last-child td {
            border-bottom: none;
        }

        .highlight {
            color: #dc2626;
            font-weight: 700;
        }

        .btn {
            display: block; text-align: center;
            background: #0a2463;
            color: #fff; font-size: 14px; font-weight: 700;
            padding: 12px 24px; border-radius: 10px;
            text-decoration: none; margin-bottom: 24px;
            transition: background 0.2s ease;
        }
        .btn:hover {
            background: #1e3a8a;
        }

        .warning-box {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            border-radius: 0 8px 8px 0;
            padding: 16px 20px;
            margin-bottom: 24px;
        }
        .warning-box p { font-size: 13px; color: #92400e; line-height: 1.6; }

        .contact-box {
            background: #f3f4f6;
            border-radius: 10px;
            padding: 20px 24px;
            margin-bottom: 8px;
        }
        .contact-title {
            font-size: 11px; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; color: #4b5563;
            margin-bottom: 12px;
        }
        .contact-item { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; }
        .contact-item:last-child { margin-bottom: 0; }
        .contact-dot { width: 6px; height: 6px; border-radius: 50%; background: #9ca3af; flex-shrink: 0; }
        .contact-item p { font-size: 13px; color: #4b5563; }
        .contact-item a { color: #0a2463; text-decoration: none; font-weight: 500; }

        .footer { background: #1f2937; border-radius: 0 0 12px 12px; padding: 20px 40px; text-align: center; }
        .footer p { font-size: 11px; color: rgba(255,255,255,0.3); line-height: 1.6; }
        .footer span { color: rgba(255,255,255,0.5); }
    </style>
</head>
<body>
    <div class="wrapper">

        {{-- Header --}}
        <div class="header">
            <div class="header-badge">Convocatoria · Educación a Distancia</div>
            <h1>Extensión de plazo para pago</h1>
            <p>Instituto Tecnológico de Aguascalientes</p>
        </div>

        {{-- Body --}}
        <div class="body">
            <p class="greeting">
                Estimado(a) aspirante <strong>{{ $nombre_completo }}</strong>,
            </p>

            <p class="intro">
                Por medio de la presente, te informamos que se ha <strong>ampliado el plazo</strong> para realizar el pago de 
                <strong>{{ $concepto }}</strong> correspondiente al proceso de admisión de la <strong>modalidad a distancia</strong>.
            </p>

            <div class="info-box">
                <p>
                    ✅ Si aún continúas interesado(a) en formar parte de nuestro modelo educativo, 
                    <strong>aún estás a tiempo de completar tu registro</strong>. Hemos recibido múltiples solicitudes y 
                    queremos darte la oportunidad de concluir tu proceso.
                </p>
            </div>

            <p class="section-title">Detalles del pago</p>
            <table class="details-table">
                <tr>
                    <td>Carrera</td>
                    <td><strong>{{ $carrera }}</strong></td>
                </tr>
                <tr>
                    <td>Concepto</td>
                    <td>{{ $concepto }}</td>
                </tr>
                <tr>
                    <td>Monto</td>
                    <td class="highlight">${{ number_format(floatval($monto), 2) }} MXN</td>
                </tr>
                <tr>
                    <td>Nueva fecha límite</td>
                    <td><strong>{{ \Carbon\Carbon::parse($fecha_limite)->format('d \d\e F \d\e Y') }}</strong> (sin excepción)</td>
                </tr>
                <tr>
                    <td>CURP</td>
                    <td>{{ $curp }}</td>
                </tr>
            </table>


            <div class="warning-box">
                <p>
                    <strong>⚠️ Importante:</strong> Si deseas continuar con tu proceso de admisión y 
                    <strong>aún no has realizado el pago</strong>, es indispensable que nos respondas a este correo 
                    indicando tu <strong>CURP ({{ $curp }})</strong> y la carrera (<strong>{{ $carrera }}</strong>).
                    <br><br>
                    De esta forma, podremos enviarte la <strong>ficha de pago actualizada</strong> con la nueva fecha límite 
                    y los datos correctos para que realices tu pago correspondiente.
                </p>
            </div>

            <div class="info-box">
                <p>
                    Si ya realizaste tu pago, favor de contestar a este correo con el comprobante correspodiente.
                </p>
            </div>

            <div class="contact-box">
                <p class="contact-title">¿Necesitas más información?</p>
                <div class="contact-item">
                    <p>Correo: <a href="mailto:ead@aguascalientes.tecnm.mx">ead@aguascalientes.tecnm.mx</a></p>
                </div>
                <div class="contact-item">
                    <p>Teléfono: (449) 910 50 02 ext. 125</p>
                </div>
                <div class="contact-item">
                    <p>Horario de atención: 9:00 a 15:00 hrs</p>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="footer">
            <p>
                Este correo es generado automáticamente.<br>
                © 2026 <span>Instituto Tecnológico de Aguascalientes</span> — Educación a Distancia
            </p>
        </div>
    </div>
</body>
</html>