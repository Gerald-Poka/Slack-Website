@php $props = json_decode($block->props, true); @endphp
<section class="py-5">
    <div class="container py-5">
        <div class="row g-4">
            @foreach($props['items'] ?? [] as $item)
                <div class="col-md-4 text-center">
                    <div class="p-4 rounded-4 shadow-sm h-100 bg-white">
                        <div class="bg-primary bg-opacity-10 text-primary p-3 d-inline-block rounded-pill mb-3">
                            <i class="{{ $item['icon'] ?? 'ph-star' }} fs-1"></i>
                        </div>
                        <h4 class="fw-bold">{{ $item['title'] ?? '' }}</h4>
                        <p class="text-muted mb-0">{{ $item['desc'] ?? '' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
