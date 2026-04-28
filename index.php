<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">

            <!-- Left side (log) -->
            <div class="col-12 col-md-6">
                   <?php include 'monitoring.php'; ?>
                   <?php include 'soft/clients.php'; ?>
            </div>

            <!-- right side (server) -->
            <div class="col-12 col-md-6">
                <div class="row">

                    <div class="col-12 col-md-6 mb-3">
                        <div class="card">
                            <?php include 'server/disque.php'; ?>  
                        </div>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <div class="card">
                            <?php include 'server/processeur.php'; ?>  
                        </div>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <div class="card">
                            <?php include 'server/ram.php'; ?>  
                        </div>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <div class="card">
                            <?php include 'server/swap.php'; ?>  
                        </div>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <div class="card">
                            <?php include 'server/trafficDisque.php'; ?>  
                        </div>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <div class="card">
                            <?php include 'server/trafficReseau.php'; ?>  
                        </div>
                    </div>       
                </div>
            </div>


            
            </div>
        </div>
    </div>
</body>
</html>