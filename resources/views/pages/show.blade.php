@extends('layouts.app')

@section('title', $page->title . ' — Service Public BF')
@section('meta_description', $page->meta_description ?? Str::limit(strip_tags($page->content), 160))

@section('content')
    <x-ui.hero-banner
        :title="$page->title"
        subtitle="Informations officielles"
        :showBreadcrumb="false"
    />

    <x-ui.breadcrumb :items="[$page->title => '']" />

    <div class="container section-padding">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card-premium border-0 shadow-sm p-4 p-md-5">
                    <h1 class="h2 fw-bold mb-4" style="font-family: var(--font-heading);">
                        <i class="bi bi-info-circle text-bf-green me-2"></i>{{ $page->title }}
                    </h1>
                    <div class="page-content text-muted lead" style="font-size: 1.15rem; line-height: 1.8;">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.tricolor-line {
    width: 60px;
    height: 4px;
    background: linear-gradient(to right, #ce1126 33.33%, #fcd116 33.33%, #fcd116 66.66%, #009e49 66.66%);
    border-radius: 2px;
}
.rtf-content h2 { margin-top: 2rem; font-weight: 700; color: var(--bs-dark); }
.rtf-content p { line-height: 1.8; color: #4b5563; }
.rtf-content ul { padding-left: 1.25rem; }
.rtf-content li { margin-bottom: 0.5rem; color: #4b5563; }
</style>
@endsection
