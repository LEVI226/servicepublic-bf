/**
 * Tooltips pour la barre latérale admin — Service Public BF
 * Ajoute une bulle d'aide au survol de chaque élément de navigation
 */
document.addEventListener('DOMContentLoaded', function () {
    // Descriptions des éléments de navigation (correspondance par texte du lien)
    const tooltips = {
        // Groupes
        'Contenu éditorial': 'Gérez tout le contenu visible sur le site : fiches, actualités, FAQ…',
        'Événements de vie': 'Parcours guidés type « Comment faire si je me marie ? »',
        'Administration': 'Gestion de l\'annuaire des services publics du Burkina Faso',
        'Outils & Médias': 'E-services, documents PDF téléchargeables et import de données',
        'Paramètres': 'Utilisateurs, rôles et configuration du système',
        'Filament Shield': 'Gestion des rôles et permissions d\'accès au panneau admin',

        // Items individuels
        'Tableau de bord': 'Vue d\'ensemble : statistiques du site en temps réel',
        'Rôles': 'Définir qui peut voir, créer ou modifier chaque section',
        'Thématiques': 'Les 16 grands domaines (Commerce, Santé, Justice…) — visibles dans le menu « Thématiques » du site',
        'Sous-thématiques': 'Subdivisions des thématiques (ex : Commerce → Import/Export, Création d\'entreprise)',
        'Fiches pratiques': 'Les démarches administratives : passeport, CNIB, acte de naissance… (1 fiche = 1 démarche)',
        'Actualités': 'Articles d\'information publiés sur la page « Actualités » du site',
        'FAQ': 'Questions fréquemment posées par les citoyens, affichées sur la page FAQ',
        'Pages statiques': 'Pages libres : Mentions légales, À propos, Accessibilité…',
        'Comment faire si ?': 'Les 12 situations de vie (mariage, entreprise, passeport…) avec les fiches associées',
        'Annuaire (Organismes)': 'Les 182 services publics avec adresse, téléphone et email',
        'E-Services': 'Liens vers les plateformes en ligne officielles (e-CNIB, e-SITAX…)',
        'Documents & Formulaires': 'Fichiers PDF téléchargeables rattachés aux fiches pratiques',
        'Import de données': 'Importer des fiches en masse via fichier CSV ou JSON',
        'Utilisateurs': 'Gérer les comptes admin et éditeur (créer, modifier, supprimer)',
        'Régions': 'Les 13 régions administratives du Burkina Faso',
    };

    function applyTooltips() {
        // Sélectionner tous les liens et boutons de navigation dans la sidebar
        const navItems = document.querySelectorAll(
            '.fi-sidebar-nav a, .fi-sidebar-nav button, ' +
            '[class*="sidebar"] a, [class*="sidebar"] button, ' +
            '.fi-sidebar a, .fi-sidebar button'
        );

        navItems.forEach(function (el) {
            const text = el.textContent.trim().replace(/\s+/g, ' ');

            // Chercher une correspondance exacte ou partielle
            for (const [label, description] of Object.entries(tooltips)) {
                if (text === label || text.startsWith(label) || text.includes(label)) {
                    el.setAttribute('title', label + ' — ' + description);
                    el.style.cursor = 'help';
                    break;
                }
            }
        });

        // Aussi appliquer aux groupes de navigation
        const groupLabels = document.querySelectorAll(
            '.fi-sidebar-group-label, [class*="group"] button span, ' +
            '.fi-sidebar-group button'
        );

        groupLabels.forEach(function (el) {
            const text = el.textContent.trim();
            if (tooltips[text]) {
                const parent = el.closest('button') || el.closest('a') || el;
                parent.setAttribute('title', text + ' — ' + tooltips[text]);
            }
        });
    }

    // Appliquer au chargement et après les updates Livewire
    applyTooltips();

    // Réappliquer après chaque navigation Livewire (SPA-like)
    if (typeof Livewire !== 'undefined') {
        document.addEventListener('livewire:navigated', applyTooltips);
    }

    // Observer les changements DOM (pour les menus qui se déplient)
    const observer = new MutationObserver(function () {
        setTimeout(applyTooltips, 100);
    });

    const sidebar = document.querySelector('.fi-sidebar, [class*="sidebar"]');
    if (sidebar) {
        observer.observe(sidebar, { childList: true, subtree: true });
    }
});
