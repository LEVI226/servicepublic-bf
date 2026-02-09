@extends('layouts.app')

@section('title', 'Mes Notifications')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
    <li class="breadcrumb-item active" aria-current="page">Notifications</li>
@endsection

@section('content')
<section class="section pt-5">
    <div class="container">
         <h2 class="h3 fw-bold mb-4">Vos Notifications</h2>

         <div class="card shadow-sm border-0">
            <div class="list-group list-group-flush">
                @forelse($notifications as $notif)
                <div class="list-group-item list-group-item-action p-4 {{ !$notif->lu ? 'bg-light' : '' }}">
                    <div class="d-flex w-100 justify-content-between mb-1">
                        <h5 class="mb-1 {{ !$notif->lu ? 'fw-bold text-primary' : '' }}">
                            @if($notif->type == 'success') <i class="bi bi-check-circle-fill text-success me-2"></i>
                            @elseif($notif->type == 'danger') <i class="bi bi-x-circle-fill text-danger me-2"></i>
                            @elseif($notif->type == 'warning') <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                            @else <i class="bi bi-info-circle-fill text-info me-2"></i>
                            @endif
                            {{ $notif->titre }}
                        </h5>
                        <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-1">{{ $notif->message }}</p>
                    @if($notif->lien)
                        <a href="{{ $notif->lien }}" class="btn btn-sm btn-link ps-0 text-decoration-none">Voir les détails <i class="bi bi-arrow-right"></i></a>
                    @endif
                </div>
                @empty
                <div class="text-center py-5">
                    <i class="bi bi-bell-slash fs-1 text-muted mb-3 d-block"></i>
                    <p class="text-muted">Vous n'avez aucune notification.</p>
                </div>
                @endforelse
            </div>
            @if($notifications->hasPages())
            <div class="card-footer bg-white border-top-0 py-3">
                {{ $notifications->links() }}
            </div>
            @endif
         </div>
    </div>
</section>
@endsection
