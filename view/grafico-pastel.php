
<!-- NO TERMINADO --> 

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafico Pastel</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous"
    />
</head>
<body>

    <div class="container">
        <div class="alert alert-warning mt-3">
            <h5>Alistar héroes</h5>
        </div>

        <form action="" id="formpublisher" autocomplete="off">
            <div class="mb-3">
                <label for="publisher_name" class="form-label">Publisher</label>
                <select name="publisher_name" id="publisher_name" class="form-select">
                    <option value="">Seleccione</option>
                </select>
            </div>
        </form>

        <div class="mt-4">
            <canvas id="grafiPastel" width="400" height="200"></canvas>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            function $(id){
                return document.querySelector(id);
            }

            (function () {
                fetch(`../controller/publisher.controller.php?operacion=listar`)
                    .then(respuesta => respuesta.json())
                    .then(datos => {
                        datos.forEach(element => {
                            const Poption = document.createElement("option");
                            Poption.value = element.id;
                            Poption.innerHTML = element.publisher_name;
                            $("#publisher_name").appendChild(Poption);
                        });
                    })
                    .catch(e => {
                        console.error(e);
                    });
            })();

            const grafiPastel = new Chart($("#grafiPastel").getContext("2d"),{
                type: "pie",
                data: {
                    labels: [],
                    datasets: [{
                        data: [],
                        backgroundColor: [
                            "#FF6384",
                            "#36A2EB",
                            "#FFCE56",
                            "#4CAF50",
                            "#FF9800",
                            "#9C27B0",
                            "#795548",
                        ],
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                },
            });

            function PieChart(data){
                grafiPastel.data.labels = data.map(item => item.publisher_name);
                grafiPastel.data.datasets[0].data = data.map(item => item.total_heroes)
                total_heroes.update();
            }

            $("#publisher_name").addEventListener("change", ()=>{
                const selePubliId = $("#publisher_name").value;
                if(selePubliId) {
                    fetch(`../controller/publisher.controller.php?operacion=listarHeroes&publisher_id=${selePubliId}`)
                        .then(respuesta => respuesta.json())
                        .then(data => {
                            PieChart(data);
                        })
                        .catch(e => {
                            console.error(e);
                        });
                }
            });
        });
    </script>
    
</body>
</html>