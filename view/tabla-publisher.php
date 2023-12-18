<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Var casas de publicaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
</head>
<body>
   
    <div class="container">
        <div class="alert alert-success mt-3">
            <h5>Buscador por casa de auditoria</h5>
        </div>

        <div class="mb-3">
            <label for="publisher_name" class="form-label">Publisher</label>
            <select name="publisher_name" id="publisher_name" class="form-select">
                <option value="">Seleccione</option>
            </select>
        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () =>{

            function $(id) {return document.querySelector(id)}

            (function (){
            fetch(`../controller/publisher.controller.php?operacion=listar`)
                .then(respuesta => respuesta.json())
                .then(datos =>{
                console.log(datos)
                
                datos.forEach(element => {
                    const Poption = document.createElement("option")
                    Poption.value = element.id
                    Poption.innerHTML = element.publisher_name
                    $("#publisher_name").appendChild(Poption)
                });

                })
                .catch(e =>{
                console.error(e)
                })
            })();
        })   
    </script>

</body>
</html>
