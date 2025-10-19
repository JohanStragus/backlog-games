<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Backlog Games') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ====== Paleta & tokens ====== */
        :root {
            --bg: #0e0f16;
            --panel-soft: #141620;
            --panel: #1b1e2a;
            --text: #e6e8f0;
            --muted: #94a3b8;
            --accent: #6366f1;
            /* índigo */
            --accent-weak: color-mix(in srgb, var(--accent) 32%, transparent);
            --input-bg: #232635;
            --input-border: #2f3345;
        }

        /* ====== Lienzo base ====== */
        body {
            font-family: 'Inter', sans-serif;
            color: var(--text);
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background:
                radial-gradient(1200px 700px at 20% -10%, rgba(99, 102, 241, .06), transparent 60%),
                radial-gradient(900px 600px at 110% 120%, rgba(124, 58, 237, .05), transparent 60%),
                radial-gradient(circle at top left, #11121a 0%, var(--bg) 100%);
        }

        /* ====== Contenedor 2 columnas ====== */
        .auth-container {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            width: 100%;
            max-width: 1200px;
            min-height: 650px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0, 0, 0, .6);
            background: var(--panel-soft);
            transition: all .3s ease;
        }

        /* ====== Columna de imagen ====== */
        .auth-image {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            color: #f3f4f6;
            background-size: cover;
            background-position: center;
        }

        .auth-image::after {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 40% 60%, rgba(99, 102, 241, .22), transparent 55%);
            pointer-events: none;
        }

        /* ====== Columna de formulario ====== */
        .auth-form {
            background: var(--panel);
            padding: 3rem 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Wrapper interior para encajar contenido */
        .auth-form-inner {
            width: 100%;
            max-width: 560px;
            /* login */
            margin-left: auto;
            /* pegado a la derecha del panel */
            margin-right: 0;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .auth-form-inner header {
            margin-bottom: 1.25rem;
        }

        .auth-form-inner .form-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .auth-form-inner footer {
            margin-top: 1.25rem;
        }

        .auth-form h1 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text);
        }

        .auth-form p {
            color: var(--muted);
            font-size: 1rem;
            margin-top: .5rem;
        }

        /* Inputs base */
        .auth-form input[type="email"],
        .auth-form input[type="password"],
        .auth-form input[type="text"] {
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            color: var(--text);
            border-radius: .5rem;
            padding: .75rem 1rem;
        }

        .auth-form input:focus {
            outline: 0;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-weak);
        }

        /* ====== Toggle de contraseña (envoltorio) ====== */
        .input-wrap {
            position: relative;
        }

        .input-wrap>input {
            padding-right: 2.6rem;
            /* hueco para el botón ojo */
        }

        .pw-toggle {
            position: absolute;
            right: .6rem;
            top: 50%;
            transform: translateY(-50%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border-radius: .5rem;
            border: 1px solid var(--input-border);
            background: #1f2230;
            color: #cbd5e1;
            cursor: pointer;
        }

        .pw-toggle:hover {
            filter: brightness(1.05);
        }

        .pw-toggle svg {
            width: 18px;
            height: 18px;
        }

        /* Botón principal reutilizable */
        .btn-primary {
            width: 100%;
            padding: .9rem 1rem;
            border-radius: 12px;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(90deg, color-mix(in srgb, var(--accent) 90%, #4f46e5), var(--accent));
            border: 0;
            box-shadow: 0 10px 20px rgba(99, 102, 241, .25);
            transition: transform .15s ease, filter .15s ease, box-shadow .15s ease;
        }

        .btn-primary:hover {
            filter: brightness(1.06);
            transform: translateY(-1px);
            box-shadow: 0 12px 24px rgba(99, 102, 241, .32);
        }

        .btn-primary:focus {
            outline: 0;
            box-shadow: 0 0 0 4px var(--accent-weak);
        }

        /* Links */
        a.link-accent {
            color: color-mix(in srgb, var(--accent) 85%, white);
        }

        a.link-accent:hover {
            color: #fff;
        }

        footer {
            text-align: center;
            font-size: .8rem;
            color: #64748b;
        }

        /* ====== Autofill: mantiene el fondo oscuro ====== */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0px 1000px var(--input-bg) inset !important;
            -webkit-text-fill-color: var(--text) !important;
            transition: background-color 9999s ease-in-out 0s;
            caret-color: var(--text);
            border: 1px solid var(--input-border) !important;
        }

        /* ====== SOLO REGISTER (más compacto y garantizando footer) ====== */
        @media (min-width: 1024px) {
            .page-register .auth-form {
                padding: 2rem 3rem;
            }

            .page-register .auth-form-inner {
                display: grid;
                grid-template-rows: auto 1fr auto;
                row-gap: .75rem;
                max-width: 520px;
                margin-left: auto;
                margin-right: 0;
            }

            .page-register .auth-form-inner header {
                margin-bottom: .5rem;
            }

            .page-register .auth-form h1 {
                font-size: 1.85rem;
                line-height: 1.2;
            }

            .page-register .auth-form p {
                font-size: .95rem;
            }

            .page-register .auth-form-inner .form-body {
                gap: .8rem;
            }

            .page-register .auth-form input[type="text"],
            .page-register .auth-form input[type="email"],
            .page-register .auth-form input[type="password"] {
                padding-top: .40rem;
                padding-bottom: .40rem;
            }

            .page-register .btn-primary {
                padding: .8rem 1rem;
                margin-top: .25rem;
            }

            .page-register .auth-form-inner footer {
                margin-top: .6rem;
            }
        }
    </style>
</head>

<body class="{{ request()->routeIs('register') ? 'page-register' : '' }}">
    @php
    $authImage = asset('images/juegosPortada2.jpg');
    if (request()->routeIs('register') && file_exists(public_path('images/register-bg.jpg'))) {
    $authImage = asset('images/register-bg.jpg');
    }
    @endphp

    <div class="auth-container">
        <!-- Imagen / Lado izquierdo -->
        <div class="auth-image"
            style="background:
            linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.72)),
            url('{{ $authImage }}') center/cover no-repeat;">
        </div>

        <!-- Formulario / Lado derecho -->
        <div class="auth-form">
            <div class="auth-form-inner">
                <header>
                    <h1>
                        {{ request()->routeIs('register') ? 'Create your account' : 'Welcome back' }}
                    </h1>
                    <p>
                        {{ request()->routeIs('register')
                        ? 'Sign up to start building your library'
                        : 'Sign in to continue to your library' }}
                    </p>
                </header>

                <div class="form-body">
                    {{ $slot }}
                </div>

                <footer>
                    <p>© {{ date('Y') }} Backlog Games. Built with Laravel.</p>
                </footer>
            </div>
        </div>
    </div>

    <!-- Toggle de contraseña (auto para login y register, sin tocar vistas) -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const scope = document.querySelector('.auth-form-inner') || document;
            const pwFields = scope.querySelectorAll('input[type="password"]');

            pwFields.forEach((input, idx) => {
                // Si ya está envuelto, saltamos
                if (input.parentElement && input.parentElement.classList.contains('input-wrap')) return;

                // Envolver input
                const wrap = document.createElement('div');
                wrap.className = 'input-wrap';
                input.parentElement.insertBefore(wrap, input);
                wrap.appendChild(input);

                // Crear botón ojo
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'pw-toggle';
                btn.setAttribute('aria-label', 'Show password');
                btn.setAttribute('aria-pressed', 'false');

                // Icono ojo (visible=false)
                const eye = `
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7"/>
            <circle cx="12" cy="12" r="3"/>
        </svg>`;
                // Icono ojo tachado (visible=true)
                const eyeOff = `
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a20.8 20.8 0 0 1 5.06-6.94"/>
            <path d="M1 1l22 22"/>
            <path d="M9.9 4.24A10.94 10.94 0 0 1 12 4c7 0 11 8 11 8a20.8 20.8 0 0 1-4.06 5.06"/>
            <path d="M14.12 14.12A3 3 0 0 1 9.88 9.88"/>
        </svg>`;

                btn.innerHTML = eye;
                wrap.appendChild(btn);

                // Toggle handler
                btn.addEventListener('click', () => {
                    const visible = input.type === 'text';
                    if (visible) {
                        input.type = 'password';
                        btn.setAttribute('aria-pressed', 'false');
                        btn.setAttribute('aria-label', 'Show password');
                        btn.innerHTML = eye;
                    } else {
                        input.type = 'text';
                        btn.setAttribute('aria-pressed', 'true');
                        btn.setAttribute('aria-label', 'Hide password');
                        btn.innerHTML = eyeOff;
                    }
                    input.focus({
                        preventScroll: true
                    });
                    // Mueve el cursor al final
                    const val = input.value;
                    input.value = '';
                    input.value = val;
                });
            });
        });
    </script>
</body>

</html>