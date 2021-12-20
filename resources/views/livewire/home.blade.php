@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/home.css') }}">
@endpush

<div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 gy-5 gy-lg-0 pt-5">
        <div class="col">
            <div class="card bg-gray-200 border-0 h-100">
                <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4">
                        <i class="bi bi-bar-chart-line"></i>
                    </div>
                    <h2 class="fs-4 fw-bold mb-0 pt-2">{{ __('Hitung PPh 21') }}</h2>
                </div>
                <a href="javascript:void(0)" class="stretched-link"></a>
            </div>
        </div>
        <div class="col">
            <div class="card bg-gray-200 border-0 h-100">
                <div class="coming-soon">
                    <span class="badge bg-warning">Coming Soon</span>
                </div>
                <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <h2 class="fs-4 fw-bold mb-0 pt-2">{{ __('Hitung BPJS') }}</h2>
                </div>
                <a href="javascript:void(0)" class="stretched-link"></a>
            </div>
        </div>
        <div class="col">
            <div class="card bg-gray-200 border-0 h-100">
                <div class="coming-soon">
                    <span class="badge bg-warning">Coming Soon</span>
                </div>
                <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4">
                        <i class="bi bi-card-heading"></i>
                    </div>
                    <h2 class="fs-4 fw-bold mb-0 pt-2">Next Time</h2>
                </div>
                <a href="javascript:void(0)" class="stretched-link"></a>
            </div>
        </div>
    </div>
</div>
