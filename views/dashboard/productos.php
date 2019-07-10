<?php
require_once('../../core/helpers/dashboard.php');
Dashboard::headerTemplate('Administrar productos');
?>
<div class="row">
    <!-- Formulario de búsqueda -->
    <form method="post" id="form-search">
        <div class="input-field col s6 m4">
            <i class="material-icons prefix pink-text text-darken-2 ">search</i>
            <input id="buscar" type="text" name="busqueda"/>
            <label for="buscar">Buscador</label>
        </div>
        <div class="input-field col s6 m4">
            <button type="submit" class="btn waves-effect pink tooltipped  " data-tooltip="Buscar"><i class="material-icons">check_circle</i></button>
        </div>
    </form>
    <!-- Botón para abrir ventana de nuevo registro -->
    <div class="input-field center-align col s12 m4">
        <a href="#modal-create" class="btn waves-effect black tooltipped modal-trigger" data-tooltip="Agregar"><i class="material-icons">add_circle</i></a>
    </div>
</div>
<!-- Tabla para mostrar los registros existentes -->
<table class="highlight">
    <thead>
        <tr>
            <th>IMAGEN</th>
			<th>NOMBRE</th>
			<th>PRECIO (US$)</th>
            <th>MARCA</th>
			<th>CATEGORÍA</th>
			<th>ESTADO</th>
			<th>ACCIÓN</th>
        </tr>
    </thead>
    <tbody id="tbody-read">
    </tbody>
</table>
<!-- Ventana para crear un nuevo registro -->
<div id="modal-create" class="modal">
    <div class="modal-content">
        <h4 class="center-align">Crear producto</h4>
        <form method="post" id="form-create" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col s12 m6">
                  	<i class="material-icons prefix">note_add</i>
                  	<input id="create_nombre" type="text" name="create_nombre" class="validate" required/>
                  	<label for="create_nombre">Nombre</label>
                </div>
                <div class="input-field col s12 m6">
                    <select id="create_marca" name="create_marca">
                    </select>
                </div>
                <div class="input-field col s12 m6">
                  	<i class="material-icons prefix">shopping_cart</i>
                  	<input id="create_precio" type="number" name="create_precio" class="validate" max="999.99" min="0.01" step="any" required/>
                  	<label for="create_precio">Precio ($)</label>
                </div>
                <div class="input-field col s12 m6">
                  	<i class="material-icons prefix">description</i>
                  	<input id="create_descripcion" type="text" name="create_descripcion" class="validate" required/>
                  	<label for="create_descripcion">Descripción</label>
                </div>
                <div class="input-field col s12 m6">
                    <select id="create_categoria" name="create_categoria">
                    </select>
                </div>
              	<div class="file-field input-field col s12 m6">
                    <div class="btn waves-effect pink">
                        <span><i class="material-icons pink">image</i></span>
                        <input id="create_archivo" type="file" name="create_archivo" required/>
                    </div>
                    <div class="file-path-wrapper">
                        <input type="text" class="file-path validate" placeholder="Seleccione una imagen de 500x500"/>
                    </div>
                </div>
                <div class="col s12 m6">
                    <p>
                        <div class="switch">
                            <span>Estado:</span>
                            <label>
                                <i class="material-icons ">visibility_off</i>
                                <input id="create_estado" type="checkbox" name="create_estado" checked/>
                                <span class="lever pink"></span>
                                <i class="material-icons">visibility</i>
                            </label>
                        </div>
                    </p>
                </div>
            </div>
            <div class="row center-align">
                <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                <button type="submit" class="btn waves-effect pink tooltipped" data-tooltip="Crear"><i class="material-icons">save</i></button>
            </div>
        </form>
    </div>
</div>
<!-- Ventana para modificar un registro existente -->
<div id="modal-update" class="modal">
    <div class="modal-content">
        <h4 class="center-align">Modificar producto</h4>
        <form method="post" id="form-update" enctype="multipart/form-data">
            <input type="hidden" id="id_producto" name="id_producto"/>
            <input type="hidden" id="imagen_producto" name="imagen_producto"/>
            <div class="row">
                <div class="input-field col s12 m6">
                  	<i class="material-icons prefix">note_add</i>
                  	<input id="update_nombre" type="text" name="update_nombre" class="validate" required/>
                  	<label for="update_nombre">Nombre</label>
                </div>
                <div class="input-field col s12 m6">
                    <select id="update_marca" name="update_marca">
                    </select>
                </div>
                <div class="input-field col s12 m6">
                  	<i class="material-icons prefix">shopping_cart</i>
                  	<input id="update_precio" type="number" name="update_precio" class="validate" min="0.01" max="999.99" step="any" required/>
                  	<label for="update_precio">Precio ($)</label>
                </div>
                <div class="input-field col s12 m6">
                  	<i class="material-icons prefix">description</i>
                  	<input id="update_descripcion" type="text" name="update_descripcion" class="validate" required/>
                  	<label for="update_descripcion">Descripción</label>
                </div>
                <div class="input-field col s12 m6">
                    <select id="update_categoria" name="update_categoria">
                    </select>
                </div>
              	<div class="file-field input-field col s12 m6">
                    <div class="btn waves-effect pink">
                        <span><i class="material-icons white-text">image</i></span>
                        <input id="update_archivo" type="file" name="update_archivo"/>
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate " type="text" placeholder="Seleccione una imagen de 500x500"/>
                    </div>
                </div>
                <div class="col s12 m6">
                    <p>
                        <div class="switch">
                            <span>Estado:</span>
                            <label>
                                <i class="material-icons">visibility_off</i>
                                <input id="update_estado" type="checkbox" name="update_estado"/>
                                <span class="lever pink"></span>
                                <i class="material-icons">visibility</i>
                            </label>
                        </div>
                    </p>
                </div>
            </div>
            <div class="row center-align">
                <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                <button type="submit" class="btn waves-effect pink tooltipped" data-tooltip="Modificar"><i class="material-icons">save</i></button>
            </div>
        </form>
    </div>
</div>
<?php
Dashboard::footerTemplate('productos.js');
?>
