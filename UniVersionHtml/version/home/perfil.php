<?php
require_once "../controller/ReniecController.php";

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
    <link rel="stylesheet" href="./style/style.css">
</head>

<body>
    <div class="container">
        <div class="main-panel">
            <h2 class="text-center mb-4 text-primary">
                <i class="bi bi-person-badge-fill me-2"></i>Panel de Información de Personas
            </h2>

            <div class="accordion" id="accordionPanels">
                <!-- Datos Personales -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#datosPersonales" aria-expanded="true" aria-label="Datos personales">
                            <i class="bi bi-person-vcard-fill section-icon"></i>Datos Personales
                        </button>
                    </h2>
                    <div id="datosPersonales" class="accordion-collapse collapse show"
                        data-bs-parent="#accordionPanels">
                        <div class="accordion-body">
                            <div class="row align-items-center">
                                <div class="col-md-3 text-center mb-3 mb-md-0">
                                    <img src="data:image/jpeg;base64,[IMAGEN_BASE64]" alt="Foto"
                                        class="photo img-thumbnail">
                                    <div class="mt-2 small text-muted">Última actualización: 15/10/2023</div>
                                </div>
                                <div class="col-md-9">
                                    <p><strong>DNI:</strong><span><?= $datosReniec['dni'] ?? 'No disponible' ?></span></p>
                                    <p><strong>Apellido Paterno:</strong><span><?= $datosReniec['apellido_paterno'] ?? 'No disponible' ?></span></p>
                                    <p><strong>Apellido Materno:</strong><span><?= $datosReniec['apellido_materno'] ?? 'No disponible' ?></span></p>
                                    <p><strong>Nombres:</strong><span><?= $datosReniec['nombres'] ?? 'No disponible' ?></span></p>
                                    <p><strong>Fecha de Nacimiento:</strong><span><?= $datosReniec['fecha_nacimiento'] ?? 'No disponible' ?></span></p>
                                    <p><strong>Sexo:</strong><span><?= $datosReniec['sexo'] ?? 'No disponible' ?></span></p>
                                    <p><strong>Estado Civil:</strong><span><?= $datosReniec['estado_civil'] ?? 'No disponible' ?></span></p>
                                    <p><strong>Dirección:</strong><span><?= $datosReniec['direccion'] ?? 'No disponible' ?></span></p>
                                    <p><strong>Departamento:</strong><span><?= $datosReniec['departamento'] ?? 'No disponible' ?></span></p>
                                    <p><strong>Provincia:</strong><span><?= $datosReniec['provincia'] ?? 'No disponible' ?></span></p>
                                    <p><strong>Distrito:</strong><span><?= $datosReniec['distrito'] ?? 'No disponible' ?></span></p>
                                    <p><strong>Nacionalidad:</strong><span><?= $datosReniec['nacionalidad'] ?? 'No disponible' ?></span></p>
                                    <p><strong>Telefono Fijo:</strong><span><?= $datosReniec['telefono_fijo'] ?? 'No disponible' ?></span></p>
                                    <p><strong>Telefono Movil:</strong><span><?= $datosReniec['telefono_movil'] ?? 'No disponible' ?></span></p>
                                    <p><strong>Correo Electronico:</strong><span><?= $datosReniec['correo_electronico'] ?? 'No disponible' ?></span></p>
                                    <p><strong>Estado:</strong><span class="badge bg-success"><?= $datosReniec['estado'] ?? 'No disponible' ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RENIEC -->
                <div class="accordion-item reniec">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#reniecData" aria-expanded="false" aria-label="Datos RENIEC">
                            <i class="bi bi-file-earmark-text-fill section-icon"></i>Datos RENIEC
                        </button>
                    </h2>
                    <div id="reniecData" class="accordion-collapse collapse" data-bs-parent="#accordionPanels">
                        <div class="accordion-body">
                            <p><strong>Estado DNI:</strong><span>Vigente</span></p>
                            <p><strong>Fecha de Emisión:</strong><span>15/05/2020</span></p>
                            <p><strong>Fecha de Caducidad:</strong><span>15/05/2030</span></p>
                            <p><strong>Lugar de Emisión:</strong><span>Oficina RENIEC Miraflores</span></p>
                            <p><strong>Estado Civil Registrado:</strong><span>Soltero</span></p>
                        </div>
                    </div>
                </div>

                <!-- Records Penales -->
                <div class="accordion-item records">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#recordsPenales" aria-expanded="false" aria-label="Records penales">
                            <i class="bi bi-shield-lock-fill section-icon"></i>Records Penales
                        </button>
                    </h2>
                    <div id="recordsPenales" class="accordion-collapse collapse" data-bs-parent="#accordionPanels">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead class="table-danger">
                                        <tr>
                                            <th>Número Expediente</th>
                                            <th>Delito</th>
                                            <th>Código Delito</th>
                                            <th>Fecha Delito</th>
                                            <th>Fecha Detencion</th>
                                            <th>Fecha Sentencia</th>
                                            <th>Tipo Sentencia</th>
                                            <th>Pena Impuesta</th>
                                            <th>Reparacion Civil</th>
                                            <th>Fecha Inicio de Pena</th>
                                            <th>Fecha Fin de Pena</th>
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
                                        <tr>
                                            <td>EXP12345</td>
                                            <td>Robo agravado</td>
                                            <td>ART-123</td>
                                            <td>15/03/2015</td>
                                            <td>Condenatoria</td>
                                            <td>5 años</td>
                                            <td>Lurigancho</td>
                                            <td><span class="badge bg-success">Cumplida</span></td>
                                            <td>Lurigancho</td>
                                            <td>Lurigancho</td>
                                            <td>Lurigancho</td>
                                            <td>Lurigancho</td>
                                            <td>Lurigancho</td>
                                            <td>Lurigancho</td>
                                            <td>Lurigancho</td>
                                            <td>Lurigancho</td>
                                            <td>Lurigancho</td>
                                            <td>Lurigancho</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- <div class="alert alert-info mt-3">
                                <i class="bi bi-info-circle-fill me-2"></i>Información proporcionada por el Ministerio
                                de Justicia.
                            </div> -->
                        </div>
                    </div>
                </div>

                <!-- Seguro Médico -->
                <div class="accordion-item medical">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#seguroMedico" aria-expanded="false" aria-label="Seguro médico">
                            <i class="bi bi-heart-pulse-fill section-icon"></i>Seguro Médico
                        </button>
                    </h2>
                    <div id="seguroMedico" class="accordion-collapse collapse" data-bs-parent="#accordionPanels">
                        <div class="accordion-body">
                            <p><strong>Historial Médico:</strong><span>O+</span></p>
                            <p><strong>Tipo de Sangre:</strong><span>O+</span></p>
                            <p><strong>Alergias:</strong><span>Ninguna</span></p>
                            <p><strong>Enfermedades Crónicas:</strong><span>Hipertensión</span></p>
                            <p><strong>Contacto de Emergencia:</strong><span>María López (madre) - 987123456</span></p>
                        </div>
                    </div>
                </div>

                <!-- Afiliacion Seguro Medico -->
                <div class="accordion-item afilliation">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#afiliacionSeguroMedico" aria-expanded="false"
                            aria-label="Afilición Seguro Médico">
                            <i class="bi bi-hospital-fill section-icon"></i>Afilición Seguro Médico
                        </button>
                    </h2>
                    <div id="afiliacionSeguroMedico" class="accordion-collapse collapse"
                        data-bs-parent="#accordionPanels">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Tipo Seguro</th>
                                            <th>Fecha Afiliación</th>
                                            <th>Fecha Baja</th>
                                            <th>Estado</th>
                                            <th>Centro Atención</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>ESSALUD</td>
                                            <td>01/01/2010</td>
                                            <td><span class="badge bg-success">Activo</span></td>
                                            <td>Hospital Rebagliati</td>
                                            <td>Hospital Rebagliati</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sunedu -->
                <div class="accordion-item sunedu">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#suneduData" aria-expanded="false" aria-label="Datos SUNEDU">
                            <i class="bi bi-mortarboard-fill section-icon"></i>Datos SUNEDU
                        </button>
                    </h2>
                    <div id="suneduData" class="accordion-collapse collapse" data-bs-parent="#accordionPanels">
                        <div class="accordion-body">
                            <p><strong>Estado Grado:</strong><span>Titulado</span></p>
                            <p><strong>Registro SUNEDU:</strong><span>REG-2019-01234</span></p>
                        </div>
                    </div>
                </div>

                <!-- Historial Academico -->
                <div class="accordion-item historialAcademico">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#historialAcademico" aria-expanded="false" aria-label="Historial Academico">
                            <i class="bi bi-journal-bookmark-fill section-icon"></i>Historial Academico
                        </button>
                    </h2>
                    <div id="historialAcademico" class="accordion-collapse collapse" data-bs-parent="#accordionPanels">
                        <div class="accordion-body">
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Institución</th>
                                            <th>Carrera</th>
                                            <th>Nivel</th>
                                            <th>Año Inicio</th>
                                            <th>Año Fin</th>
                                            <th>Modalidad</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Universidad Nacional Mayor de San Marcos</td>
                                            <td>Ingeniería de Sistemas</td>
                                            <td>2006</td>
                                            <td>2012</td>
                                            <td>2012</td>
                                            <td>2012</td>
                                            <td><span class="badge bg-success">Egresado</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Diplomas y Titulos -->
                <div class="accordion-item education">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#educacion" aria-expanded="false" aria-label="Educación">
                            <i class="bi bi-book-fill section-icon"></i>Diplomas y Títulos
                        </button>
                    </h2>
                    <div id="educacion" class="accordion-collapse collapse" data-bs-parent="#accordionPanels">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Institución</th>
                                            <th>Título</th>
                                            <th>Tipo</th>
                                            <th>Número Registro</th>
                                            <th>Fecha Obtención</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>UNMSM</td>
                                            <td>Bachiller en Ingeniería de Sistemas</td>
                                            <td>Grado Académico</td>
                                            <td>Grado Académico</td>
                                            <td>15/12/2012</td>
                                        </tr>
                                        <tr>
                                            <td>UNMSM</td>
                                            <td>Título Profesional de Ingeniero de Sistemas</td>
                                            <td>Título Profesional</td>
                                            <td>Grado Académico</td>
                                            <td>20/05/2013</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DENUNCIAS VIOLENCIA -->
                <div class="accordion-item denunciasViolencia">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#denunciasViolencia" aria-expanded="false" aria-label="Denuncias Violencia">
                            <i class="bi bi-flag-fill section-icon"></i>Denuncias Violencia
                        </button>
                    </h2>
                    <div id="denunciasViolencia" class="accordion-collapse collapse" data-bs-parent="#accordionPanels">
                        <div class="accordion-body">
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tipo Violencia</th>
                                            <th>Tipo Agresor</th>
                                            <th>Fecha Denuncia</th>
                                            <th>Estado Denuncia</th>
                                            <th>Fecha Resolucion</th>
                                            <th>Orden Protección</th>
                                            <th>Centro Atencion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Universidad Nacional Mayor de San Marcos</td>
                                            <td>Ingeniería de Sistemas</td>
                                            <td>2006</td>
                                            <td>2012</td>
                                            <td>2012</td>
                                            <td>2012</td>
                                            <td><span class="badge bg-success">Egresado</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SUNAT -->
                <div class="accordion-item sunat">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#sunatData" aria-expanded="false" aria-label="Datos SUNAT">
                            <i class="bi bi-building-fill section-icon"></i>Datos SUNAT
                        </button>
                    </h2>
                    <div id="sunatData" class="accordion-collapse collapse" data-bs-parent="#accordionPanels">
                        <div class="accordion-body">
                            <p><strong>RUC:</strong><span>20123456781</span></p>
                            <p><strong>Tipo Contribuyente:</strong><span>Persona Natural</span></p>
                            <p><strong>Nombre Legal:</strong><span>PÉREZ LÓPEZ JUAN CARLOS</span></p>
                            <p><strong>Nombre Comercial:</strong><span>20123456781</span></p>
                            <p><strong>Estado Contribuyente:</strong><span class="badge bg-success">HABIDO</span></p>
                            <p><strong>Fecha Inscripción:</strong><span>15/01/2015</span></p>
                            <p><strong>Domicilio Fiscal:</strong><span>Av. Siempre Viva 123, Miraflores, Lima</span></p>
                            <p><strong>Actividades:</strong><span>20123456781</span></p>
                            <p><strong>Régimen Tributario:</strong><span>Régimen General</span></p>

                            <h5 class="mt-4">Actividades Económicas</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Actividad</th>
                                            <th>Ingreso Aprox. Mensual</th>
                                            <th>Frecuencia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Consultoría en Sistemas</td>
                                            <td>S/ 8,500.00</td>
                                            <td>Permanente</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MIMP -->
                <div class="accordion-item family">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#mimpData" aria-expanded="false" aria-label="Datos MIMP">
                            <i class="bi bi-people-fill section-icon"></i>Datos MIMP
                        </button>
                    </h2>
                    <div id="mimpData" class="accordion-collapse collapse" data-bs-parent="#accordionPanels">
                        <div class="accordion-body">
                            <p><strong>Situación Familiar:</strong><span>Vive con padres y hermana</span></p>
                            <p><strong>Número de Hijos:</strong><span>0</span></p>
                            <p><strong>Es Víctima de Violencia:</strong><span class="badge bg-danger">No</span></p>
                        </div>
                    </div>
                </div>

                <!-- Biometricos -->
                <div class="accordion-item biometricos">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#biometricos" aria-expanded="false" aria-label="Biometricos">
                            <i class="bi bi-fingerprint section-icon"></i>Biometricos
                        </button>
                    </h2>
                    <div id="biometricos" class="accordion-collapse collapse" data-bs-parent="#accordionPanels">
                        <div class="accordion-body">
                            <div class="row align-items-center">
                                <div class="col-md-4 text-center mb-3 mb-md-0">
                                    <img src="data:image/jpeg;base64,[IMAGEN_BASE64]" alt="Foto"
                                        class="photo img-thumbnail">
                                    <div class="mt-2 small text-muted">Huella Dactilar</div>
                                </div>
                                <div class="col-md-4 text-center mb-3 mb-md-0">
                                    <img src="data:image/jpeg;base64,[IMAGEN_BASE64]" alt="Foto"
                                        class="photo img-thumbnail">
                                    <div class="mt-2 small text-muted">Firma Digital</div>
                                </div>
                                <div class="col-md-4 text-center mb-3 mb-md-0">
                                    <img src="data:image/jpeg;base64,[IMAGEN_BASE64]" alt="Foto"
                                        class="photo img-thumbnail">
                                    <div class="mt-2 small text-muted">Fotografía</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center mt-5 text-muted small">
        Última actualización: Abril 2025 | Sistema de Información de Personas
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>