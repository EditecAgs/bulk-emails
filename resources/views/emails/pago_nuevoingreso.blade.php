{{-- resources/views/emails/curso_propedeutico.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripción Nuevo Ingreso | Instituto Tecnológico de Aguascalientes</title>
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

        .section-title {
            font-size: 11px; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; color: #0a2463;
            margin-bottom: 14px;
            margin-top: 16px;
        }

        .credentials-box {
            background: #eef2ff;
            border-radius: 10px;
            padding: 20px 24px;
            margin: 20px 0;
            border-left: 4px solid #0a2463;
        }
        .credential-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #cbd5e1;
        }
        .credential-row:last-child { border-bottom: none; }
        .credential-label { font-size: 13px; font-weight: 600; color: #1e3a8a; }
        .credential-value {
            font-size: 14px; font-weight: 700; color: #0a2463;
            font-family: monospace; letter-spacing: 0.5px;
        }

        .module-list {
            background: #f9fafb;
            border-radius: 10px;
            padding: 16px 20px;
            margin: 20px 0;
            border: 1px solid #e5e7eb;
        }
        .module-item {
            margin-bottom: 12px;
            font-size: 14px;
            color: #374151;
        }
        .module-item strong {
            color: #0a2463;
        }
        .module-item ul {
            margin-top: 6px;
            margin-left: 20px;
            padding-left: 0;
        }
        .module-item ul li {
            margin-bottom: 4px;
        }
        .support-box {
            background: #f0fdf4;
            border-left: 4px solid #16a34a;
            border-radius: 0 8px 8px 0;
            padding: 16px 20px;
            margin: 20px 0;
        }
        .support-box p {
            font-size: 13px;
            color: #166534;
            line-height: 1.6;
        }
        .warning-box {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            border-radius: 0 8px 8px 0;
            padding: 16px 20px;
            margin: 20px 0;
        }
        .warning-box p {
            font-size: 13px;
            color: #92400e;
            line-height: 1.6;
        }
        .footer {
            background: #1f2937;
            border-radius: 0 0 12px 12px;
            padding: 20px 40px;
            text-align: center;
        }
        .footer p { font-size: 11px; color: rgba(255,255,255,0.3); line-height: 1.6; }
        .footer span { color: rgba(255,255,255,0.5); }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="header-badge">Proceso de Inscripción</div>
            <h1>Inscripción a Educación a Distancia - Nuevo Ingreso</h1>
            <p>Instituto Tecnológico de Aguascalientes</p>
        </div>

        <div class="body">
            <p class="greeting">
                Estimado aspirante: <strong>{{ $nombre_completo }}</strong>
            </p>
            <p class="intro">
                El motivo de este correo es, en primer lugar, felicitarlos por haber sido aceptados para ingresar al Instituto Tecnológico de Aguascalientes, deseándoles mucho éxito en esta nueva etapa académica que están por comenzar.
            </p>
            <p class="intro">
                Por medio del presente, les compartimos la información correspondiente a su proceso de inscripción, el cual se llevará a cabo de forma virtual, a través de la plataforma institucional.
            </p>

            <p class="section-title">Fechas importantes del proceso de inscripción</p>
            <div class="module-list">
                <div class="module-item">
                    <strong>Periodo de pago del semestre:</strong><br>
                    Del <strong>4 al 18 de agosto de 2026</strong>.<br>
                    <span style="font-size: 13px; color: #4b5563;">
                        Las instrucciones para descargar su recibo de pago estarán disponibles en el Paso 4 de la siguiente página:<br>
                        <a href="https://cloud.aguascalientes.tecnm.mx/apply" target="_blank">https://cloud.aguascalientes.tecnm.mx/apply</a><br>
                        También pueden ingresar directamente a:<br>
                        <a href="https://aspirantes.aguascalientes.tecnm.mx/distancia/" target="_blank">https://aspirantes.aguascalientes.tecnm.mx/distancia/</a><br>
                        donde deberán capturar su CURP para que se desplieguen los recibos correspondientes.
                    </span>
                </div>
                <div class="module-item" style="margin-top: 16px;">
                    <strong>Periodo de entrega de documentación:</strong><br>
                    Del <strong>17 al 20 de agosto de 2026</strong>.<br>
                    <span style="font-size: 13px; color: #4b5563;">
                        La entrega se realizará de manera virtual a través del aula correspondiente en la plataforma institucional. Algunos formatos serán proporcionados por la institución, por lo que es importante seguir cuidadosamente las indicaciones que se encontrarán en la plataforma.<br>
                        <strong>Aula para la entrega de documentos:</strong><br>
                        <a href="https://cloud.aguascalientes.tecnm.mx/moodle/course/view.php?id=19235" target="_blank">https://cloud.aguascalientes.tecnm.mx/moodle/course/view.php?id=19235</a>
                    </span>
                </div>
                <div class="module-item" style="margin-top: 16px;">
                    <strong>Inicio de clases:</strong><br>
                    <strong>24 de agosto de 2026</strong>.
                </div>
            </div>

            <p class="section-title">Accesos a la plataforma</p>
            <div class="credentials-box">
                <div class="credential-row">
                    <span class="credential-label">Enlace de acceso:&nbsp; </span>
                    <span class="credential-value">
                        <a href="https://cloud.aguascalientes.tecnm.mx/login" target="_blank" style="font-family: 'Segoe UI', sans-serif; font-weight: 400;">https://cloud.aguascalientes.tecnm.mx/login</a>
                    </span>
                </div>
                <div class="credential-row">
                    <span class="credential-label">Usuario: </span>
                    <span class="credential-value">&nbsp;{{ $username }}</span>
                </div>
                <div class="credential-row">
                    <span class="credential-label">Contraseña: </span>
                    <span class="credential-value">&nbsp;Prueba123$</span>
                </div>
            </div>
            <p class="intro" style="margin-top: -8px; font-size: 13px;">
                <strong>Nota:</strong> La contraseña es <strong>Prueba123$</strong> (con 'P' mayúscula, seguido de 'rueba123$'). Al ingresar por primera vez, el sistema te solicitará cambiarla.
            </p>

            <div class="support-box">
                <p>
                    <strong>Contacto:</strong> Cualquier duda o comentario, favor de contactarnos por los medios institucionales al correo ead.soporte@aguascalientes.tecnm.mx y ead.carreras@aguascalientes.tecnm.mx
                </p>
            </div>

            <div class="warning-box">
                <p>
                    <strong>Confirmación de recibido:</strong> Favor de confirmar la recepción del presente correo.
                </p>
            </div>

            <p class="intro">
                Sin más por el momento, el Departamento de Educación a Distancia les da la más cordial bienvenida y les desea mucho éxito en esta nueva etapa.
            </p>

            <p class="intro" style="margin-top: 20px;">
                Atentamente,<br>
                <strong>Coordinación de Educación a Distancia</strong><br>
                Instituto Tecnológico de Aguascalientes
            </p>
        </div>

        <div class="footer">
            <p>
                © 2026 <span>Instituto Tecnológico de Aguascalientes</span> — Educación a Distancia
            </p>
        </div>
    </div>
</body>
</html>