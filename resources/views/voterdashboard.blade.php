<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Voting System using PHP</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{URL::to('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{URL::to('plugins/iCheck/all.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{URL::to('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::to('dist/css/AdminLTE.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{URL::to('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{URL::to('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="{{URL::to('plugins/timepicker/bootstrap-timepicker.min.css')}}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{URL::to('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{URL::to('dist/css/skins/_all-skins.min.css')}}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  	<![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style type="text/css">
        .bold {
            font-weight: bold;
        }

        #candidate_list {
            margin-top: 20px;
        }

        #candidate_list ul {
            list-style-type: none;
        }

        #candidate_list ul li {
            margin: 0 30px 30px 0;
            vertical-align: top
        }

        .clist {
            margin-left: 20px;
        }

        .cname {
            font-size: 25px;
        }
    </style>
</head>

<body class="hold-transition skin-blue layout-top-nav">
    
        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="#" class="navbar-brand"><b>Voting</b>System</a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <?php
                            if (isset($_SESSION['student'])) {
                                echo "
                <li><a href='index.php'>HOME</a></li>
                <li><a href='transaction.php'>TRANSACTION</a></li>
              ";
                            }
                            ?>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="user user-menu">
                                <a href="">
                                    <img src="{{Auth::guard('voter')->user()->photo}}" class="user-image" alt="User Image">
                                    <span class="hidden-xs">{{Auth::guard('voter')->user()->firstname}}"</span>
                                </a>
                            </li>
                            <li><a href="logout.php"><i class="fa fa-sign-out"></i> LOGOUT</a></li>
                        </ul>
                    </div>
                    <!-- /.navbar-custom-menu -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>
    

        <main>
            <div class="content-wrapper">
                <div class="container">
                    <section class="content">
                        <h1 class="page-header text-center title"><b>2027 Elections</b></h1>
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">
                                @if(session('error'))
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <ul>
                                        @foreach(session('error') as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                @if(session('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                                    {{ session('success') }}
                                </div>
                                @endif

                                <div class="alert alert-danger alert-dismissible" id="alert" style="display:none;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <span class="message"></span>
                                </div>

                                @if($votes->count() > 0)
                                <div class="text-center">
                                    <h3>You have already voted for this election.</h3>
                                    <a href="#view" data-toggle="modal" class="btn btn-flat btn-primary btn-lg">View Ballot</a>
                                </div>
                                @else
                                <!-- Voting Ballot -->
                                <form method="POST" id="ballotForm" action="{{ route('vote.submit') }}">
                                    @csrf
                                    @foreach($positions as $position)
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="box box-solid" id="{{ $position->id }}">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title"><b>{{ $position->description }}</b></h3>
                                                </div>
                                                <div class="box-body">
                                                    <p>{{ $position->max_vote > 1 ? 'You may select up to ' . $position->max_vote . ' candidates' : 'Select only one candidate' }}
                                                        <span class="pull-right">
                                                            <button type="button" class="btn btn-success btn-sm btn-flat reset" data-desc="{{ Str::slug($position->description) }}"><i class="fa fa-refresh"></i> Reset</button>
                                                        </span>
                                                    </p>
                                                    <div id="candidate_list">
                                                        <ul>
                                                            @foreach($position->candidates as $candidate)
                                                            @php
                                                            $input = $position->max_vote > 1 ?
                                                            '<input type="checkbox" class="flat-red ' . Str::slug($position->description) . '" name="' . Str::slug($position->description) . '[]" value="' . $candidate->id . '">' :
                                                            '<input type="radio" class="flat-red ' . Str::slug($position->description) . '" name="' . Str::slug($position->description) . '" value="' . $candidate->id . '">';
                                                            $image = $candidate->photo ? asset('images/' . $candidate->photo) : asset('images/profile.jpg');
                                                            @endphp
                                                            <li>
                                                                {!! $input !!} <button type="button" class="btn btn-primary btn-sm btn-flat clist platform" data-platform="{{ $candidate->platform }}" data-fullname="{{ $candidate->firstname . ' ' . $candidate->lastname }}"><i class="fa fa-search"></i> Platform</button>
                                                                <img src="{{ $image }}" height="100px" width="100px" class="clist">
                                                                <span class="cname clist">{{ $candidate->firstname . ' ' . $candidate->lastname }}</span>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-flat" name="vote"><i class="fa fa-check-square-o"></i> Submit</button>
                                    </div>
                                </form>
                                <!-- End Voting Ballot -->
                                @endif
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>All rights reserved</b>
            </div>
        </footer>
        <!-- Platform -->
        <div class="modal fade" id="platform">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><b><span class="candidate"></b></h4>
                    </div>
                    <div class="modal-body">
                        <p id="plat_view"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>


        @section('scripts')

        @endsection
        
</body>

</html>