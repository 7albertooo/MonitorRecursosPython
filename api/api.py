from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel
from sshCon import ejecutar_comando

app = FastAPI()

# Configuración de CORS para que tu PHP (en otro hosting) pueda entrar
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
    
    comando_unico = (
        "uptime -p | sed 's/up //'; "
        "df -h / --output=pcent | tail -1; "
        "free | awk '/Mem:/ {printf \"%.2f%%\", $3/$2*100}'"
    )
    
    raw_output = ejecutar_comando(servidor.ip, servidor.usuario, servidor.password, comando_unico)
    

    lineas = raw_output.strip().split('\n')
    
    if len(lineas) >= 3:
        return {
            "uptime": lineas[0].strip(),
            "disk": lineas[1].strip(),
            "ram": lineas[2].strip()
        }
    
    return {"error": "No se pudo obtener la información completa"}