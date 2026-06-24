# 🖥️ Gestor de Equipos IT

Aplicación web profesional, donde he podido prácticar diferentes tecnologías. El Gestor de Inventario IT es una aplicación web de uso interno diseñada para centralizar, proteger y optimizar el control del equipamiento informático de una empresa.
La aplicación se encuentra aún se encuentra en fase de desarrollo, e implementará nuevas funcionalidades y mejoras en el futuro.

## 💻 Como ejecutar la aplicación localmente

Si quieres clonar este repositorio y probar la aplicación en tu máquina, asegúrate de tener instalado **Docker** y **DDEV**. Luego, ejecuta los siguientes comandos en tu terminal:

# 1. Clonar el repositorio en tu máquina
git clone 

# 2. Entrar en la carpeta
cd gestor-equipos

# 3. Levantar el entorno de DDEV
ddev start

# 4. Instalar las dependencias de PHP de Laravel
ddev composer install

# 5. Crear la base de datos y sus tablas
ddev artisan migrate


## 🛠️ Tecnologías

* **WSL2 / Ubuntu:** Entorno de Linux nativo integrado en Windows para garantizar un desarrollo profesional sin fallos de compatibilidad.
* **Docker Desktop y DDEV:** Motor de contenedores y orquestador. Automatizan la configuración de PHP, Nginx y MySQL en entornos aislados.
* **Laravel:** El framework (esqueleto) de PHP. Es el código base. Te da la seguridad y la estructura de carpetas para que no tengas que programar desde 0.
* **Artisan:** Interfaz de línea de comandos (CLI) de Laravel para agilizar la creación de modelos, migraciones y controladores.
* **Blade:** El motor de plantillas de Laravel. Permite escribir HTML normal pero inyectando lógica de PHP.
* **Bootstrap (y Bootstrap Icons):** Framework de diseño CSS para crear interfaces visuales corporativas y responsivas sin escribir CSS a mano.

---

## 🔄 Arquitectura y Flujo de Trabajo

El desarrollo sigue el patrón **MVC (Modelo-Vista-Controlador)** y se ejecuta sobre un entorno aislado mediante **Docker y DDEV** en **WSL2**. Esto asegura que la aplicación se pueda levantar en cualquier equipo en segundos y sin conflictos de instalación.

* 🗄️ **Base de Datos (Modelos):** Toda la estructura de MySQL se genera mediante migraciones de Artisan. Además, se aplica **Borrado Lógico** en el inventario; los equipos eliminados no se destruyen físicamente, sino que se ocultan para mantener el histórico de auditoría de la empresa.

* 🧠 **Lógica (Controladores):** Las rutas dirigen el tráfico hacia los controladores, que se encargan del CRUD completo. Aquí también se gestiona el buscador dinámico: el controlador lee los parámetros de la URL (peticiones `GET`) y filtra los resultados de la base de datos en tiempo real.

* 🖥️ **Interfaz (Vistas):** Pantallas diseñadas con **Blade** y **Bootstrap** para garantizar un diseño corporativo y responsivo.

* 🛡️ **Autenticación y Seguridad:** 
  * 🔑 Las contraseñas de los usuarios se encriptan obligatoriamente con la fachada `Hash` antes de guardarse.
  * 🔐 La validación de credenciales y el cierre de sesión se gestionan con la clase nativa `Auth`, regenerando los tokens del navegador para evitar vulnerabilidades de fijación de sesión.
  * 🛑 Todos los formularios están blindados contra ataques externos (*Cross-Site Request Forgery*) mediante directivas `@csrf`.
  * 🚧 Las rutas críticas están protegidas por **Middleware**: si un usuario intenta acceder a una URL del inventario sin una sesión activa, el sistema intercepta la petición y lo redirige automáticamente a la pantalla de login.
