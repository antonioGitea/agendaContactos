<?php
/**
 * Página principal del proyecto (sin base de datos).
 *
 * Este script demuestra:
 * - Uso de PHPDoc a nivel de archivo.
 * - Funciones documentadas con tipos, throws y deprecated.
 * - Saludo dinámico según la hora actual.
 * - Manejo de excepciones con presentación en HTML.
 *
 * @package ProyectoDemo
 */
/**
 * Obtiene un saludo en función de la hora actual.
 *
 * @return string Saludo adecuado según la hora.
 * @throws Exception Si no se puede obtener la hora del sistema.
 */
function obtenerSaludo(): string
{
    $hora = date('H');
    if ($hora === false) {
        throw new Exception("No se pudo obtener la hora del sistema.");
    }
    $hora = (int) $hora;
    if ($hora < 12) {
        return "Buenos días";
    } elseif ($hora < 20) {
        return "Buenas tardes";
    }
    return "Buenas noches";
}
/**
 * Función obsoleta de ejemplo.
 *
 * No se usa en el proyecto, pero sirve para que phpDocumentor
 * muestre entradas con el tag @deprecated.
 *
 * @deprecated Esta función no debe usarse. Mantener solo con fines de documentación.
 * @return string Mensaje fijo de ejemplo.
 */
function saludoAntiguo(): string
{
    return "Hola (saludo antiguo).";
}
// -----------------------------------------------------------------------------
// Ejecución principal
// -----------------------------------------------------------------------------
try {
    $saludo = obtenerSaludo();
} catch (Throwable $e) {
    $saludo = "Error generando saludo";
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Proyecto con Saludo Documentado</title>
</head>

<body>
    <h1><?php echo $saludo; ?></h1>
    <p>Página simple sin base de datos, con funciones documentadas en PHPDoc.</p>
    <?php if (isset($error)): ?>
        <p style="color:red;"><strong>Error:</strong>
            <?php echo htmlspecialchars($error);
            ?>
        </p>
    <?php endif; ?>
    <hr>
    <p><em>Ejemplo de función obsoleta (deprecated):</em> <?php echo
        saludoAntiguo(); ?></p>
</body>

</html>