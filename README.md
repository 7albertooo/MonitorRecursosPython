# 🚀 Remote Server Monitor (SSH)

Una solución ligera y moderna para la monitorización de recursos de servidores Linux en tiempo real. Este proyecto utiliza un backend en **FastAPI** para la comunicación SSH y un frontend elegante construido con **PHP** y **Tailwind CSS**.

---

## 📋 Características

- **Métricas en Tiempo Real:** Visualización de Uptime, uso de Disco, RAM y Carga de CPU.
- **Monitoreo de Temperatura:** Seguimiento térmico del sistema.
- **Gestión de Procesos:** Listado dinámico de los procesos con mayor consumo de recursos.
- **Acciones Remotas:** Botones integrados para reiniciar o apagar el servidor de forma segura.
- **Diseño Responsive:** Interfaz oscura optimizada para escritorio y móviles.

---

## 🛠️ Requisitos Previos

Antes de empezar, asegúrate de tener instalado:

- **Python 3.8+**
- **Servidor Web con PHP 8.x**
- **Git**

---

## 🔧 Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/tu-usuario/monitor-recursos.git
cd monitor-recursos
```

### 2. Configuración del Backend (API)

```bash
# Crear entorno virtual
python -m venv .venv

# Activar entorno (Linux/macOS)
source .venv/bin/activate

# Activar entorno (Windows)
.venv\Scripts\activate

# Instalar dependencias
pip install -r requeriments.txt
```

### 3. Configuración del Frontend

Mueve los archivos web a tu servidor:

- `index.php`
- `vista.php`
- carpeta `api/`

---

## 🚀 Ejecución

### Iniciar la API

```bash
python -m uvicorn api.api:app --host 0.0.0.0 --port 8000
```

### Acceder al Dashboard

```text
http://localhost/tu-carpeta/index.php
```

---

## 📂 Estructura del Proyecto

```text
MONITORRECURSOS/
├── api/
│   ├── api.py
│   └── sshCon.py
├── index.php
├── vista.php
├── requeriments.txt
└── .gitignore
```

---

## 📸 Captura

<img src="https://raw.githubusercontent.com/7albertooo/MonitorRecursosPython/main/image.png" width="900">

