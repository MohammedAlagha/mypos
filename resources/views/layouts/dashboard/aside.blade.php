<body>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
    </div>

    <section>

      <div class="leftpanel">

        <div class="logopanel">
            <h1><span>[</span> MyPos <span>]</span></h1>
        </div><!-- logopanel -->

        <div class="leftpanelinner">

            <!-- This is only visible to small devices -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media userlogged">
                    <img alt="" src="images/photos/loggeduser.png" class="media-object">
                    <div class="media-body">
                        <h4>John Doe</h4>
                        <span>"Life is so..."</span>
                    </div>
                </div>

                <h5 class="sidebartitle actitle">Account</h5>
                <ul class="nav nav-pills nav-stacked nav-bracket mb30">
                  <li><a href="profile.html"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                  <li><a href=""><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
                  <li><a href=""><i class="fa fa-question-circle"></i> <span>Help</span></a></li>
                  <li><a href="signout.html"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
                </ul>
            </div>

          <h5 class="sidebartitle">Navigation</h5>
          <ul class="nav nav-pills nav-stacked nav-bracket">
          <li class="active"><a href=" {{route('dashboard.index')}} "><i class="fa fa-home"></i> <span>@lang('site.dashboard')</span></a></li>

          @if (auth()->user()->hasPermission('read_categories'))
          <li><a href="{{route('dashboard.categories.index')}}"><i class="glyphicon glyphicon-user"></i> <span>@lang('site.categories')</span></a></li>
          @endif

          @if (auth()->user()->hasPermission('read_products'))
          <li><a href="{{route('dashboard.products.index')}}"><i class="glyphicon glyphicon-user"></i> <span>@lang('site.products')</span></a></li>
          @endif

          @if (auth()->user()->hasPermission('read_users'))
            <li><a href="{{route('dashboard.users.index')}}"><i class="glyphicon glyphicon-user"></i> <span>@lang('site.users')</span></a></li>
          @endif


          </ul>



        </div><!-- leftpanelinner -->
      </div><!-- leftpanel -->

    </section>
