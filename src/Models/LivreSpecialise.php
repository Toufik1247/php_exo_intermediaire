<?php

// Utilisation de l'espace de noms App\Models, ce qui permet de regrouper logiquement cette classe avec d'autres modèles.
namespace App\Models;

// Déclaration de la classe LivreSpecialise qui étend (hérite de) la classe Livre.
class LivreSpecialise extends Livre {
    // Propriété privée 'domaine' de la classe LivreSpecialise.
    // L'accès à cette propriété est limité à cette classe.
    private $domaine;

    // Constructeur de la classe LivreSpecialise.
    // Il est appelé lors de la création d'un nouvel objet LivreSpecialise.
    public function __construct($titre, $auteur, $anneePublication, $domaine) {
        // Appel au constructeur de la classe parente (Livre) pour initialiser les propriétés héritées.
        parent::__construct($titre, $auteur, $anneePublication);
        // Affectation de la valeur fournie à la propriété 'domaine' de cet objet.
        $this->domaine = $domaine;
    }

    // Méthode pour obtenir le domaine du livre spécialisé.
    public function getDomaine() {
        // Retourne la valeur de la propriété 'domaine'.
        return $this->domaine;
    }

    // Méthode pour afficher les informations du livre spécialisé.
    public function afficherInfos() {
        // Appel de la méthode 'afficherInfos' du parent pour afficher les informations de base du livre.
        parent::afficherInfos();
        // Affiche le domaine spécifique du livre spécialisé.
        echo "Domaine: " . $this->domaine . "\n";
    }
}
