<?php
require_once '../db/connection.php';
if (!isset($_SESSION['name'])) {
  header('Location: ../');
}
?>

<?php
require_once 'includes/navbar.php';
navabar('Product');
?>
</body>

</html>