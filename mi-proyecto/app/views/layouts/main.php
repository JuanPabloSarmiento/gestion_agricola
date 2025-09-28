<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Gestión Agrícola' ?></title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.2rem;
        }
        .container-main {
            margin-top: 70px;
        }
        footer {
            margin-top: 50px;
            padding: 15px 0;
            background: #343a40;
            color: #fff;
            text-align: center;
            position: absolute;
            bottom: -200px;
            width: 100%;
            
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="/mi-proyecto/public/index.php?action=dashboard">🌱 Gestión Agrícola</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="/mi-proyecto/public/index.php?action=cultivos">Cultivos</a></li>
        <li class="nav-item"><a class="nav-link" href="/mi-proyecto/public/index.php?action=categorias">Categorías</a></li>
        <li class="nav-item"><a class="nav-link" href="/mi-proyecto/public/index.php?action=insumos">Insumos</a></li>
        <li class="nav-item"><a class="nav-link" href="/mi-proyecto/public/index.php?action=ver_trazabilidad">Trazabilidad</a></li>
        <li class="nav-item"><a class="nav-link" href="/mi-proyecto/public/index.php?action=comparativo">Reportes</a></li>
      </ul>
      <ul class="navbar-nav">
        <?php if (!empty($_SESSION['usuario'])): ?>
          <li class="nav-item"><span class="nav-link">👤 <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?></span></li>
          <li class="nav-item"><a class="nav-link" href="/mi-proyecto/public/index.php?action=logout">Salir</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="/mi-proyecto/public/index.php?action=login">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Contenido principal -->
<div class="container container-main">
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?= $content ?? '' ?>
</div>

<!-- Footer -->
<footer>
  <p>© <?= date('Y') ?> Sistema de Gestión Agrícola | Todos los derechos reservados</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
