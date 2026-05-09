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
                    <p class="mt-2 max-w-2xl text-slate-400">Visualiza el uptime, uso de disco y RAM de tu API en tiempo real.</p>
                </div>
            </div>
        </header>

        <section class="mb-10 rounded-3xl border border-slate-800 bg-slate-900/70 p-6 shadow-xl shadow-slate-900/20">
            <h2 class="text-xl font-semibold text-white">Enviar credenciales</h2>
            <p class="mt-2 text-sm text-slate-400">Introduce la IP, usuario y contraseña para conectar con la API.</p>
            <form method="post" action="" class="mt-6 grid gap-4 sm:grid-cols-2">
                <label class="block">
                    <span class="text-sm text-slate-300">IP</span>
                    <input type="text" name="ip" value="<?= htmlspecialchars($form_ip) ?>" placeholder="192.168.0.1" class="mt-2 w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none ring-2 ring-transparent transition focus:ring-sky-500" />
                </label>
                <label class="block">
                    <span class="text-sm text-slate-300">Usuario</span>
                    <input type="text" name="user" value="<?= htmlspecialchars($form_user) ?>" placeholder="pi" class="mt-2 w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none ring-2 ring-transparent transition focus:ring-emerald-500" />
                </label>
                <label class="block sm:col-span-2">
                    <span class="text-sm text-slate-300">Contraseña</span>
                    <input type="password" name="password" value="<?= htmlspecialchars($form_password) ?>" placeholder="••••••••" class="mt-2 w-full rounded-2xl border border-slate-700 bg-slate-950 px-4 py-3 text-white outline-none ring-2 ring-transparent transition focus:ring-violet-500" />
                </label>
                <div class="sm:col-span-2 flex justify-end">
                    <button type="submit" class="rounded-2xl bg-sky-500 px-6 py-3 text-sm font-semibold text-white transition hover:bg-sky-400">Enviar datos</button>
                </div>
            </form>
        </section>

        <main>
            <?php if (isset($datos_limpios) && $datos_limpios): ?>
                <div class="grid gap-6 md:grid-cols-3">
                    <article class="rounded-3xl border border-slate-800 bg-slate-900/70 p-6 shadow-xl shadow-slate-900/20 transition hover:-translate-y-1 hover:shadow-slate-900/30">
                        <div class="mb-4 flex items-center justify-between">
                            <p class="text-sm uppercase tracking-[0.3em] text-sky-300/80">Uptime</p>
                            <span class="inline-flex rounded-full bg-sky-500/10 px-3 py-1 text-xs font-semibold text-sky-300">Sistema</span>
                        </div>
                        <h2 class="text-4xl font-semibold text-white"><?= htmlspecialchars($datos_limpios['uptime']) ?></h2>
                        <p class="mt-3 text-sm leading-6 text-slate-400">Tiempo de actividad desde el último reinicio del sistema.</p>
                    </article>

                    <article class="rounded-3xl border border-slate-800 bg-slate-900/70 p-6 shadow-xl shadow-slate-900/20 transition hover:-translate-y-1 hover:shadow-slate-900/30">
                        <div class="mb-4 flex items-center justify-between">
                            <p class="text-sm uppercase tracking-[0.3em] text-emerald-300/80">Disco</p>
                            <span class="inline-flex rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-300">Almacenamiento</span>
                        </div>
                        <h2 class="text-4xl font-semibold text-white"><?= htmlspecialchars($datos_limpios['disk']) ?></h2>
                        <p class="mt-3 text-sm leading-6 text-slate-400">Uso de disco ocupado en el sistema.</p>
                    </article>

                    <article class="rounded-3xl border border-slate-800 bg-slate-900/70 p-6 shadow-xl shadow-slate-900/20 transition hover:-translate-y-1 hover:shadow-slate-900/30">
                        <div class="mb-4 flex items-center justify-between">
                            <p class="text-sm uppercase tracking-[0.3em] text-violet-300/80">RAM</p>
                            <span class="inline-flex rounded-full bg-violet-500/10 px-3 py-1 text-xs font-semibold text-violet-300">Memoria</span>
                        </div>
                        <h2 class="text-4xl font-semibold text-white"><?= htmlspecialchars($datos_limpios['ram']) ?></h2>
                        <p class="mt-3 text-sm leading-6 text-slate-400">Uso actual de memoria RAM del servidor.</p>
                    </article>
                </div>
            <?php elseif($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($datos_limpios)): ?>
                <div class="rounded-3xl border border-rose-500/20 bg-rose-500/10 p-8 text-center text-rose-100 shadow-lg shadow-rose-950/20">
                    <p class="text-lg font-semibold">Error al obtener los datos de la API.</p>
                    <p class="mt-2 text-sm text-slate-300">Comprueba la conexión y vuelve a cargar la página.</p>
                </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
