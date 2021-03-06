<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', 'AdminController@index')->name('admin');
Route::post('/admin/solicitud/store', 'AdminController@store')->name('solicitudes.storeA');

// prefijo admin para las vistas de administracion
Route::prefix('admin')->group(function () {
    // Perfiles
    Route::get('/perfil', 'AdminController@perfil')->name('admin.perfil');
    Route::put('/perfil/{id}', 'AdminController@update')->name('admin.perfil.update');

    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\LoginController@login')->name('admin.login.submit');
    Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');

    /**
     * controlar para administrador y responsable de area
     */
    Route::resource('users', 'Admins\UserController');
    Route::get('users/listarUsers/{id}', 'Admins\UserController@listarUsers')->name('users.listarUsers');

    /**
     *Controlador para los usuarios (profesores y alumnos)
     */
    Route::resource('usuarios', 'Admins\UsuarioController');
    Route::get('usuarios/listarUsuarios/{id}', 'Admins\UsuarioController@listarUsuarios')->name('usuarios.listarUsuarios');

    /**
     * ruta para controlar areas
     */
    Route::resource('areas', 'Admins\AreaController');
    Route::get('areas/listarAreas/{id}', 'Admins\AreaController@listarAreas')->name('areas.listarAreas');

    /**
     * Controlador para categoria elementos
     */
    Route::resource('categoria-elementos', 'Admins\CategoriaElementoController');
    Route::get('categoria-elementos/listarCategorias/{id}', 'Admins\CategoriaElementoController@listarCategorias')->name('categoria-elementos.listarCategorias');
    /**
     * Controlador para elementos
     */
    Route::resource('elementos', 'Admins\ElementoController');
    Route::get('elementos/listarElementos/{id}', 'Admins\ElementoController@listarElementos')->name('elementos.listarElementos');

    /**
     *Controlador para espacios academicos
     */
    Route::resource('espacios', 'Admins\EspacioController');
    Route::get('espacios/listarEspacios/{id}', 'Admins\EspacioController@listarEspacios')->name('espacios.listarEspacios');
    Route::post('espacios/estadisticas', 'Admins\EspacioController@estadisticas')->name('espacios.estadisticas');
    // Route::get('espacios/estadisticas/uso', 'Admins\EspacioController@mostrar_estadisticas')->name('espacios.mostrar_estadisticas');
    // Route::post('espacios/estadisticas-espacios-usados', 'Admins\EspacioController@grafica_espacios_usados')->name('espacios.estadisticas_espacios');
    /**
     * Controlador para solicitudes
     */
    Route::resource('solicitudes', 'Admins\SolicitudController');
    Route::get('solicitudes/{id}/aprobar', 'Admins\SolicitudController@aprobar')->name('solicitudes.aprobar');
    Route::put('solicitudes/{id}/rechazar', 'Admins\SolicitudController@rechazar')->name('solicitudes.rechazar');
    Route::put('solicitudes/{id}/cancelar', 'Admins\SolicitudController@cancelar')->name('solicitudes.cancelar');
    Route::get('solicitudes/listarSolicitudes/{id}', 'Admins\SolicitudController@listarSolicitudes')->name('solicitudes.listarSolicitudes');
    Route::get('solicitudes/ver/{id}', 'Admins\SolicitudController@ver')->name('solicitudes.ver');

    /**
     * Controlador para Roles y permisos
     */
    Route::resource('roles', 'Admins\RoleController');

    /**
     * Controlador para mensaje de administrador
     */
    // Mensajes
    Route::resource('correo', 'Admins\CorreosController');
    Route::get('correo/entrada/{email}', 'Admins\CorreosController@entrada');
    Route::get('correo-enviados', 'Admins\CorreosController@enviados')->name('correo.enviados');
    Route::get('correo/salida/{email}', 'Admins\CorreosController@salida');
    Route::get('correo-borrados', 'Admins\CorreosController@eliminados')->name('correo.eliminados');
    Route::get('correo/basura/{email}', 'Admins\CorreosController@correo_eliminado');
    Route::post('correo-fetch', 'Admins\CorreosController@fetch')->name('correo.fetch');
    Route::get('correo/delete/{id}', 'Admins\CorreosController@delete')->name('correo.delete');
    Route::get('correo/delete/salida/{id}', 'Admins\CorreosController@delete_de')->name('correo.delete_de');
    Route::get('correo/responder/{id}', 'Admins\CorreosController@responder')->name('correo.responder');

    /* Actividades Academicas (Horarios y calendarios de examenes);
     */
    Route::resource('calendarios', 'Admins\CalendarioEscolarController');
    Route::get('calendarios-horarios', 'Admins\CalendarioEscolarController@horarios')->name('calendarios.horarios');
    Route::get('calendarios/listarHorarios/{id}', 'Admins\CalendarioEscolarController@listarHorarios')->name('calendarios.listarHorarios');

    /**
     * PDF
     */
    Route::get('pdf/admin', 'Admins\UserController@administradores')->name('pdf.admin');
    Route::get('pdf/usuario', 'Admins\UsuarioController@usuarios')->name('pdf.usuarios');
    Route::get('pdf/area', 'Admins\AreaController@areas')->name('pdf.areas');
    Route::get('pdf/cateogoria-elementos', 'Admins\CategoriaElementoController@categoria_elementos')->name('pdf.cateogoria-elementos');
    Route::get('pdf/elemento', 'Admins\ElementoController@elementos')->name('pdf.elementos');
    Route::get('pdf/espacio', 'Admins\EspacioController@espacios')->name('pdf.espacios');
    Route::get('pdf/solicitud', 'Admins\SolicitudController@solicitudes')->name('pdf.solicitudes');
    Route::get('pdf/solicitud/{id}', 'Admins\SolicitudController@solicitud')->name('pdf.solicitud');
    Route::get('pdf/solicitud-usuario', 'Usuarios\SolicitudController@solicitudes')->name('pdf.solicitudesU');
    Route::get('pdf/solicitud-usuario/{id}', 'Usuarios\SolicitudController@solicitud')->name('pdf.solicitudU');

    Route::get('export-usuarios', 'Admins\UsuarioController@export')->name('admin.export');
    // Export Import Areas
    Route::get('export-areas', 'Admins\AreaController@export')->name('admin.export-area');
    Route::post('import-areas', 'Admins\AreaController@import')->name('admin.import-area');

    // Export Import Elementos
    Route::get('export-elementos', 'Admins\ElementoController@export')->name('admin.export-elemento');
    Route::post('import-elementos', 'Admins\ElementoController@import')->name('admin.import-elemento');

    // Export Import CategoriaElementos
    Route::get('export-categoria-elementos', 'Admins\CategoriaElementoController@export')->name('admin.export-categoriaE');
    Route::post('import-categoria-elementos', 'Admins\CategoriaElementoController@import')->name('admin.import-categoriaE');

    // Export Import Espacios
    Route::get('export-espacios', 'Admins\EspacioController@export')->name('admin.export-espacios');
    Route::post('import-espacios', 'Admins\EspacioController@import')->name('admin.import-espacios');

    // Export Solicitudes
    Route::get('export-solicitudes', 'Admins\SolicitudController@export')->name('admin.export-solicitud');

});

