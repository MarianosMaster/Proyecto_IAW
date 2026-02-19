<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Geekvault</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header class="main-header">
        <div class="header-content">
            <div class="logo">GeekVault</div>
            <nav>
                <ul>
                    <li><a href="../index.php">Inicio</a></li>
                    <li><a href="#" class="active">Contacto</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="contact-container">
            <div class="contact-header">
                <h2>Contáctanos</h2>
                <p>Estamos aquí para ayudarte. Envíanos un mensaje.</p>
            </div>

            <form class="contact-form" action="" method="POST">

                <div class="input-group">
                    <input type="text" id="nombre" name="nombre" required placeholder=" ">
                    <label for="nombre">Nombre Completo</label>
                    <i class="fa-solid fa-user"></i>
                </div>

                <div class="input-group">
                    <input type="email" id="email" name="email" required placeholder=" ">
                    <label for="email">Correo Electrónico</label>
                    <i class="fa-solid fa-envelope"></i>
                </div>

                <div class="input-group">
                    <textarea id="mensaje" name="mensaje" required placeholder=" " rows="4"></textarea>
                    <label for="mensaje">Tu Mensaje</label>
                    <i class="fa-solid fa-comment-dots" style="top: 20px; transform: none;"></i>
                </div>

                <button type="submit" class="submit-btn">
                    <span>Enviar Mensaje</span>
                    <i class="fa-solid fa-paper-plane"></i>
                </button>

            </form>
        </div>
    </main>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Simple acknowledgment for now
        echo "<script>alert('Gracias por tu mensaje. Nos pondremos en contacto contigo pronto.');</script>";
    }
    ?>
</body>

</html>