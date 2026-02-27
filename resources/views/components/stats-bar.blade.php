<div class="stats-bar bg-white border-bottom border-top py-4 shadow-sm" style="position: relative; z-index: 10;">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-6 col-md-3 border-end-md">
                <div class="text-bf-green display-6 fw-bold mb-1">{{ $stats['regions'] ?? 13 }}</div>
                <div class="text-muted small fw-semibold text-uppercase">Régions</div>
            </div>
            <div class="col-6 col-md-3 border-end-md">
                <div class="text-bf-green display-6 fw-bold mb-1">{{ $stats['procedures'] ?? '600' }}+</div>
                <div class="text-muted small fw-semibold text-uppercase">Fiches Pratiques</div>
            </div>
            <div class="col-6 col-md-3 border-end-md">
                <div class="text-bf-green display-6 fw-bold mb-1">{{ $stats['eservices'] ?? '117' }}</div>
                <div class="text-muted small fw-semibold text-uppercase">E-Services</div>
            </div>
            <div class="col-6 col-md-3">
                <div class="text-bf-green display-6 fw-bold mb-1">{{ $stats['provinces'] ?? 45 }}</div>
                <div class="text-muted small fw-semibold text-uppercase">Provinces</div>
            </div>
        </div>
    </div>
</div>
<style>
    @media (min-width: 768px) {
        .border-end-md {
            border-right: 1px solid rgba(0,0,0,0.05);
        }
    }
</style>
