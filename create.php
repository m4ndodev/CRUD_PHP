<?php
// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Inclure le fichier de configuration de la base de données
    require_once "config.php";

    // Définir les variables de connexion à partir de celles définies dans config.php
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

    try {
        $pdo = new PDO($dsn, $user, $password);

        // Activer les exceptions PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
        exit();
    }

    // Définir les variables à partir des données du formulaire
    $prenom = $_POST["prenom"];
    $age = $_POST["age"];
    $ville = $_POST["ville"];
    $pays = $_POST["pays"];

    // Valider les données du formulaire
    $errors = array();
    if (empty($prenom)) {
        $errors[] = "Le prénom est obligatoire.";
    }
    if (empty($age) || !is_numeric($age)) {
        $errors[] = "L'âge doit être un nombre entier.";
    }
    if (empty($ville)) {
        $errors[] = "La ville est obligatoire.";
    }
    if (empty($pays)) {
        $errors[] = "Le pays est obligatoire.";
    }

    // Si aucune erreur n'a été trouvée
    if (empty($errors)) {
        // Préparer l'instruction SQL
        $sql = "INSERT INTO users (prenom, age, ville, pays) VALUES (?, ?, ?, ?)";

        try {
            $stmt = $pdo->prepare($sql);
            // Lier les variables à l'instruction préparée en tant que paramètres
            $stmt->bindParam(1, $prenom);
            $stmt->bindParam(2, $age);
            $stmt->bindParam(3, $ville);
            $stmt->bindParam(4, $pays);

            // Exécuter l'instruction préparée
            if ($stmt->execute()) {
                // Rediriger vers la page d'accueil avec un message de confirmation
                header("location: index.php?success=1");
                exit();
            } else {
                echo "Erreur. Veuillez réessayer ultérieurement.";
            }

            // Fermer l'instruction
            $stmt->close();
        } catch (PDOException $e) {
            echo "Erreur d'exécution de la requête : " . $e->getMessage();
            exit();
        }
    }

    // Fermer la connexion
    $pdo = null;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mon CRUD avec Tailwind CSS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900">
    <div class="flex justify-center items-center min-h-screen bg-gray-900">
        <div class="bg-gray-800 rounded-lg shadow-lg p-8 w-full sm:w-3/4 md:w-1/2 lg:w-1/3">
            <h2 class="text-2xl font-bold mb-4 text-white text-center">Ajouter un stagiaire</h2>

            <?php
            // Afficher les messages d'erreur
            if (!empty($errors)) {
                echo '<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">';
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
                echo '</div>';
            }
            ?>

            <form action="create.php" method="post">
                <div class="mb-4">
                    <label class="block text-gray-200 font-bold mb-2" for="prenom">Prénom</label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-200 bg-gray-700 leading-tight focus:outline-none focus:bg-gray-600 focus:border-gray-500" id="prenom" name="prenom" type="text" placeholder="Entrez votre prénom">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-200 font-bold mb-2" for="age">Age</label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-200 bg-gray-700 leading-tight focus:outline-none focus:bg-gray-600 focus:border-gray-500" id="age" name="age" type="text" placeholder="Entrez votre âge">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-200 font-bold mb-2" for="ville">Ville</label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-200 bg-gray-700 leading-tight focus:outline-none focus:bg-gray-600 focus:border-gray-500" id="ville" name="ville" type="text" placeholder="Entrez votre ville">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-200 font-bold mb-2" for="pays">Pays</label>
                    <input class="appearance-none border rounded w-full py-2 px-3 text-gray-200 bg-gray-700 leading-tight focus:outline-none focus:bg-gray-600 focus:border-gray-500" id="pays" name="pays" type="text" placeholder="Entrez votre pays">
                </div>
                <div class="flex justify-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Ajouter
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