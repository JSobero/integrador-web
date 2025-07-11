<?php
require_once "../helpers/EstadoHelper.php";
require_once "../controller/ReniecController.php";
require_once "../controller/DatosPersonalesController.php";
require_once '../controller/RecordsPenalesController.php';
require_once "../controller/SunatController.php";
require_once "../controller/ActividadesEconomicasController.php";
require_once "../controller/AfiliacionController.php";
require_once "../controller/SeguroMedicoController.php";
require_once "../controller/DiplomasController.php";
require_once "../controller/HistorialAcademicoController.php";
require_once "../controller/MimpController.php";
require_once "../controller/SuneduController.php";
require_once "../controller/DenunciasViolenciaController.php";
require_once "../controller/BiometricosReniecController.php";

$dni = $_POST['dni'];

$reniecController = new ReniecController();
$datosReniec = $reniecController->obtenerDatos($dni);

$datosPersonalesController = new DatosPersonalesController();
$datosDatosPersonales = $datosPersonalesController->obtenerDatos($dni);

$recordsController = new RecordsPenalesController();
$recordsPenales = $recordsController->obtenerPorDni($dni);

$controllerSunat = new SunatController();
$rucData = $controllerSunat->obtenerRucPorDni($dni);
$ruc = $rucData['ruc'] ?? null;

$actividadesController = new ActividadesEconomicasController();
$datosActividades = $ruc ? $actividadesController->obtenerPorRuc($ruc) : [];

$afiliacionController = new AfiliacionController();
$datosAfiliaciones = $afiliacionController->obtenerDatos($dni);

$seguroController = new SeguroMedicoController();
$datosSeguro = $seguroController->obtenerDatos($dni);

$diplomasController = new DiplomasController();
$datosTitulos = $diplomasController->obtenerTitulos($dni);

$historialController = new HistorialAcademicoController();
$datosHistorial = $historialController->obtenerHistorial($dni);

$mimpController = new MimpController();
$datosMimp = $mimpController->obtenerDatos($dni);

$suneduController = new SuneduController();
$datosSunedu = $suneduController->obtenerDatos($dni);

$ctrlDenuncias = new DenunciasViolenciaController();
$datosDenunciasViolencia = $ctrlDenuncias->obtenerDatos($dni);

