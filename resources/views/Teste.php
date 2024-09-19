<style>

@import url('../css/effects.css');
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap');

body {
    background: rgb(0,0,0);
    display: flex;
    justify-content: center;
}
/*
.logo {
    width: 260px;
    height: 150px;
    cursor: pointer;
    background-size: cover;
    position: absolute;
    margin-top: 50px;
    float: left;
    background-image: url('https://i.imgur.com/uBr6bK2.png');
}
*/
.base {
    margin-top: 150px;
    float: left;
}
.base .filme {
    width: 200px;
    height: auto;
    background-color: white;
    padding: 10px;
    border-radius: 10px;
    transition: 0.1s ease-in-out;
    float: left;
    margin-left: 10px;
    margin-bottom: 40px;
    margin-top: 70px;
}

.base .filme img {
    image-rendering: optimizeSpeed;
    width: 100%;
    height: 200px;
    border-radius: 5px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.253);
    cursor: pointer;
}

.base .filme img:hover {
    border: 1px solid red;
}

.base .filme .nome {
    font-family: 'Poppins', sans-serif;
    text-align: center;
    margin-top: 15px;
    width: 180px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.base .filme .data {
    font-family: 'Poppins', sans-serif;
    text-align: center;
    margin-top: -10px;
}

.base .filme .data b{
    color: red;
}
/*
.base .filme img:hover + .imghover {
    width: 220px;
    height: 300px;
    background-color: rgba(0, 0, 0, 0.753);
    position: absolute;
    border-radius: 5px;
    color: rgb(255, 255, 255);
    text-shadow: -1px -1px 0px rgba(255, 255, 255, 0.459);
    font-family: 'Poppins', sans-serif;
    padding: 5px;
    text-align: center;
    margin-top: -300px;
}
*/
.base .filme .imghover span  {
    display: none;
}
.base .filme:hover .imghover span {
    display: block;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 13px;
    font-family: 'Poppins';
    transition: 0.6s ease-in-out;
}

/*
.copyright {
    width: 360px;
    height: 150px;
    background-size: cover;
    position: absolute;
    margin-top: 600px;
    float: left;
    font-family: 'Poppins', sans-serif;
    color: white;
}* /
/ *
.logo:hover {
    image-rendering: -moz-crisp-edges;image-rendering: pixelated;
	-webkit-animation-name: wobble-to-top-right;
	animation-name: wobble-to-top-right;
	-webkit-animation-duration: 1s;
	animation-duration: 1s;
	-webkit-animation-timing-function: ease-in-out;
	animation-timing-function: ease-in-out;
	-webkit-animation-iteration-count: 1;
	animation-iteration-count: 1;
	-webkit-filter: drop-shadow(1px 1px 0 white) drop-shadow(-2px 1px 0 white) drop-shadow(0 -2px 0 white);
}
*/
@-webkit-keyframes wobble-to-top-right {
	16.65% {
		-ms-transform: translate(8px, -8px);
		-webkit-transform: translate(8px, -8px);
    	transform: translate(8px, -8px);
	}
	33.3% {
	    -ms-transform: translate(-6px, 6px);
	    -webkit-transform: translate(-6px, 6px);
	    transform: translate(-6px, 6px);
  	}
	49.95% {
	    -ms-transform: translate(4px, -4px);
	    -webkit-transform: translate(4px, -4px);
	    transform: translate(4px, -4px);
  	}
  	66.6% {
	    -ms-transform: translate(-2px, 2px);
	    -webkit-transform: translate(-2px, 2px);
	    transform: translate(-2px, 2px);
  	}
	83.25% {
    	-ms-transform: translate(1px, -1px);
    	-webkit-transform: translate(1px, -1px);
		transform: translate(1px, -1px);
	}
	100% {
		-ms-transform: translate(0, 0);
		-webkit-transform: translate(0, 0);
		transform: translate(0, 0);
	}
}
@keyframes wobble-to-top-right {
  	16.65% {
  	    -ms-transform: translate(8px, -8px);
	    -webkit-transform: translate(8px, -8px);
	    transform: translate(8px, -8px);
  	}
  	33.3% {
  		-ms-transform: translate(-6px, 6px);
	    -webkit-transform: translate(-6px, 6px);
	    transform: translate(-6px, 6px);
  	}
  	49.95% {
  		-ms-transform: translate(4px, -4px);
	    -webkit-transform: translate(4px, -4px);
	    transform: translate(4px, -4px);
  	}
  	66.6% {
  		-ms-transform: translate(-2px, 2px);
	    -webkit-transform: translate(-2px, 2px);
	    transform: translate(-2px, 2px);
  	}
  	83.25% {
  		-ms-transform: translate(1px, -1px);
	    -webkit-transform: translate(1px, -1px);
	    transform: translate(1px, -1px);
  	}
  	100% {
  		-ms-transform: translate(0, 0);
	    -webkit-transform: translate(0, 0);
	    transform: translate(0, 0);
  	}
}

</style>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/icon.png?<?php echo time()?>" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/tt.css?<?php echo time()?>">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>AluraFlix: Aula | 04</title>
</head>
<body style="background-color: black;">
<!--
    <a class="logo" href="http://alura.com.br" target="_blank" rel="noopener noreferrer"> Teste </a>
    <script src="aula05.js"></script>
    <div class="copyright"><p>2024</p></div>
-->

</body>
</html>

<script>
    var listaImagens = []

listaImagens.push("https://upload.wikimedia.org/wikipedia/pt/thumb/6/69/The_Avengers_Cartaz.jpg/250px-The_Avengers_Cartaz.jpg")
listaImagens.push("https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcRTdpdUJXIxA1p7FGQrfU9bHQ-DZ1llewRwmIjzccBZKjmSYF8O")
listaImagens.push("https://i0.wp.com/www.nerdtrip.com.br/wp-content/uploads/2020/06/365-01.jpeg?resize=560%2C600&ssl=1")
listaImagens.push("https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQj8Wl8nuEnSYeZtvYhluedCRoCB_9mRkGfpFBELmxRqtghozmj")
listaImagens.push("https://upload.wikimedia.org/wikipedia/pt/c/cc/Step_Up.jpg")
listaImagens.push("https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQo1Os17YZIWCSQWO117qLvg7B4Vm1SPA22bYN5kXjSWzZPrExP")

listaImagens.push("https://upload.wikimedia.org/wikipedia/pt/thumb/6/69/The_Avengers_Cartaz.jpg/250px-The_Avengers_Cartaz.jpg")
listaImagens.push("https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcRTdpdUJXIxA1p7FGQrfU9bHQ-DZ1llewRwmIjzccBZKjmSYF8O")
listaImagens.push("https://i0.wp.com/www.nerdtrip.com.br/wp-content/uploads/2020/06/365-01.jpeg?resize=560%2C600&ssl=1")
listaImagens.push("https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQj8Wl8nuEnSYeZtvYhluedCRoCB_9mRkGfpFBELmxRqtghozmj")
listaImagens.push("https://upload.wikimedia.org/wikipedia/pt/c/cc/Step_Up.jpg")
listaImagens.push("https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQo1Os17YZIWCSQWO117qLvg7B4Vm1SPA22bYN5kXjSWzZPrExP")

var listaNomes = []

listaNomes.push("Avengers", "To All the Boys I've Loved Before", "365 DNI", "Twilight", "Step Up", "Black Widow")

var genero = []

genero.push("Aventura/Ação", "Romance/Adolescente", "Romance/Drama", "Romance/Fantasia", "Dança/Musical", "Ação/Aventura")


var ids = []

ids.push("1", "2", "3", "4", "5", "6")

var trailers = []

trailers.push("https://www.youtube.com/embed/eOrNdBpGMv8", "https://www.youtube.com/embed/555oiY9RWM4", "https://www.youtube.com/embed/h89OcmbNydA", "https://www.youtube.com/embed/uxjNDE2fMjI", "https://www.youtube.com/embed/DgZvrCY5-2Y", "https://www.youtube.com/embed/RxAtuMu_ph4")

var hora = []

hora.push("2h 24m", "1h 39m", "1h 56m", "2h 6m", "1h 44m", "2h 13m")

var desde = []

desde.push("<b>2012</b> á 2019", "<b>2018</b> á 2021", "<b>2020</b>", "<b>2008</b> à 2012", "<b>2006</b> à 2014", "<b>2021</b>")

var img = document.querySelector("#filmes");
for (var i = 0; i < listaImagens.length; i++){
    document.write("<div class='base' id='filmes'><div class='filme'><img data-toggle='modal' data-target='#"+ids[i]+"' src=" + listaImagens[i]+ "><p class='nome'>"+ listaNomes[i] + "</p><p class='data'>Desde de " + desde[i]+ "<div class='imghover'><div class='info'><span>"+ genero[i] + "</span><span>Duração: "+ hora[i] + "</span></div></div></div></div><div class='modal fade' id='"+ids[i]+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'><div class='modal-dialog modal-dialog-centered' role='document'><div class='modal-content'><div class='modal-body'><iframe style='border-radius: 10px;' width='100%' height='320' src="+ trailers[i] +" title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe></div></div></div></div>")
}

</script>