<?php

// Déclaration de l'espace de noms pour la classe LivreException.
// Cela permet d'organiser le code et évite les conflits de noms avec d'autres classes.
namespace App\Exceptions;

// Importation de la classe de base Exception du langage PHP.
use Exception;

// Définition de la classe LivreException qui étend la classe Exception standard de PHP.
// Cette classe sera utilisée pour gérer des situations exceptionnelles spécifiques aux opérations sur les livres.
class LivreException extends Exception {
    // Pas de méthodes ou propriétés supplémentaires sont définies ici.
    // LivreException hérite toutes les fonctionnalités de la classe Exception,
    // mais peut être étendue pour inclure des fonctionnalités spécifiques liées aux livres si nécessaire.
}
