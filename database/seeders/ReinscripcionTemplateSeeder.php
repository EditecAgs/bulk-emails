<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class ReinscripcionTemplateSeeder extends Seeder
{
    public function run()
    {
        // Limpiar HTML para guardar en la BD
        $html = <<<'HTML'
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Periodo de Pago - Reinscripción Agosto-Diciembre 2026</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
            font-family: Arial, Helvetica, sans-serif;
            color: #333333;
        }
        .container {
            width: 100%;
            padding: 40px 0;
            background-color: #f4f6f9;
        }
        .card {
            width: 600px;
            max-width: 600px;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
        .header {
            background-color: #0B5ED7;
            padding: 28px 25px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            color: #ffffff;
            font-size: 23px;
            font-weight: 600;
        }
        .header p {
            margin: 8px 0 0;
            color: #dbe9ff;
            font-size: 14px;
        }
        .content {
            padding: 40px;
            color: #333333;
            font-size: 15px;
            line-height: 1.7;
        }
        .content p {
            margin: 0 0 18px;
        }
        .period-box {
            margin: 25px 0;
            border: 1px solid #b8d4ff;
            border-radius: 7px;
            background-color: #f4f8ff;
            text-align: center;
        }
        .period-title {
            padding: 12px 18px 5px;
            color: #495057;
            font-size: 14px;
            font-weight: bold;
        }
        .period-date {
            padding: 0 18px 15px;
            color: #0B5ED7;
            font-size: 20px;
            font-weight: bold;
        }
        .payment-box {
            margin: 25px 0;
            border-left: 4px solid #0B5ED7;
            background-color: #f8f9fa;
            padding: 18px 20px;
        }
        .payment-box strong {
            color: #0B5ED7;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .button {
            display: inline-block;
            background-color: #0B5ED7;
            color: #ffffff !important;
            text-decoration: none;
            padding: 13px 25px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 15px;
        }
        .important {
            margin: 25px 0;
            padding: 18px 20px;
            background-color: #fff8e1;
            border: 1px solid #ffe69c;
            border-radius: 6px;
            color: #664d03;
        }
        .support-box {
            margin-top: 25px;
            padding: 18px 20px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 6px;
        }
        .support-box a {
            color: #0B5ED7;
            text-decoration: none;
        }
        .classes-box {
            margin: 30px 0;
            padding: 20px;
            background-color: #e8f1ff;
            border: 1px solid #b8d4ff;
            border-radius: 7px;
            text-align: center;
        }
        .classes-box .title {
            color: #495057;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .classes-box .date {
            color: #0B5ED7;
            font-size: 22px;
            font-weight: bold;
        }
        .footer {
            background-color: #f1f3f5;
            text-align: center;
            padding: 18px;
            color: #6c757d;
            font-size: 12px;
            line-height: 1.5;
        }
        @media only screen and (max-width: 620px) {
            .card {
                width: 100% !important;
            }
            .content {
                padding: 25px !important;
            }
        }
    </style>
</head>
<body>
    <table width="100%" cellpadding="0" cellspacing="0" border="0"
           style="background-color:#f4f6f9; padding:40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0"
                       style="background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                    <!-- ENCABEZADO -->
                    <tr>
                        <td style="background:#0B5ED7; padding:28px 25px; text-align:center;">
                            <h1 style="margin:0; color:#ffffff; font-size:23px; font-weight:600;">
                                Aviso Importante
                            </h1>
                            <p style="margin:8px 0 0; color:#dbe9ff; font-size:14px;">
                                Reinscripción Agosto - Diciembre 2026
                            </p>
                        </td>
                    </tr>
                    <!-- CONTENIDO -->
                    <tr>
                        <td style="padding:40px; color:#333333; font-size:15px; line-height:1.7;">
                            <p style="margin-top:0;">
                                Estimados estudiantes de la <strong>Modalidad a Distancia</strong>:
                            </p>
                            <p>
                                El motivo del presente mensaje es informarles que se encuentra
                                abierto el periodo de pago correspondiente a la
                                <strong>reinscripción al semestre Agosto - Diciembre 2026</strong>.
                            </p>
                            <!-- PERIODO DE PAGO -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                   style="margin:25px 0; border:1px solid #b8d4ff; border-radius:7px; background:#f4f8ff;">
                                <tr>
                                    <td align="center" style="padding:12px 18px 5px; color:#495057; font-size:14px; font-weight:bold;">
                                        PERIODO DE PAGO
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding:0 18px 15px; color:#0B5ED7; font-size:20px; font-weight:bold;">
                                        03 al 19 de agosto de 2026
                                    </td>
                                </tr>
                            </table>
                            <p>
                                Para descargar su recibo de pago deberá ingresar al siguiente sitio:
                            </p>
                            <!-- BOTÓN -->
                            <div style="text-align:center; margin:30px 0;">
                                <a href="https://ciapagos.aguascalientes.tecnm.mx"
                                   target="_blank"
                                   style="display:inline-block; background:#0B5ED7; color:#ffffff; text-decoration:none; padding:13px 25px; border-radius:6px; font-weight:bold; font-size:15px;">
                                    Descargar recibo de pago
                                </a>
                            </div>
                            <p>
                                En este sitio encontrarán el recibo de pago asignado con el concepto:
                            </p>
                            <!-- CONCEPTO -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                   style="margin:20px 0; border:1px solid #dee2e6; border-radius:6px;">
                                <tr>
                                    <td style="background:#f8f9fa; padding:12px 18px; width:150px; font-weight:bold; color:#495057;">
                                        Concepto
                                    </td>
                                    <td style="padding:12px 18px; color:#0B5ED7; font-weight:bold;">
                                        REINSCRIPCIÓN DISTANCIA
                                    </td>
                                </tr>
                            </table>
                            <p>
                                Si no puede acceder al <strong>SIE</strong>, favor de enviar un correo a:
                            </p>
                            <p style="text-align:center; margin:25px 0;">
                                <a href="mailto:ead.carreras@aguascalientes.tecnm.mx"
                                   style="color:#0B5ED7; font-weight:bold; text-decoration:none;">
                                    ead.carreras@aguascalientes.tecnm.mx
                                </a>
                            </p>
                            <p>
                                En el correo deberá solicitar su <strong>contraseña del SIE</strong>.
                            </p>
                            <!-- NOTA IMPORTANTE -->
                            <div style="margin:25px 0; padding:18px 20px; background:#fff8e1; border:1px solid #ffe69c; border-radius:6px; color:#664d03;">
                                <strong>Nota importante:</strong><br><br>
                                Si usted ya realizó su pago, favor de hacer caso omiso de este mensaje.
                                <br><br>
                                Recuerde que los alumnos de la <strong>Modalidad a Distancia NO deben cargar materias en el SIE</strong>.
                                La carga de materias la realizamos nosotros y estas aparecerán en la plataforma
                                una vez que inicien las clases.
                            </div>
                            <!-- SOPORTE -->
                            <div style="margin-top:25px; padding:18px 20px; background:#f8f9fa; border:1px solid #dee2e6; border-radius:6px;">
                                <p style="margin:0 0 10px;">
                                    <strong>¿Necesita ayuda?</strong>
                                </p>
                                <p style="margin:0 0 8px;">
                                    Si presenta alguna complicación, favor de comunicarse con:
                                </p>
                                <p style="margin:0 0 5px;">
                                    <strong>Correo:</strong>
                                    <a href="mailto:ead.soporte@aguascalientes.tecnm.mx"
                                       style="color:#0B5ED7; text-decoration:none;">
                                        ead.soporte@aguascalientes.tecnm.mx
                                    </a>
                                </p>
                                <p style="margin:0;">
                                    <strong>Teléfono:</strong> 910 5002 ext. 125
                                </p>
                            </div>
                            <!-- INICIO DE CLASES -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                   style="margin:30px 0; background:#e8f1ff; border:1px solid #b8d4ff; border-radius:7px;">
                                <tr>
                                    <td align="center" style="padding:18px;">
                                        <div style="color:#495057; font-size:14px; font-weight:bold; margin-bottom:5px;">
                                            INICIO DE CLASES
                                        </div>
                                        <div style="color:#0B5ED7; font-size:22px; font-weight:bold;">
                                            24 de agosto de 2026
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <p>
                                Quedo pendiente ante cualquier duda.
                            </p>
                            <p style="margin-top:30px; margin-bottom:0;">
                                Saludos cordiales,
                            </p>
                            <p style="margin-top:5px; margin-bottom:0;">
                                <strong>Departamento de Educación a Distancia</strong><br>
                                <span style="color:#6c757d;">
                                    TecNM | Instituto Tecnológico de Aguascalientes
                                </span>
                            </p>
                        </td>
                    </tr>
                    <!-- PIE DE CORREO -->
                    <tr>
                        <td style="background:#f1f3f5; text-align:center; padding:18px; color:#6c757d; font-size:12px; line-height:1.5;">
                            Este es un mensaje informativo del Departamento de Educación a Distancia.<br>
                            © 2026 TecNM | Instituto Tecnológico de Aguascalientes.
                            Todos los derechos reservados.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
HTML;

        Template::create([
            'name' => 'Reinscripción Agosto - Diciembre 2026',
            'subject' => 'Reinscripción Agosto - Diciembre 2026',
            'html' => $html,
            'is_default' => false,
        ]);

        $this->command->info('✅ Plantilla "Reinscripción Agosto - Diciembre 2026" creada exitosamente.');
    }
}