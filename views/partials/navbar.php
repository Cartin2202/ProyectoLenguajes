<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow sticky-top my-navbar">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
      <img src="assets/img/logo.png" alt="Logo" height="70">
      <span class="fw-bold text-uppercase">Piedras & Enchapes</span>
    </a>
    <button class="navbar-toggler border-0 p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

        <!-- Enlace Inicio -->
        <li class="nav-item">
          <a class="nav-link px-3 rounded-pill <?= basename($_SERVER['PHP_SELF'])=='index.php' ? 'active fw-bold' : '' ?>" href="index.php">
            <i class="bi bi-house-door"></i> Inicio 
          </a>
        </li>

        <!-- Enlace Login -->
        <li class="nav-item">
          <a class="nav-link px-3 rounded-pill <?= basename($_SERVER['PHP_SELF'])=='login.php' ? 'active fw-bold' : '' ?>" href="login.php">
            <i class="bi bi-box-arrow-in-right"></i> Login 
          </a>
        </li>

        <!-- Dropdown Productos y Categorías -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle px-3 rounded-pill <?= in_array(basename($_SERVER['PHP_SELF']), ['productos.php','categorias.php']) ? 'active fw-bold' : '' ?>" href="#" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-gem"></i> Piedras & Enchapes
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow">
            <li><a class="dropdown-item" href="productos.php"><i class="bi bi-box-seam"></i> Productos</a></li>
            <li><a class="dropdown-item" href="categorias.php"><i class="bi bi-tags"></i> Categorías</a></li>
          </ul>
        </li>

        <!-- Enlace Inventario -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle px-3 rounded-pill <?= in_array(basename($_SERVER['PHP_SELF']), ['inventario.php','registrar_movimiento.php','asociar_producto_movimiento.php','actualizar_movimiento.php','eliminar_movimiento.php','lista_movimientos.php']) ? 'active fw-bold' : '' ?>" href="#" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-archive"></i> Inventario
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow">
            <li><a class="dropdown-item" href="registrar_movimiento.php"><i class="bi bi-plus-circle"></i> Registrar Movimiento</a></li>
            <li><a class="dropdown-item" href="asociar_producto_movimiento.php"><i class="bi bi-link-45deg"></i> Asociar Producto</a></li>
            <li><a class="dropdown-item" href="actualizar_movimiento.php"><i class="bi bi-pencil-square"></i> Actualizar Movimiento</a></li>
            <li><a class="dropdown-item" href="eliminar_movimiento.php"><i class="bi bi-trash"></i> Eliminar Movimiento</a></li>
            <li><a class="dropdown-item" href="lista_movimientos.php"><i class="bi bi-list-check"></i> Lista Movimientos</a></li>
          </ul>
        </li>

        <!-- Dropdown Empleados -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle px-3 rounded-pill <?= in_array(basename($_SERVER['PHP_SELF']), ['registrar_empleado.php','empleados.php']) ? 'active fw-bold' : '' ?>" href="#" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-people"></i> Empleados
         </a>
          <ul class="dropdown-menu dropdown-menu-end shadow">
           <li><a class="dropdown-item" href="registrar_empleado.php"><i class="bi bi-person-plus"></i> Registrar</a></li>
           <li><a class="dropdown-item" href="empleados.php"><i class="bi bi-search"></i> Consultar</a></li>
         </ul>
        </li>

        <!-- Dropdown Clientes -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle px-3 rounded-pill <?= in_array(basename($_SERVER['PHP_SELF']), ['clientes.php','insertar_clientes.php','editar_clientes.php','eliminar_clientes.php']) ? 'active fw-bold' : '' ?>" href="#" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-people-fill"></i> Clientes
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow">
            <li><a class="dropdown-item" href="clientes.php"><i class="bi bi-search"></i> Consultar</a></li>
            <li><a class="dropdown-item" href="insertar_clientes.php"><i class="bi bi-person-plus"></i> Registrar</a></li>
            <li><a class="dropdown-item" href="editar_clientes.php"><i class="bi bi-pencil-square"></i> Editar</a></li>
            <li><a class="dropdown-item" href="eliminar_clientes.php"><i class="bi bi-trash"></i> Eliminar</a></li>
          </ul>
        </li>

        <!-- Dropdown Proveedores -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle px-3 rounded-pill <?= in_array(basename($_SERVER['PHP_SELF']), ['proveedores.php','registrar_proveedor.php','asociar_producto_proveedor.php','actualizar_proveedor.php','eliminar_proveedor.php']) ? 'active fw-bold' : '' ?>" href="#" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-truck"></i> Proveedores
          </a>
         <ul class="dropdown-menu dropdown-menu-end shadow">
           <li><a class="dropdown-item" href="proveedores.php"><i class="bi bi-search"></i> Consultar</a></li>
           <li><a class="dropdown-item" href="registrar_proveedor.php"><i class="bi bi-person-plus"></i> Registrar</a></li>
           <li><a class="dropdown-item" href="asociar_producto_proveedor.php"><i class="bi bi-link-45deg"></i> Asociar producto</a></li>
           <li><a class="dropdown-item" href="actualizar_proveedor.php"><i class="bi bi-pencil-square"></i> Actualizar</a></li>
           <li><a class="dropdown-item" href="eliminar_proveedor.php"><i class="bi bi-trash"></i> Eliminar</a></li>
          </ul>
        </li>

        <!-- carrito> -->
        <li class="nav-item">
          <a class="nav-link px-3 rounded-pill <?= basename($_SERVER['PHP_SELF']) == 'carrito.php' ? 'active fw-bold' : '' ?>" href="carrito.php">
            <i class="bi bi-cart"></i> Carrito
          </a>
        </li>

        <!-- ventas"> -->
        <li class="nav-item">
          <a class="nav-link px-3 rounded-pill <?= basename($_SERVER['PHP_SELF']) == 'ventas.php' ? 'active fw-bold' : '' ?>" href="ventas.php">
            <i class="bi bi-receipt"></i> Ventas
          </a>
        </li>

        <!-- Sesión activa -->
        <?php if (isset($_SESSION['usuario'])): ?>
          <li class="nav-item">
            <span class="navbar-text me-3">Hola, <?= $_SESSION['usuario'] ?></span>
          </li>
          <li class="nav-item">
            <a class="btn btn-sm btn-outline-dark" href="controllers/LogoutController.php">Cerrar sesión</a>
          </li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>