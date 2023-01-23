 <div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <ul id="side-menu">
                <li class="menu-title" style="color: #fff;">Navigation</li>
                <li>
                    <a href="{{ route('dashboard') }}">
                    <i data-feather="home"></i>
                    <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.index') }}">
                    <i data-feather="user"></i>
                    <span>Users</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('group.index') }}">
                    <i data-feather="users"></i>
                    <span>Groups</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('contact.index') }}">
                    <i data-feather="file-text"></i>
                    <span>Contacts</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('message.index') }}">
                    <i data-feather="message-circle"></i>
                    <span>Messages</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('keyword.index') }}">
                    <i data-feather="file-text"></i>
                    <span>Keywords</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('report.index') }}">
                    <i data-feather="pie-chart"></i>
                    <span>Reports</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.index') }}">
                    <i data-feather="settings"></i>
                    <span>Profile Setting</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>