<style>@media (max-width: 576px) {
    h4{
        margin-top:5rem;
    }
}
</style>
<ul class="text-center list-unstyled">

                @guest
                
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                @endguest
    @if (Auth::check())
    <h4 >{!! Auth::user()->displayName !!}</h4>
        <div class="d-flex justify-content-center">
            <!-- Avatar -->
    
            <img src="/images/avatars/{!! Auth::user()->avatar !!}" alt="User Avatar" class="img-fluid rounded-circle" style="max-height: 115px;">
            
            <!-- Buttons -->
            <div class="d-flex flex-column ms-4 pl-2 pb-1 gap-2">
                <a href="{{ url('notifications') }}"
                    class="btn {{ Auth::user()->notifications_unread ? 'btn-warning' : 'btn-secondary' }} 
                            rounded-circle p-2 mb-1 d-inline-flex justify-content-center align-items-center"
                    style="width: 40px; height: 40px; text-decoration: none; color: inherit;">
                        <i class="fas fa-envelope"></i>
                </a>

                <a href="{{ url('account/settings') }}" 
                        class="btn btn-secondary rounded-circle p-2 mb-1 d-inline-flex justify-content-center align-items-center"
                        style="width: 40px; height: 40px; text-decoration: none; color: inherit;">
                    <i class="fas fa-cog"></i>
                </a>

                <a href="{{ Auth::user()->url }}" 
                        class="btn btn-secondary rounded-circle p-2 mb-1 d-inline-flex justify-content-center align-items-center"
                        style="width: 40px; height: 40px; text-decoration: none; color: inherit;">
                    <i class="fas fa-user"></i>
                </a>
            </div>    
            
        </div>
        
        <div class="d-flex justify-content-center ">
            <a href="{{ url('characters') }}" class="btn btn-secondary my-auto mx-1 py-2" style="width:100%;">Loaf</a> 
            <a href="{{ url('inventory') }}" class="btn btn-secondary my-auto mx-1 py-2" style="width:100%;">Bank</a> 
            <a href="{{ url('bank') }}" class="btn btn-secondary my-auto mx-1 py-2" style="width:100%;">Wallet</a> 
        </div>
@endif
<br><br>


    <div class="p-2 ml-3">              
    <h5>Current Season</h5>
    {!! $sidebar->box1content !!}
</div>

<div class="p-2 ml-3">              
    <h5>Beauty Contest Theme</h5>
    {!! $sidebar->box1content !!}
</div>
  
    
</ul>
