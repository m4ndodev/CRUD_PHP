<?php
// Inclure le fichier config.php
require_once 'config.php';

// Vérifier si l'ID est défini dans l'URL
if (isset($_GET['id'])) {
  // Récupérer l'ID de l'URL
  $id = $_GET['id'];

  // Vérifier si le formulaire a été soumis
  if (isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];
    $ville = $_POST['ville'];
    $pays = $_POST['pays'];

    // Mettre à jour les données dans la base de données
    $query = "UPDATE users SET prenom=:prenom, age=:age, ville=:ville, pays=:pays WHERE id=:id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':ville', $ville);
    $stmt->bindParam(':pays', $pays);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // Rediriger vers la page index après la mise à jour
    header('Location: index.php');
    exit();
  }

  // Récupérer les données de l'enregistrement correspondant à l'ID
  $query = "SELECT * FROM users WHERE id=:id";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
  // Rediriger vers la page index si l'ID n'est pas défini dans l'URL
  header('Location: index.php');
  exit();
}

// Fermer la connexion à la base de données
$conn = null;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Modifier un utilisateur</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-800 text-white">
  <div class="container mx-auto mt-8">
    <h1 class="text-2xl text-center font-bold mb-8">Modifier un étudiant</h1>
    <form action="update.php?id=<?php echo $id; ?>" method="post" class="bg-gray-700 px-8 pt-6 pb-8 mb-4 rounded">
      <div class="mb-4">
        <label for="prenom" class="block text-gray-200 font-bold mb-2">Prénom :</label>
        <input type="text" name="prenom" id="prenom" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo $row['prenom']; ?>" required>
      </div>
      <div class="mb-4">
        <label for="age" class="block text-gray-200 font-bold mb-2">Age :</label>
        <input type="number" name="age" id="age" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo $row['age']; ?>" required>
      </div>
      <div class="mb-4">
        <label for="ville" class="block text-gray-200 font-bold mb-2">Ville :</label>
        <input type="text" name="ville" id="ville" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo $row['ville']; ?>" required>
      </div>
      <div class="mb-4">
        <label for="pays" class="block text-gray-200 font-bold mb-2">Pays :</label>
        <input type="text" name="pays" id="pays" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo $row['pays']; ?>" required>
      </div>
      <div class="flex items-center justify-center">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="submit">
          Modifier
        </button>
      </div>
    </form>
  </div>

</body>
<footer class="text-white font-bold p-4 text-center fixed bottom-0 w-full">
  <p class="text-white">CRUD PHP - Créer par M4NDO</p>
</footer>

</html>