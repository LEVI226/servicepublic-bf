@props(['procedure'])

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm" style="border-left: 4px solid var(--bf-green) !important;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center mb-1">
                    <x-heroicon-o-banknotes class="w-5 h-5 text-muted me-2 inline-block align-text-bottom" />
                    <span class="text-muted small fw-bold text-uppercase">Coût</span>
                </div>
                <div class="fw-bold fs-5 text-dark">
                    {{ $procedure->cost ?: 'Gratuit' }}
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm" style="border-left: 4px solid #FCD116 !important;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center mb-1">
                    <x-heroicon-o-clock class="w-5 h-5 text-muted me-2 inline-block align-text-bottom" />
                    <span class="text-muted small fw-bold text-uppercase">Délai</span>
                </div>
                <div class="fw-bold fs-5 text-dark">
                    {{ $procedure->delay ?: 'Variable' }}
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm" style="border-left: 4px solid #0D6EFD !important;">
            <div class="card-body p-3">
                <div class="d-flex align-items-center mb-1">
                    <x-heroicon-o-user-plus class="w-5 h-5 text-muted me-2 inline-block align-text-bottom" />
                    <span class="text-muted small fw-bold text-uppercase">Public</span>
                </div>
                <div class="fw-bold fs-5 text-dark text-truncate" title="{{ $procedure->public_target ?? 'Tout public' }}">
                    {{ $procedure->public_target ?? 'Tout public' }}
                </div>
            </div>
        </div>
    </div>
</div>
