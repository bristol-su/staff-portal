<div class="row header">
    <div class="col-xs-4 toolbar-col">
        <div class="toolbar-content left">
            <div class="icon-button" id="menu_div" onclick="$('#wrapper').toggleClass('toggled');">
                <div class="icon">
                    <i class="material-icons">menu</i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-4 toolbar-col">
    <div class="toolbar-content center">
        <div id="header-title" class="header-title">Staff Portal</div>
    </div>
    </div>

    @if(auth()->check())
    <div class="col-xs-4 toolbar-col">
        <div class="toolbar-content right header-user-menu">
            <img src="/img/demoprofile.svg" alt="User Image"/>

            <ul>
                <li><a href="/users/{{auth()->user()->id}}/view">My Profile</a></li>
                <li><a href="/logout" class="highlight">Logout</a></li>
            </ul>
        </div>
    </div>
    @endif
</div>