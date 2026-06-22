# 🖥️ Gestor de Equipos IT

Aplicación web profesional, donde he podido prácticar diferentes tecnologías, la aplicación creada sirve para gestionar el inventario de ordenadores de una empresa, construida con arquitectura MVC, borrado lógico y diseño corporativo.
A continuación, explico el flujo de trabajo y las tecnologías utilizadas.

---

## 🛠️ Tecnologías

* **WSL2 / Ubuntu:** Un "corazón" de Linux nativo. Convierte Windows en un entorno profesional sin fallos de compatibilidad. Todos tus archivos y comandos viven aquí ahora.
* **Docker Desktop:** El motor de los contenedores. Te permite tener mini-ordenadores aislados en lugar de instalar programas en tu Windows.
* **DDEV:** Le da las órdenes a Docker. Gracias a él no hay que configurar manualmente PHP, Nginx ni MySQL. Con `ddev start` levantó todo el servidor.
* **Laravel:** El framework (esqueleto) de PHP. Es el código base. Te da la seguridad y la estructura de carpetas para que no tengas que programar desde 0.
* **Artisan:** El asistente de consola de Laravel. En lugar de crear archivos a mano, con comandos como `make:model` y `migrate` ha programado y configurado la base de datos por ti.
* **Blade:** El motor de plantillas de Laravel. Permite escribir HTML normal pero inyectando lógica de PHP.
* **Bootstrap (y Bootstrap Icons):** Framework de diseño CSS para crear interfaces visuales corporativas y responsivas sin escribir CSS a mano.

---

## 🔄 Flujo de trabajo (El ciclo CRUD y MVC)

### 1. Preparar infraestructura:
* Encender virtualización en BIOS para crear máquinas virtuales.
* Instalar WSL2 y Ubuntu para terminal de Linux.
* Instalar Docker y conectarlo con Ubuntu para que pudieran comunicarse.
* Instalar DDEV dentro de Linux para poder controlar Docker con comandos sencillos.

### 2. Levantar el servidor:
* Creamos la carpeta del proyecto.
* Ejecutamos `ddev config` y `ddev start`. Con esto, DDEV va a internet, baja una base de datos MySQL, un servidor web y la versión correcta de PHP aislando todo en un contenedor seguro.
* Le pedimos a DDEV que descargue Laravel y lo meta en nuestra carpeta.

### 3. Base de Datos (El Modelo):
* **Los planos:** usamos Artisan para crear una migración. Abrimos el editor y le decimos a Laravel que la tabla necesita las columnas marca, modelo y estado.
* **La construcción:** ejecutamos `ddev artisan migrate`. Laravel tradujo los planos a código SQL y construyó la tabla real y física dentro del MySQL del ordenador.

### 4. La lógica y las rutas (El Controlador):
* **El mapa (`routes/web.php`):** Creamos la URL `/equipos` y la conectamos al controlador para que, cuando el usuario escriba esa dirección en su navegador, se dispare la lógica.
* **El cerebro (`EquipoController.php`):** Extrae los datos del modelo y se los pasa a la vista.

### 5. La Interfaz (Vista - Read):
* En Vscode vamos a `resources/views` y creamos `equipos.blade.php`.
* Escribimos HTML con Bootstrap inyectando variables de PHP con Blade para dibujar la tabla de ordenadores.

### 6. Formularios y Creación (Create):
* Vista con formulario protegido con el token `@csrf`.
* Ruta con método `POST` y función `store()` en el Controlador que usa la orden `save()` para inyectar los datos en MySQL.

### 7. Edición (Update):
* Ruta dinámica con ID (`/equipos/{id}/editar`).
* Controlador que busca el equipo específico con `Equipo::find($id)` y muestra el formulario relleno.
* Guardado de datos sobrescritos mediante el método `PUT`.

### 8. Eliminación Profesional (Delete):
* Uso de Modal de Bootstrap para confirmación de seguridad.
* Formulario oculto con método `DELETE`.
* **Soft Delete (Borrado Lógico):** En lugar de borrar físicamente el registro de la BD, usamos una migración para añadir la columna `deleted_at`, ocultando el equipo pero manteniendo el histórico corporativo intacto.