$(document).ready(function()
{
    $('.slider').slider();    
    readPreDetalle();
})

//Función para obtener y mostrar los preDetalles
function readPreDetalle()
{
    $.ajax({
        url: apiCatalogo + 'readPreDetalle',
        type: 'post',
        data: null,
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                let content = '';
                let label= '';
                let divTotal='';
                let totalVenta = 0;
                result.dataset.forEach(function(row){
                    var subtotal=parseFloat(row.total).toFixed(2);
                    content += `
                    <div class="row">
                    <div class="card horizontal hoverable">                   
                    <input id="idPDetalle" type="hidden" name="idPDetalle" value="${row.idPreDetalle}"/>                
                        <!--Definicion de la tajeta horizontal-->
                        <div class="card-image">
                            <img src="../../resource/img/productos/${row.foto}">
                            <!--Imagen de la tarjeta-->
                        </div>
                        <div class="card-stacked">
                            <div class="card-content">
                                <!--Contenido de la tarjeta-->
                                <strong>
                                    <h5>${row.producto}
                                        <strong>
                                    </h5>
                                    <strong>
                                        <h5>Cantidad: ${row.cantidad}
                                            <strong>
                                        </h5>
                                        <strong>
                                            <h5>Precio Unitario($): ${row.precio}
                                                <strong>
                                            </h5>
                                            <strong>
                                                <h5>Precio Total($): ${row.total}
                                                    <strong>
                                                </h5>
                                                             
                                    <button  class="btn waves-effect waves-light btn red" 
                                        name="action" onclick="confirmDelete(${row.idPreDetalle})">Eliminar
                                        <i class="material-icons right">delete</i>
                                    </button>                                    
                                </div>
                            </div>
                        </div>                
                    </div>                
                    `;
                    totalVenta= parseFloat(subtotal)+ parseFloat(totalVenta);
                });
                lblTotal=parseFloat(totalVenta).toFixed(2);

                divTotal += `
                <div class="col s12 m12 l3">
                    <div class="card light-blue darken-2 hoverable">
                        <!--Definicion de la tajeta para pagar-->
                        <div class="card-content white-text">
                            <!--Contenido de la tarjeta-->
                            <span class="card-title">MakaStore</span>
                            
                            <h5>Total a pagar($): ${lblTotal}</h5>
                        </div>
                        <div class="card-action center">
                            <!--Boton para pagar-->
                            <button onclick="pagar()" class="btn waves-effect green tooltipped" data-tooltip="Pagar" id="realizarVenta">
                            <i class="material-icons">check</i>
                        </button>
                        </div>
                    </div>
                </div>
                `;
                                
                $('#title').text('Nuestro catálogo');
                $('#busquedaProducto').html(null);                
                $('#barraBusqueda').html(null);
                $('#detalleVenta').html(content);
                $('#total').html(divTotal);
                $('.tooltipped').tooltip();
            } else {
                /* $('#title').html('<i class="material-icons small">cloud_off</i><span class="red-text">' + result.exception + '</span>'); */
                sweetAlert(2, result.exception, 'index.php');
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

function modalCantidad(id)
{
    $.ajax({
        url: apiCatalogo + 'getPre',
        type: 'post',
        data:{
            idPreDetalle: id,                        
        },
        datatype: 'json'
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio para mostrar los valores en el formulario, sino se muestra la excepción
            if (result.status) {
                $('#form-cantidadC')[0].reset();
                $('#idPre').val(id);                                                                     
                M.updateTextFields();
                $('#modalCantidad').modal('open');                
            } else {
                sweetAlert(2, result.exception, null);
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

//Funcion para agregar cantidad de producto
$('#form-cantidadC').submit(function()
{
    event.preventDefault();
    $.ajax({
        url: apiCatalogo + 'updateCantidadPre',
        type: 'post',
        data: new FormData($('#form-cantidadC')[0]),
        datatype: 'json',
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                $('#modalCantidad').modal('close');
                if (result.status == 1) {
                    sweetAlert(1, 'Cantidad agregada correctamente', null);
                } else if(result.status == 2) {
                    sweetAlert(3, 'Cantidad agregada. ' + result.exception, null);
                } else {
                    sweetAlert(1, 'Cantidad modificada. ' + result.exception, null);
                }
                readPreDetalle();
            } else {
                sweetAlert(2, result.exception, null);
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
})


//Función para eliminar un registro seleccionado
function confirmDelete(id)
{
    swal({
        title: 'Advertencia',
        text: '¿Quiere eliminar el producto?',
        icon: 'warning',
        buttons: ['Cancelar', 'Aceptar'],
        closeOnClickOutside: false,
        closeOnEsc: false
    })
    .then(function(value){
        if (value) {
            $.ajax({
                url: apiCatalogo + 'deletePre',
                type: 'post',
                data:{
                    idPreDetalle: id,                    
                },
                datatype: 'json'
            })
            .done(function(response){
                //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
                if (isJSONString(response)) {
                    const result = JSON.parse(response);
                    //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                    if (result.status) {
                        if (result.status == 1) {
                            sweetAlert(1, 'Producto eliminado correctamente', null);
                        } else {
                            sweetAlert(3, 'Producto eliminado. ' + result.exception, null);
                        }                                                  
                        readPreDetalle();
                    } else {
                        sweetAlert(2, result.exception, null);
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
    });
}

/* $("#realizarVenta").on("click",function(){ */
    function pagar(){    
    $.ajax({
        url: apiCatalogo + 'createSale',
        type: 'post',
        data: null,
        datatype: 'json',
    })
    .done(function(response){
        //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
            if (result.status) {
                if (result.status == 1) {
                    sweetAlert(1, 'Venta procesada correctamente', 'index.php');
                } else if(result.status == 2) {
                    sweetAlert(3, 'Venta procesada. ' + result.exception, 'index.php');
                } else {
                   sweetAlert(1, 'Venta procesada. ' + result.exception, 'index.php');
                }
            } else {
                sweetAlert(2, result.exception, null);
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


