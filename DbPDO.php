<?php

class DbPDO
{
    private static string $server = 'localhost';
    private static string $username = 'root';
    private static string $password = '';
    private static string $database = 'test';
    private static ?PDO $db = null;

    public static function connect(): ?PDO {
        if (self::$db == null){
            try {
                self::$db = new PDO("mysql:host=".self::$server.";dbname=".self::$database, self::$username, self::$password);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$db->beginTransaction();

//   EXERCISE 1             $server = self::$db->prepare("SELECT * from user WHERE nom NOT IN('Doe')");
//    EXERCISE 2            $server = self::$db->prepare("SELECT * from user WHERE prenom NOT IN('John')");

//
//     ETAPE 3           $server = self::$db->prepare("SELECT * from user WHERE id <= 2");
//      ETAPE 4          $server = self::$db->prepare("SELECT * from user WHERE id >= 2");

//       ETAPE 5         $server = self::$db->prepare("SELECT * from user WHERE id = 1");
//   ETAPE 6    $server = self::$db->prepare("SELECT * from user WHERE id > 1 AND nom = 'Doe'");
//    ETAPE 7   $server = self::$db->prepare("SELECT * from user WHERE nom = 'Doe' AND prenom = 'John' ");
//   ETAPE8    $server = self::$db->prepare("SELECT * from user WHERE nom = 'Conor' || prenom = 'Jane' ");
//      ETAPE 9        $server = self::$db->prepare("SELECT * from user ORDER BY id LIMIT 2");
//     ETAPE 10         $server = self::$db->prepare("SELECT * from user ORDER BY id ASC LIMIT 1");
//      ETAPE  11        $server = self::$db->prepare("SELECT * from user WHERE nom LIKE 'C___r'");
//     ETAPE     12      $server = self::$db->prepare("SELECT * from user WHERE nom LIKE '%e%'");
//     ETAPE  13    $server = self::$db->prepare("SELECT * from user WHERE prenom IN('John', 'Sarah')");
           $server = self::$db->prepare("SELECT * from user WHERE id BETWEEN 2 AND 4");
                $test = $server->execute();


                if ($test){
                    echo '<div class="test">';
                    foreach ($server->fetchAll() as $user){
                        echo '<p style="margin: 0;">Utilisateur Id: ' . $user["id"]  .$user["nom"] . " " . $user['prenom'] . " " . $user['mail'] . "</p>";
                    }
//                    foreach ($server->fetchAll() as $user){
//                        echo '<p style="margin: 0;">Utilisateur: ' . $user["nom"] . " " . $user['prenom'] . "</p>";
//                    }
                    echo '</div>';
                }
                else{
                    echo "Une erreur s'est produite..";
                }
            }
            catch (PDOException $e) {
                echo "Erreur de la connexion à la dn : " . $e->getMessage();
                self::$db->rollBack(); // On restaure les anciens données en cas d'erreur
            }
        }
        return self::$db;
    }
}

?>


<div class="user-info">
    <?php if (isset($_GET["rules"]) && $_GET["rules"] == 1): ?>

    <?php else: ?>
    <?php endif; ?>
</div>
