<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Read - Mon CRUD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-gray-100">
    <div class="container mx-auto my-10">
        <h1 class="text-3xl font-bold text-center mb-10">Liste des stagiaires</h1>

        <div class="flex justify-center mb-4">
            <a href="create.php" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Ajouter un stagiaire</a>
        </div>

        <table class="w-full table-auto">

            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Prénom</th>
                    <th class="px-4 py-2">Age</th>
                    <th class="px-4 py-2">Ville</th>
                    <th class="px-4 py-2">Pays</th>
                    <th class="px-4 py-2">Actions</th> <!-- nouvelle colonne -->
                </tr>
            </thead>
            <tbody>
                <?php
                include 'config.php';
                $users = $conn->query('SELECT * FROM users')->fetchAll();

                foreach ($users as $user) {
                    echo '<tr>';
                    echo '<td class="border px-4 py-2">' . $user['id'] . '</td>';
                    echo '<td class="border px-4 py-2">' . $user['prenom'] . '</td>';
                    echo '<td class="border px-4 py-2">' . $user['age'] . '</td>';
                    echo '<td class="border px-4 py-2">' . $user['ville'] . '</td>';
                    echo '<td class="border px-4 py-2">' . $user['pays'] . '</td>';
                    echo '<td class="border px-4 py-2">';
                    echo '<div class="flex justify-center">';
                    echo '<a href="update.php?id=' . $user['id'] . '" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">Modifier</a>';
                    echo '<form action="delete.php" method="post">';
                    echo '<input type="hidden" name="id" value="' . $user['id'] . '">';
                    echo '<button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Supprimer</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>

            </tbody>
        </table>
    </div>
    <footer class="text-white font-bold p-4 text-center fixed bottom-0 w-full">
        <p class="text-white">CRUD PHP - Créer par M4NDO</p>
    </footer>
</body>

</html>