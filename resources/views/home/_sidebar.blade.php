<ul>
    <li class="sidebar-header"><a href="{{ url('/') }}" class="card-link">Home</a></li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">Kukus</div>
        <div class="sidebar-item"><a href="{{ url('characters') }}" class="{{ set_active('characters') }}">My Kukuri</a></div>
        <!-- <div class="sidebar-item"><a href="{{ url('breeding-permissions') }}" class="{{ set_active('breeding-permissions') }}">Breeding Permissions</a></div> --> 
    </li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">Activity</div>
        <div class="sidebar-item"><a href="{{ url('submissions') }}" class="{{ set_active('submissions*') }}">Prompt Submissions</a></div>
        <div class="sidebar-item"><a href="{{ url('claims') }}" class="{{ set_active('claims*') }}">Claims</a></div>
        <div class="sidebar-item"><a href="{{ url('characters/transfers/incoming') }}" class="{{ set_active('characters/transfers*') }}">Character Transfers</a></div>
        <div class="sidebar-item"><a href="{{ url('trades/open') }}" class="{{ set_active('trades/open*') }}">Trades</a></div>
        <div class="sidebar-item"><a href="{{ url('comments/liked') }}" class="{{ set_active('comments/liked*') }}">Liked Comments</a></div>
        <div class="sidebar-item"><a href="{{ url('applications') }}" class="{{ set_active('applications*') }}">Applications</a></div>
    </li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">Bank</div>
        <div class="sidebar-item"><a href="{{ url('world/recipes') }}" class="{{ set_active('world/recipes') }}">Recipes</a></div>
        <div class="sidebar-item"><a href="{{ url('inventory') }}" class="{{ set_active('inventory*') }}">Bank</a></div>
        <div class="sidebar-item"><a href="{{ url('bank') }}" class="{{ set_active('bank*') }}">Wallet</a></div>
        <div class="sidebar-item"><a href="{{ url('pets') }}" class="{{ set_active('pets*') }}">Familiars</a></div>
        <div class="sidebar-item"><a href="{{ url(__('safetydeposit.url')) }}" class="{{ set_active(__('safetydeposit.url').'*') }}">{{ ucwords(__('safetydeposit.name')) }}</a></div>
    </li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">Reports</div>
        <div class="sidebar-item"><a href="{{ url('reports') }}" class="{{ set_active('reports*') }}">Reports</a></div>
    </li>
</ul>
