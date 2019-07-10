$(document).ready(function(){
    $('.sidenav').sidenav();
    $('.modal').modal();
    setImageParallax();
});

function setImageParallax()
{
    let images = ['img01.jpg', 'img02.jpg', 'img03.jpg', 'img04.jpg', 'img05.jpg'];
    let element = Math.floor(Math.random() * images.length);
    $('#parallax').attr('src', '../../resources/img/parallax/' + images[element]);
    $('.parallax').parallax();
}
