@php $props = json_decode($block->props, true); @endphp
<section class="py-5 bg-light" style="background-image: url('{{ $props['image'] ?? '' }}'); background-size: cover;">
    <div class="container py-5 text-center">
        <h1 class="display-3 fw-bold mb-4">{{ $props['title'] ?? 'Hero Title' }}</h1>
        <p class="lead mb-5 text-muted">{{ $props['subtitle'] ?? 'Hero subtitle goes here.' }}</p>
        <a href="#" class="btn btn-primary btn-lg px-5 py-3 rounded-pill fw-bold">
            {{ $props['button_text'] ?? 'Learn More' }}
        </a>
    </div>
</section>
