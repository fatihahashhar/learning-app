<div class="min-h-full">
    <nav class="bg-gray-900">
        <div class="mx-auto max-w-9xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="hidden md:block">
                        <div class="ml-3 flex items-baseline space-x-4">
                            @auth
                                @if (auth()->user()->role === 'admin')
                                    <a href="{{ route('courses.index') }}"
                                        class="bg-gray-900 text-white rounded-md px-3 py-2 text-md font-medium"
                                        aria-current="page">Courses</a>
                                    <a href="{{ route('users.index') }}"
                                        class="bg-gray-900 text-white rounded-md px-3 py-2 text-md font-medium"
                                        aria-current="page">Users</a>
                                @elseif (auth()->user()->role === 'user')
                                    <a href="{{ route('normalUsers.dashboard', auth()->user()->id) }}"
                                        class="bg-gray-900 text-white rounded-md px-3 py-2 text-md font-medium"
                                        aria-current="page">Home</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropbtn" onclick="myFunction()">
                            @auth
                                {{ auth()->user()->username }}
                                <i class="fa fa-caret-down ms-2"></i>
                            @endauth
                        </button>
                        <div class="dropdown-content" id="myDropdown">
                            <a href="{{ route('logout') }}">Log Out</a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
</div>


<script>
    document.getElementById('logout-link').addEventListener('click', function(event) {
        event.preventDefault();

        if (confirm('Are you sure you want to log out?')) {
            window.location.href = this.getAttribute('href');
        }
    });
</script>
