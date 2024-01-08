<?php

// Inclut le fichier d'autoload généré par Composer, permettant de charger automatiquement les classes.
require_once __DIR__ . '/../vendor/autoload.php';

// Utilise les espaces de noms pour les différentes classes nécessaires.
use App\Models\Livre;
use App\Models\LivreSpecialise;
use App\Exceptions\LivreException;
use App\Interfaces\Recherchable;
use App\Helpers\UIHelper;

// Définition de la classe Bibliotheque qui implémente l'interface Recherchable.
class Bibliotheque implements Recherchable {
    private $livres; // Propriété pour stocker une collection de livres.

    // Constructeur de la classe Bibliotheque.
    public function __construct() {
        $this->livres = []; // Initialise la collection de livres comme un tableau vide.
    }

    // Méthode pour ajouter un livre à la bibliothèque.
    public function ajouterLivre(Livre $livre) {
        $this->livres[] = $livre; // Ajoute le livre passé en argument au tableau de livres.
    }

    // Méthode pour rechercher des livres dans la bibliothèque. 
    //(L'implémentation de cette méthode est imposée par l'interface Recherchable)
    public function rechercher($motCle) {
        // Utilise array_filter pour parcourir la collection de livres.
        return array_filter($this->livres, function($livre) use ($motCle) {
            // Si le livre est un LivreSpecialise, compare son domaine au mot-clé.
            if ($livre instanceof LivreSpecialise) {
                return strtolower($livre->getDomaine()) === strtolower($motCle);
            } else {
                // Sinon, effectue une recherche par titre.
                return strpos(strtolower($livre->getTitre()), strtolower($motCle)) !== false;
            }
        });
    }
}

// Création d'une instance de la classe Bibliotheque.
$bibliotheque = new Bibliotheque();


while (true) {
    UIHelper::afficherMenu();
    $choix = readline("Choisissez une option : ");

    switch ($choix) {
        case "1":
            try {
                // Demande des informations du livre à l'utilisateur
                $titre = readline("Entrez le titre : ");
                $auteur = readline("Entrez l'auteur : ");
                $anneePublicationStr = readline("Entrez l'année de publication : ");
                $domaine = readline("Entrez le domaine (ou laissez vide) : ");

                // Validation de l'année de publication
                $anneePublication = filter_var($anneePublicationStr, FILTER_VALIDATE_INT, [
                    "options" => [
                        "min_range" => 1000,
                        "max_range" => 9999
                    ]
                ]);

                // Si l'année de publication n'est pas valide, une exception est levée
                if ($anneePublication === false) {
                    throw new LivreException("L'année de publication doit être un nombre à 4 chiffres.");
                }

                // Création de l'objet Livre ou LivreSpecialise selon que le domaine est fourni ou non
                if (empty($domaine)) {
                    $livre = new Livre($titre, $auteur, $anneePublication);
                } else {
                    $livre = new LivreSpecialise($titre, $auteur, $anneePublication, $domaine);
                }

                // Ajout du livre à la collection
                $livres[] = $livre;
                echo "Livre ajouté avec succès.\n";

            } catch (LivreException $e) {
                // Gestion de l'exception et affichage du message d'erreur
                echo "Erreur lors de l'ajout du livre : " . $e->getMessage() . "\n";
            }
            break;


        case "2":
            echo "\nListe des livres :\n";
            // Parcours et affichage de chaque livre dans la collection
            foreach ($livres as $livre) {
                $livre->afficherInfos();
            }
            break;

        case "3":
            $critere = readline("Entrez le titre à rechercher : ");
            // Filtrage des livres dont le titre correspond au critère
            $resultats = array_filter($livres, function($livre) use ($critere) {
                return strpos(strtolower($livre->getTitre()), strtolower($critere)) !== false;
            });

            echo "\nRésultats de la recherche par titre :\n";
            // Affichage des livres trouvés
            foreach ($resultats as $resultat) {
                $resultat->afficherInfos();
            }
            break;

        case "4":
            $domaineRecherche = readline("Entrez le domaine à rechercher : ");
            // Utilisation de array_filter pour filtrer les livres par le domaine spécifié
            $resultats = array_filter($livres, function ($livre) use ($domaineRecherche) {
                // Vérification si le livre est de type LivreSpecialise et si le domaine correspond
                return $livre instanceof LivreSpecialise && strtolower($livre->getDomaine()) === strtolower($domaineRecherche);
            });

            if (count($resultats) > 0) {
                // Affichage des livres trouvés si le résultat n'est pas vide
                echo "\nRésultats de la recherche pour le domaine '$domaineRecherche' :\n";
                foreach ($resultats as $resultat) {
                    $resultat->afficherInfos();
                }
            } else {
                // Message si aucun livre correspondant n'est trouvé
                echo "\nAucun livre trouvé pour le domaine '$domaineRecherche'.\n";
            }
            break; // Remplacez 'exit' par 'break' pour continuer la boucle
        
        case "5":
            exit("\033[1;32mFin du programme.\n\033[0m");

        default:
            // Message pour une option non valide
            echo "\033[1;31mOption non valide. Veuillez réessayer.\n\033[0m";
            break;

    }
}
