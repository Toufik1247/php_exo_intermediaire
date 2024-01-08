<?php

// Déclaration de l'espace de noms pour la classe Livre.
namespace App\Models;

// Importation de la classe LivreException pour pouvoir l'utiliser dans la classe Livre.
use App\Exceptions\LivreException;

// Définition de la classe Livre.
class Livre {
    // Propriétés protégées de la classe Livre : titre, auteur et année de publication.
    // Elles sont accessibles dans cette classe et les classes qui en héritent.
    protected $titre;
    protected $auteur;
    protected $anneePublication;

    // Constructeur de la classe Livre.
    // Il est appelé lors de la création d'un nouvel objet Livre.
    public function __construct($titre, $auteur, $anneePublication) {
        // Vérification des données fournies : le titre et l'auteur ne doivent pas être vides,
        // et l'année de publication doit être un entier.
        if (empty($titre) || empty($auteur) || !is_int($anneePublication)) {
            // Si les données ne sont pas valides, une exception est lancée.
            throw new LivreException("Informations invalides pour la création du livre.");
        }

        // Attribution des valeurs aux propriétés de l'objet.
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->anneePublication = $anneePublication;
    }

    // Méthode pour obtenir le titre du livre.
    public function getTitre() {
        return $this->titre;
    }

    // Méthode pour obtenir l'auteur du livre.
    public function getAuteur() {
        return $this->auteur;
    }

    // Méthode pour obtenir l'année de publication du livre.
    public function getAnneePublication() {
        return $this->anneePublication;
    }

    // Méthode pour afficher les informations du livre.
    public function afficherInfos() {
        // Affiche le titre, l'auteur et l'année de publication du livre.
        echo "Titre: " . $this->titre . ", Auteur: " . $this->auteur . ", Année de publication: " . $this->anneePublication . "\n";
    }
}
