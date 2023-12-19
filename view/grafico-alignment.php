<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de Alignment</title>
</head>
<body>
    <div style="width: 70%; margin: auto;">
        <canvas id="lienzo"></canvas>
    </div>
    
    <table border="1" style="width: 70%; margin: auto; margin-top: 20px;">
        <thead>
            <tr>
                <th>Alignment</th>
                <th>Cantidad de Heroes</th>
            </tr>
        </thead>
        <tbody id="tabla-body"></tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const contexto = document.querySelector("#lienzo");
        const tablaBody = document.querySelector("#tabla-body");

        const grafico = new Chart(contexto, {
            type: 'bar',
            data: {
                labels: [],
                datasets:[{
                    label: "Resumen de Alignment",
                    data: []
                }]
            }
        });

        (function(){
            fetch(`../controller/alignment-controller.php?operacion=getResumenAlignment`)
                .then(respuesta => respuesta.json())
                .then(datos =>{
                    grafico.data.labels = datos.map(registro => registro.alignment);
                    grafico.data.datasets[0].data = datos.map(registro => registro.total);
                    grafico.update();

                    datos.forEach(registro => {
                  const fila = document.createElement("tr");
                  const celdaAlignment = document.createElement("td");
                  const celdaCantidad = document.createElement("td");

                  celdaAlignment.textContent = registro.alignment;
                  celdaCantidad.textContent = registro.total;

                  fila.appendChild(celdaAlignment);
                  fila.appendChild(celdaCantidad);

                  tablaBody.appendChild(fila);
                });
                })
                .catch(e => {
                    console.error(e);
                });
        })();

    </script>

</body>
</html>