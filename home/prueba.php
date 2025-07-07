<?php
require_once "../controller/ReniecController.php";
require_once "../helpers/EstadoHelper.php";

$dni = $_POST['dni'];
$reniecController = new ReniecController();
$datosReniec = $reniecController->obtenerDatos($dni);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Información de Personas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        :root {
            --primary-color: #3b82f6;
            --secondary-color: #6366f1;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #06b6d4;
            --purple-color: #8b5cf6;
            --orange-color: #f97316;
            --pink-color: #ec4899;
            
            --glass-bg: rgba(255, 255, 255, 0.85);
            --glass-border: rgba(255, 255, 255, 0.2);
            --glass-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.12);
            
            --text-primary: #1f2937;
            --text-secondary: #374151;
            --text-muted: #6b7280;
            --bg-subtle: #f8fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 20%, rgba(59, 130, 246, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(99, 102, 241, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        .container {
            position: relative;
            z-index: 1;
            padding: 0 15px;
        }

        .main-panel {
            margin: 20px auto;
            max-width: 1200px;
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 30px 20px;
            box-shadow: var(--glass-shadow);
            position: relative;
            overflow: hidden;
        }

        .main-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        }

        .panel-title {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }

        .panel-title h2 {
            font-size: clamp(1.8rem, 5vw, 2.5rem);
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 10px;
            text-shadow: none;
        }

        .panel-title .subtitle {
            color: var(--text-muted);
            font-size: clamp(0.9rem, 3vw, 1.1rem);
            font-weight: 400;
            letter-spacing: 0.5px;
        }

        .modern-accordion {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .modern-accordion-item {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        }

        .modern-accordion-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
            border-color: rgba(255, 255, 255, 0.7);
        }

        .modern-accordion-header {
            padding: 0;
            margin: 0;
            border: none;
            background: none;
        }

        .modern-accordion-button {
            width: 100%;
            padding: 20px 16px;
            background: none;
            border: none;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: clamp(1rem, 3vw, 1.2rem);
            font-weight: 600;
            color: var(--text-primary);
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            text-align: left;
        }

        .modern-accordion-button::after {
            content: '▼';
            margin-left: auto;
            transition: transform 0.3s ease;
            font-size: 0.9rem;
            opacity: 0.7;
        }

        .modern-accordion-button.collapsed::after {
            transform: rotate(-90deg);
        }

        .modern-accordion-button:not(.collapsed)::after {
            transform: rotate(0deg);
        }

        .section-icon {
            font-size: clamp(1.1rem, 3vw, 1.4rem);
            padding: 10px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 0, 0, 0.05);
            color: var(--text-primary);
            flex-shrink: 0;
        }

        /* Colores específicos para cada sección */
        .personal-data .section-icon {
            background: linear-gradient(135deg, var(--primary-color), #60a5fa);
            color: white;
        }

        .reniec-data .section-icon {
            background: linear-gradient(135deg, var(--secondary-color), #a5b4fc);
            color: white;
        }

        .clients-data .section-icon {
            background: linear-gradient(135deg, var(--pink-color), #f9a8d4);
            color: white;
        }

        .records-data .section-icon {
            background: linear-gradient(135deg, var(--danger-color), #fca5a5);
            color: white;
        }

        .medical-data .section-icon {
            background: linear-gradient(135deg, var(--info-color), #67e8f9);
            color: white;
        }

        .education-data .section-icon {
            background: linear-gradient(135deg, var(--success-color), #6ee7b7);
            color: white;
        }

        .employment-data .section-icon {
            background: linear-gradient(135deg, var(--warning-color), #fcd34d);
            color: white;
        }

        .family-data .section-icon {
            background: linear-gradient(135deg, var(--purple-color), #c4b5fd);
            color: white;
        }

        .modern-accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: var(--bg-subtle);
            backdrop-filter: blur(10px);
        }

        .modern-accordion-content.show {
            max-height: 5000px;
        }

        .modern-accordion-body {
            padding: 20px 16px;
            animation: fadeInUp 0.5s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .profile-section {
            display: flex;
            flex-direction: column;
            gap: 25px;
            align-items: center;
        }

        .profile-photo-container {
            flex-shrink: 0;
            text-align: center;
        }

        .profile-photo {
            width: 120px;
            height: 120px;
            border-radius: 20px;
            object-fit: cover;
            border: 4px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .profile-photo:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }

        .photo-date {
            margin-top: 12px;
            font-size: 0.8rem;
            color: var(--text-muted);
            background: rgba(255, 255, 255, 0.8);
            padding: 6px 12px;
            border-radius: 20px;
            display: inline-block;
        }

        .profile-data {
            flex: 1;
            width: 100%;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .data-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
            padding: 16px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
            border-left: 4px solid var(--primary-color);
            transition: all 0.3s ease;
            text-align: center;
            min-height: 90px;
            justify-content: center;
        }

        .data-item:hover {
            background: rgba(255, 255, 255, 1);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .data-label {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .data-value {
            color: var(--text-secondary);
            font-size: 0.95rem;
            font-weight: 500;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            background: linear-gradient(135deg, var(--success-color), #6ee7b7);
            color: white;
            border: none;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
            display: inline-block;
            width: fit-content;
            margin: 0 auto;
        }

        .simple-data-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            max-width: 100%;
            margin: 0 auto;
        }

        /* Estilos para la tabla de clientes */
        .clients-table-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.5);
            overflow-x: auto;
        }

        .clients-table {
            width: 100%;
            margin: 0;
            background: transparent;
            min-width: 600px;
        }

        .clients-table thead {
            background: linear-gradient(135deg, var(--pink-color), #f9a8d4);
            color: white;
        }

        .clients-table thead th {
            padding: 16px 12px;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            text-align: center;
            white-space: nowrap;
        }

        .clients-table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .clients-table tbody tr:hover {
            background: rgba(236, 72, 153, 0.05);
        }

        .clients-table tbody td {
            padding: 12px 8px;
            vertical-align: middle;
            border: none;
            text-align: center;
            font-weight: 500;
            color: var(--text-secondary);
            font-size: 0.85rem;
        }

        .client-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            color: white;
            border: none;
            display: inline-block;
            white-space: nowrap;
        }

        .client-status.active {
            background: linear-gradient(135deg, var(--success-color), #6ee7b7);
            box-shadow: 0 2px 10px rgba(16, 185, 129, 0.3);
        }

        .client-status.inactive {
            background: linear-gradient(135deg, var(--danger-color), #fca5a5);
            box-shadow: 0 2px 10px rgba(239, 68, 68, 0.3);
        }

        .client-status.pending {
            background: linear-gradient(135deg, var(--warning-color), #fcd34d);
            box-shadow: 0 2px 10px rgba(245, 158, 11, 0.3);
        }

        .client-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.3);
            margin: 0 auto;
            display: block;
        }

        .client-name {
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
            font-size: 0.85rem;
        }

        .client-email {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin: 4px 0 0 0;
        }

        .client-actions {
            display: flex;
            gap: 6px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-action {
            padding: 6px 8px;
            border-radius: 6px;
            border: none;
            font-size: 0.75rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            color: white;
            min-width: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-view {
            background: linear-gradient(135deg, var(--info-color), #67e8f9);
        }

        .btn-edit {
            background: linear-gradient(135deg, var(--warning-color), #fcd34d);
        }

        .btn-delete {
            background: linear-gradient(135deg, var(--danger-color), #fca5a5);
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Animaciones de entrada */
        .modern-accordion-item {
            opacity: 0;
            transform: translateY(30px);
            animation: slideInUp 0.6s ease forwards;
        }

        .modern-accordion-item:nth-child(1) { animation-delay: 0.1s; }
        .modern-accordion-item:nth-child(2) { animation-delay: 0.2s; }
        .modern-accordion-item:nth-child(3) { animation-delay: 0.3s; }
        .modern-accordion-item:nth-child(4) { animation-delay: 0.4s; }
        .modern-accordion-item:nth-child(5) { animation-delay: 0.5s; }

        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Efectos de partículas flotantes */
        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .floating-element {
            position: absolute;
            width: 6px;
            height: 6px;
            background: rgba(59, 130, 246, 0.1);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        .floating-element:nth-child(1) { top: 20%; left: 20%; animation-delay: 0s; }
        .floating-element:nth-child(2) { top: 60%; left: 80%; animation-delay: 1s; }
        .floating-element:nth-child(3) { top: 80%; left: 40%; animation-delay: 2s; }
        .floating-element:nth-child(4) { top: 40%; left: 60%; animation-delay: 3s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Responsive Design Mejorado */
        @media (max-width: 768px) {
            .container {
                padding: 0 10px;
            }

            .main-panel {
                margin: 15px;
                padding: 20px 15px;
                border-radius: 16px;
            }

            .panel-title {
                margin-bottom: 20px;
            }

            .modern-accordion {
                gap: 12px;
            }

            .modern-accordion-button {
                padding: 16px 12px;
                gap: 10px;
            }

            .modern-accordion-body {
                padding: 16px 12px;
            }

            .profile-section {
                gap: 20px;
            }

            .profile-photo {
                width: 100px;
                height: 100px;
            }

            .profile-data {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .simple-data-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .data-item {
                padding: 14px;
                min-height: 80px;
            }

            .data-label {
                font-size: 0.8rem;
            }

            .data-value {
                font-size: 0.9rem;
            }

            .clients-table-container {
                margin: 0 -12px;
                border-radius: 12px;
            }

            .clients-table {
                font-size: 0.8rem;
            }

            .clients-table thead th {
                padding: 12px 8px;
                font-size: 0.75rem;
            }

            .clients-table tbody td {
                padding: 10px 6px;
                font-size: 0.8rem;
            }

            .client-avatar {
                width: 30px;
                height: 30px;
            }

            .client-name {
                font-size: 0.8rem;
            }

            .client-email {
                font-size: 0.7rem;
            }

            .client-actions {
                gap: 4px;
            }

            .btn-action {
                padding: 5px 6px;
                font-size: 0.7rem;
                min-width: 28px;
            }

            .client-status {
                padding: 4px 8px;
                font-size: 0.7rem;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 5px;
            }

            .main-panel {
                margin: 15px;
                padding: 15px 10px;
            }

            .profile-data {
                gap: 10px;
            }

            .simple-data-grid {
                gap: 10px;
            }

            .data-item {
                padding: 12px;
                min-height: 75px;
            }

            .clients-table {
                min-width: 500px;
            }

            .clients-table thead th,
            .clients-table tbody td {
                padding: 8px 4px;
                font-size: 0.75rem;
            }

            .client-name {
                font-size: 0.75rem;
            }

            .client-email {
                font-size: 0.65rem;
            }
        }

        /* Mejoras adicionales para evitar overflow */
        .modern-accordion-content {
            width: 100%;
            box-sizing: border-box;
        }

        .modern-accordion-body {
            width: 100%;
            box-sizing: border-box;
            overflow-x: hidden;
        }

        .profile-section,
        .simple-data-grid,
        .clients-table-container {
            width: 100%;
            box-sizing: border-box;
        }

        /* Asegurar que el texto no se desborde */
        .data-value span {
            display: block;
            word-break: break-word;
            overflow-wrap: break-word;
            hyphens: auto;
        }
    </style>
</head>

<body>
    <!-- Elementos flotantes decorativos -->
    <!-- <div class="floating-elements">
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
    </div> -->

    <div class="container">
        <div class="main-panel">
            <div class="panel-title">
                <h2>
                    <i class="bi bi-person-badge-fill me-3"></i>Panel de Información
                </h2>
                <div class="subtitle">Sistema de gestión de datos personales</div>
            </div>

            <div class="modern-accordion">
                <!-- Datos Personales -->
                <div class="modern-accordion-item personal-data">
                    <h2 class="modern-accordion-header">
                        <button class="modern-accordion-button" type="button" onclick="toggleAccordion('datosPersonales')">
                            <i class="bi bi-person-vcard-fill section-icon"></i>
                            <span>Datos Personales</span>
                        </button>
                    </h2>
                    <div id="datosPersonales" class="modern-accordion-content show">
                        <div class="modern-accordion-body">
                            <div class="profile-section">
                                <div class="profile-photo-container">
                                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='140' height='140' viewBox='0 0 140 140'%3E%3Crect width='140' height='140' fill='%23f0f0f0'/%3E%3Ctext x='70' y='75' font-family='Arial' font-size='16' text-anchor='middle' fill='%23999'%3EFoto%3C/text%3E%3C/svg%3E" 
                                         alt="Foto" class="profile-photo">
                                    <div class="photo-date">Última actualización: 15/10/2023</div>
                                </div>
                                <div class="profile-data">
                                    <div class="data-item">
                                        <div class="data-label">DNI:</div>
                                        <div class="data-value"><span><?= $datosReniec['dni'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Apellido Paterno</div>
                                        <div class="data-value"><span><?= $datosReniec['apellido_paterno'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Apellido Materno</div>
                                        <div class="data-value"><span><?= $datosReniec['apellido_materno'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Nombres</div>
                                        <div class="data-value"><span><?= $datosReniec['nombres'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Fecha de Nacimiento</div>
                                        <div class="data-value"><span><?= $datosReniec['fecha_nacimiento'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Sexo</div>
                                        <div class="data-value"><span><?= $datosReniec['sexo'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Estado Civil</div>
                                        <div class="data-value"><span><?= $datosReniec['estado_civil'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Dirección</div>
                                        <div class="data-value"><span><?= $datosReniec['direccion'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Departamento</div>
                                        <div class="data-value"><span><?= $datosReniec['departamento'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Provincia</div>
                                        <div class="data-value"><span><?= $datosReniec['provincia'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Distrito</div>
                                        <div class="data-value"><span><?= $datosReniec['distrito'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Nacionalidad</div>
                                        <div class="data-value"><span><?= $datosReniec['nacionalidad'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Teléfono Fijo</div>
                                        <div class="data-value"><span><?= $datosReniec['telefono_fijo'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Teléfono Móvil</div>
                                        <div class="data-value"><span><?= $datosReniec['telefono_movil'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Correo Electrónico</div>
                                        <div class="data-value"><span><?= $datosReniec['correo_electronico'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Estado</div>
                                        <div class="data-value">
                                            <?= EstadoHelper::badgeEstado($datosReniec['estado'] ?? 'No disponible') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RENIEC -->
                <div class="modern-accordion-item reniec-data">
                    <h2 class="modern-accordion-header">
                        <button class="modern-accordion-button collapsed" type="button" onclick="toggleAccordion('reniecData')">
                            <i class="bi bi-file-earmark-text-fill section-icon"></i>
                            <span>Datos RENIEC</span>
                        </button>
                    </h2>
                    <div id="reniecData" class="modern-accordion-content">
                        <div class="modern-accordion-body">
                            <div class="simple-data-grid">
                                <div class="data-item">
                                    <div class="data-label">Estado DNI</div>
                                    <div class="data-value">Vigente</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">Fecha de Emisión</div>
                                    <div class="data-value">15/05/2020</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">Fecha de Caducidad</div>
                                    <div class="data-value">15/05/2030</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">Lugar de Emisión</div>
                                    <div class="data-value">Oficina RENIEC Miraflores</div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">Estado Civil Registrado</div>
                                    <div class="data-value">Soltero</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Clientes -->
                <div class="modern-accordion-item clients-data">
                    <h2 class="modern-accordion-header">
                        <button class="modern-accordion-button collapsed" type="button" onclick="toggleAccordion('clientsData')">
                            <i class="bi bi-people-fill section-icon"></i>
                            <span>Clientes</span>
                        </button>
                    </h2>
                    <div id="clientsData" class="modern-accordion-content">
                        <div class="modern-accordion-body">
                            <div class="clients-table-container">
                                <table class="clients-table table">
                                    <thead>
                                        <tr>
                                            <th>Avatar</th>
                                            <th>Cliente</th>
                                            <th>Teléfono</th>
                                            <th>Fecha Registro</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 40 40'%3E%3Ccircle cx='20' cy='20' r='20' fill='%23e2e8f0'/%3E%3Ctext x='20' y='25' font-family='Arial' font-size='14' text-anchor='middle' fill='%23374151'%3EMA%3C/text%3E%3C/svg%3E" 
                                                     alt="Avatar" class="client-avatar">
                                            </td>
                                            <td>
                                                <div class="client-name">María Fernández</div>
                                                <div class="client-email">maria.fernandez@email.com</div>
                                            </td>
                                            <td>987654321</td>
                                            <td>15/01/2024</td>
                                            <td>
                                                <span class="client-status active">Activo</span>
                                            </td>
                                            <td>
                                                <div class="client-actions">
                                                    <button class="btn-action btn-view">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <button class="btn-action btn-edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <button class="btn-action btn-delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 40 40'%3E%3Ccircle cx='20' cy='20' r='20' fill='%23ddd6fe'/%3E%3Ctext x='20' y='25' font-family='Arial' font-size='14' text-anchor='middle' fill='%23374151'%3ECA%3C/text%3E%3C/svg%3E" 
                                                     alt="Avatar" class="client-avatar">
                                            </td>
                                            <td>
                                                <div class="client-name">Carlos Mendoza</div>
                                                <div class="client-email">carlos.mendoza@email.com</div>
                                            </td>
                                            <td>956789123</td>
                                            <td>28/02/2024</td>
                                            <td>
                                                <span class="client-status pending">Pendiente</span>
                                            </td>
                                            <td>
                                                <div class="client-actions">
                                                    <button class="btn-action btn-view">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <button class="btn-action btn-edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <button class="btn-action btn-delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 40 40'%3E%3Ccircle cx='20' cy='20' r='20' fill='%23fed7d7'/%3E%3Ctext x='20' y='25' font-family='Arial' font-size='14' text-anchor='middle' fill='%23374151'%3EAR%3C/text%3E%3C/svg%3E" 
                                                     alt="Avatar" class="client-avatar">
                                            </td>
                                            <td>
                                                <div class="client-name">Ana Rodríguez</div>
                                                <div class="client-email">ana.rodriguez@email.com</div>
                                            </td>
                                            <td>912345678</td>
                                            <td>10/03/2024</td>
                                            <td>
                                                <span class="client-status inactive">Inactivo</span>
                                            </td>
                                            <td>
                                                <div class="client-actions">
                                                    <button class="btn-action btn-view">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <button class="btn-action btn-edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <button class="btn-action btn-delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 40 40'%3E%3Ccircle cx='20' cy='20' r='20' fill='%23bee3f8'/%3E%3Ctext x='20' y='25' font-family='Arial' font-size='14' text-anchor='middle' fill='%23374151'%3ELS%3C/text%3E%3C/svg%3E" 
                                                     alt="Avatar" class="client-avatar">
                                            </td>
                                            <td>
                                                <div class="client-name">Luis Silva</div>
                                                <div class="client-email">luis.silva@email.com</div>
                                            </td>
                                            <td>987123456</td>
                                            <td>05/04/2024</td>
                                            <td>
                                                <span class="client-status active">Activo</span>
                                            </td>
                                            <td>
                                                <div class="client-actions">
                                                    <button class="btn-action btn-view">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <button class="btn-action btn-edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <button class="btn-action btn-delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40' viewBox='0 0 40 40'%3E%3Ccircle cx='20' cy='20' r='20' fill='%23c6f6d5'/%3E%3Ctext x='20' y='25' font-family='Arial' font-size='14' text-anchor='middle' fill='%23374151'%3EST%3C/text%3E%3C/svg%3E" 
                                                     alt="Avatar" class="client-avatar">
                                            </td>
                                            <td>
                                                <div class="client-name">Sofía Torres</div>
                                                <div class="client-email">sofia.torres@email.com</div>
                                            </td>
                                            <td>945678912</td>
                                            <td>20/04/2024</td>
                                            <td>
                                                <span class="client-status active">Activo</span>
                                            </td>
                                            <td>
                                                <div class="client-actions">
                                                    <button class="btn-action btn-view">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <button class="btn-action btn-edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <button class="btn-action btn-delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function toggleAccordion(targetId) {
            const content = document.getElementById(targetId);
            const button = content.previousElementSibling.querySelector('.modern-accordion-button');
            
            // Cerrar otros acordeones
            document.querySelectorAll('.modern-accordion-content').forEach(item => {
                if (item.id !== targetId) {
                    item.classList.remove('show');
                    item.previousElementSibling.querySelector('.modern-accordion-button').classList.add('collapsed');
                }
            });
            
            // Toggle el acordeón actual
            content.classList.toggle('show');
            button.classList.toggle('collapsed');
        }

        // Animación de entrada para los elementos
        document.addEventListener('DOMContentLoaded', function() {
            const items = document.querySelectorAll('.modern-accordion-item');
            items.forEach((item, index) => {
                item.style.animationDelay = `${index * 0.1}s`;
            });
        });

        // Efecto de paralaje sutil
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelector('.main-panel');
            const speed = scrolled * 0.1;
            
            if (parallax) {
                parallax.style.transform = `translateY(${speed}px)`;
            }
        });

    </script>
</body>

</html>