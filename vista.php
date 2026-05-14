<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PI</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-950 text-white">
    <?php
    $form_ip = $_POST['ip'] ?? '';
    $form_user = $_POST['user'] ?? '';
    $form_password = $_POST['password'] ?? '';
    ?>
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
        <header class="mb-10 rounded-3xl border border-slate-800 bg-slate-900/80 p-8 shadow-xl shadow-slate-900/20 backdrop-blur-xl">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-sky-300/80">Estado del sistema</p>
                    <h1 class="mt-2 text-3xl font-semibold text-white">Dashboard de monitorización</h1>
                    <p class="mt-2 max-w-2xl text-slate-400">Visualiza el Uptime, RAM, Temperatura y otras opciones de tu equipo.</p>
                </div>
            </div>
        </header>

        <section class="mb-10 rounded-3xl border border-slate-800 bg-slate-900/70 p-6 shadow-xl shadow-slate-900/20">
            <h2 class="text-xl font-semibold text-white">Enviar credenciales</h2>
            <p class="mt-2 text-sm text-slate-400">Introduce la IP, usuario y contraseña para conectar con la API.</p>
            <form method="post" action="" class="mt-6 grid gap-4 sm:grid-cols-2">
                <input type="hidden" name="accion" value="estado">
                <label class="block">
                    <span class="text-sm text-slate-300">IP</span>
                    <input type="text" name="ip" value="<?= htmlspecialchars($_SESSION['datos']['ip']) ?>" placeholder="192.168.0.1" class="mt-2 w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none ring-2 ring-transparent transition focus:ring-sky-500" />
                </label>
                <label class="block">
                    <span class="text-sm text-slate-300">Usuario</span>
                    <input type="text" name="user" value="<?= htmlspecialchars($_SESSION['datos']['usuario']) ?>" placeholder="pi" class="mt-2 w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none ring-2 ring-transparent transition focus:ring-emerald-500" />
                </label>
                <label class="block sm:col-span-2">
                    <span class="text-sm text-slate-300">Contraseña</span>
                    <input type="password" name="password" value="<?= htmlspecialchars($_SESSION['datos']['password']) ?>" placeholder="••••••••" class="mt-2 w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none ring-2 ring-transparent transition focus:ring-violet-500" />
                </label>
                <?php if(empty($_SESSION['datos_limpios']) || !isset($_SESSION['datos_limpios']) ) :?>
                <div class="sm:col-span-2 flex justify-end">
                    <button type="submit" class="rounded-2xl bg-sky-500 px-6 py-3 text-sm font-semibold text-white transition hover:bg-sky-400">Conectar</button>
                </div>
                <?php endif ?>
            </form>
            <?php if(!empty($_SESSION['datos_limpios']) && isset($_SESSION['datos_limpios']) ) :?>
            <form action="" method="post">
                <input type="hidden" name="accion" value="desconectar">
                <div class="sm:col-span-2 flex justify-end mt-4">
                    <button type="submit" class="rounded-2xl bg-sky-500 px-6 py-3 text-sm font-semibold text-white transition hover:bg-sky-400">Desconectar</button>
                </div>
            </form>
            <?php endif ?>
        </section>

        <main>
            <?php if (isset($_SESSION['datos_limpios']) && !empty($_SESSION['datos_limpios'])): ?>
                <?php $datos_limpios = $_SESSION['datos_limpios'] ?>
               
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3 ">
                    <!-- 1. Uptime -->
                    <article class="rounded-3xl border border-slate-800 bg-slate-900/70 p-6 shadow-xl shadow-slate-900/20">
                        <div class="mb-4 flex items-center justify-between">
                            <p class="text-sm uppercase tracking-[0.3em] text-sky-300/80">Uptime</p>
                            <span class="inline-flex rounded-full bg-sky-500/10 px-3 py-1 text-xs font-semibold text-sky-300">Sistema</span>
                        </div>
                        <h2 class="text-3xl font-semibold text-white"><?= htmlspecialchars($datos_limpios['uptime']) ?></h2>
                    </article>

                    <!-- 2. Disco -->
                    <article class="rounded-3xl border border-slate-800 bg-slate-900/70 p-6 shadow-xl shadow-slate-900/20">
                        <div class="mb-4 flex items-center justify-between">
                            <p class="text-sm uppercase tracking-[0.3em] text-emerald-300/80">Disco</p>
                            <span class="inline-flex rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-300">Almacenamiento</span>
                        </div>
                        <h2 class="text-4xl font-semibold text-white"><?= htmlspecialchars($datos_limpios['disco']) ?></h2>
                    </article>

                    <!-- 3. RAM -->
                    <article class="rounded-3xl border border-slate-800 bg-slate-900/70 p-6 shadow-xl shadow-slate-900/20">
                        <div class="mb-4 flex items-center justify-between">
                            <p class="text-sm uppercase tracking-[0.3em] text-violet-300/80">RAM</p>
                            <span class="inline-flex rounded-full bg-violet-500/10 px-3 py-1 text-xs font-semibold text-violet-300">Memoria</span>
                        </div>
                        <h2 class="text-4xl font-semibold text-white"><?= htmlspecialchars($datos_limpios['ram']) ?></h2>
                    </article>

                    <!-- 4. CPU -->
                    <article class="rounded-3xl border border-slate-800 bg-slate-900/70 p-6 shadow-xl shadow-slate-900/20">
                        <div class="mb-4 flex items-center justify-between">
                            <p class="text-sm uppercase tracking-[0.3em] text-amber-300/80">CPU</p>
                            <span class="inline-flex rounded-full bg-amber-500/10 px-3 py-1 text-xs font-semibold text-amber-300">Carga</span>
                        </div>
                        <h2 class="text-4xl font-semibold text-white"><?= htmlspecialchars($datos_limpios['cpu']) ?></h2>
                    </article>

                    <!-- 5. Temperatura -->
                    <article class="rounded-3xl border border-slate-800 bg-slate-900/70 p-6 shadow-xl shadow-slate-900/20">
                        <div class="mb-4 flex items-center justify-between">
                            <p class="text-sm uppercase tracking-[0.3em] text-orange-300/80">Temperatura</p>
                            <span class="inline-flex rounded-full bg-orange-500/10 px-3 py-1 text-xs font-semibold text-orange-300">ºC</span>
                        </div>
                        <h2 class="text-4xl font-semibold text-white"><?= htmlspecialchars($datos_limpios['temp']) ?></h2>
                    </article>

                    <article class="rounded-3xl border border-slate-800 bg-slate-900/70 p-6 shadow-xl shadow-slate-900/20">
                        <div class="mb-4 flex items-center justify-between">
                            <p class="text-sm uppercase tracking-[0.3em] text-orange-500/80">Acciones</p>
                            <span class="inline-flex rounded-full bg-orange-500/10 px-3 py-1 text-xs font-semibold text-orange-500">Ejecutar</span>
                        </div>

                        <div class="rounded-3xl border border-slate-800 bg-red-800 p-2 mb-2 shadow-xl shadow-slate-900/20 flex justify-center items-center">
                            <form action="" method="post" onsubmit="return confirm('¿Seguro que quieres APAGAR?')">
                                <input type="hidden" name="accion" value="apagar">
                                <button type="submit">Apagar</button>
                            </form>
                        </div>

                        <div class="rounded-3xl border border-slate-800 bg-yellow-600 p-2 shadow-xl shadow-slate-900/20 flex justify-center items-center">
                            <form action="" method="post" onsubmit="return confirm('¿Seguro que quieres REINICIAR?')">
                                <input type="hidden" name="accion" value="reiniciar">
                                <button type="submit">Reiniciar</button>
                            </form>
                        </div>
                    </article>

                </div>

                <!-- 6. SECCIÓN DE PROCESOS (Fuera del grid anterior para que ocupe todo el ancho) -->
                <section class="mt-8 rounded-3xl border border-slate-800 bg-slate-900/70 p-6 shadow-xl shadow-slate-900/20">
                    <div class="mb-6 flex items-center justify-between border-b border-slate-800 pb-4">
                        <p class="text-sm uppercase tracking-[0.3em] text-indigo-300/80">Listado de Procesos</p>
                        <span class="text-xs text-slate-500">Top consumo CPU</span>
                    </div>

                    <div class="grid gap-3 md:grid-cols-2 lg:grid-cols-3">
                        <?php foreach ($datos_limpios['procesos'] as $proceso): ?>
                            <div class="flex items-center gap-3 rounded-2xl border border-slate-800 bg-slate-950/50 p-4 transition hover:border-indigo-500/50">
                                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-500/10 font-mono text-xs font-bold text-indigo-400">
                                    EXE
                                </span>
                                <p class="truncate font-mono text-sm text-slate-300" title="<?= htmlspecialchars($proceso) ?>">
                                    <?= htmlspecialchars($proceso) ?>
                                </p>
                            </div>
                        <?php endforeach ?>
                    </div>
                </section>
            <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($datos_limpios) && $_POST['accion'] === 'estado'): ?>
                <div class="rounded-3xl border border-rose-500/20 bg-rose-500/10 p-8 text-center text-rose-100 shadow-lg shadow-rose-950/20">
                    <p class="text-lg font-semibold">Error al obtener los datos de la API.</p>
                    <p class="mt-2 text-sm text-slate-300">Comprueba la conexión y vuelve a cargar la página.</p>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>

</html>