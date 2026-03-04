<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Paramètres du site';
    protected static ?string $navigationGroup = 'Outils & Médias';
    protected static ?int $navigationSort = 90;
    protected static ?string $title = 'Paramètres du site';
    protected static string $view = 'filament.pages.site-settings';

    public string $stat_regions_value = '17';
    public string $stat_regions_suffix = '';
    public string $stat_procedures_value = '1000';
    public string $stat_procedures_suffix = '+';
    public string $stat_eservices_value = '100';
    public string $stat_eservices_suffix = '+';
    public string $stat_provinces_value = '47';
    public string $stat_provinces_suffix = '';

    public function mount(): void
    {
        $settings = SiteSetting::where('group', 'stats')->get()->keyBy('key');
        foreach (['stat_regions', 'stat_procedures', 'stat_eservices', 'stat_provinces'] as $key) {
            if (isset($settings[$key])) {
                $this->{$key . '_value'} = $settings[$key]->value;
                $this->{$key . '_suffix'} = $settings[$key]->suffix ?? '';
            }
        }
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Statistiques de la barre d\'accueil')
                ->description('Ces chiffres s\'affichent sur la barre de statistiques visible en page d\'accueil.')
                ->icon('heroicon-o-chart-bar')
                ->columns(4)
                ->schema([
                    TextInput::make('stat_regions_value')->label('Régions — Valeur')->required()->maxLength(10),
                    TextInput::make('stat_regions_suffix')->label('Suffixe (ex: +)')->maxLength(5)->placeholder('vide = aucun'),
                    TextInput::make('stat_procedures_value')->label('Fiches Pratiques — Valeur')->required()->maxLength(10),
                    TextInput::make('stat_procedures_suffix')->label('Suffixe')->maxLength(5),
                    TextInput::make('stat_eservices_value')->label('E-Services — Valeur')->required()->maxLength(10),
                    TextInput::make('stat_eservices_suffix')->label('Suffixe')->maxLength(5),
                    TextInput::make('stat_provinces_value')->label('Provinces — Valeur')->required()->maxLength(10),
                    TextInput::make('stat_provinces_suffix')->label('Suffixe')->maxLength(5),
                ]),
        ]);
    }

    public function save(): void
    {
        $stats = [
            'stat_regions' => ['label' => 'Régions', 'order' => 1],
            'stat_procedures' => ['label' => 'Fiches Pratiques', 'order' => 2],
            'stat_eservices' => ['label' => 'E-Services', 'order' => 3],
            'stat_provinces' => ['label' => 'Provinces', 'order' => 4],
        ];

        foreach ($stats as $key => $meta) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                [
                    'label' => $meta['label'],
                    'value' => $this->{$key . '_value'},
                    'suffix' => $this->{$key . '_suffix'} ?: null,
                    'group' => 'stats',
                    'order' => $meta['order'],
                ]
            );
        }

        SiteSetting::clearStatsCache();

        Notification::make()->title('Paramètres enregistrés avec succès')->success()->send();
    }
}
