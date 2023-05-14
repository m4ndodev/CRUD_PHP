<?php
require_once 'config.php';

if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $sql = "DELETE FROM users WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$id]);
  header('Location: index.php');
} else {
  header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Supprimer un utilisateur</title>
  <!-- Styles Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white">

  <div class="flex flex-col items-center justify-center min-h-screen py-2">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
      <h2 class="text-center text-xl font-bold mb-4">Supprimer un utilisateur</h2>

      <form method="POST" action="delete.php" class="space-y-6">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <div>
          <label for="name" class="block text-sm font-medium mb-2">Prénom</label>
          <input type="text" name="name" id="name" value="<?php echo $user['name']; ?>" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md bg-gray-900 text-white">
        </div>
        <div>
          <label for="age" class="block text-sm font-medium mb-2">Âge</label>
          <input type="number" name="age" id="age" value="<?php echo $user['age']; ?>" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md bg-gray-900 text-white">
        </div>
        <div>
          <label for="city" class="block text-sm font-medium mb-2">Ville</label>
          <input type="text" name="city" id="city" value="<?php echo $user['city']; ?>" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md bg-gray-900 text-white">
        </div>
        <div>
          <label for="country" class="block text-sm font-medium mb-2">Pays</label>
          <input type="text" name="country" id="country" value="<?php echo $user['country']; ?>" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md bg-gray-900 text-white">
        </div>
        <div>
          <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
            Supprimer
          </button>
        </div>
      </form>
    </div>
  </div>
  <footer class="text-white font-bold p-4 text-center fixed bottom-0 w-full">
    <p class="text-white">CRUD PHP - Créer par M4NDO</p>
  </footer>
</body>

</html>