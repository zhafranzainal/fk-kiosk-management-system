<li class="side-nav-item">
    <a href="{{ route('dashboard') }}" class="side-nav-link">
        <i class="uil-home-alt"></i>
        {{ __('Dashboard') }}
    </a>
</li>

@can('view-any', App\Models\User::class)
    <li class="side-nav-item">
        <a href="{{ route('users.index') }}" class="side-nav-link">
            <i class="dripicons-user-group"></i>
            <span> Users </span>
        </a>
    </li>
@endcan

@can('view-any', App\Models\Kiosk::class)
    <li class="side-nav-item">
        <a href="{{ route('kiosks.index') }}" class="side-nav-link">
            <i class="dripicons-store"></i>
            <span> Manage Kiosks </span>
        </a>
    </li>
@endcan

@can('view-any', App\Models\Application::class)
    <li class="side-nav-item">
        <a href="{{ route('applications.index') }}" class="side-nav-link">
            <i class="dripicons-document"></i>
            <span> Kiosk Applications </span>
        </a>
    </li>
@endcan

@can('view-any', App\Models\Sale::class)
    <li class="side-nav-item">
        <a href="{{ route('sales.index') }}" class="side-nav-link">
            <i class="dripicons-tags"></i>
            <span> Kiosk Sales </span>
        </a>
    </li>
@endcan

@can('view-any', App\Models\Transaction::class)
    <li class="side-nav-item">
        <a href="{{ route('payments.index-bill') }}" class="side-nav-link">
            <i class="uil-money-stack"></i>
            <span> Kiosk Payments </span>
        </a>
    </li>
@endcan

@can('view-any', App\Models\Complaint::class)
    <li class="side-nav-item">
        <a href="{{ route('complaints.index') }}" class="side-nav-link">
            <i class="dripicons-document-edit"></i>
            <span> Kiosk Complaints </span>
        </a>
    </li>
@endcan
