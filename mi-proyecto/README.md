# Sistema de Gestión Agrícola

## Descripción del Proyecto
Este proyecto tiene como objetivo digitalizar la gestión agrícola, centralizando la administración de usuarios, cultivos, insumos, aplicaciones y reportes, con control de roles y seguridad en la sesión.

### Funcionalidades Principales del Módulo de Usuarios
- Registro de usuario con rol (Administrador, Empleado, Supervisor)
- Login de usuario con validación de credenciales
- Logout seguro
- Dashboard con botones y accesos según rol
- Lista de usuarios accesible solo para administradores
- Control de sesión y redirección automática
- Control de cache para prevenir acceso mediante "go back"
- Mensajes de sesión (`error` / `success`)

## Estructura de Archivos
```
mi-proyecto/
│
├─ public/
│   └─ index.php          # Router principal
│
├─ app/
│   ├─ controllers/
│   │   └─ UsuarioController.php
│   ├─ models/
│   │   └─ Usuario.php
│   └─ views/
│       ├─ usuarios/
│       │   ├─ login.php
│       │   ├─ registro.php
│       │   └─ list.php
│       └─ dashboard.php
│
├─ core/
│   ├─ Database.php
│   └─ Model.php
│
└─ config/
    └─ database.php
```

## Detalle Técnico
- Conexión a base de datos usando PDO con consultas preparadas (`Database.php`).
- Controladores centralizados y router simple en `index.php`.
- Sesiones controladas desde el constructor del controlador.
- Cabeceras HTTP de cache para proteger vistas.
- Roles implementados para control de acceso (`1=Administrador`, `2=Empleado`, `3=Supervisor`).
- Mensajes de sesión para errores y confirmaciones.

## Código Clave
### Dashboard.php
```php
<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

$usuario = $_SESSION['usuario'] ?? null;
if (!$usuario) {
    $_SESSION['error'] = "Debes iniciar sesión";
    header("Location: /mi-proyecto/public/index.php?action=login");
    exit;
}

$esAdmin = ($usuario['id_rol'] == 1);
$roles = [1=>'Administrador', 2=>'Empleado', 3=>'Supervisor'];
$rolNombre = $roles[$usuario['id_rol']] ?? 'Desconocido';
?>
```

### Botón Admin en Dashboard
```php
<?php if ($esAdmin): ?>
    <a href="/mi-proyecto/public/index.php?action=usuarios">Ver Usuarios</a>
<?php endif; ?>
```

### Redirección Automática en Login/Registro
```php
if (isset($_SESSION['usuario'])) {
    header("Location: /mi-proyecto/public/index.php?action=dashboard");
    exit;
}
```

### Logout Seguro
```php
public function logout() {
    session_destroy();
    header("Location: /mi-proyecto/public/index.php?action=login");
    exit;
}
```

## Fases del Proyecto
| Fase | Descripción | Estado |
|------|------------|-------|
| Fase 1 | Infraestructura básica | ✅ Completada |
| Fase 2 | Usuarios y autenticación | ✅ Completada |
| Fase 3 | Gestión agrícola | ⬜ Pendiente |
| Fase 4 | Reportes y PQRS | ⬜ Pendiente |
| Fase 5 | Frontend avanzado | ⬜ Pendiente |
| Fase 6 | Ajustes finales y despliegue | ⬜ Pendiente |

## Progreso Actual
- Caso de Uso 1: Módulo de Usuarios ✅ Completado
- Control de roles y permisos ✅
- Protección de vistas y sesiones ✅
- Mensajes de sesión ✅
- Control de cache ✅

## Próximos Pasos
1. Fase 3 – Gestión agrícola (cultivos, insumos, aplicaciones, categorías).
2. Implementar CRUD completo con permisos según roles.
3. Continuar con reportes y exportaciones (Fase 4).
4. Mejorar frontend y gráficos dinámicos (Fase 5).
5. Ajustes finales y despliegue (Fase 6).

---
**Nota:** Este README sirve como referencia completa de todo el progreso actual y permitirá continuar el proyecto de manera ordenada y controlada.