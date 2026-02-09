![PHP](https://img.shields.io/badge/PHP-8-blue)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-UI-blue)
![Status](https://img.shields.io/badge/Status-In_Development-yellow)


# 🔐 User System — Modern Authentication System (en desarrollo)

Sistema completo de autenticación y gestión de usuarios desarrollado con **PHP, MySQL y Tailwind CSS**, enfocado en seguridad, diseño moderno y buenas prácticas de desarrollo web.

Este proyecto simula un sistema real de producción para dashboards administrativos, plataformas SaaS o aplicaciones empresariales.

---

## ✨ Características

### 🔑 Autenticación
- Registro de usuarios con validación avanzada
- Inicio de sesión seguro con hashing (`password_hash`, `password_verify`)
- Confirmación de contraseña en registro
- Mostrar / ocultar contraseña 👁️
- Barra de fuerza de contraseña en tiempo real

### 👤 Perfil de usuario
- Subida de foto de perfil (avatar)
- Preview instantáneo del avatar
- Sidebar con imagen dinámica desde sesión
- Actualización de avatar sin cerrar sesión

### 🎨 Interfaz moderna
- UI Glassmorphism (blur + transparencia)
- Diseño responsive (desktop & mobile)
- Tailwind CSS utility-first
- Animaciones con GSAP

### 🌐 Integraciones (en progreso)
- Google OAuth Login
- GitHub OAuth Login
- Google reCAPTCHA
- Verificación de correo electrónico

---

## 🛠️ Tecnologías

| Tecnología | Uso |
|------------|------|
| PHP 8 | Backend |
| MySQL | Base de datos |
| Tailwind CSS | UI moderna |
| JavaScript | Validaciones dinámicas |
| GSAP | Animaciones |
| HTML5 / CSS3 | Estructura |

---

## 🧩 Estructura del Proyecto

```bash
user_system/
│
├── admin/
│   ├── cambiar_rol.php
│   ├── eliminar.php
│   └── usuarios.php
│
├── assets/
│   └── js/
│       ├── animations.js
│       ├── login_animations.js
│       └── theme.js
│
├── css/
│   ├── auth.css
│   └── sidebar.css
│
├── database/
│   └── user_system.sql
│
├── includes/
│   ├── admin_auth.php
│   ├── auth.php
│   ├── conexion.php
│   ├── head.php
│   ├── sidebar_admin.php
│   ├── sidebar.php
│   ├── subir_foto.php
│   └── validar_admin.php
│
├── uploads/
│   └── perfiles/
│
├── .gitignore
├── dashboard.php
├── index.php
├── login.php
├── perfil.php
├── register.php
└── test_conexion.php
```


## 👨‍💻 Autor

**Antonio Izamael Mendoza**  
Ingeniería en Sistemas Computacionales 🇲🇽  

> Proyecto personal para portafolio profesional.



## 📈 Hoja de ruta

- [x] Registro de usuarios
- [x] Login seguro
- [x] Avatar upload
- [x] UI Glassmorphism
- [x] GSAP Animations
- [ ] Email verification
- [ ] reCAPTCHA
- [ ] Roles de usuario (Admin / User)
- [ ] MVC Architecture
- [ ] API REST


