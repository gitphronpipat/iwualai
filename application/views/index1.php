<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include"include/function.php";
        css_function();
        ?>
    </head>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

    <style>
      @import "https://fonts.googleapis.com/css?family=Raleway";

* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: Mulish, sans-serif;
    transition: all 0.3s ease-in-out;
}

.container {
    height: 100vh;
    width: 100%;
    display: flex;
    align-items: stretch;
    align-content: space-around;
}

.box {
    flex: 1;
    color: #fff;
    display: flex;
    align-content: center;
    align-items: center;
    flex-flow: wrap;
    overflow: hidden;
    cursor: pointer;
}

.box:hover {
    flex-grow: 2;
}
.box a{
  text-align: center;
  color: #fff;
  text-decoration: none;
  font-weight: 800;
}
.box  h2 {
    color: #fff;
    margin: auto;
    font: 900 2vw/45px Mulish;
    text-shadow: -1px 1px 1px rgba(0, 0, 0, 0.5);
}

.box p {
    font: 100 14px/29px Mulish;
    color: #ecf0f1;
    text-align: center;
    width: 90%;
    margin: auto;
    text-shadow: -1px 1px 1px rgba(0, 0, 0, 0.2);
}

.box:first-of-type {
    background: linear-gradient(to top, rgb(28 28 28), rgb(164 164 164 / 23%)), url(images/1.jpg) no-repeat center;
    background-size: cover;
}

.box:nth-of-type(2) {
    background: linear-gradient(to top,
        rgba(127, 140, 141, 1),
        rgba(127, 140, 141, 0.7)),
        url("images/2.jpg") no-repeat center;
    background-size: cover;
}

.box:nth-of-type(3) {
    background: linear-gradient(to top,
        rgba(44, 62, 80, 1),
        rgba(44, 62, 80, 0.7)),
        url("images/3.jpg") no-repeat center;
    background-size: cover;
}

@media screen and (max-width: 600px) {
    h2 {
        font-size: 30px !important;
    }

 

    .container {
    height: 100vh;
    width: 100%;
    display: flex;
    align-items: stretch !important;
    align-content: space-around !important;
    flex-direction: column !important;

    }

    .box {
        display: flex;
        width: 100%;
        height: 25vh;
    }
}










    </style>
  <body>
  <div class="container">
  
    <div class="box" >
    <h2><a href="https://chiangmaizone.net/iwualai/"><span style="color: #ff0100;">i</span>Silver Hotel</a></h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisic- ing elit</p>
  </div>


  <div class="box" >
    <h2><a href="https://chiangmaizone.net/iwualai/"><span style="color: #ff0100;">i</span>Wualai Hotel</a></h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisic- ing elit</p>
  </div>

  <div class="box" >
    <h2><a href="https://chiangmaizone.net/iwualai/"><span style="color: #ff0100;">i</span>Thaphae Hotel</a></h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisic- ing elit
    </p>
  </div>

 
</div>

  
            <?php script_function(); ?>
            <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
        </body>
    </html>
    