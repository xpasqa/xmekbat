@php
    $steps = [
        ['step' => 0, 'route' => 'user.informasi', 'label' => 'Project Details'],
        ['step' => 1, 'route' => 'user.pilihlab', 'label' => 'Test Categories'],
        ['step' => 2, 'route' => 'user.quotation', 'label' => 'Quotation'],
        ['step' => 3, 'route' => 'user.pengiriman', 'label' => 'Shipping'],
        ['step' => 4, 'route' => 'user.preparasi', 'label' => 'Sample Preparation'],
        ['step' => 5, 'route' => 'user.labtest', 'label' => 'Rock Testing'],
        ['step' => 6, 'route' => 'user.invoice', 'label' => 'Invoice'],
        ['step' => 7, 'route' => 'user.download', 'label' => 'Download'],
    ];
@endphp

<div class="side-navbar active-nav d-flex justify-content-between flex-wrap flex-column" id="sidebar">
    <ul class="nav flex-column text-white w-100">
        <li>
            <div class="my-5 mx-4">
                <h6 class="font-black color-dark">LABORATORY TEST</h6>
                <div class="progress progressside mt-3">
                    <div class="progress-bar" role="progressbar" style="width: {{ $sidebar_progress }}%;"
                        aria-valuenow="{{ $sidebar_progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </li>
        @foreach ($steps as $item)
            <a href="{{ $sidebar_step >= $item['step'] ? route($item['route']) : 'javascript:void(0)' }}"
                class="side-nav-link nav-link font-bold color-dark nav-{{ request()->routeIs($item['route']) ? 'active ' : '' }}">
                <span class="sidebar-step-icon">
                    @if ($sidebar_step > $item['step'])
                        <img src="{{ URL::asset('assets/icons/checked.png') }}" alt="checked">
                    @endif
                </span>
                <span class="mx-2 side-link">{{ $item['label'] }}</span>
            </a>
        @endforeach
        <li>
            <div class="sidebar-support">
                <div class="sidebar-support-icon">
                    <span class="fa fa-headphones"></span>
                </div>
                <div class="sidebar-support-copy">
                    <strong>Need help?</strong>
                    <span>Our support team is ready to assist you.</span>
                </div>
                <a href="https://wa.me/0856" target="_blank" rel="noopener" class="btn sidebar-support-button">
                    Contact Support
                </a>
            </div>
        </li>
    </ul>
</div>
