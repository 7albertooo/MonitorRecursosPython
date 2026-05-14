# 🚀 Remote Server Monitor (SSH)

Una solución ligera y moderna para la monitorización de recursos de servidores Linux en tiempo real. Este proyecto utiliza un backend en **FastAPI** para la comunicación SSH y un frontend elegante construido con **PHP** y **Tailwind CSS**.

---

## 📋 Características
- **Métricas en Tiempo Real:** Visualización de Uptime, uso de Disco, RAM y Carga de CPU.
- **Monitoreo de Temperatura:** Seguimiento térmico del sistema .
- **Gestión de Procesos:** Listado dinámico de los procesos con mayor consumo de recursos.
- **Acciones Remotas:** Botones integrados para reiniciar o apagar el servidor de forma segura.
- **Diseño Responsive:** Interfaz oscura (Dark Mode) optimizada para escritorio y dispositivos móviles.

---

## 🛠️ Requisitos Previos
Antes de empezar, asegúrate de tener instalado:
* **Python 3.8+**
* **Servidor Web con PHP 8.x** (XAMPP, Apache o Nginx)
* **Git**

---

## 🔧 Instalación

### 1. Clonar el repositorio
```bash
git clone [https://github.com/tu-usuario/monitor-recursos.git](https://github.com/tu-usuario/monitor-recursos.git)
cd monitor-recursos
2. Configuración del Backend (API)
Se recomienda utilizar un entorno virtual para mantener las dependencias aisladas:

Bash
# Crear entorno virtual
python -m venv .venv

# Activar entorno (Linux/macOS)
source .venv/bin/activate

# Activar entorno (Windows)
.venv\Scripts\activate

# Instalar dependencias
pip install -r requeriments.txt
3. Configuración del Frontend
Mueve los archivos web a tu directorio de servidor web (ej: htdocs en XAMPP o /var/www/html/ en Linux). Asegúrate de incluir:

index.php

vista.php

Carpeta api/ (que contiene la lógica de Python)

🚀 Ejecución
Iniciar la API de Python
Desde la raíz del proyecto (con el entorno virtual activo):

Bash
python -m uvicorn api.api:app --host 0.0.0.0 --port 8000
Acceder al Dashboard
Abre tu navegador y dirígete a:
http://localhost/tu-carpeta/index.php

📂 Estructura del Proyecto
Plaintext
MONITORRECURSOS/
├── api/
│   ├── api.py          # Endpoints de FastAPI
│   └── sshCon.py       # Lógica de conexión SSH (Paramiko)
├── index.php           # Controlador principal (PHP)
├── vista.php           # Interfaz de usuario (HTML/Tailwind)
├── requeriments.txt    # Dependencias de Python
└── .gitignore          # Archivos excluidos de Git
🔐 Seguridad y Notas
Acceso VPN: Para entornos corporativos, asegúrate de que el equipo donde corre la API tenga acceso a la red de las IPs que deseas consultar.

Credenciales: Esta aplicación no almacena contraseñas; los datos viajan por POST de forma segura hacia la API.[cite: 1]

Privacidad: Nunca subas tus archivos .venv o credenciales reales al repositorio público.[cite: 1]

Temperatura: La monitorización de temperatura depende de la disponibilidad de thermal_zone0 en el servidor destino.[cite: 1]

<img src="https://raw.githubusercontent.com/7albertooo/MonitorRecursosPython/main/image.png" width="800">