// Restablecer contraseña
Route::get('password/reset', 'Auth\RestablecerContraseñaController@showForm')->name('password.request');
Route::post('password/email', 'Auth\RestablecerContraseñaController@enviarLink')->name('password.email');

/**
 * Login para usuarios tipo Profesor y Alumnos
 */
Route::get('login', 'Auth\UsuarioLoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\UsuarioLoginController@login')->name('login');

// Route::get('inicio', 'HomeController@dashboard')->name('dashboard');
Route::get('inicio', 'UsuarioController@dashboard')->name('dashboard');

Route::post('logout', 'Auth\UsuarioLoginController@logout')->name('logout');

/**
 * Registro de usuarios
 */
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

/**
 * Confirmacion de cuenta
 */
Route::get('confirmacion-de-cuenta', 'UsuarioController@confirmarCuenta')->name('confirmarCuenta');
Route::get('confirmacion/{email}/token/{codigoConfirmacion}', 'UsuarioController@confirmacion');
Route::get('reenviar-confirmacion/{id}/token/{codigoConfirmacion}', 'UsuarioController@reenviarCorreo');

/**
 * Peticiones AJAX
 */
Route::get('/admin/espacios/elementos/{idCategoria}', 'Admins\AJAXController@elementos');
Route::get('/admin/espacios/categorias-elementos/{id}', 'Admins\AJAXController@categorias');
Route::get('/admin/espacios/detalles/{id}', 'Admins\AJAXController@detallesEspacio');
Route::get('/admin/elementos/existencias/{id}', 'Admins\AJAXController@existenciasElementos');

