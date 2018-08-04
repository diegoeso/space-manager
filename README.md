# Space Manager Unidad Académica Profesional Tianguistenco UAEMex

Sistema para el control y administración de los espacios académicos para la Unidad Académica Profesional Tianguistenco.


### Requerimientos

* Laravel
* PHP >= 7.1.3
* OpenSSL PHP Extension
* PDO PHP Extension
* Ctype PHP Extension
* JSON PHP Extension
* MySQL

### Instalación
1.- Proyecto
```
git clone https://github.com/diegoeso/space-manager.git 
```
2.- Instalar
<br/>
Ubicarse en la carpeta del proyecto
```
composer install
```
3.- Configurar
<br/>
En caso de no existir crear el archivo ".env" en la raíz del proyecto

4.- Crear llave de encriptación
```
php artisan key:generate
```
5.-Configurar Base de Datos
```
DB_DATABASE=space-manager
DB_USERNAME=root
DB_PASSWORD=
```
6.-Datos semilla para pruebas del sistema ejecutar en terminal 

```
php artisan migrate:install --seed   ó   php artisan migrate:refresh --seed
```
El cual creara datos ficticios para comprobar el funcionamiento del sistema, no incluir "--seed" para agregar solo las tablas sin datos

7.- Configurar CRONTAB para la ejecución de las "schedule" (CRONJOB's)
Ejecutar en la terminal:
```
crontab -e
```
agregar la siguiente linea de código 
```
* * * * * php /nombre-de-la-carpeta-del-proyecto/artisan schedule:run >> /dev/null 2>&1
```

8.- Ejecutar el siguiente comando en la terminal
```
php artisan schedule:run
```
9.- Ejecutar el siguiente comando en la terminal
```
php artisan storage:link
```


## Ejecucion

1.- Iniciar MySQL y Apache

2.- Iniciar servidor de laravel
```
php artisan serve
```

3.- Abrir 
 > http://127.0.0.1:8000 
 

### Iniciar el sistema

La ejecución de las migraciones crean 4 tipos de usuarios

```
	alumno@gmail.com

	profesor@gmail.com
	
	responsable@gmail.com
	
	admin@gmail.com

```
> password: secret

Para el responsable de area es necesario asignar permisos al rol "Responsable de Area" y posteriormente asignar el rol al usuario responsable de area

## Autor

* **Diego Enrique Sánchez Ordoñez**  - https://www.facebook.com/diego.enriqueSO


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

