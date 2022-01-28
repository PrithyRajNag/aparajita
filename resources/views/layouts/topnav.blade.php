
<div class="col">
    <div class="row">
        <div class="col-lg-12 bg-primary pt-2 justify-content-between d-flex top-nav">
            <a href="#" class="text-white" id="open-nav"><h3><i class="fas fa-bars"></i></h3></a>

            <a href="{{ route('logout') }}" class="text-light mt-1"
               onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                               <i class="fas fa-sign-out-alt"></i>{{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
{{--<div class="col">--}}
{{--    <div class="row">--}}
{{--        <div class="col-lg-12 bg-primary pt-2 justify-content-between d-flex">--}}
{{--            <a href="#" class="text-white" id="open-nav"><h3><i class="fas fa-bars"></i></h3></a>--}}
{{--            <h4 class="text-light"><?= $title; ?></h4>--}}
{{--            <div class="btn-group mt-0">--}}
{{--                <button type="button" class="btn text-light mt-0 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                    Wellcome, User Name--}}
{{--                </button>--}}
{{--                <div class="dropdown-menu dropdown-menu-right">--}}
{{--                    <button class="dropdown-item" type="button">Action</button>--}}
{{--                    <button class="dropdown-item" type="button">Another action</button>--}}
{{--                    <a href="{{ route('logout') }}" class="text-dark mt-1 ml-2"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
