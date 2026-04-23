<x-filament-panels::page>

    {{-- ÉTAPE 1 : Upload --}}
    @if($step === 'upload')
        <div class="space-y-6">
            <x-filament::section>
                <x-slot name="heading">1. Sélectionner un fichier JSON</x-slot>
                <x-slot name="description">
                    Uploadez un fichier JSON nettoyé (catégories, procédures, e-services, organismes ou événements de vie).
                    Le type sera détecté automatiquement.
                </x-slot>

                {{ $this->form }}

                <div class="mt-4">
                    <x-filament::button wire:click="analyzeFile" icon="heroicon-o-magnifying-glass">
                        Analyser le fichier
                    </x-filament::button>
                </div>
            </x-filament::section>

            {{-- Guide des formats --}}
            <x-filament::section collapsible collapsed>
                <x-slot name="heading">Formats JSON acceptés</x-slot>
                <div class="prose dark:prose-invert max-w-none text-sm">
                    <p><strong>Catégories</strong> : <code>[{"name": "...", "slug": "...", "procedures_count": 10}]</code></p>
                    <p><strong>Procédures</strong> : <code>[{"title": "...", "slug": "...", "description": "...", "cost": "...", "category": "..."}]</code></p>
                    <p><strong>E-services</strong> : <code>[{"title": "...", "url": "https://...", "description": "..."}]</code></p>
                    <p><strong>Organismes</strong> : <code>[{"name": "...", "phone": "...", "email": "..."}]</code></p>
                    <p><strong>Événements de vie</strong> : <code>[{"title": "...", "slug": "...", "icon": "..."}]</code></p>
                </div>
            </x-filament::section>
        </div>
    @endif

    {{-- ÉTAPE 2 : Aperçu et validation --}}
    @if($step === 'preview' && $analysis)
        <div class="space-y-6">
            {{-- Stats --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <x-filament::section>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-primary-600">{{ $analysis['total'] ?? 0 }}</div>
                        <div class="text-sm text-gray-500">Total</div>
                    </div>
                </x-filament::section>
                <x-filament::section>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-success-600">{{ $analysis['new'] ?? 0 }}</div>
                        <div class="text-sm text-gray-500">Nouveaux</div>
                    </div>
                </x-filament::section>
                <x-filament::section>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-warning-600">{{ $analysis['update'] ?? 0 }}</div>
                        <div class="text-sm text-gray-500">Mises à jour</div>
                    </div>
                </x-filament::section>
                <x-filament::section>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-danger-600">{{ $analysis['empty_fields'] ?? $analysis['invalid_urls'] ?? $analysis['no_category'] ?? 0 }}</div>
                        <div class="text-sm text-gray-500">Problèmes</div>
                    </div>
                </x-filament::section>
            </div>

            {{-- Type détecté + override --}}
            <x-filament::section>
                <x-slot name="heading">2. Type détecté</x-slot>
                {{ $this->form }}
                <div class="mt-2">
                    <x-filament::button wire:click="reAnalyze" size="sm" color="gray" icon="heroicon-o-arrow-path">
                        Re-analyser
                    </x-filament::button>
                </div>
            </x-filament::section>

            {{-- Aperçu des données --}}
            <x-filament::section>
                <x-slot name="heading">3. Aperçu (10 premiers enregistrements)</x-slot>

                @if(!empty($analysis['preview']))
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    @foreach($analysis['columns'] ?? array_keys($analysis['preview'][0] ?? []) as $col)
                                        <th class="px-4 py-2 text-left font-medium text-gray-700 dark:text-gray-300">{{ $col }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($analysis['preview'] as $row)
                                    <tr>
                                        @foreach($analysis['columns'] ?? array_keys($row) as $col)
                                            <td class="px-4 py-2 text-gray-600 dark:text-gray-400">
                                                {{ \Illuminate\Support\Str::limit($row[$col] ?? '-', 60) }}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </x-filament::section>

            {{-- Boutons d'action --}}
            <div class="flex gap-3">
                <x-filament::button wire:click="executeImport" icon="heroicon-o-arrow-down-tray" color="success" size="lg">
                    Lancer l'import ({{ $analysis['total'] ?? 0 }} enregistrements)
                </x-filament::button>
                <x-filament::button wire:click="resetImport" color="gray" icon="heroicon-o-arrow-uturn-left">
                    Annuler
                </x-filament::button>
            </div>
        </div>
    @endif

    {{-- ÉTAPE 3 : Résultat --}}
    @if($step === 'result' && $importReport)
        <div class="space-y-6">
            <x-filament::section>
                <x-slot name="heading">Rapport d'import</x-slot>

                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="rounded-lg bg-success-50 dark:bg-success-900/20 p-4 text-center">
                        <div class="text-3xl font-bold text-success-600">{{ $importReport['created'] ?? 0 }}</div>
                        <div class="text-sm text-success-700 dark:text-success-400">Créés</div>
                    </div>
                    <div class="rounded-lg bg-warning-50 dark:bg-warning-900/20 p-4 text-center">
                        <div class="text-3xl font-bold text-warning-600">{{ $importReport['updated'] ?? 0 }}</div>
                        <div class="text-sm text-warning-700 dark:text-warning-400">Mis à jour</div>
                    </div>
                    <div class="rounded-lg bg-danger-50 dark:bg-danger-900/20 p-4 text-center">
                        <div class="text-3xl font-bold text-danger-600">{{ count($importReport['errors'] ?? []) }}</div>
                        <div class="text-sm text-danger-700 dark:text-danger-400">Erreurs</div>
                    </div>
                </div>

                @if(!empty($importReport['errors']))
                    <div class="mt-4 p-4 rounded-lg bg-danger-50 dark:bg-danger-900/20">
                        <h4 class="font-medium text-danger-700 dark:text-danger-400 mb-2">Erreurs détaillées :</h4>
                        <ul class="list-disc list-inside text-sm text-danger-600 space-y-1">
                            @foreach(array_slice($importReport['errors'], 0, 20) as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            @if(count($importReport['errors']) > 20)
                                <li>... et {{ count($importReport['errors']) - 20 }} autres erreurs</li>
                            @endif
                        </ul>
                    </div>
                @endif
            </x-filament::section>

            <x-filament::button wire:click="resetImport" icon="heroicon-o-plus" color="primary">
                Nouvel import
            </x-filament::button>
        </div>
    @endif

</x-filament-panels::page>
