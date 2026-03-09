<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item menu-open">

            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('books.index') }}" class="nav-link ">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Books</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('members.index') }}" class="nav-link ">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Members</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Borrowings</p>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</nav>
