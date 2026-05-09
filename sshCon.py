import paramiko

def ejecutar_comando (ip, usuario, contraseña, comando):

    ssh = paramiko.SSHClient()

    ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())

    ssh.connect(
        hostname=ip,
        username=usuario,
        password=contraseña,
    )


    stdin, stdout, stderr = ssh.exec_command(comando)

    resultado = stdout.read().decode().strip()

    ssh.close()

    return resultado
    




