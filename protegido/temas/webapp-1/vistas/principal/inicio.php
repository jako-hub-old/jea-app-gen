<div class="row">
    <div class="col-sm-8">
        <!-- Panel 1 -->
        <div class="panel panel-default">
            <div class="panel-body">
                <textarea class="form-control" placeholder="¿Qué haces?"></textarea>
            </div>
            <div class="panel-footer">
                <div class="row">                    
                    <div class="col-sm-8">
                        <div class="btn-toolbar">
                            <div class="btn-group">
                                <?php echo CBoot::boton(CBoot::fa('camera')); ?>
                                <?php echo CBoot::boton(CBoot::fa('video-camera')); ?>
                                <?php echo CBoot::boton(CBoot::fa('microphone')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 text-right">
                        <?php echo CBoot::boton(CBoot::fa('send') . ' Publicar', 'success'); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Panel 2 -->
        <div class="panel panel-default">
            <div class="panel-heading">Últimos post</div>
            <div class="panel-body">
                <div class="media">
                    <div class="media-left media-middle">
                        <a href="#">
                            <img width="32px" class="media-object" src="<?php echo Sistema::apl()->tema->getUrlBase() . '/imgs/photo1.png'; ?>" alt="...">
                        </a>
                        <p class="text-center">Jako</p>
                    </div>
                    <div class="media-body">
                      <h4 class="media-heading">Publicación de ejemplo</h4>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veni...                        
                        <p class="text-center"><a href="#">Leer más..</a></p>
                    </div>
                </div>
                <div class="media">
                    <div class="media-left media-middle">
                        <a href="#">
                            <img width="32px" class="media-object" src="<?php echo Sistema::apl()->tema->getUrlBase() . '/imgs/photo1.png'; ?>" alt="...">
                        </a>
                        <p class="text-center">Jako</p>
                    </div>
                    <div class="media-body">
                      <h4 class="media-heading">Publicación de ejemplo</h4>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veni...                        
                        <p class="text-center"><a href="#">Leer más..</a></p>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row">                    
                    <div class="col-sm-4 col-sm-offset-4">
                        <?php echo CBoot::boton(CBoot::fa('eye') . ' Ver todos', 'default btn-block'); ?>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">Grafico 1</div>
            <div class="panel-body">
                <canvas id="graph-1"></canvas>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Grafico 1</div>
            <div class="panel-body">
                <canvas id="graph-2"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
    var data = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
        {
            label: "Line 2",
            fill: true,
            backgroundColor: "rgba(100,50,86,0.4)",
            borderColor: "rgba(100,50,86,1)",
            pointBorderColor: "rgba(255,205,86,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(255,205,86,1)",
            pointHoverBorderColor: "rgba(255,205,86,1)",
            pointHoverBorderWidth: 2,
            // The actual data
            data: [10, 59, 55, 60, 56, 55, 40],
        },
        {
            label: "Line 2",
            fill: true,
            backgroundColor: "rgba(255,205,86,0.4)",
            borderColor: "rgba(255,205,86,1)",
            pointBorderColor: "rgba(255,205,86,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(255,205,86,1)",
            pointHoverBorderColor: "rgba(255,205,86,1)",
            pointHoverBorderWidth: 2,
            data: [28, 48, 40, 19, 50, 27]
        }
    ]
};
    var ctx = document.getElementById("graph-1").getContext("2d");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: data,
    });
    
    var data2 = {
    labels: [
        "Red",
        "Green",
        "Yellow"
    ],
    datasets: [
        {
            data: [300, 50, 100],
            backgroundColor: [
                "#FF6384",
                "#36A2EB",
                "#FFCE56"
            ],
            hoverBackgroundColor: [
                "#FF6384",
                "#36A2EB",
                "#FFCE56"
            ]
        }]
};
    var ctx2 = document.getElementById("graph-2").getContext("2d");
    var myPieChart = new Chart(ctx2,{
        type: 'pie',
        data: data2,
    });
    
</script>