<?php

namespace App\Services;

use App\Services\Importers\CategoryImporter;
use App\Services\Importers\ProcedureImporter;
use App\Services\Importers\EserviceImporter;
use App\Services\Importers\OrganismeImporter;
use App\Services\Importers\LifeEventImporter;
use App\Services\Importers\ImporterInterface;

class DataImportService
{
    protected array $importers = [
        CategoryImporter::class,
        ProcedureImporter::class,
        EserviceImporter::class,
        OrganismeImporter::class,
        LifeEventImporter::class,
    ];

    /**
     * Détecte automatiquement le type de données.
     */
    public function detect(array $data): ?string
    {
        foreach ($this->importers as $importerClass) {
            if ($importerClass::detect($data)) {
                return $importerClass;
            }
        }
        return null;
    }

    /**
     * Retourne la liste des importers disponibles.
     */
    public function availableImporters(): array
    {
        $result = [];
        foreach ($this->importers as $class) {
            $result[$class] = $class::label();
        }
        return $result;
    }

    /**
     * Analyse les données avec l'importer spécifié.
     */
    public function analyze(string $importerClass, array $data): array
    {
        $importer = new $importerClass();
        return $importer->analyze($data);
    }

    /**
     * Lance l'import.
     */
    public function import(string $importerClass, array $data): array
    {
        $importer = new $importerClass();
        return $importer->import($data);
    }
}
