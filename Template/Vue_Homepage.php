<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'acceuille</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital@1&display=swap');

        * {
            padding: 0;
            margin: 0;
            font-family: 'Be Vietnam Pro', sans-serif;
            background-color: #f0f2f5;
            box-sizing: border-box;
        }

        h1,
        h2 {
            text-align: center;
        }

        th,
        td {
            padding: 10px;
        }

        table {
            margin: 20px auto;
        }

        .main {
            margin: 25px auto;
            padding: 10px;
        }

        .overflow {
            overflow-y: scroll;
            height: 500px;
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="main">

        <?= isset($_SESSION['email_connexion']) ? "<h1> Bienvenue et Bon retour parmi nous mon chèr(e) " .  $_SESSION['email_connexion'] . "</h1>" : "" ?>


        <h2>Voici la liste des inscrits</h2>
        <div class="overflow">
            <?php if ($tabEmailPhone) : ?>
                <table border="1">
                    <th>Nom</th>
                    <th>Prenom</th>




                    <?php foreach ($tabEmailPhone as $client) : ?>
                        <tr>
                            <td><?= $client['nom'] ?></td>
                            <td><?= $client['prenom'] ?></td>



                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </table>
        </div>
    </div>
</body>

</html>