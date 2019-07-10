$(document).ready(function()
{
    let today = new Date();
	let hour = today.getHours();
    if (hour < 12) {
        greeting = 'Buenos días';
    } else if (hour < 19) {
        greeting = 'Buenas tardes';
    } else if (hour <= 23) {
        greeting = 'Buenas noches';
    }
    // Se muestra un saludo dependiendo de la hora del cliente
    $('#greeting').text(greeting);
    // Se muestra un gráfico
    graficoCategorias();
    graficoMarcas();
    graficoTres();
    graficoCuatro();
    graficoCinco();
})

// Constante para establecer la ruta y parámetros de comunicación con la API
const api = '../../core/api/dashboard/productos.php?action=';

// Función para generar un gráfico de la cantidad de productos por categoría
function graficoCategorias()
{
    $.ajax({
        url: api + 'cantidadProductosCategoria',
        type: 'post',
        data: null,
        datatype: 'json'
    })
    .done(function(response){
        // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            // Se comprueba que no hay usuarios registrados para redireccionar al registro del primer usuario
            if (result.status) {
                let categorias = [];
                let cantidad = [];
                result.dataset.forEach(function(row){
                    categorias.push(row.nombre_categoria);
                    cantidad.push(row.cantidad);
                });
                const context = $('#chart');
                const chart = new Chart(context, {
                    type: 'line',
                    data: {
                        labels: categorias,
                        datasets: [{
                            label: 'Cantidad de productos',
                            data: cantidad,
                            backgroundColor: 'rgba(189, 155, 192, 0.6)',
                            borderColor: 'rgba(94, 26, 100, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Cantidad de productos por categoría'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    stepSize: 1
                                }
                            }]
                        }
                    }
                });
            } else {
                $('#chart').remove();
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        // Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

// Función para generar un gráfico de marca
function graficoMarcas()
{
    $.ajax({
        url: api + 'ProductosporMarca',
        type: 'post',
        data: null,
        datatype: 'json'
    })
    .done(function(response){
        // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            // Se comprueba que no hay usuarios registrados para redireccionar al registro del primer usuario
            if (result.status) {
                let marca = [];
                let cantidad = [];
                result.dataset.forEach(function(row){
                    marca.push(row.marca);
                    cantidad.push(row.cantidad);
                });
                const context = $('#chart2');
                const chart = new Chart(context, {
                    type: 'bar',
                    data: {
                        labels: marca,
                        datasets: [{
                            label: 'Marcas por producto',
                            data: cantidad,
                            backgroundColor: 'rgba(189, 155, 192, 0.6)',
                            borderColor: 'rgba(94, 26, 100, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Productos por marca'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    stepSize: 1
                                }
                            }]
                        }
                    }
                });
            } else {
                $('#chart2').remove();
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        // Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

function graficoTres()
{
    $.ajax({
        url: api + 'MontoporCategoria',
        type: 'post',
        data: null,
        datatype: 'json'
    })
    .done(function(response){
        // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            // Se comprueba que no hay usuarios registrados para redireccionar al registro del primer usuario
            if (result.status) {
                let categorias = [];
                let cantidad = [];
                result.dataset.forEach(function(row){
                    categorias.push(row.nombre_categoria);
                    cantidad.push(row.cantidad);
                });
                const context = $('#chart3');
                const chart = new Chart(context, {
                    type: 'bar',
                    data: {
                        labels: categorias,
                        datasets: [{
                            label: 'Monto($)',
                            data: cantidad,
                            backgroundColor: 'rgba(189, 155, 192, 0.6)',
                            borderColor: 'rgba(94, 26, 100, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Monto de venta por categoria'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                        
                                }
                            }]
                        }
                    }
                });
            } else {
                $('#chart3').remove();
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        // Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

function graficoCuatro()
{
    $.ajax({
        url: api + 'MontosporMarca',
        type: 'post',
        data: null,
        datatype: 'json'
    })
    .done(function(response){
        // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            // Se comprueba que no hay usuarios registrados para redireccionar al registro del primer usuario
            if (result.status) {
                let categorias = [];
                let cantidad = [];
                result.dataset.forEach(function(row){
                    categorias.push(row.marca);
                    cantidad.push(row.cantidad);
                });
                const context = $('#chart4');
                const chart = new Chart(context, {
                    type: 'bar',
                    data: {
                        labels: categorias,
                        datasets: [{
                            label: 'Monto($)',
                            data: cantidad,
                            backgroundColor: 'rgba(189, 155, 192, 0.6)',
                            borderColor: 'rgba(94, 26, 100, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Monto de ventas por marca'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                
                                }
                            }]
                        }
                    }
                });
            } else {
                $('#chart4').remove();
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        // Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}

function graficoCinco()
{
    $.ajax({
        url: api + 'VentaporFecha',
        type: 'post',
        data: null,
        datatype: 'json'
    })
    .done(function(response){
        // Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            // Se comprueba que no hay usuarios registrados para redireccionar al registro del primer usuario
            if (result.status) {
                let categorias = [];
                let cantidad = [];
                result.dataset.forEach(function(row){
                    categorias.push(row.fecha);
                    cantidad.push(row.cantidad);
                });
                const context = $('#chart5');
                const chart = new Chart(context, {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            label: 'Venta',
                            data: cantidad,
                            backgroundColor: 'rgba(189, 155, 192, 0.6)',
                            borderColor: 'rgba(94, 26, 100, 1)',
                            borderWidth: 1
                        }],
                        labels: categorias,
                    },
                    options: {
                        
                        title: {
                            display: true,
                            text: 'Venta de los ultimos 3 dias'
                        },
                        
                    }
                });
            } else {
                $('#chart5').remove();
            }
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        // Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}