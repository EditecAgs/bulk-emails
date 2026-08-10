{{-- resources/views/emails/curso_propedeutico.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso Propedéutico | Instituto Tecnológico de Aguascalientes</title>
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

        .access-link {
            display: inline-block;
            background: #0a2463;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            margin: 16px 0 8px;
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
            <div class="header-badge">Curso Propedéutico</div>
            <h1>Acceso a Plataforma Virtual</h1>
            <p>Instituto Tecnológico de Aguascalientes</p>
        </div>

        <div class="body">
            <p class="greeting">
                Estimado(a) aspirante <strong>{{ $nombre_completo }}</strong>,
            </p>
            <p class="intro">
                Por medio de la presente, le compartimos sus accesos a la plataforma virtual donde tendrá acceso al <strong>Curso Propedéutico de Admisión</strong> para la <strong>modalidad a Distancia</strong>.
            </p>

            <div class="credentials-box">
                <div class="credential-row">
                    <span class="credential-label">Enlace de acceso:&nbsp; </span>
                    <span class="credential-value">
                        <a href="https://cloud.aguascalientes.tecnm.mx/login" style="color:#0a2463;">https://cloud.aguascalientes.tecnm.mx/login</a>
                    </span>
                </div>
                <div class="credential-row">
                    <span class="credential-label">Usuario: </span>
                    <span class="credential-value">&nbsp;{{ $username }}</span>
                </div>
                <div class="credential-row">
                    <span class="credential-label">Contraseña temporal: </span>
                    <span class="credential-value">&nbsp;Prueba123$</span>
                </div>
            </div>

            <p class="intro" style="margin-top: -8px;">
                <strong>Nota:</strong> La contraseña es <strong>Prueba123$</strong> (con 'P' mayúscula, seguido de 'rueba123$'). Al ingresar por primera vez, el sistema te solicitará cambiarla.
            </p>

            <p class="section-title">📅 Calendario del curso</p>
            <div class="module-list">
                <div class="module-item">
                    <strong>🔹 Lunes 25 de mayo de 2026</strong> – Inicia el <strong>Módulo 1: Manejo de plataforma Moodle y herramientas computacionales</strong><br>
                    <span style="font-size: 13px; color: #4b5563;">Duración: 1 semana (del 25 al 31 de mayo).</span>
                </div>
                <div class="module-item">
                    <strong>🔸 A partir del 1 de junio de 2026</strong> – Se activarán los siguientes módulos (disponibles hasta el 12 de junio):
                    <ul style="margin-top: 6px; margin-left: 20px;">
                        <li><strong>Módulo 2:</strong> Lineamientos y trabajo en equipo (1 semana).</li>
                        <li><strong>Módulo 3:</strong> Habilidades matemáticas (2 semanas).</li>
                    </ul>
                </div>
            </div>

            <div class="support-box">
                <p>
                    <strong>Soporte técnico:</strong> Si presentas algún problema para acceder a la plataforma, olvidaste tu contraseña o tienes dificultades técnicas, escribe al correo:<br>
                    <a href="mailto:ead.soporte@aguascalientes.tecnm.mx" style="color:#166534; font-weight:600;">ead.soporte@aguascalientes.tecnm.mx</a>
                </p>
            </div>

            <div class="warning-box">
                <p>
                    ⚠️ <strong>Importante:</strong> Es indispensable completar el curso propedéutico para continuar con el proceso de admisión. 
                    Los módulos se irán habilitando en las fechas indicadas, respetando el calendario establecido.
                </p>
            </div>

            <p class="intro">
                Quedamos atentos a cualquier duda o aclaración. Le deseamos mucho éxito en esta nueva etapa que está por comenzar.
            </p>

            <p class="intro" style="margin-top: 20px;">
                Saludos cordiales,<br>
                <strong>Coordinación de Educación a Distancia</strong><br>
                Instituto Tecnológico de Aguascalientes
            </p>
        </div>

        <div class="footer">
            <p>
                Este correo es generado automáticamente. Por favor no responder a esta dirección.<br>
                © 2026 <span>Instituto Tecnológico de Aguascalientes</span> — Educación a Distancia
            </p>
        </div>
    </div>
</body>
</html>