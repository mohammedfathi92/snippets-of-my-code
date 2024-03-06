
	<div class="col-lg-3 col-md-4  profile-info">
		            <div class="card">
		              <div class="card-body box-profile">
		                <div class="text-center">
		                  <img class="profile-user-img img-fluid img-circle" src="{{$userBase->picture}}" alt="{{$userLMS->name}}">
		                </div>

		                <h3 class="profile-username text-center"><strong></strong>{{$userLMS->name}}</h3>

		                <p class="text-muted text-center">{{$userLMS->job_title}}
		                </p>

		                <ul class="list-group list-group-unbordered mb-3">
		                  <li class="list-group-item">
		                  	<center><p style="color: #f8b032;"><strong>@lang('developnet-lms::labels.profile.subscribtions')</strong>  </p></center>
		                    <b>@lang('developnet-lms::labels.profile.plans')</b> <a class="float-right">{{$hasSubscriptions?$subscriptions->where('subscriptionnable_type', 'plan')->count():0}}</a>
		                  </li>
		                  <li class="list-group-item">
		                    <b>@lang('developnet-lms::labels.profile.courses')</b> <a class="float-right">{{$hasSubscriptions?$subscriptions->where('subscriptionnable_type', 'course')->count():0}}</a>
		                  </li>
		                  <li class="list-group-item">
		                    <b>@lang('developnet-lms::labels.profile.quizzes')</b> <a class="float-right">{{$hasSubscriptions?$subscriptions->where('subscriptionnable_type', 'quiz')->count():0}}</a>
		                  </li>
		                </ul>
@if(\LMS::profilePermissions($userBase, 'LMS::invoice.view'))
		                <a href="{{route('subscriptions.invoices', $userLMS->hashed_id)}}" class="btn btn-primary btn-block"><b>@lang('developnet-lms::labels.headings.text_invoices')</b></a>
		 @endif               

		              </div>
		            </div>

		            <!-- About Me Box -->
		           {{--  <div class="card card-primary">
		              <div class="card-header">
		                <h3 class="card-title">About Me</h3>
		              </div>
		              <!-- /.card-header -->
		              <div class="card-body">
		                <strong><i class="fa fa-book mr-1"></i> Education</strong>

		                <p class="text-muted">
		                  B.S. in Computer Science from the University of Tennessee at Knoxville
		                </p>

		                <hr>

		                <strong><i class="fa fa-map-marker mr-1"></i> Location</strong>

		                <p class="text-muted">Malibu, California</p>

		                <hr>

		                <strong><i class="fa fa-pencil mr-1"></i> Skills</strong>

		                <p class="text-muted">
		                  <span class="tag tag-danger">UI Design</span>
		                  <span class="tag tag-success">Coding</span>
		                  <span class="tag tag-info">Javascript</span>
		                  <span class="tag tag-warning">PHP</span>
		                  <span class="tag tag-primary">Node.js</span>
		                </p>

		                <hr>

		                <strong><i class="fa fa-file-text-o mr-1"></i> Notes</strong>

		                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
		              </div>
		              <!-- /.card-body -->
		            </div> --}}
		            <!-- /.card -->
		        </div>