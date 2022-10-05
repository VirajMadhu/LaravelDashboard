<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Book Managemen System</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
</head>

<body>
    <div class="main_page">
        <div class="container-fluid">
            <div class="page-header">
                <div class="container">
                    <div class="col-md-3">
                        <a href="#"><img src="images/logo.png" alt="logo" /></a>
                    </div>
                    <div class="col-md-9">
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>

                                </div>

                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <ul class="nav navbar-nav">
                                        <li class="active"><a href="#">HOME
                                                <span class="sr-only">(current)</span></a></li>
                                        <li><a href="#">FEATURED BOOKS</a></li>
                                        @if (Route::has('login'))
                                            @auth
                                                <li><a href="{{ url('/dashboard') }}">DASHBOARD</a></li>
                                            @else
                                                <li><a href="{{ route('login') }}">LOG IN</a></li>
                                            @endauth
                                        @endif
                                    </ul>

                                </div>
                            </div>
                        </nav>

                    </div>
                </div>
            </div>
            <div class="jumbotron banner">
                <div class="col-md-12">
                    <button type="button" value="GET DISTRIBUTED">GET DISTRIBUTED</button>
                    <button type="button" value="GET DISTRIBUTED">GETTING PUBLISHED</button>
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
        <div class="col-md-12 section_1">
            <h1>Have An Idea For A Book </h1>
            <div class="container row-padding">
                <div class="col-md-6 section_1_1">
                    <p>Let us assist you with your book project.<br />

                        Let's help you go from your manuscript to a
                        professionally published book, and to a
                        possible great seller.<br />
                        Our book self-publishing service enables you,
                        the writer, to fully control your intellectual
                        property rights, and the development of your
                        project.<br />
                        <span>E-book Enquiries</span>
                    </p>
                </div>
                <div class="col-md-6 section_1_2">
                    <img src="images/121213.png" />
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="clearfix"></div>
        <div class="col-md-12 section_3">
            <h1>OUR SERVICES</h1>
            <div class="col-md-12">
                <div class="col-md-3">
                    <div class="col-md-12">
                        <img src="images/1.png" />
                    </div>
                    <p>Our book self-publishing service
                        enables you, the writer, to fully
                        control your intellectual property.</p>
                    <a href="#">
                        <h3>SELF-PUBLISHING</h3>
                    </a>
                </div>
                <div class="col-md-3">
                    <div class="col-md-12">
                        <img src="images/2.png" />
                    </div>
                    <p>Let's help you go from your
                        manuscript to a professionally
                        published book.</p>
                    <a href="#">
                        <h3>ADVERTORIALS</h3>
                    </a>
                </div>
                <div class="col-md-3">
                    <div class="col-md-12">
                        <img src="images/3.png" />
                    </div>
                    <p>Agora makes book publishing
                        accessible to all writers across
                        Canada and internationally.</p>
                    <a href="#">
                        <h3>SEM FOR WRITERS</h3>
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
