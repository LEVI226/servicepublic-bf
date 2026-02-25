@extends('layouts.app')
@section('title', 'Foire Aux Questions (FAQ)')

@section('content')
    <x-ui.hero-banner 
        title="Foire Aux Questions (FAQ)" 
        subtitle="Trouvez rapidement les réponses à vos questions les plus fréquentes." 
    />

    <div class="container section-padding pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if($faqs->isEmpty())
                    <div class="alert alert-light border text-center p-5 rounded-4">
                        <i class="fas fa-question-circle text-muted fs-1 mb-3 d-block"></i>
                        <h3 class="h4 fw-bold text-dark mb-2" style="font-family: var(--font-heading);">Aucune question pour le moment</h3>
                        <p class="text-muted mb-0">La base de connaissances est en cours de création.</p>
                    </div>
                @else
                    <div class="accordion accordion-flush" id="faqAccordion">
                        @foreach($faqs as $index => $faq)
                            <div class="accordion-item border rounded-3 mb-3 overflow-hidden shadow-sm">
                                <h2 class="accordion-header" id="heading-{{ $faq->id }}">
                                    <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }} bg-white fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $faq->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse-{{ $faq->id }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="collapse-{{ $faq->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading-{{ $faq->id }}" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body text-muted bg-soft border-top">
                                        {{ $faq->answer }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                
                <div class="mt-5 text-center p-4 bg-soft rounded-4 border border-light">
                    <i class="fas fa-headset text-bf-green fs-2 mb-3 d-block"></i>
                    <h3 class="h4 fw-bold text-dark mb-2" style="font-family: var(--font-heading);">Vous n'avez pas trouvé votre réponse ?</h3>
                    <p class="text-muted mb-4">Notre équipe d'assistance est là pour vous aider.</p>
                    <a href="{{ route('contact') }}" class="btn-sp btn-sp-primary">Contactez-nous</a>
                </div>
            </div>
        </div>
    </div>
@endsection
