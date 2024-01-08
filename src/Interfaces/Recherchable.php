<?php

// Utilisation de l'espace de noms pour structurer le code.
// Ici, la classe Recherchable est placée dans le namespace App\Interfaces.
namespace App\Interfaces;

// Définition de l'interface Recherchable.
// Une interface est un contrat qui spécifie quelles méthodes une classe doit implémenter.
interface Recherchable {
    // Déclaration d'une méthode 'rechercher'.
    // Toute classe qui implémente cette interface devra fournir une implémentation concrète de cette méthode.
    public function rechercher($motCle);
}
