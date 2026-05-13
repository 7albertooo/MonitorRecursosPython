from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel
from api.sshCon import ejecutar_comando

app = FastAPI()


app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],  
    allow_methods=["*"],
    allow_headers=["*"],
)

class Servidor(BaseModel):
    ip: str
    usuario: str
    password: str

@app.post("/estado")
def obtener_estado(servidor: Servidor):
    # Usamos un separador claro para evitar que las salidas se peguen
    separador = "SEPARATOR_LINE"
    
    comandos = [
        "uptime -p | sed 's/up //'",                                     # 0: Uptime
        "df -h / --output=pcent | tail -1",                             # 1: Disco
        "free | awk '/Mem:/ {printf \"%.2f%%\", $3/$2*100}'",           # 2: RAM
        "cat /proc/loadavg | awk '{print $1}'",                         # 3: Load
        "cat /sys/class/thermal/thermal_zone0/temp 2>/dev/null || echo 0", # 4: Temp
        "ps -eo %cpu,cmd --sort=-%cpu | head -n 6 | tail -n 5"          # 5: Procesos
    ]
    
    # Unimos con echo para forzar el salto de línea real
    comando_final = f" && echo {separador} && ".join(comandos)

    raw_output = ejecutar_comando(servidor.ip, servidor.usuario, servidor.password, comando_final)
    
    # Limpiamos y dividimos por nuestro separador
    partes = [p.strip() for p in raw_output.split("SEPARATOR_LINE")]

    if len(partes) < 6:
        return {"error": "Datos incompletos", "bruto": partes}

    # Procesar temperatura (de milicelsius a grados)
    try:
        temp_c = float(partes[4]) / 1000
    except:
        temp_c = 0.0

    return {
        "uptime": partes[0],
        "disco": partes[1],
        "ram": partes[2],
        "cpu": partes[3],
        "temp": f"{temp_c:.1f}°C",
        "procesos": partes[5].split('\n') if len(partes) > 5 else []
    }
    

@app.post("/orden")
def ejecutar_orden(servidor: Servidor, accion: str):
   
    comandos = {
        "reiniciar": "sudo reboot",
        "apagar": "sudo poweroff"
    }
    
    if accion in comandos:
        # Ejecutamos el comando SSH
        ejecutar_comando(servidor.ip, servidor.usuario, servidor.password, comandos[accion])
        return {"status": "ok", "message": f"Comando {accion} enviado"}
    
    return {"status": "error", "message": "Acción no válida"}