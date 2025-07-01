<?php
require_once 'Connect.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $grade = $_POST['grade'] ?? '';

    if ($name && $email && $grade) {
        $sql = "INSERT INTO students (NAME, EMAIL, GRADE) VALUES (?, ?, ?)";
        $params = [$name, $email, $grade];
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt) {
            $message = "<p style='color: green;'>Étudiant ajouté avec succès !</p>";
        } else {
            $message = "<p style='color: red;'>Erreur d'insertion : " . print_r(sqlsrv_errors(), true) . "</p>";
        }
    } else {
        $message = "<p style='color: red;'>Tous les champs sont obligatoires.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter un étudiant + Liste</title>
</head>
<body>
  <h1>Ajouter un étudiant</h1>
  <?= $message ?>

  <form method="POST">
    <label>Nom :
      <input type="text" name="name" required>
    </label><br><br>
    <label>Email :
      <input type="email" name="email" required>
    </label><br><br>
    <label>Note :
      <input type="text" name="grade" maxlength="1" required>
    </label><br><br>
    <button type="submit">Ajouter</button>
  </form>

  <hr>

  <h2>Liste des étudiants</h2>
  <table border="1" cellpadding="6">
    <tr>
      <th>ID</th>
      <th>Nom</th>
      <th>Email</th>
      <th>Note</th>
    </tr>
    <?php
    $result = sqlsrv_query($conn, "SELECT ID, NAME, EMAIL, GRADE FROM students ORDER BY ID DESC");
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
        echo "<td>" . htmlspecialchars($row['NAME']) . "</td>";
        echo "<td>" . htmlspecialchars($row['EMAIL']) . "</td>";
        echo "<td>" . htmlspecialchars($row['GRADE']) . "</td>";
        echo "</tr>";
    }
    ?>
  </table>
</body>
</html>
