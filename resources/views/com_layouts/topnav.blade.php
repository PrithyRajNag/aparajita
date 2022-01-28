
<div class="col">
				<div class="row">
					<div class="col-lg-12 bg-primary pt-2 justify-content-between d-flex">
						<a href="#" class="text-white" id="open-nav"><h3><i class="fas fa-bars"></i></h3></a>

{{--						<h4 class="text-light"><?= $title; ?></h4>--}}


                        <a href="{{ route('com-logout') }}" class="text-light mt-1"
                           onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>{{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('com-logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
{{--<a href="assets/php/logout.php" class="text-light mt-1"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>--}}
</div>
</div>
