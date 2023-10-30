    <div class="min-h-full">
        <nav class="bg-gray-900">
            <div class="mx-auto max-w-9xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="hidden md:block">
                            <div class="ml-3 flex items-baseline space-x-4">
                                <a href={{ route('courses.index') }}
                                    class="bg-gray-900 text-white rounded-md px-3 py-2 text-md font-medium"
                                    aria-current="page">Home</a>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropbtn" onclick="myFunction()">Profile_Name
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content" id="myDropdown">
                            <a href="#">Log Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>

