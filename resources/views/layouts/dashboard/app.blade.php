@include('layouts/dashboard/header')

@include('layouts/dashboard/aside')




<div class="mainpanel">

    @include('layouts/dashboard/navbar')

    @yield('content')

</div><!-- mainpanel -->



@include('layouts/dashboard/footer')