/**
 * Solicitudes
 */
Route::get('/admin/solicitudes/espacios/{idA}', 'Admins\AJAXController@espacios');
Route::get('/admin/solicitudes/infoEspacio/{id}', 'Admins\AJAXController@infoEspacio');
Route::get('/admin/solicitudes/elementos-espacio/{id}', 'Admins\AJAXController@elementosEspacio');
Route::get('/admin/solicitudes/detalles/{id}', 'Admins\AJAXController@detallesSolicitud');
Route::get('/admin/solicitudes/solicitudesFullCalendar/{estado}', 'Admins\AJAXController@solicitudesFullCalendar');
Route::get('/admin/solicitudes/solicitudesFullCalendarUsuarios/{carrera}', 'Admins\AJAXController@solicitudesFullCalendarUsuarios');

// actualizar inventario de elementos al eliminar elemento de la solicitud
Route::get('/admin/solicitudes/editarElemento/{id}/cantidad/{cantidad}/solicitud/{solicitud}', 'Admins\AJAXController@editarElemento');

// Eliminar elemento asociado de espacio academico
Route::get('/admin/espacios/editarEspacio/{id}/{espacio}', 'Admins\AJAXController@editarEspacio');

Route::get('/admin/calendario/calendarioEscolar/{carrera}', 'Admins\AJAXController@calendarioEscolar');
// Mostrar informacion de la solicitud seleccionada (usuarios)
Route::get('/admin/solicitudes/mostrarSolicitud/{id}', 'Admins\AJAXController@mostrarSolicitud');

// Perfiles
Route::get('/perfil', 'GeneralController@perfil')->name('perfil');
Route::put('/perfil/{id}', 'GeneralController@update')->name('perfil.update');

/**
 * Controlador para solicitudes de usuarios
 */
Route::resource('solicitud', 'Usuarios\SolicitudController');
Route::get('solicitud/ver/{id}', 'Usuarios\SolicitudController@ver')->name('solicitud.ver');
Route::get('solicitud/listarSolicitudesUsuario/{id}', 'Usuarios\SolicitudController@listarSolicitudes')->name('listarSolicitudes');
Route::post('solicitud/cancelar', 'Usuarios\SolicitudController@cancelar')->name('solicitud.cancelar');

/**
 * Controlador para mensajes Usuario
 */
Route::resource('mensaje', 'Usuarios\MensajesController');
Route::get('mensaje/entrada/{email}', 'Usuarios\MensajesController@entrada');
Route::get('mensaje-enviados', 'Usuarios\MensajesController@enviados')->name('mensaje.enviados');
Route::get('mensaje/salida/{email}', 'Usuarios\MensajesController@salida');
Route::get('mensaje/responder/{id}', 'Usuarios\MensajesController@responder')->name('mensaje.responder');
Route::get('mensaje/delete/{id}', 'Usuarios\MensajesController@delete')->name('mensaje.delete');
Route::get('mensaje/delete/salida/{id}', 'Usuarios\MensajesController@delete_de')->name('mensaje.delete_de');
Route::get('mensajes-borrados', 'Usuarios\MensajesController@eliminados')->name('mensaje.eliminados');
Route::get('mensaje/basura/{email}', 'Usuarios\MensajesController@correo_eliminado');
/**
 * Evaluaciones de los usuarios
 */
Route::resource('evaluaciones', 'Admins\EvaluacionesController');
Route::get('evaluaciones/listarEvaluaciones/{id}', 'Admins\EvaluacionesController@listarEvaluaciones');

Route::get('grafica/solicitudes', 'Admins\AJAXController@solicitudesGrafica')->name('solicitudesGrafica');

Route::get('grafica/evaluaciones-usuario', 'Admins\AJAXController@evaluacionesUsuarios')->name('evaluacionesUsuarios');

// Calendario en vista welcome
Route::get('calendar/{carrera}', 'CalendarController@welcome_calendar')->name('calendar');
Route::get('mostrar_evento/{id}', 'CalendarController@mostrar_evento')->name('evento');
