<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="resources/js/vue.global.js"></script>
    
    <script src="resources/js/bootstrap.min.js"></script>
    <script src="resources/js/axios.min.js"></script>
    
    <link href="resources/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
	
	<header class="bg-dark d-flex align-items-center justify-content-between p-3">
		<h1 class="m-0 text-white" style="font-size: 30px;">DigiSync</h1>
		<img src="resources/img/img.png" height="57px">
	</header>
	
	<div class="container-fluid" style="min-height: calc(100vh - 57px); background: linear-gradient(to right, #87bdd8, #d5f4e6, #fefbd8);" >
		<div class="row">

			<!-- Left side (log) -->
			<div class="col-12 col-md-6" id="appSync">
                <?php include 'soft/clients.php'; ?>
            </div>

			<!-- right side (server) -->
			<div class="col-12 col-md-6" >
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
		<script src="resources/js/echarts.js"></script>
	    <script src="resources/js/monitoring.js"></script>
</body>
</html>