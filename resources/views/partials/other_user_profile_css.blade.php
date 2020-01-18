
@if(isFollowing(Auth::user()->id, $user->id))
    <style>
        .following-dropdown {
            display: block;
        }

        .follow-btn {
            display: none;
        }
    </style>
@else
    <style>
        .following-dropdown {
            display: none;
        }

        .follow-btn {
            display: block;
        }
    </style>
@endif