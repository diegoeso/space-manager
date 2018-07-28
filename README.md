# Space Manager Unidad Academica Profesional Tianguistenco UAEMex

Sistema para el control y administracion de los espacios academicos para la Unidad Academica Profesional Tianguistenco.


### Prerequerimientos

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
Ubicarse en la carpeta del proyecto
```
composer install
```
3.- Configurar
En caso de no existir crear el archivo ".env" en la raiz del proyecto

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
6.-Datos semilla para pruebas del sistema
Ejecutar en terminal 
```
php artisan migrate:install --seed   ó   php artisan migrate:refresh --seed
```
El cual creara datos ficticios para comprobar el funcionamiento del sistema, no incluir "--seed" para agregar solo las tablas sin datos

7.- Configurar CRONTAB para la ejecucion de las "schedule" (CRONJOB's)
Ejecutar en la terminal:
```
crontab -e
```
agregar la siguiente linea de codigo 
```
* * * * * php /nombre-de-la-carpeta-del-proyecto/artisan schedule:run >> /dev/null 2>&1
```

## Ejecucion

1.- Iniciar MySQL y Apache

2.- Iniciar servidor de laravel
```
php artisan serve
```

Abrir 
 > http://127.0.0.1:8000 
 

### Iniciar el sistema

La ejecucion de las migraciones crean 4 tipos de usuarios

```
alumno@gmail.com
profesor@gmail.com
responsable@gmail.com
admin@gmail.com
```

## Authors

* **Diego Enrique Sánchez Ordoñez**  - (https://www.facebook.com/diego.enriqueSO)


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

