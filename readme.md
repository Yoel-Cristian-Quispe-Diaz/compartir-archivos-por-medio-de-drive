# Compartir Archivos por medio de Google Drive

Sistema web desarrollado con **PHP**, **JavaScript (jQuery / AJAX)** y **MySQL** para la autenticación de integrantes, carga, visualización y gestión de archivos en la nube a través de la **API de Google Drive**.

---

## 🚀 Características

- **Validación de Integrantes**: Sistema de acceso previo mediante formulario web que verifica nombres y apellidos contra una base de datos MySQL.
- **Carga asíncrona de archivos**: Subida a Google Drive mediante AJAX sin recargar la página web.
- **Integración con Google Drive API v3**:
  - Almacenamiento directo de archivos en una carpeta compartida de Google Drive.
  - Generación automática del enlace directo al archivo.
  - Listado dinámico de los archivos existentes en la carpeta de Drive.
  - Vaciado / eliminación masiva de los archivos almacenados.
- **Registro en base de datos**: Guarda metadatos clave (nombre del archivo, tipo MIME / extensión y URL de acceso de Drive) en MySQL.

---

## 🛠️ Tecnologías Utilizadas

- **Backend**: PHP 7.x / 8.x
- **Librería de Google**: `google/apiclient` (Google APIs Client Library for PHP)
- **Base de Datos**: MySQL / MariaDB
- **Frontend**: HTML5, CSS3, JavaScript y jQuery (AJAX)

---

## 📂 Estructura del Proyecto

```text
├── google_api/                       # SDK de Google Client Library (Composer / vendor)
├── compartir-archivos-php-*.json     # Clave de cuenta de servicio de Google Cloud
├── index.html                        # Interfaz principal de subida y consulta de archivos
├── formulario.php / formulario2.php  # Vistas de formulario de carga y consulta
├── formulario3.html                  # Plantilla HTML de acceso tras verificación
├── verificacion.html                 # Pantalla de validación de identidad
├── verificar.php                     # Script PHP que valida al integrante en MySQL
├── index_formulario.php              # Lógica de subida a Drive y registro en la BD
├── listar.php                        # Obtiene y lista los archivos desde Google Drive
├── Limpiar.php                       # Elimina los archivos alojados en Drive
├── integrantes.txt                   # Registro de autores del proyecto
└── README.md                         # Documentación del proyecto
```

---

## ⚙️ Requisitos Previos

1. Servidor web local como **XAMPP**, **WAMP**, **Laragon** o Apache con soporte para PHP y MySQL.
2. Proyecto creado en la consola de **Google Cloud Platform** con:
   - La **API de Google Drive** habilitada.
   - Una **Cuenta de servicio (Service Account)** con rol de editor.
   - Archivo de credenciales en formato `.json` descargado.

---

## 📦 Instalación y Configuración

### 1. Clonar el repositorio
Ubica el repositorio en la carpeta raíz de tu servidor web (por ejemplo, `htdocs` en XAMPP):

```bash
git clone https://github.com/Yoel-Cristian-Quispe-Diaz/compartir-archivos-por-medio-de-drive.git proyecto_f
```

### 2. Configurar la Base de Datos
Crea la base de datos `archivos_subidos` y las tablas correspondientes en MySQL:

```sql
CREATE DATABASE IF NOT EXISTS archivos_subidos;
USE archivos_subidos;

-- Tabla de verificación de integrantes
CREATE TABLE IF NOT EXISTS integrantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL
);

-- Tabla de registro de archivos subidos
CREATE TABLE IF NOT EXISTS archivos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    Ruta TEXT NOT NULL,
    Extension VARCHAR(100) NOT NULL,
    fecha_subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserción de integrantes de ejemplo
INSERT INTO integrantes (nombre, apellido) VALUES 
('Yoel Cristian', 'Quispe Diaz'),
('Cesar Ernesto', 'Mosquez C.'),
('Eduardo', 'Reyes Flores');
```

### 3. Configurar las Credenciales de Google Drive
1. Ubica tu archivo de credenciales JSON en la raíz del proyecto.
2. Revisa que en los archivos `index_formulario.php`, `listar.php` y `Limpiar.php` la variable de entorno apunte a tu archivo JSON:
   ```php
   putenv('GOOGLE_APPLICATION_CREDENTIALS=tu-archivo-de-credenciales.json');
   ```
3. En `index_formulario.php`, coloca el ID de tu carpeta de Google Drive:
   ```php
   $file->SetParents(array("TU_ID_DE_CARPETA_DE_DRIVE"));
   ```
4. **Importante**: Comparte la carpeta en Google Drive con el correo de la cuenta de servicio (`client_email`) asignándole permisos de **Editor**.

---

## 🖥️ Uso del Sistema

1. Inicia Apache y MySQL en tu panel de control local.
2. Accede desde tu navegador web a:
   ```text
   http://localhost/proyecto_f/verificacion.html
   ```
3. Introduce el nombre y apellido registrados en la base de datos para acceder.
4. En el panel principal podrás:
   - Seleccionar un archivo y pulsar **Cargar** para subirlo a Google Drive.
   - Presionar **Mostrar Lista de Archivos** para consultar los enlaces de descarga.
   - Pulsar **Limpiar archivos** para vaciar los ficheros almacenados.

---

## 👥 Integrantes

- **Yoel Cristian Quispe Diaz**
- **Cesar Ernesto Mosquez C.**
- **Eduardo Reyes Flores**

---

## ⚠️ Nota de Seguridad

> [!CAUTION]
> **No subas archivos de credenciales `.json` con claves privadas a repositorios públicos.** Asegúrate de incluir cualquier clave o archivo de credenciales en tu `.gitignore` y revoca cualquier clave que haya quedado expuesta accidentalmente en el historial de commits.