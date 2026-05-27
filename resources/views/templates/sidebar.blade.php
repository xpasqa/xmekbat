<div class="side-navbar active-nav d-flex justify-content-between flex-wrap flex-column" id="sidebar">
    <ul class="nav flex-column text-white w-100">
        <li>
            <div class="my-5 mx-4">
                <h6 class="font-black color-dark">LABORATORY TEST</h6>
                <div class="progress progressside mt-3">
                    <div class="progress-bar" role="progressbar" style="width: {{$sidebar_progress}}%;" aria-valuenow="{{$sidebar_progress}}" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
            </div>
        </li>
        <a href="{{ $sidebar_step >= 0 ? route('user.informasi') : 'javascript:void(0)' }}" class="side-nav-link nav-link font-bold color-dark nav-{{ (request()->routeIs('user.informasi')) ? 'active ' : '' }}">
            <img src="{{ ($sidebar_step > 0) ? URL::asset('assets/icons/checked.png') : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs='}}" alt="checked">
            <span class="mx-2 side-link">Project Details</span>
        </a>
        <a href="{{ $sidebar_step >= 1 ? route('user.pilihlab') : 'javascript:void(0)' }}" class="side-nav-link nav-link font-bold color-dark nav-{{ (request()->routeIs('user.pilihlab')) ? 'active ' : '' }}">
            <img src="{{ ($sidebar_step > 1) ? URL::asset('assets/icons/checked.png') : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs='}}" alt="checked">
            <span class="mx-2 side-link">Test Categories</span>
        </a>
        <a href="{{ $sidebar_step >= 2 ? route('user.quotation') : 'javascript:void(0)' }}" class="side-nav-link nav-link font-bold color-dark nav-{{ (request()->routeIs('user.quotation')) ? 'active ' : '' }}">
            <img src="{{ ($sidebar_step > 2) ? URL::asset('assets/icons/checked.png') : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs='}}" alt="checked">
            <span class="mx-2 side-link">Quotation</span>
        </a>
        <a href="{{ $sidebar_step >= 3 ? route('user.pengiriman') : 'javascript:void(0)' }}" class="side-nav-link nav-link font-bold color-dark nav-{{ (request()->routeIs('user.pengiriman')) ? 'active ' : '' }}">
            <img src="{{ ($sidebar_step > 3) ? URL::asset('assets/icons/checked.png') : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs='}}" alt="checked">
            <span class="mx-2 side-link">Shipping</span>
        </a>
        <a href="{{ $sidebar_step >= 4 ? route('user.preparasi') : 'javascript:void(0)' }}" class="side-nav-link nav-link font-bold color-dark nav-{{ (request()->routeIs('user.preparasi')) ? 'active ' : '' }}">
            <img src="{{ ($sidebar_step > 4) ? URL::asset('assets/icons/checked.png') : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs='}}" alt="checked">
            <span class="mx-2 side-link">Sample Preparation</span>
        </a>
        <a href="{{ $sidebar_step >= 5 ? route('user.labtest') : 'javascript:void(0)' }}" class="side-nav-link nav-link font-bold color-dark nav-{{ (request()->routeIs('user.labtest')) ? 'active ' : '' }}">
            <img src="{{ ($sidebar_step > 5) ? URL::asset('assets/icons/checked.png') : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs='}}" alt="checked">
            <span class="mx-2 side-link">Rock Testing</span>
        </a>
        <a href="{{ $sidebar_step >= 6 ? route('user.invoice') : 'javascript:void(0)' }}" class="side-nav-link nav-link font-bold color-dark nav-{{ (request()->routeIs('user.invoice')) ? 'active ' : '' }}">
            <img src="{{ ($sidebar_step > 6) ? URL::asset('assets/icons/checked.png') : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs='}}" alt="checked">
            <span class="mx-2 side-link">Invoice</span>
        </a>
        <a href="{{ $sidebar_step >= 7 ? route('user.download') : 'javascript:void(0)' }}" class="side-nav-link nav-link font-bold color-dark nav-{{ (request()->routeIs('user.download')) ? 'active ' : '' }}">
            <img src="{{ ($sidebar_step > 7) ? URL::asset('assets/icons/checked.png') : 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs='}}" alt="checked">
            <span class="mx-2 side-link">Download</span>
        </a>
    </ul>
</div>
