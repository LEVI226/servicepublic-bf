<?php

namespace App\Services\Importers;

interface ImporterInterface
{
    /**
     * Détecte si ce JSON correspond à ce type d'import.
     */
    public static function detect(array $data): bool;

    /**
     * Retourne le nom humain du type d'import.
     */
    public static function label(): string;

    /**
     * Valide les données et retourne les stats.
     */
    public function analyze(array $data): array;

    /**
     * Exécute l'import et retourne le rapport.
     */
    public function import(array $data): array;
}
