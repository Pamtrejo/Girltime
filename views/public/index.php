<?php
require_once('../../core/helpers/Commerce.php');
Commerce::headerTemplate('Tu tienda de belleza');
?>
<!-- Slider con indicadores y altura de 400px -->
<div class="slider" id="slider">
    <ul class="slides">
        <li>
            <img src="../../resources/img/slider/img01.jpg" alt="Foto01">
            <div class="caption center-align">
                <h2></h2>
                <h4 class="white-text"></h4>
            </div>
        </li>
        <li>
            <img src="../../resources/img/slider/img02.jpg" alt="Foto02">
            <div class="caption left-align">
                <h2></h2>
                <h4></h4>
            </div>
        </li>
        <li>
            <img src="../../resources/img/slider/img03.jpg" alt="Foto03">
            <div class="caption right-align">
                <h2></h2>
                <h4 class="white-text">.</h4>
            </div>
        </li>
        <li>
            <img src="../../resources/img/slider/img04.jpg" alt="Foto04">
            <div class="caption center-align">
                <h2></h2>
                <h4 class="white-text"></h4>
            </div>
        </li>
    </ul>
</div>


<!-- Contenido principal: categorías, productos por categoría y detalles del producto -->
<div class=" pink lighten-5">
<div class="container pink lighten-5">
    <h4 class="center pink-text letras" id="title"></h4>
    <div class="row" id="catalogo"></div>
</div>
</div>

<!-- Efecto parallax con una altura de 300px -->
<div class="parallax-container">
	<div class="parallax">
        <img id="parallax">
    </div>
</div>
<?php
Commerce::footerTemplate('catalogo.js');
?>
