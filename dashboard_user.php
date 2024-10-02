<?php
require_once './bd/conexion_login.php';  // Corrige la ruta

session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: dashboard_user.php");
    exit();
}

$conexion = new ConexionLogin();
$conn = $conexion->Conectar();

// Obtener lista de usuarios registrados
$sql = "SELECT id, email, password, role FROM users";
$stmt = $conn->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./admin/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Estilos para el topbar */
        .topbar {
            width: 100%;
            background-color: #1f293a;
            color: white;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 10px 60px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .topbar .logout-btn {
            background: #d32f2f;
            border: none;
            padding: 10px 20px;
            color: white;
            cursor: pointer;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            margin-right: 100px;
        }

        .topbar .logout-btn:hover {
            background-color: #c1272d;
        }
    </style>
</head>

<body>
    <div class="topbar">
        <form id="logoutForm" method="POST" action="./admin/logout.php">
            <button type="button" class="logout-btn" onclick="confirmLogout()">Cerrar Sesión</button>
        </form>
    </div>
    <div class="container">
        <h1>Administrador</h1>
        <h2>Lista de Usuarios Registrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['password']) ?></td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                        <td>
                            <button class="btn"
                                onclick="editUser('<?= $user['id'] ?>', '<?= $user['email'] ?>', '<?= $user['role'] ?>')">Editar</button>
                            <button class="btn"
                                onclick="confirmDeleteUser('<?= $user['id'] ?>', '<?= $user['email'] ?>')">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button class="btn" onclick="toggleForm('addUserForm')">Agregar Usuario</button>
        <div id="addUserForm" class="form-container">
            <h2>Agregar Usuario</h2>
            <form action="admin/manage_users.php" method="POST">
                <div class="input-box">
                    <label for="emailAdd">Correo Electrónico</label>
                    <input type="email" id="emailAdd" name="email" required>
                </div>
                <div class="input-box">
                    <label for="passwordAdd">Contraseña</label>
                    <input type="password" id="passwordAdd" name="password" required>
                </div>
                <div class="input-box">
                    <label for="roleAdd">Rol</label>
                    <select id="roleAdd" name="role" required>
                        <option value="user">Usuario</option>
                        <option value="admin">Administrador</option>
                        <option value="cont">Contador</option>
                        <option value="calidad">Calidad</option>
                    </select>
                </div>
                <button class="btn" type="submit" name="action" value="add">Agregar Usuario</button>
            </form>
        </div>

        <div id="editUserForm" class="form-container">
            <h2>Editar Usuario</h2>
            <form action="admin/manage_users.php" method="POST">
                <input type="hidden" id="userIdEdit" name="id">
                <div class="input-box">
                    <label for="emailEdit">Correo Electrónico</label>
                    <input type="email" id="emailEdit" name="email" required>
                </div>
                <div class="input-box">
                    <label for="passwordEdit">Nueva Contraseña (opcional)</label>
                    <input type="password" id="passwordEdit" name="password">
                </div>
                <div class="input-box">
                    <label for="roleEdit">Rol</label>
                    <select id="roleEdit" name="role" required>
                        <option value="user">Usuario</option>
                        <option value="admin">Administrador</option>
                        <option value="cont">Contador</option>
                        <option value="calidad">Calidad</option>
                    </select>
                </div>
                <button class="btn" type="submit" name="action" value="edit">Guardar Cambios</button>
            </form>
        </div>

        <div id="deleteUserForm" class="form-container">
            <h2>Eliminar Usuario</h2>
            <form id="deleteForm" action="admin/manage_users.php" method="POST">
                <input type="hidden" id="userIdDelete" name="id">
                <p>¿Estás seguro que deseas eliminar al usuario <strong id="userEmailDelete"></strong>?</p>
                <button class="btn" type="submit" name="action" value="delete">Eliminar Usuario</button>
            </form>
        </div>

    </div>

    <script>
        function toggleForm(formId) {
            const forms = document.querySelectorAll('.form-container');
            forms.forEach(form => {
                if (form.id === formId) {
                    form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
                } else {
                    form.style.display = 'none';
                }
            });
        }

        function editUser(id, email, role) {
            toggleForm('editUserForm');
            document.getElementById('userIdEdit').value = id;
            document.getElementById('emailEdit').value = email;
            document.getElementById('roleEdit').value = role;
        }

        function confirmDeleteUser(id, email) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: `¿Deseas eliminar al usuario ${email}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#d32f2f',
                cancelButtonColor: '#6c757d',
                reverseButtons: true,
                customClass: {
                    container: 'swal-container',
                    popup: 'swal-popup',
                    title: 'swal-title',
                    content: 'swal-content',
                    confirmButton: 'swal-confirm-button',
                    cancelButton: 'swal-cancel-button'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar el formulario de eliminación
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'admin/manage_users.php';

                    const inputId = document.createElement('input');
                    inputId.type = 'hidden';
                    inputId.name = 'id';
                    inputId.value = id;
                    form.appendChild(inputId);

                    const inputAction = document.createElement('input');
                    inputAction.type = 'hidden';
                    inputAction.name = 'action';
                    inputAction.value = 'delete';
                    form.appendChild(inputAction);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function confirmLogout() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Deseas cerrar sesión?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, cerrar sesión',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#d32f2f',
                cancelButtonColor: '#6c757d',
                reverseButtons: true,
                customClass: {
                    container: 'swal-container',
                    popup: 'swal-popup',
                    title: 'swal-title',
                    content: 'swal-content',
                    confirmButton: 'swal-confirm-button',
                    cancelButton: 'swal-cancel-button'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logoutForm').submit();
                }
            });
        }

        <?php
        if (isset($_GET['mensaje']) && isset($_GET['tipo'])) {
            echo "Swal.fire({
                icon: '" . htmlspecialchars($_GET['tipo']) . "',
                title: 'Resultado de la operación',
                text: '" . htmlspecialchars($_GET['mensaje']) . "',
                background: '#f8f9fa',
                color: '#333',
                customClass: {
                    container: 'swal-container',
                    popup: 'swal-popup',
                    title: 'swal-title',
                    content: 'swal-content',
                    confirmButton: 'swal-confirm-button'
                }
            }).then(() => {
                // Limpiar los parámetros de la URL después de mostrar la alerta
                const url = new URL(window.location.href);
                url.searchParams.delete('mensaje');
                url.searchParams.delete('tipo');
                window.history.replaceState({}, '', url);
            });";
        }
        ?>
    </script>
</body>

</html>
