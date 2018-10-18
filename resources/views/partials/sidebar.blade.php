<!-- Custom CSS -->

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->


    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <img alt="Bristol SU" src="{{asset('img/sulogo.png')}}" style="width: 70%"/>
        </li>
          <br/>
        @php $links = array(
          'Login|guest'=>'/login',
          'Register|guest'=>'register',
          'Dashboard|user'=>'/',
          'Shortcuts|user'=>array(
              'My Shortcuts|user'=>'/shortcuts',
              'Create Shortcut|user'=>'/shortcuts/create',
          ),
          'Departments|admin'=>array(
              'Departments|admin'=>'/departments',
              'Create Department|admin'=>'/departments/create',
            ),
            'Users|admin'=>array(
              'Users|admin'=>'/users',
              'Validate Users|admin'=>'/users/validate'
          ),
          'My Profile|user'=>'/users/'.(Auth::check()?Auth::user()->id:0).'/view',
        'Logout|user'=>'/logout',
        )
          @endphp


          @foreach($links as $label=>$link)
              @php $labelauth = explode('|', $label); $label = $labelauth[0]; $auth = $labelauth[1]; @endphp
          <!--First we check for auth or not-->
              @if(($auth == 'guest' && !Auth::check()) || (($auth != 'guest' && Auth::check()) && (($auth != 'admin') || ($auth == 'admin') && (Auth::user()->isAdmin())) ))
              <li>
                  @if(is_array($link))
                      @php $linkName = preg_replace('/\W+/','',strtolower(strip_tags($label)));@endphp
                      <a href="#{{$linkName}}" role="button" onclick="$('#{{$linkName}}').toggle('in');">{{$label}}</a>
                          <ul id="{{$linkName}}" class="collapse">
                            @foreach($link as $sublabel=>$sublink)
                                @php $sublabelauth = explode('|', $sublabel); $sublabel = $sublabelauth[0]; $subauth = $sublabelauth[1]; @endphp
                                @if($subauth != 'admin' || (Auth::user()->isAdmin()))
                                  <a href="{{$sublink}}">{{$sublabel}}</a>
                                @endif
                            @endforeach
                          </ul>

                  @else
                      <a href="{{$link}}">{{$label}}</a>
                  @endif
              </li>
              @endif
          @endforeach
      </ul>
    </div>