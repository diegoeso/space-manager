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
            'name'        => 'Navegar areas',
            'slug'        => 'areas.index',
            'description' => 'Lista y navega todos los areas del sistema',
        ]);

        Permission::create([
            'name'        => 'Ver detalle de un area',
            'slug'        => 'areas.show',
            'description' => 'Ve en detalle cada areas del sistema',
        ]);

        Permission::create([
            'name'        => 'Creación de areas',
            'slug'        => 'areas.create',
            'description' => 'Podría crear nuevos areas en el sistema',
        ]);

        Permission::create([
            'name'        => 'Edición de areas',
            'slug'        => 'areas.edit',
            'description' => 'Podría editar cualquier dato de un area del sistema',
        ]);

        Permission::create([
            'name'        => 'Eliminar areas',
            'slug'        => 'areas.destroy',
            'description' => 'Podría eliminar cualquier areas del sistema',
        ]);

        // Permisos Categoria Elementos
        //
        Permission::create([
            'name'        => 'Navegar categorias elementos',
            'slug'        => 'categoria-elementos.index',
            'description' => 'Lista y navega todas las categorias elementos del sistema',
        ]);

        Permission::create([
            'name'        => 'Ver detalle de una categoria',
            'slug'        => 'categoria-elementos.show',
            'description' => 'Ve en detalle cada categoria elementos del sistema',
        ]);

        Permission::create([
            'name'        => 'Creación de categoria elementos',
            'slug'        => 'categoria-elementos.create',
            'description' => 'Podría crear nuevos categoria elementos en el sistema',
        ]);

        Permission::create([
            'name'        => 'Edición de categoria elementos',
            'slug'        => 'categoria-elementos.edit',
            'description' => 'Podría editar cualquier dato de una categoria del sistema',
        ]);

        Permission::create([
            'name'        => 'Eliminar categorias elementos',
            'slug'        => 'categoria-elementos.destroy',
            'description' => 'Podría eliminar cualquier categorias elementos del sistema',
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
            'name'        => 'Navegar espacios academicos',
            'slug'        => 'espacios.index',
            'description' => 'Lista y navega todos los espacios academico del sistema',
        ]);

        Permission::create([
            'name'        => 'Ver detalle de un espacio academico',
            'slug'        => 'espacios.show',
            'description' => 'Ve en detalle cada espacio academico del sistema',
        ]);

        Permission::create([
            'name'        => 'Creación de espacios academicos',
            'slug'        => 'espacios.create',
            'description' => 'Podría crear nuevos espacios academicos en el sistema',
        ]);

        Permission::create([
            'name'        => 'Edición de espacios',
            'slug'        => 'espacios.edit',
            'description' => 'Podría editar cualquier dato de un espacio academico del sistema',
        ]);

        Permission::create([
            'name'        => 'Eliminar espacios',
            'slug'        => 'espacios.destroy',
            'description' => 'Podría eliminar cualquier espacio academico del sistema',
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

    }
}
