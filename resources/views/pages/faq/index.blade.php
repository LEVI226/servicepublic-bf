@extends('layouts.app')

@section('title', 'Foire Aux Questions')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">FAQ</li>
@endsection

@section('content')
<section class="section pt-5">
    <div class="container">
        <div class="section-title">
            <h2>Foire Aux Questions</h2>
            <p class="subtitle">Des réponses à vos questions les plus fréquentes</p>
            <div class="barre"></div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @foreach($categories as $categorie)
                    <div class="mb-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-bf-vert text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <i class="bi bi-question-lg"></i>
                            </div>
                            <h3 class="h4 mb-0 text-gray-900">{{ $categorie->nom }}</h3>
                        </div>
                        
                        <div class="accordion shadow-sm rounded overflow-hidden border-0" id="faqAccordion{{ $categorie->id }}">
                            @foreach($categorie->faqs as $index => $faq)
                            <div class="accordion-item border-0 border-bottom">
                                <h2 class="accordion-header" id="heading{{ $categorie->id }}-{{ $index }}">
                                    <button class="accordion-button collapsed fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $categorie->id }}-{{ $index }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $categorie->id }}-{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion{{ $categorie->id }}">
                                    <div class="accordion-body bg-light text-muted">
                                        {!! nl2br(e($faq->reponse)) !!}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                @if($faqsGenerales->isNotEmpty())
                    <div class="mb-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-bf-rouge text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <i class="bi bi-chat-text"></i>
                            </div>
                            <h3 class="h4 mb-0 text-gray-900">Questions Générales</h3>
                        </div>

                        <div class="accordion shadow-sm rounded overflow-hidden border-0" id="faqAccordionGeneral">
                            @foreach($faqsGenerales as $index => $faq)
                            <div class="accordion-item border-0 border-bottom">
                                <h2 class="accordion-header" id="headingGeneral{{ $index }}">
                                    <button class="accordion-button collapsed fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGeneral{{ $index }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="collapseGeneral{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#faqAccordionGeneral">
                                    <div class="accordion-body bg-light text-muted">
                                        {!! nl2br(e($faq->reponse)) !!}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
