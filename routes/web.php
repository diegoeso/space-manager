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

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
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
    Route::resource('mensajes', 'Admins\MensajesController');
    Route::get('mensajes/responder/{id}', 'Admins\MensajesController@responder')->name('mensajes.responder');

    /**
     * Actividades Academicas (Horarios y calendarios de examenes);
     */
    Route::resource('actividades', 'Admins\ActividadesController');

    /**
     * Actividades Academicas (Horarios y calendarios de examenes);
     */
    Route::resource('calendarios', 'Admins\CalendarioEscolarController');
    Route::get('calendarios-horarios', 'Admins\CalendarioEscolarController@horarios')->name('calendarios.horarios');
    Route::get('calendarios/listarHorarios/{id}', 'Admins\CalendarioEscolarController@listarHorarios')->name('calendarios.listarHorarios');

    /**
     * Solicitud de elementos
     */
    Route::resource('solicitudes-elementos', 'Admins\SolicitudElementosController');
    Route::get('solicitudes-elementos/listarSolicitudesUsuario/{id}', 'Admins\SolicitudElementosController@listarSolicitudes')->name('solicitudes-elementos.listarSolicitudes');
    Route::get('solicitudes-elementos/cancelar/{id}', 'Admins\SolicitudElementosController@cancelar')->name('solicitudes-elementos.cancelar');
    Route::get('solicitudes-elementos/{id}/aprobar', 'Admins\SolicitudElementosController@aprobar')->name('solicitudes-elementos.aprobar');
    Route::put('solicitudes-elementos/{id}/rechazar', 'Admins\SolicitudElementosController@rechazar')->name('solicitudes-elementos.rechazar');
    Route::put('solicitudes-elementos/{id}/cancelar', 'Admins\SolicitudElementosController@cancelar')->name('solicitudes-elementos.cancelar');
});

/**
 * Login para usuarios tipo Profesor y Alumnos
 */
Route::get('login', 'Auth\UsuarioLoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\UsuarioLoginController@login')->name('login');
Route::get('inicio', 'HomeController@dashboard')->name('dashboard');
Route::post('logout', 'Auth\UsuarioLoginController@logout')->name('logout');

/**
 * Registro de usuarios
 */
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

/**
 * Confirmacion de cuenta
 */
Route::get('/confirmacion', 'HomeController@index')->name('confirmacion');
Route::get('/confirmacion/{email}/token/{codigoConfirmacion}', 'HomeController@confirmacion');
Route::get('/reenviarCorreo/{id}/token/{codigoConfirmacion}', 'HomeController@reenviarCorreo');

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
Route::get('mensaje/responder/{id}', 'Usuarios\MensajesController@responder')->name('mensaje.responder');

/**
 * Solicitud de elementos
 */

Route::resource('solicitud-elementos', 'Usuarios\SolicitudElementosController');
Route::get('solicitud-elementos/listarSolicitudesUsuario/{id}', 'Usuarios\SolicitudElementosController@listarSolicitudes')->name('listarSolicitudes');
Route::get('solicitud-elementos/cancelar/{id}', 'Usuarios\SolicitudElementosController@cancelar')->name('solicitud-elementos.cancelar');
/**
 * Evaluaciones de los usuarios
 */
Route::resource('evaluaciones', 'Admins\EvaluacionesController');
Route::get('evaluaciones/listarEvaluaciones/{id}', 'Admins\EvaluacionesController@listarEvaluaciones');
