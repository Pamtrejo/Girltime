$(document).ready(function()
{
    readCompras();
})
const apiCompras = '../../core/api/carrito.php?site=commerce&action=';
function readCompras()
{
    $.ajax({
        url: apiCompras + 'readCompras',
        type: 'post',
        data: null,
        datatype: 'json'
    }).done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                let content = '';
                result.dataset.forEach(function(row){
                    content += `
                        <div class="col s12 m6 l3">
                            <div class="card hoverable">
                                <div class="card-image waves-effect waves-block waves-light">
                                    <img class="activator" src="../../resources/img/categorias/${row.imagen_categoria}">
                                </div>
                                <div class="card-content">
                                    <span class="card-title activator grey-text text-darken-4">${row.nombre_categoria}<i class="material-icons right">more_vert</i></span>
                                    <p class="center"><a href="#" onclick="readProductosCategoria(${row.id_categoria}, '${row.nombre_categoria}')" class="tooltipped  pink-text text-darken-2 " data-tooltip="Ver más"><i class="material-icons small ">import_contacts</i></a></p>
                                </div>
                                <div class="card-reveal">
                                    <span class="card-title grey-text text-pink darken-2">${row.nombre_categoria}<i class="material-icons right ">close</i></span>
                                    <p>${row.descripcion_categoria}</p>
                                </div>
                            </div>
                        </div>
                    `;
                });
                $('#title').text('Compras');
                $('#carrito').html(content);
                $('.tooltipped').tooltip();
            } else {
                $('#title').html('<i class="material-icons small">cloud_off</i><span class="red-text">' + result.exception + '</span>');
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}