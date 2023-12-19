<!DOCTYPE html>
<html lang="es">
<head>
    <title>Alistar Heroes</title>
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
<div class="container">
    <div class="alert alert-warning mt-3">
        <h5>Alistar héroes</h5>
        <span> Complete la información solicitada</span>
    </div>

    <form action="" id="formpublisher" autocomplete="off">
        <div class="mb-3">
            <label for="publisher_name" class="form-label">Publisher</label>
            <select name="publisher_name" id="publisher_name" class="form-select">
                <option value="">Seleccione</option>
            </select>
        </div>
    </form>

    <div class="mt-3">
        <h5>Héroes del Publisher</h5>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Nombre completo</th>
                <th>Género</th>
                <th>Raza</th>
            </tr>
            </thead>
            <tbody id="heroes_table_body">
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        function $(id) {
            return document.querySelector(id)
        }

        (function () {
            fetch(`../controller/publisher.controller.php?operacion=listar`)
                .then(respuesta => respuesta.json())
                .then(datos => {
                    datos.forEach(element => {
                        const Poption = document.createElement("option")
                        Poption.value = element.id
                        Poption.innerHTML = element.publisher_name
                        $("#publisher_name").appendChild(Poption)
                    });

                })
                .catch(e => {
                    console.error(e)
                })
        })();
        $("#publisher_name").addEventListener("change", () => {
            const selectedPublisherId = $("#publisher_name").value;

            if (selectedPublisherId !== "") {
                fetch(`../controller/publisher.controller.php?operacion=listarHeroes&publisher_id=${selectedPublisherId}`)
                    .then(respuesta => respuesta.json())
                    .then(heroes => {
                        $("#heroes_table_body").innerHTML = "";

                        heroes.forEach(hero => {
                            const row = document.createElement("tr");
                            row.innerHTML = `
                                <td>${hero.id}</td>
                                <td>${hero.superhero_name}</td>
                                <td>${hero.full_name}</td>
                                <td>${hero.gender}</td>
                                <td>${hero.race}</td>
                            `;
                            $("#heroes_table_body").appendChild(row);
                        });
                    })
                    .catch(e => {
                        console.error(e)
                    })
            } else {
                $("#heroes_table_body").innerHTML = "";
            }
        });
    });
</script>

</body>

</html>