$ctrlBiometricos = new BiometricosReniecController();
$datosBiometricos = $ctrlBiometricos->obtenerDatos($dni);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Información de Personas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
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
                                    <img src="../images/photo/<?= $datosDatosPersonales['dni'] ?>.jpeg" width='140' height='140' viewBox='0 0 140 140'%3E%3Crect width='140' height='140' fill='%23f0f0f0'/%3E%3Ctext x='70' y='75' font-family='Arial' font-size='16' text-anchor='middle' fill='%23999'%3EFoto%3C/text%3E%3C/svg%3E" 
                                         alt="Foto" class="profile-photo">
                                         <!-- <div class="photo-date">Última actualización: 15/10/2023</div> -->
                                </div>
                                <div class="profile-data">
                                    <div class="data-item">
                                        <div class="data-label">DNI:</div>
                                        <div class="data-value"><span><?= $datosDatosPersonales['dni'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Apellido Paterno</div>
                                        <div class="data-value"><span><?= $datosDatosPersonales['apellido_paterno'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Apellido Materno</div>
                                        <div class="data-value"><span><?= $datosDatosPersonales['apellido_materno'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Nombres</div>
                                        <div class="data-value"><span><?= $datosDatosPersonales['nombres'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Fecha de Nacimiento</div>
                                        <div class="data-value"><span><?= $datosDatosPersonales['fecha_nacimiento'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Sexo</div>
                                        <div class="data-value"><span><?= $datosDatosPersonales['sexo'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Estado Civil</div>
                                        <div class="data-value"><span><?= $datosDatosPersonales['estado_civil'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Dirección</div>
                                        <div class="data-value"><span><?= $datosDatosPersonales['direccion'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Departamento</div>
                                        <div class="data-value"><span><?= $datosDatosPersonales['departamento'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Provincia</div>
                                        <div class="data-value"><span><?= $datosDatosPersonales['provincia'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Distrito</div>
                                        <div class="data-value"><span><?= $datosDatosPersonales['distrito'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Nacionalidad</div>
                                        <div class="data-value"><span><?= $datosDatosPersonales['nacionalidad'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Teléfono Fijo</div>
                                        <div class="data-value"><span><?= $datosDatosPersonales['telefono_fijo'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Teléfono Móvil</div>
                                        <div class="data-value"><span><?= $datosDatosPersonales['telefono_movil'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Correo Electrónico</div>
                                        <div class="data-value"><span><?= $datosDatosPersonales['correo_electronico'] ?? 'No disponible' ?></span></div>
                                    </div>
                                    <div class="data-item">
                                        <div class="data-label">Estado</div>
                                        <div class="data-value">
                                            <?= EstadoHelper::badgeEstado($datosDatosPersonales['estado'] ?? 'No disponible') ?>
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
                                    <div class="data-value"><span><?= $datosReniec['estado_dni'] ?? 'No disponible' ?></span></div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">Fecha de Emisión</div>
                                    <div class="data-value"><?= $datosReniec['fecha_emision'] ?? 'No disponible' ?></div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">Fecha de Caducidad</div>
                                    <div class="data-value"><?= $datosReniec['fecha_caducidad'] ?? 'No disponible' ?></div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">Lugar de Emisión</div>
                                    <div class="data-value"><?= $datosReniec['lugar_emision'] ?? 'No disponible' ?></div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">Estado Civil Registrado</div>
                                    <div class="data-value"><?= $datosReniec['estado_civil_registrado'] ?? 'No disponible' ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Record Penales -->
                <div class="modern-accordion-item record-data">
                    <h2 class="modern-accordion-header">
                        <button class="modern-accordion-button collapsed" type="button" onclick="toggleAccordion('recordsPenales')">
                            <i class="bi bi-shield-fill-exclamation section-icon"></i>
                            <span>Records Penales</span>
                        </button>
                    </h2>
                    <div id="recordsPenales" class="modern-accordion-content">
                        <div class="modern-accordion-body">
                            <div class="clients-table-container" style="overflow-x: auto;">
                                <table class="record-table table table-striped">
                                    <thead>
                                        <tr>
                                            <th>N° Expediente</th>
                                            <th>Delito</th>
                                            <th>Código</th>
                                            <th>F. Delito</th>
                                            <th>F. Detención</th>
                                            <th>F. Sentencia</th>
                                            <th>Tipo Sentencia</th>
                                            <th>Pena</th>
                                            <th>Reparación Civil</th>
                                            <th>F. Inicio Pena</th>
                                            <th>F. Fin Pena</th>
                                            <th>Centro Penitenciario</th>
                                            <th>Estado Caso</th>
                                            <th>Juzgado</th>
                                            <th>Abogado Defensor</th>
                                            <th>Reincidencia</th>
                                            <th>Sentencia Firme</th>
                                            <th>Observaciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($recordsPenales)): ?>
                                            <?php foreach ($recordsPenales as $record): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($record['numero_expediente']) ?></td>
                                                    <td><?= htmlspecialchars($record['delito']) ?></td>
                                                    <td><?= htmlspecialchars($record['codigo_delito']) ?></td>
                                                    <td><?= $record['fecha_delito'] ? date('d/m/Y', strtotime($record['fecha_delito'])) : '' ?></td>
                                                    <td><?= $record['fecha_detencion'] ? date('d/m/Y', strtotime($record['fecha_detencion'])) : '' ?></td>
                                                    <td><?= $record['fecha_sentencia'] ? date('d/m/Y', strtotime($record['fecha_sentencia'])) : '' ?></td>
                                                    <td><?= htmlspecialchars($record['tipo_sentencia']) ?></td>
                                                    <td><?= htmlspecialchars($record['pena_impuesta']) ?></td>
                                                    <td>S/ <?= number_format($record['reparacion_civil'], 2) ?></td>
                                                    <td><?= $record['fecha_inicio_pena'] ? date('d/m/Y', strtotime($record['fecha_inicio_pena'])) : '' ?></td>
                                                    <td><?= $record['fecha_fin_pena'] ? date('d/m/Y', strtotime($record['fecha_fin_pena'])) : '' ?></td>
                                                    <td><?= htmlspecialchars($record['centro_penitenciario']) ?></td>
                                                    <td><?= htmlspecialchars($record['estado_caso']) ?></td>
                                                    <td><?= htmlspecialchars($record['juzgado']) ?></td>
                                                    <td><?= htmlspecialchars($record['abogado_defensor']) ?></td>
                                                    <td>
                                                        <?= $record['reincidencia'] ? '<span class="badge bg-danger">Sí</span>' : '<span class="badge bg-success">No</span>' ?>
                                                    </td>
                                                    <td>
                                                        <?= $record['sentencia_firme'] ? '<span class="badge bg-primary">Sí</span>' : '<span class="badge bg-secondary">No</span>' ?>
                                                    </td>
                                                    <td><?= nl2br(htmlspecialchars($record['observaciones'])) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="18" class="text-center">No se encontraron registros penales.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sunat -->
                <div class="modern-accordion-item sunat-data">
                    <h2 class="modern-accordion-header">
                        <button class="modern-accordion-button collapsed" type="button" onclick="toggleAccordion('sunatData')">
                            <i class="bi bi-briefcase-fill section-icon"></i>
                            <span>Datos SUNAT</span>
                        </button>
                    </h2>
                    <div id="sunatData" class="modern-accordion-content">
                        <div class="modern-accordion-body">
                            <div class="simple-data-grid">
                                <div class="data-item">
                                    <div class="data-label">RUC</div>
                                    <div class="data-value"><?= $rucData['ruc'] ?? 'No disponible' ?></div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">Tipo de Contribuyente</div>
                                    <div class="data-value"><?= $rucData['tipo_contribuyente'] ?? 'No disponible' ?></div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">Nombre Legal</div>
                                    <div class="data-value"><?= $rucData['nombre_legal'] ?? 'No disponible' ?></div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">Nombre Comercial</div>
                                    <div class="data-value"><?= $rucData['nombre_comercial'] ?? 'No disponible' ?></div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">Estado del Contribuyente</div>
                                    <div class="data-value"><?= $rucData['estado_contribuyente'] ?? 'No disponible' ?></div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">Fecha de Inscripción</div>
                                    <div class="data-value"><?= $rucData['fecha_inscripcion'] ?? 'No disponible' ?></div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">Domicilio Fiscal</div>
                                    <div class="data-value"><?= $rucData['domicilio_fiscal'] ?? 'No disponible' ?></div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">Actividades</div>
                                    <div class="data-value"><?= $rucData['actividades'] ?? 'No disponible' ?></div>
                                </div>
                                <div class="data-item">
                                    <div class="data-label">Régimen Tributario</div>
                                    <div class="data-value"><?= $rucData['regimen_tributario'] ?? 'No disponible' ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actividades economicas -->
                <div class="modern-accordion-item actividades-data">
                    <h2 class="modern-accordion-header">
                        <button class="modern-accordion-button collapsed" type="button" onclick="toggleAccordion('actividadesData')">
                            <i class="bi bi-bar-chart-fill section-icon"></i>
                            <span>Actividades Económicas</span>
                        </button>
                    </h2>
                    <div id="actividadesData" class="modern-accordion-content">
                        <div class="modern-accordion-body">
                            <?php if (!empty($datosActividades)) : ?>
                                <div class="clients-table-container">
                                    <table class="clients-table table table-striped">
                                        <thead>
                                            <tr>
                                                <th>RUC</th>
                                                <th>Actividad</th>
                                                <th>Ingreso Mensual Aproximado</th>
                                                <th>Frecuencia de Actividad</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($datosActividades as $actividad) : ?>
                                                <tr>
                                                    <td><?= $actividad['ruc'] ?></td>
                                                    <td><?= $actividad['actividad'] ?></td>
                                                    <td>S/ <?= number_format($actividad['ingreso_aproximado_mensual'], 2) ?></td>
                                                    <td><?= $actividad['frecuencia_actividad'] ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else : ?>
                                <p>No se encontraron actividades económicas asociadas.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Afiliacion seguro medico -->
                <div class="modern-accordion-item afiliacion-data">
    <h2 class="modern-accordion-header">
        <button class="modern-accordion-button collapsed" type="button" onclick="toggleAccordion('afiliacionData')">
            <i class="bi bi-heart-pulse-fill section-icon"></i>
            <span>Afiliación Seguro Médico</span>
        </button>
    </h2>
    <div id="afiliacionData" class="modern-accordion-content">
        <div class="modern-accordion-body">
            <?php if (!empty($datosAfiliaciones)) : ?>
                <div class="clients-table-container">
                    <table class="clients-table table">
                        <thead>
                            <tr>
                                <th>Tipo de Seguro</th>
                                <th>Fecha Afiliación</th>
                                <th>Fecha Baja</th>
                                <th>Estado</th>
                                <th>Centro de Atención</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datosAfiliaciones as $afiliacion) : ?>
                                <tr>
                                    <td><?= $afiliacion['tipo_seguro'] ?></td>
                                    <td><?= $afiliacion['fecha_afiliacion'] ? date('d/m/Y', strtotime($afiliacion['fecha_afiliacion'])) : '' ?></td>
                                    <td><?= $afiliacion['fecha_baja'] ? date('d/m/Y', strtotime($afiliacion['fecha_baja'])) : '—' ?></td>
                                    <td><?= $afiliacion['estado_afiliacion'] ?></td>
                                    <td><?= $afiliacion['centro_atencion_asignado'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <p>No se encontraron datos de afiliación médica.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Seguro medico -->
<div class="modern-accordion-item seguro-medico-data">
    <h2 class="modern-accordion-header">
        <button class="modern-accordion-button collapsed" type="button" onclick="toggleAccordion('seguroMedicoData')">
            <i class="bi bi-hospital-fill section-icon"></i>
            <span>Seguro Médico</span>
        </button>
    </h2>
    <div id="seguroMedicoData" class="modern-accordion-content">
        <div class="modern-accordion-body">
            <?php if (!empty($datosSeguro)) : ?>
                <div class="simple-data-grid">
                    <div class="data-item">
                        <div class="data-label">Historial Médico</div>
                        <div class="data-value"><?= nl2br(htmlspecialchars($datosSeguro['historial_medico'])) ?></div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">Tipo de Sangre</div>
                        <div class="data-value"><?= $datosSeguro['tipo_sangre'] ?? 'No disponible' ?></div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">Alergias</div>
                        <div class="data-value"><?= nl2br(htmlspecialchars($datosSeguro['alergias'])) ?></div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">Enfermedades Crónicas</div>
                        <div class="data-value"><?= nl2br(htmlspecialchars($datosSeguro['enfermedades_cronicas'])) ?></div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">Contacto de Emergencia</div>
                        <div class="data-value"><?= $datosSeguro['contacto_emergencia'] ?? 'No disponible' ?></div>
                    </div>
                </div>
            <?php else : ?>
                <p>No se encontraron datos del seguro médico.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Diplomas y Titulos -->
<div class="modern-accordion-item diplomas-data">
    <h2 class="modern-accordion-header">
        <button class="modern-accordion-button collapsed" type="button" onclick="toggleAccordion('diplomasData')">
            <i class="bi bi-award-fill section-icon"></i>
            <span>Diplomas y Títulos</span>
        </button>
    </h2>
    <div id="diplomasData" class="modern-accordion-content">
        <div class="modern-accordion-body">
            <?php if (!empty($datosTitulos)) : ?>
                <div class="clients-table-container">
                    <table class="clients-table table">
                        <thead>
                            <tr>
                                <th>Institución</th>
                                <th>Nombre del Título</th>
                                <th>Tipo</th>
                                <th>N° Registro</th>
                                <th>Fecha Obtención</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datosTitulos as $titulo) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($titulo['nombre_institucion']) ?></td>
                                    <td><?= htmlspecialchars($titulo['nombre_titulo']) ?></td>
                                    <td><?= htmlspecialchars($titulo['tipo_titulo']) ?></td>
                                    <td><?= htmlspecialchars($titulo['numero_registro']) ?></td>
                                    <td><?= date('d/m/Y', strtotime($titulo['fecha_obtencion'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <p>No se encontraron diplomas o títulos registrados.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Historial Académico -->
<div class="modern-accordion-item historial-academico-data">
    <h2 class="modern-accordion-header">
        <button class="modern-accordion-button collapsed" type="button" onclick="toggleAccordion('historialAcademico')">
            <i class="bi bi-journal-text section-icon"></i>
            <span>Historial Académico</span>
        </button>
    </h2>
    <div id="historialAcademico" class="modern-accordion-content">
        <div class="modern-accordion-body">
            <?php if (!empty($datosHistorial)) : ?>
                <div class="clients-table-container">
                    <table class="clients-table table">
                        <thead>
                            <tr>
                                <th>Institución</th>
                                <th>Carrera</th>
                                <th>Nivel Educativo</th>
                                <th>Año Inicio</th>
                                <th>Año Fin</th>
                                <th>Modalidad</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datosHistorial as $historial) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($historial['nombre_institucion']) ?></td>
                                    <td><?= htmlspecialchars($historial['carrera']) ?></td>
                                    <td><?= htmlspecialchars($historial['nivel_educativo']) ?></td>
                                    <td><?= $historial['anio_inicio'] ?></td>
                                    <td><?= $historial['anio_fin'] ?></td>
                                    <td><?= htmlspecialchars($historial['modalidad_estudio']) ?></td>
                                    <td><?= htmlspecialchars($historial['estado']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <p>No se encontró historial académico registrado.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Mimp -->
<div class="modern-accordion-item mimp-data">
    <h2 class="modern-accordion-header">
        <button class="modern-accordion-button collapsed" type="button" onclick="toggleAccordion('mimpData')">
            <i class="bi bi-people-fill section-icon"></i>
            <span>Datos MIMP</span>
        </button>
    </h2>
    <div id="mimpData" class="modern-accordion-content">
        <div class="modern-accordion-body">
            <?php if (!empty($datosMimp)) : ?>
                <div class="simple-data-grid">
                    <div class="data-item">
                        <div class="data-label">Situación Familiar</div>
                        <div class="data-value"><?= htmlspecialchars($datosMimp['situacion_familiar']) ?></div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">Número de Hijos</div>
                        <div class="data-value"><?= $datosMimp['numero_hijos'] ?></div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">¿Es Víctima de Violencia?</div>
                        <div class="data-value">
                            <?= $datosMimp['es_victima_violencia'] ? '<span class="badge bg-danger">Sí</span>' : '<span class="badge bg-success">No</span>' ?>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <p>No se encontraron datos del MIMP.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Sunedu -->
<?php
require_once "../controller/SuneduController.php";
$suneduController = new SuneduController();
$datosSunedu = $suneduController->obtenerDatos($dni);
?>

<div class="modern-accordion-item sunedu-data">
    <h2 class="modern-accordion-header">
        <button class="modern-accordion-button collapsed" type="button" onclick="toggleAccordion('suneduData')">
            <i class="bi bi-mortarboard-fill section-icon"></i>
            <span>Registro SUNEDU</span>
        </button>
    </h2>
    <div id="suneduData" class="modern-accordion-content">
        <div class="modern-accordion-body">
            <?php if (!empty($datosSunedu)) : ?>
                <div class="simple-data-grid">
                    <div class="data-item">
                        <div class="data-label">Estado del Grado</div>
                        <div class="data-value"><?= htmlspecialchars($datosSunedu['estado_grado']) ?></div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">Registro SUNEDU</div>
                        <div class="data-value"><?= htmlspecialchars($datosSunedu['registro_sunedu']) ?></div>
                    </div>
                </div>
            <?php else : ?>
                <p>No se encontraron registros en SUNEDU.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Denuncias -->
<div class="modern-accordion-item denuncias-data">
    <h2 class="modern-accordion-header">
        <button class="modern-accordion-button collapsed" type="button" onclick="toggleAccordion('denunciasViolenciaData')">
            <i class="bi bi-exclamation-triangle-fill section-icon"></i>
            <span>Denuncias por Violencia</span>
        </button>
    </h2>
    <div id="denunciasViolenciaData" class="modern-accordion-content">
        <div class="modern-accordion-body">
            <?php if (!empty($datosDenunciasViolencia)) : ?>
                <div class="clients-table-container">
                    <table class="clients-table table table-striped">
                        <thead>
                            <tr>
                                <th>Tipo de Violencia</th>
                                <th>Tipo de Agresor</th>
                                <th>Fecha de Denuncia</th>
                                <th>Estado de la Denuncia</th>
                                <th>Fecha de Resolución</th>
                                <th>Orden de Protección</th>
                                <th>Centro de Atención</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($datosDenunciasViolencia as $denuncia) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($denuncia['tipo_violencia']) ?></td>
                                    <td><?= htmlspecialchars($denuncia['tipo_agresor']) ?></td>
                                    <td><?= $denuncia['fecha_denuncia'] ? date('d/m/Y', strtotime($denuncia['fecha_denuncia'])) : '' ?></td>
                                    <td><?= htmlspecialchars($denuncia['estado_denuncia']) ?></td>
                                    <td><?= $denuncia['fecha_resolucion'] ? date('d/m/Y', strtotime($denuncia['fecha_resolucion'])) : '' ?></td>
                                    <td>
                                        <?= $denuncia['orden_proteccion'] ? '<span class="badge bg-danger">Sí</span>' : '<span class="badge bg-secondary">No</span>' ?>
                                    </td>
                                    <td><?= htmlspecialchars($denuncia['centro_atencion']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <p>No se encontraron denuncias por violencia asociadas.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Biometricos -->
<div class="modern-accordion-item biometricos-data">
    <h2 class="modern-accordion-header">
        <button class="modern-accordion-button collapsed" type="button" onclick="toggleAccordion('biometricosData')">
            <i class="bi bi-person-vcard-fill section-icon"></i>
            <span>Biométricos RENIEC</span>
        </button>
    </h2>
    <div id="biometricosData" class="modern-accordion-content">
        <div class="modern-accordion-body">
            <?php if (!empty($datosBiometricos)) : ?>
                <div class="simple-data-grid">
                    <div class="data-item">
                        <div class="data-label">Formato de Archivo</div>
                        <div class="data-value"><?= htmlspecialchars($datosBiometricos['formato_archivo']) ?: 'No disponible' ?></div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">Huella Dactilar</div>
                        <div class="data-value">
                            <?php if (!empty($datosBiometricos['huella_dactilar'])): ?>
                                <img src="data:image/png;base64,<?= base64_encode($datosBiometricos['huella_dactilar']) ?>" alt="Huella Dactilar" style="max-height: 120px;">
                            <?php else: ?>
                                <span>No disponible</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">Firma Digital</div>
                        <div class="data-value">
                            <?php if (!empty($datosBiometricos['firma_digital'])): ?>
                                <img src="data:image/png;base64,<?= base64_encode($datosBiometricos['firma_digital']) ?>" alt="Firma Digital" style="max-height: 120px;">
                            <?php else: ?>
                                <span>No disponible</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="data-item">
                        <div class="data-label">Fotografía</div>
                        <div class="data-value">
                            <?php if (!empty($datosBiometricos['fotografia'])): ?>
                                <img src="data:image/png;base64,<?= base64_encode($datosBiometricos['fotografia']) ?>" alt="Fotografía" style="max-height: 120px;">
                            <?php else: ?>
                                <span>No disponible</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <p>No se encontraron datos biométricos para este DNI.</p>
            <?php endif; ?>
        </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>