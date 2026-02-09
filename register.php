<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1'
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="css/auth.css">
</head>

<body class="bg-gradient-to-br from-indigo-900 via-purple-900 to-black flex items-center justify-center min-h-screen">
    <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl shadow-2xl overflow-hidden w-full max-w-5xl grid grid-cols-1 md:grid-cols-2">


        <!-- PANEL IZQUIERDO -->
        <div class="hidden md:flex flex-col justify-between p-10 bg-gradient-to-br from-indigo-600/90 to-purple-700/90 text-white">


            <div>
                <p class="text-sm uppercase tracking-widest opacity-70"></p>
                <h1 class="text-4xl font-bold mt-4">Crea tu cuenta</h1>
                <p class="mt-4 text-white/80">
                    Accede a tu sistema de usuarios seguro y profesional.
                </p>
            </div>

            <div class="bg-white/10 p-4 rounded-xl backdrop-blur">
                <p class="text-sm italic">
                    "Sistemas de gestión de usuarios"
                </p>
                <div class="flex items-center mt-3 gap-3">
                    <img src="assets/logo.png" 
                    class="w-14 h-14 rounded-full bg-white p-2 shadow-2xl">

                    <div>
                        <p class="font-semibold">Antonio Mendoza</p>
                        <p class="text-xs opacity-70">Desarrollador</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- PANEL DERECHO FORM -->
        <div class="p-10 bg-gray-800 text-gray-100">

            <h2 class="text-2xl font-bold">Registrate</h2>
            <form action="/user_system/includes/registrar_usuario.php" method="POST" enctype="multipart/form-data">

                <div>
                    <label class="text-sm flex">Nombre</label>
                    <input name="nombre" required class="w-full p-3 bg-white/10 backdrop-blur border border-white/20 rounded-lg focus:ring-2 focus:ring-primary outline-none">
                </div>

                <div>
                    <label class="text-sm">Correo</label>
                    <input type="email" name="correo" required class="w-full p-3 bg-white/10 backdrop-blur border border-white/20 rounded-lg focus:ring-2 focus:ring-primary outline-none">
                </div>
                <!-- CONTRASEÑA -->
                <div>
                    <label class="block text-sm mb-1">Contraseña</label>

                    <div class="relative">
                        <input type="password" id="password" name="password" required
                            class="w-full p-3 pr-10 bg-gray-700 rounded-lg focus:ring-2 focus:ring-primary outline-none">

                        <span onclick="togglePassword('password', this)"
                            class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-400 hover:text-white text-lg">
                            👁️
                        </span>
                    </div>

                    <!-- CONFIRMAR CONTRASEÑA -->
                    <div class="mt-2">
                        <label class="block text-sm mb-1">Confirmar contraseña</label>

                        <div class="relative">
                            <input type="password" id="confirmPassword" name="confirm_password" required
                                class="w-full p-3 pr-10 bg-gray-700 rounded-lg focus:ring-2 focus:ring-primary outline-none">
                            <span onclick="togglePassword('confirmPassword', this)"
                                class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-400 hover:text-white text-lg">
                                👁️
                            </span>
                        </div>

                        <p id="passwordMessage" class="text-xs mt-1 font-bold"></p>
                    </div>
                    <!-- Barra seguridad -->
                    <div class="mt-2">
                        <div class="h-2 bg-gray-700 rounded-full overflow-hidden">
                            <div id="strengthBar" class="h-full w-0 bg-red-500 transition-all duration-300"></div>
                        </div>
                        <p id="strengthText" class="text-xs mt-1 text-gray-400">Seguridad: -</p>
                    </div>

                    <button id="submitBtn" class="w-full mt-4 bg-primary hover:bg-indigo-500 transition p-3 rounded-lg font-bold">
                        Crear cuenta
                    </button>

                    <div class="flex gap-3 mt-4"> <!-- Botones de redes sociales FALTA FUNCIONALIDAD-->
                        <button class="flex items-center gap-2 bg-white text-gray-900 px-4 py-2 rounded-lg w-full justify-center hover:bg-gray-200">
                            <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5">
                            Google
                        </button>

                        <button class="flex items-center gap-2 bg-gray-700 px-4 py-2 rounded-lg w-full justify-center hover:bg-gray-600">
                            <img src="https://www.svgrepo.com/show/512317/github-142.svg" class="w-5">
                            GitHub
                        </button>
                    </div>

                    <p class="text-gray-400 text-sm mt-1">
                        ¿Ya tienes cuenta? <a href="login.php" class="text-primary">Inicia sesión</a>
                    </p>

            </form>

        </div>

    </div>
    <script src="https://unpkg.com/gsap@3/dist/gsap.min.js"></script>


    <!-- Script para la barra de fuerza de la contraseña -->
    <script>
        // Esto es para la barra de fuerza de la contraseña
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirmPassword");
        const passwordMessage = document.getElementById("passwordMessage");
        const submitBtn = document.getElementById("submitBtn");
        const bar = document.getElementById("strengthBar");
        const strengthText = document.getElementById("strengthText");


        function validatePasswordMatch() {
            if (confirmPassword.value === "") {
                passwordMessage.textContent = "";
                submitBtn.disabled = false;
                submitBtn.classList.remove("opacity-50", "cursor-not-allowed");
                return;
            }

            if (password.value !== confirmPassword.value) {
                passwordMessage.textContent = "Las contraseñas no coinciden ❌";
                passwordMessage.className = "text-xs mt-1 font-bold text-red-500";
                submitBtn.disabled = true;
                submitBtn.classList.add("opacity-50", "cursor-not-allowed");
            } else {
                passwordMessage.textContent = "Las contraseñas coinciden ✅";
                passwordMessage.className = "text-xs mt-1 font-bold text-green-500";
                submitBtn.disabled = false;
                submitBtn.classList.remove("opacity-50", "cursor-not-allowed");
            }
        }

        password.addEventListener("input", () => {
            // ... LOGICA DE LA BARRA DE FUERZA ...
            validatePasswordMatch();

            const val = password.value;
            let strength = 0;

            if (val.length >= 8) strength++;
            if (/[A-Z]/.test(val)) strength++;
            if (/[0-9]/.test(val)) strength++;
            if (/[^A-Za-z0-9]/.test(val)) strength++;

            if (strength === 0) {
                bar.style.width = "0%";
                strengthText.textContent = "Seguridad: -";
            }
            if (strength === 1) {
                bar.style.width = "25%";
                bar.className = "h-full bg-red-500 transition-all";
                strengthText.textContent = "Seguridad: Débil";
            }
            if (strength === 2) {
                bar.style.width = "50%";
                bar.className = "h-full bg-yellow-500 transition-all";
                strengthText.textContent = "Seguridad: Media";
            }
            if (strength === 3) {
                bar.style.width = "75%";
                bar.className = "h-full bg-blue-500 transition-all";
                strengthText.textContent = "Seguridad: Buena";
            }
            if (strength === 4) {
                bar.style.width = "100%";
                bar.className = "h-full bg-green-500 transition-all";
                strengthText.textContent = "Seguridad: Fuerte 🔥";
            }
        });

        confirmPassword.addEventListener("input", validatePasswordMatch);

        // Función para mostrar/ocultar la contraseña
        function togglePassword(id, icon) {
            const input = document.getElementById(id);

            if (input.type === "password") {
                input.type = "text";
                icon.textContent = "🙈";
            } else {
                input.type = "password";
                icon.textContent = "👁️";
            }
        }
    </script>

    <script>
        //Animaciones 
        gsap.from(".bg-white\\/10", {
            opacity: 0,
            y: 50,
            duration: 1,
            ease: "power3.out"
        });

        gsap.from("h2, form > div, .animated-btn", {

            opacity: 0,
            y: 20,
            duration: 0.6,
            stagger: 0.1,
            delay: 0.3
        });
    </script>

</body>

</html>