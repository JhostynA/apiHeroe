<!DOCTYPE html>
<html lang="en">
<head>
    <title>Estadísticas de Superhéroes</title>
    <meta charset="utf-8" />
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
    />
</head>

<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <h3 class="text-center">Selecciona el Publisher</h3>
            <form action="" id="publisherForm" autocomplete="off">
                <div class="mb-3">
                    <label for="publisherSelect" class="form-label">Publisher</label>
                    <select class="form-select" aria-label="Selecciona un Publisher" id="publisherSelect">
                    </select>
                </div>
            </form>
        </div>
        <div class="col-md-8">
            <h3 class="text-center">Estadísticas</h3>
            <div style="width: 100%; margin: auto;">
                <canvas id="estadisticaSP"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        function getById(id) {
            return document.querySelector(id);
        }

        const chartCanvas = getById("#estadisticaSP");
        const estadisticaSP = new Chart(chartCanvas, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: "Bandos",
                    data: []
                }]
            }
        });

        (function () {
            fetch(`../controller/publisher.controller.php?operacion=listarPublishers`)
                .then(response => response.json())
                .then(data => {
                    let opLP;
                    data.forEach(art => {
                        opLP = document.createElement("option");
                        opLP.value = art.id;
                        opLP.innerHTML = art.publisher_name;
                        getById("#publisherSelect").appendChild(opLP);
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        })();

        const formH = () => {
            const formD = new FormData();
            formD.append("operacion", "listarBandosP");
            formD.append("id", getById("#publisherSelect").value);

            fetch(`../controller/alignment-controller.php`, {
                method: "POST",
                body: formD
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    estadisticaSP.data.labels = data.map(band => band.nombre_bando);
                    estadisticaSP.data.datasets[0].data = data.map(band => band.superheroe);
                    estadisticaSP.data.labels[[2]] = "NA";
                    estadisticaSP.update();
                })
                .catch(error => {
                    console.error(error);
                });
        };

        getById("#publisherSelect").addEventListener("change", () => {
            formH();
        });

    });
</script>
</body>
</html>
