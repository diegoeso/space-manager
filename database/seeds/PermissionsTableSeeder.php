<?php

use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Users
        Permission::create([
            'name'        => 'Navegar administradores',
            'slug'        => 'users.index',
            'description' => 'Lista y navega todos los usuarios del sistema',
        ]);

        Permission::create([
            'name'        => 'Ver detalle de administrador',
            'slug'        => 'users.show',
            'description' => 'Ve en detalle cada usuario del sistema',
        ]);

        Permission::create([
            'name'        => 'Creación administradores',
            'slug'        => 'users.create',
            'description' => 'Podría crear nuevos administradores en el sistema',
        ]);

        Permission::create([
            'name'        => 'Edición de administrador',
            'slug'        => 'users.edit',
            'description' => 'Podría editar cualquier dato de un usuario del sistema',
        ]);

        Permission::create([
            'name'        => 'Eliminar administrador',
            'slug'        => 'users.destroy',
            'description' => 'Podría eliminar cualquier usuario del sistema',
        ]);

        //Permisos Roles
        Permission::create([
            'name'        => 'Navegar roles',
            'slug'        => 'roles.index',
            'description' => 'Lista y navega todos los roles del sistema',
        ]);

        Permission::create([
            'name'        => 'Ver detalle de un rol',
            'slug'        => 'roles.show',
            'description' => 'Ve en detalle cada rol del sistema',
        ]);

        Permission::create([
            'name'        => 'Creación de roles',
            'slug'        => 'roles.create',
            'description' => 'Podría crear nuevos roles en el sistema',
        ]);

        Permission::create([
            'name'        => 'Edición de roles',
            'slug'        => 'roles.edit',
            'description' => 'Podría editar cualquier dato de un rol del sistema',
        ]);

        Permission::create([
            'name'        => 'Eliminar roles',
            'slug'        => 'roles.destroy',
            'description' => 'Podría eliminar cualquier rol del sistema',
        ]);

        // Permisos Usuarios
        Permission::create([
            'name'        => 'Navegar usuario (profesor-alumno)',
            'slug'        => 'usuarios.index',
            'description' => 'Lista y navega todos los usuario (profesor-alumno) del sistema',
        ]);

        Permission::create([
            'name'        => 'Ver detalle de un usuario (profesor-alumno)',
            'slug'        => 'usuarios.show',
            'description' => 'Ve en detalle cada usuario (profesor-alumno) del sistema',
        ]);

        Permission::create([
            'name'        => 'Creación de usuarios',
            'slug'        => 'usuarios.create',
            'description' => 'Podría crear nuevos usuario (profesor-alumno) en el sistema',
        ]);

        Permission::create([
            'name'        => 'Edición de usuarios',
            'slug'        => 'usuarios.edit',
            'description' => 'Podría editar cualquier dato de un usuario (profesor-alumno) del sistema',
        ]);

        Permission::create([
            'name'        => 'Eliminar usuarios',
            'slug'        => 'usuarios.destroy',
            'description' => 'Podría eliminar cualquier usuario (profesor-alumno) del sistema',
        ]);

        // Permisos Areas
        Permission::create([
            'name'        => 'Navegar áreas',
            'slug'        => 'areas.index',
            'description' => 'Lista y navega todos los áreas del sistema',
        ]);

        Permission::create([
            'name'        => 'Ver detalle de un área',
            'slug'        => 'areas.show',
            'description' => 'Ve en detalle cada área del sistema',
        ]);

        Permission::create([
            'name'        => 'Creación de áreas',
            'slug'        => 'areas.create',
            'description' => 'Podría crear nuevas áreas en el sistema',
        ]);

        Permission::create([
            'name'        => 'Edición de áreas',
            'slug'        => 'areas.edit',
            'description' => 'Podría editar cualquier dato de un área del sistema',
        ]);

        Permission::create([
            'name'        => 'Eliminar áreas',
            'slug'        => 'areas.destroy',
            'description' => 'Podría eliminar cualquier áreas del sistema',
        ]);

        // Permisos Categoria Elementos
        //
        Permission::create([
            'name'        => 'Navegar categorías elementos',
            'slug'        => 'categoria-elementos.index',
            'description' => 'Lista y navega todas las categorías elementos del sistema',
        ]);

        Permission::create([
            'name'        => 'Ver detalle de una categoría',
            'slug'        => 'categoria-elementos.show',
            'description' => 'Ve en detalle cada categoría elementos del sistema',
        ]);

        Permission::create([
            'name'        => 'Creación de categoría elementos',
            'slug'        => 'categoria-elementos.create',
            'description' => 'Podría crear nuevos categoría elementos en el sistema',
        ]);

        Permission::create([
            'name'        => 'Edición de categoría elementos',
            'slug'        => 'categoria-elementos.edit',
            'description' => 'Podría editar cualquier dato de una categoría del sistema',
        ]);

        Permission::create([
            'name'        => 'Eliminar categorías elementos',
            'slug'        => 'categoria-elementos.destroy',
            'description' => 'Podría eliminar cualquier categorías elementos del sistema',
        ]);
        //
        //

        // Permisos  Elementos
        //
        Permission::create([
            'name'        => 'Navegar elementos',
            'slug'        => 'elementos.index',
            'description' => 'Lista y navega todos los elementos del sistema',
        ]);

        Permission::create([
            'name'        => 'Ver detalle de un elemento',
            'slug'        => 'elementos.show',
            'description' => 'Ve en detalle cada elemento del sistema',
        ]);

        Permission::create([
            'name'        => 'Creación de elementos',
            'slug'        => 'elementos.create',
            'description' => 'Podría crear nuevos elementos en el sistema',
        ]);

        Permission::create([
            'name'        => 'Edición de elementos',
            'slug'        => 'elementos.edit',
            'description' => 'Podría editar cualquier dato de un elemento del sistema',
        ]);

        Permission::create([
            'name'        => 'Eliminar elementos',
            'slug'        => 'elementos.destroy',
            'description' => 'Podría eliminar cualquier elemento del sistema',
        ]);
        //

        // Permisos  Espacios
        Permission::create([
            'name'        => 'Navegar espacios académicos',
            'slug'        => 'espacios.index',
            'description' => 'Lista y navega todos los espacios académico del sistema',
        ]);

        Permission::create([
            'name'        => 'Ver detalle de un espacio académico',
            'slug'        => 'espacios.show',
            'description' => 'Ve en detalle cada espacio académico del sistema',
        ]);

        Permission::create([
            'name'        => 'Creación de espacios académicos',
            'slug'        => 'espacios.create',
            'description' => 'Podría crear nuevos espacios académicos en el sistema',
        ]);

        Permission::create([
            'name'        => 'Edición de espacios',
            'slug'        => 'espacios.edit',
            'description' => 'Podría editar cualquier dato de un espacio académico del sistema',
        ]);

        Permission::create([
            'name'        => 'Eliminar espacios',
            'slug'        => 'espacios.destroy',
            'description' => 'Podría eliminar cualquier espacio académico del sistema',
        ]);
        //

        // Permisos  Solcitudes
        Permission::create([
            'name'        => 'Navegar solicitudes',
            'slug'        => 'solicitudes.index',
            'description' => 'Lista y navega todas las solicitudes del sistema',
        ]);

        Permission::create([
            'name'        => 'Ver detalle de una solicitud',
            'slug'        => 'solicitudes.show',
            'description' => 'Ve en detalle cada solicitud del sistema',
        ]);

        Permission::create([
            'name'        => 'Creación de solicitudes',
            'slug'        => 'solicitudes.create',
            'description' => 'Podría crear nuevas solicitudes en el sistema',
        ]);

        Permission::create([
            'name'        => 'Edición de solicitudes',
            'slug'        => 'solicitudes.edit',
            'description' => 'Podría editar cualquier dato de una solicitud del sistema',
        ]);

        Permission::create([
            'name'        => 'Eliminar solicitudes',
            'slug'        => 'solicitudes.destroy',
            'description' => 'Podría eliminar cualquier solicitud del sistema',
        ]);

        Permission::create([
            'name'        => 'Confirmar solicitudes',
            'slug'        => 'solicitudes.confirmar',
            'description' => 'Podría confirmar cualquier solicitud del sistema',
        ]);

        Permission::create([
            'name'        => 'Rechazar solicitudes',
            'slug'        => 'solicitudes.rechazar',
            'description' => 'Podría rechazar cualquier solicitud del sistema',
        ]);

        Permission::create([
            'name'        => 'Cancelar solicitudes',
            'slug'        => 'solicitudes.cancelar',
            'description' => 'Podría cancelar cualquier solicitud del sistema',
        ]);
        Permission::create([
            'name'        => 'Notificar solicitudes',
            'slug'        => 'solicitudes.notificar',
            'description' => 'Podría notificar (enviar mensajes) cualquier solicitante del sistema',
        ]);

        //
        // Permisos  Espacios
        Permission::create([
            'name'        => 'Navegar espacios calendario escolar',
            'slug'        => 'horario-escolar.index',
            'description' => 'Lista y navega todos los horarios escolares del sistema',
        ]);

        Permission::create([
            'name'        => 'Ver detalle de un horario',
            'slug'        => 'horario-escolar.show',
            'description' => 'Ve en detalle cada horario escolar del sistema',
        ]);

        Permission::create([
            'name'        => 'Creación de horarios escolares',
            'slug'        => 'horario-escolar.create',
            'description' => 'Podría crear nuevos horarios escolares en el sistema',
        ]);

        Permission::create([
            'name'        => 'Edición de horarios escolares',
            'slug'        => 'horario-escolar.edit',
            'description' => 'Podría editar cualquier dato de un horario escolar del sistema',
        ]);

        Permission::create([
            'name'        => 'Eliminar horarios escolares',
            'slug'        => 'horario-escolar.destroy',
            'description' => 'Podría eliminar cualquier horario escolar del sistema',
        ]);
    }
}
