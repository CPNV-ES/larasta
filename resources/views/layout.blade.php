{{-- Author: Xavier Carrel --}}
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Larasta</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/minimal.css">
    <!--<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">-->
    <script src="/js/utils.js"></script>
    <link rel="stylesheet" href="/css/dropzone.min.css">
    <script src="/js/ckeditor.js"></script>
    <script src="/js/dropzone.min.js"></script>
    <script src="/js/class/FieldsRemarks.js"></script>
    <link rel="stylesheet" href="/css/simplemde.min.css">
    <script src="/js/simplemde.min.js"></script>
    <script src="/js/showdown.min.js"></script>
    @stack('page_specific_css')
</head>

<body class="{{(isset($_COOKIE['sidemenu_state']) && $_COOKIE['sidemenu_state'] == 'open')?'sidemenu-open':''}}">
    @if (!empty($message))
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info alert-dismissible fade show pl-3 ml-3 mr-2 " role="alert">
                <p class="font-weight-bold mb-n1">{{ $message }}</p>
                <button type="btn" class="close" data-dismiss="alert" aria-label="Close" style="padding-bottom: 8px; padding-top: 8px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif
    
    <!-- Verifie si un message flash success est present dans la session -->
    @if (session('success'))
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show pl-3 ml-3 mr-2 " role="alert">
                <p class="font-weight-bold mb-n1">{{ session('success') }}</p>
                <button type="btn" class="close" data-dismiss="alert" aria-label="Close" style="padding-bottom: 8px; padding-top: 8px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Verifie si un message flash error est present dans la session -->
    @if (session('error'))
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show pl-3 ml-3 mr-2 " role="alert">
                <p class="font-weight-bold mb-n1">{{ session('error') }}</p>
                <button type="btn" class="close" data-dismiss="alert" aria-label="Close" style="padding-bottom: 8px; padding-top: 8px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Affiche les erreurs de validation de Laravel -->
    @if ($errors->any())
        <div class="row">
            <div class="col-12">   
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show pl-3 ml-3 mr-2 " role="alert">
                    <p class="font-weight-bold mb-n1">{{ $error }}</p>
                    <button type="btn" class="close" data-dismiss="alert" aria-label="Close" style="padding-bottom: 8px; padding-top: 8px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endforeach 
            </div>
        </div>
    @endif

    <button id="sidemenuToggler" title="toggle menu"></button>
    <div id="sidemenu" class="simple-box container-fluid text-center">
        <table class="table table-striped text-left larastable">
            @if (Auth::check())
            <form action="/auth/logout" method="POST">
            @csrf
                <tr>
                    <td class="login"><p>{{Auth::user()->fullname}}</p>
                        <div class="row">
                            <div class="col-6">                               
                                <button type="button" class="btn-info" onclick="window.location = '/';">Dashboard</button>
                            </div>
                            <div class="col-6">
                                <button class="btn-danger" type="submit">Logout</button>
                            </div>
                        </div>
                    </td>
                </tr>
            </form>
            @else
                <tr>
                    <td><a href="/auth/azure"><img alt="Azure" width="25" heigth="25" src="/images/azure.png">Login with Azure</a></td>
                </tr>
            @endif
            <tr>
                <td><a href="/people"><img alt="Personnes" src="/images/contact.png">Personnes</a></td>
            </tr>
            <tr>
                <td><a href="/entreprises"><img alt="Entreprises" src="/images/company.png">Entreprises</a></td>
            </tr>
            <tr>
                <td><a href="/internships"><img alt="Places" src="/images/internships.png">Stages</a></td>
            </tr>
            <tr>
                <td><a href="/visits"><img alt="Places" src="/images/internships.png">Visites</a></td>
            </tr>
            <tr>
                <td><a href="/about"><img alt="News" src="/images/news.png">News</a></td>
            </tr>
            <tr>
                <td><a href="/wishesMatrix"><img alt="Places" src="/images/wishes.png">Souhaits</a></td>
            </tr>
            <tr>
                <td><a href="/documents"><img alt="Documents" src="/images/documents.png">Documents</a></td>
            </tr>
            @yield ('sidemenu_table')
            @if (Auth::check())
                @if (Auth::user()->role > 1)
                    <tr>
                        <td><a href="/admin"><img alt="mp" src="/images/MP.png">Admin</a></td>
                    </tr>
                @endif
            @endif
        </table>
        @stack ('sidemenu')
        @if (!CPNVEnvironment\Environment::isProd())
            <img id="imgwip" src="/images/wip.png">
        @endif
        <div class="version">v{{ config('app.version') }}</div>
    </div>
    <div class="simple-box container-fluid text-center content-besides-sidebar">
        @yield ('content')
    </div>
    <div id="windowsContainer">
        @yield ('windows')
    </div>
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/jquery.dataTables.js"></script>
    <script src="/js/appjs.js"></script>
    @stack('page_specific_js')
</body>
</html>
