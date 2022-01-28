
<div class="container-fluid">
		<div class="row">
			<div class="admin-nav p-0">
				<div class="p-2">
					<img src="{{ asset('male_avatar.png')}}" class="rounded-circle" width="100%">
				</div>
				<h4 class="text-light tetxt-center p-2">Company Panel</h4>

				<div class="list-group list-group-flush nav-side-menu">

					<div class="menu-list">
			            <ul id="menu-content" class="menu-content collapse out">
			                <li>
			                  	<a href="{{route('company.dashboard.index')}}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
			                </li>

			                <li>
			                  	<a href="{{ route('company.organization.index') }}"><i class="fas fa-store"></i> All Organization</a>
			                </li>

			                <li>
			                  	<a href="{{route('company.organization.create')}}"><i class="far fa-plus-square"></i></i> Organization Create</a>
			                </li>

			                <li>
			                  	<a href="{{route('company.module.index')}}"><i class="fab fa-creative-commons-sampling-plus"></i> Module</a>
			                </li>

			                <li>
			                  	<a href="{{route('company.sms.index')}}"><i class="fas fa-envelope-open-text"></i> Sms</a>
			                </li>


			                <!-- <li  data-toggle="collapse" data-target="#Settings" class="collapsed">
			                  	<a href="#"><i class="fas fa-cogs"></i> Settings<span class="arrow"></span></a>
			                </li>
			                <ul class="sub-menu collapse" id="Settings">
			                    <li class="active"><a href="admin-setting.blade.php">Admin Settings</a></li>
			                    <li><a href="admin-settingLanguage.php">Language Settings</a></li>
			                </ul> -->

			                <!-- <li>
			                  	<a href="admin-noties.php"><i class="fas fa-notes-medical"></i> Notes Bord</a>
			                </li> -->


			                <li>
			                  	<a href="{{route('company.profile.index')}}"><i class="fas fa-address-card"></i> Profile</a>
			                </li>
                            <li>
                                <a href="{{route('company.employee.index')}}"><i class="fas fa-address-card"></i> Company Employee</a>
                            </li>
			            </ul>

			        </div>
				</div>
			</div>


