{{-- resources/views/emails/aceptacion-diplomado.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Fuiste aceptado! | Diplomado ASICs</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #f4f0f1; font-family: Arial, sans-serif; padding: 32px 16px; }
        .wrapper { max-width: 600px; margin: 0 auto; }

        .header {
            background: #611232;
            border-radius: 12px 12px 0 0;
            padding: 36px 40px;
            text-align: center;
        }
        .header-icon {
            width: 56px; height: 56px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
            font-size: 22px;
        }
        .header-badge {
            display: inline-block;
            font-size: 10px; font-weight: 700; letter-spacing: 2px;
            text-transform: uppercase; color: rgba(240,160,184,0.9);
            border: 1px solid rgba(240,160,184,0.3);
            border-radius: 20px; padding: 4px 14px; margin-bottom: 14px;
            background: rgba(240,160,184,0.08);
        }
        .header h1 { font-size: 24px; font-weight: 700; color: #ffffff; line-height: 1.3; margin-bottom: 6px; }
        .header p { font-size: 13px; color: rgba(255,255,255,0.5); }

        .body { background: #ffffff; padding: 40px; border-left: 1px solid #e5dde0; border-right: 1px solid #e5dde0; }

        .greeting { font-size: 16px; font-weight: 700; color: #1a0510; margin-bottom: 12px; }
        .intro { font-size: 14px; color: #4b2535; line-height: 1.7; margin-bottom: 24px; }

        .success-box {
            background: #f0fdf4;
            border-left: 4px solid #16a34a;
            border-radius: 0 8px 8px 0;
            padding: 16px 20px;
            margin-bottom: 24px;
        }
        .success-box p { font-size: 13.5px; color: #15803d; line-height: 1.7; font-weight: 500; }

        .section-title {
            font-size: 11px; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; color: #611232;
            margin-bottom: 14px;
        }

        .credentials-box {
            background: #1a0510;
            border-radius: 10px;
            padding: 24px;
            margin-bottom: 24px;
        }
        .credentials-title {
            font-size: 11px; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; color: rgba(240,160,184,0.6);
            margin-bottom: 16px;
        }
        .credential-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid rgba(97,18,50,0.3);
        }
        .credential-row:last-child { border-bottom: none; }
        .credential-label { font-size: 12px; color: rgba(255,255,255,0.4); }
        .credential-value {
            font-size: 14px; font-weight: 700; color: #f0a0b8;
            font-family: monospace; letter-spacing: 1px;
        }

        .access-btn {
            display: block; text-align: center;
            background: linear-gradient(135deg, #B9925B, #d4a96a, #9a7440);
            color: #fff; font-size: 14px; font-weight: 700;
            padding: 14px 24px; border-radius: 10px;
            text-decoration: none; margin-bottom: 24px;
            border: 1px solid rgba(255,255,255,0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .access-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(185,146,91,0.3);
        }

        .date-box {
            background: #fdf7f9;
            border: 1px solid rgba(97,18,50,0.15);
            border-radius: 10px;
            padding: 18px 20px;
            margin-bottom: 24px;
            display: flex; align-items: center; gap: 14px;
        }
        .date-icon {
            width: 40px; height: 40px;
            background: #611232;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; flex-shrink: 0;
        }
        .date-info p { font-size: 11px; color: #8b4060; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 2px; }
        .date-info strong { font-size: 16px; color: #1a0510; font-weight: 700; }

        .password-rules {
            background: #fff8f0;
            border: 1px solid rgba(185,146,91,0.25);
            border-radius: 10px;
            padding: 18px 20px;
            margin-bottom: 24px;
        }
        .password-rules-title {
            font-size: 11px; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; color: #9a7440;
            margin-bottom: 12px;
        }
        .rule { display: flex; align-items: center; gap: 8px; margin-bottom: 8px; font-size: 13px; color: #4b3010; }
        .rule:last-child { margin-bottom: 0; }
        .rule-dot { width: 18px; height: 18px; background: #B9925B; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 10px; color: white; font-weight: 700; }

        .warning-box {
            background: #fefce8;
            border-left: 4px solid #ca8a04;
            border-radius: 0 8px 8px 0;
            padding: 14px 18px;
            margin-bottom: 24px;
        }
        .warning-box p { font-size: 13px; color: #854d0e; line-height: 1.6; }

        .contact-box {
            background: #611232;
            border-radius: 10px;
            padding: 20px 24px;
            margin-bottom: 8px;
        }
        .contact-title {
            font-size: 11px; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; color: rgba(240,160,184,0.7);
            margin-bottom: 12px;
        }
        .contact-item { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; }
        .contact-item:last-child { margin-bottom: 0; }
        .contact-dot { width: 6px; height: 6px; border-radius: 50%; background: rgba(240,160,184,0.5); flex-shrink: 0; }
        .contact-item p { font-size: 13px; color: rgba(255,255,255,0.6); }
        .contact-item a { color: #f0a0b8; text-decoration: none; }

        .footer { background: #1a0510; border-radius: 0 0 12px 12px; padding: 20px 40px; text-align: center; }
        .footer p { font-size: 11px; color: rgba(255,255,255,0.25); line-height: 1.6; }
        .footer span { color: rgba(240,160,184,0.4); }
    </style>
</head>
<body>
    <div class="wrapper">

        {{-- Header --}}
        <div class="header">
            <div class="header-badge">Diplomado en ASICs · TecNM 2026</div>
            <h1>¡Felicidades, fuiste aceptado!</h1>
            <p>Instituto Tecnológico de Aguascalientes</p>
        </div>

        {{-- Body --}}
        <div class="body">
            <p class="greeting">
                Estimado/a <strong>{{ $first_name }} {{ $last_name }}</strong>,
            </p>

            <p class="intro">
                Nos complace informarte que tu solicitud de inscripción al
                <strong>Diplomado en Diseño de Circuitos Integrados de Aplicación Específica (ASICs):
                del concepto al tapeout</strong> ha sido revisada y <strong>has sido aceptado/a</strong>
                como participante del programa.
            </p>

            <div class="success-box">
                <p>
                    ✓ Tu perfil cumple con los requisitos de admisión establecidos en la convocatoria.
                    Bienvenido/a al diplomado.
                </p>
            </div>

            {{-- Credenciales --}}
            <p class="section-title">Tus accesos a la plataforma</p>
            <div class="credentials-box">
                <p class="credentials-title">Credenciales de acceso</p>
                <div class="credential-row">
                    <span class="credential-label">Usuario</span>
                    <span class="credential-value">{{ $curp }}</span>
                </div>
                <div class="credential-row">
                    <span class="credential-label">Contraseña temporal</span>
                    <span class="credential-value">{{ $password }}</span>
                </div>
            </div>

            {{-- Botón acceso --}}
            <a href="https://cloud.aguascalientes.tecnm.mx/diplomados/plataforma/login"
               class="access-btn">
                Acceder a la plataforma
            </a>

            {{-- Fecha de inicio --}}
            <div class="date-box">
                <div class="date-info">
                    <p>Inicio del diplomado</p>
                    <strong>Lunes 13 de abril de 2026</strong>
                </div>
            </div>

            <a href="https://teams.microsoft.com/meet/277532801569512?p=PEJHwRMPyF3S7vaCDY"
               class="access-btn">
                Link de videosesiones
            </a>

            <div class="success-box">
                <p>
                    El responsable del diplomado se comunicará contigo para agendar las sesiones correspondientes
                </p>
            </div>

            {{-- Cambio de contraseña --}}
            <p class="section-title">Cambio de contraseña obligatorio</p>
            <p class="intro" style="margin-bottom: 14px;">
                Al ingresar por primera vez a la plataforma, deberás cambiar tu contraseña temporal
                por una nueva que cumpla con los siguientes requisitos:
            </p>

            <div class="password-rules">
                <p class="password-rules-title">Requisitos de la nueva contraseña</p>
                <div class="rule">Mínimo 8 caracteres</div>
                <div class="rule">Al menos 1 letra mayúscula</div>
                <div class="rule">Al menos 1 letra minúscula</div>
                <div class="rule">Al menos 1 carácter especial (!, @, #, $, %, etc.)</div>
            </div>

            <div class="warning-box">
                <p>
                    ⚠️ <strong>Importante:</strong> Guarda tus credenciales en un lugar seguro.
                    Por razones de seguridad, no compartas tu contraseña con nadie.
                    Si tienes problemas para acceder, contáctanos.
                </p>
            </div>

            {{-- Contacto --}}
            <div class="contact-box">
                <p class="contact-title">¿Necesitas ayuda?</p>
                <div class="contact-item">
                    <p>Correo: <a href="mailto:soporte_tecnico_diplomados1@aguascalientes.tecnm.mx">soporte_tecnico_diplomados1@aguascalientes.tecnm.mx</a></p>
                </div>
                <div class="contact-item">
                    <p style="color: rgba(255,255,255,0.6);">Instituto Tecnológico de Aguascalientes · TecNM</p>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="footer">
            <p>
                Este correo fue generado automáticamente, por favor no respondas a este mensaje.<br>
                © 2026 <span>TecNM / ITA</span> — Todos los derechos reservados.
            </p>
        </div>
    </div>
</body>
</html>