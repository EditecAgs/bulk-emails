<?php
// app/Services/MailTypeRegistry.php

namespace App\Services;

class MailTypeRegistry
{
    public static function all(): array
    {
        return [
            'activacion_m365' => [
                'label'     => 'Activación correo institucional M365',
                'subject'   => 'Activación de correo institucional Microsoft 365',
                'view'      => 'emails.activacion-m365',
                'columns'   => ['career', 'username', 'firstname', 'lastname', 'email', 'password'],
                'recipient' => 'moodle',  // usa la columna 'moodle' que viene de la API
                'label_col' => 'username',
                'data_map'  => fn(array $row) => [
                    'name'     => $row['firstname'] . ' ' . $row['lastname'],
                    'email'    => $row['email'],
                    'password' => $row['password'],
                    'url'      => 'https://login.microsoftonline.com/',
                ],
            ],

            'recordatorio_pago' => [
                'label'     => 'Recordatorio de pago - Aspirantes nuevo ingreso',
                'subject'   => 'Recordatorio de pago - Instituto Tecnológico de Aguascalientes',
                'view'      => 'emails.recordatorio-pago',
                'columns'   => ['curp','nombre', 'apellidos', 'email','carrrera', 'monto', 'fecha_limite', 'concepto',],
                'recipient' => 'email',
                'label_col' => 'curp',
                'data_map'  => fn(array $row) => [
                    'nombre_completo' => $row['nombre'] . ' ' . $row['apellidos'],
                    'curp'      => $row['curp'],
                    'email'           => $row['email'],
                    'carrera'           => $row['carrera'],
                    'monto'           => $row['monto'],
                    'fecha_limite'    => $row['fecha_limite'],
                    'concepto'        => $row['concepto'],
                ],
            ],

            // Plantilla para futuros tipos de correo
            'bienvenida' => [
                'label'     => 'Bienvenida a nuevos alumnos',
                'subject'   => 'Bienvenido al Instituto Tecnológico',
                'view'      => 'emails.bienvenida',
                'columns'   => ['username', 'firstname', 'lastname', 'email'],
                'recipient' => 'email',
                'label_col' => 'username',
                'data_map'  => fn(array $row) => [
                    'name' => $row['firstname'] . ' ' . $row['lastname'],
                ],
            ],
        ];
    }

    public static function get(string $type): ?array
    {
        return self::all()[$type] ?? null;
    }

    public static function options(): array
    {
        return collect(self::all())
            ->mapWithKeys(fn($v, $k) => [$k => $v['label']])
            ->all();
    }
}