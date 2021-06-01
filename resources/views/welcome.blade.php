<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Football Simulation</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">




</head>

<body>


<main role="main">

    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Football Simulation</h1>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="">

            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card box-shadow">
                                <div class="card-title">
                                    <h5 class="p-l-3">League Table</h5>
                                </div>
                                <div class="card-body">
                                    <table id="teams-table">
                                        <thead>
                                        <th>Teams</th>
                                        <th>PTS</th>
                                        <th>P</th>
                                        <th>W</th>
                                        <th>D</th>
                                        <th>L</th>
                                        <th>GD</th>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                    <div class="col-md-12">
                                        <div class="col-md-3 float-left"><a href="javascript:void(0);" class="btn btn-success" onclick="main.playMatch($(this))">Play</a></div>
                                            <div class="col-md-4 float-right"><a id="next-btn" href="javascript:void(0);" class="btn btn-info" onclick="main.loadNextWeek($(this))">Show Next Week</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card box-shadow">
                                <div class="card-title">
                                    <h5 class="p-l-3">Matches Result</h5>
                                </div>
                                <div class="card-body">
                                    <table id="match-result-table">
                                        <thead>
                                        <th>PTS</th>
                                        <th>P</th>
                                        <th>W</th>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div id="predictions" class="col-md-4">
                    <div class="card box-shadow">
                        <div class="card-title">
                            <h5 class="p-l-3">Predictions of Championship</h5>
                        </div>
                        <div class="card-body">
                            <table id="predictions-table">
                                <thead>
                                <th>Teams</th>
                                <th>PTS</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

</main>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<script src="/js/main.js"></script>

<script>
    $(document).ready(function (){
        main.ready();
    });
</script>

</body>
</html>
