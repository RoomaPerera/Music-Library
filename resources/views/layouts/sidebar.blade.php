<ul class="nav flex-column">
    <li class="nav-item">
        <a href="{{route('account.profile')}}">Profile</a>
    </li>
    @if (Auth::user()->role == 'artist')
        <li class="nav-item">
            <a href="{{route('songs.index')}}">Songs</a>
        </li>
        <li class="nav-item">
            <a href="{{route('comments.index')}}">Comments</a>
        </li>
    @endif
    @if (Auth::user()->role == 'listener')
        <li class="nav-item">
            <a href="my-reviews.html">My Comments</a>
        </li>
    @endif
    <li class="nav-item">
        <a href="change-password.html">Change Password</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('account.logout') }}">Logout</a>
    </li>
    <li class="nav-item">
        <form action="{{ route('account.deleteProfile') }}" method="POST" onsubmit="return confirm('Are you sure you want to deactivate your account?');">
        @csrf
        @method('DELETE')
        <button type="submit">Deactivate Account</button>
        </form>
    </li>
</ul>
