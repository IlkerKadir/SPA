<!DOCTYPE html>
<html>
<title>Main Page</title>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
* {
    box-sizing: border-box;
}
.row::after {
    content: "";
    clear: both;
    display: table;
}
[class*="col-"] {
    float: center;
    padding: 10px;
}

html {
    font-family: "Lucida Sans", sans-serif;
}
.header {
    background-color:#ffffff ;
    color: #000000;
    padding: 15px;
}

 #box1, #box2,#box3 {
    width: 100px;
    height: 200px;
     line-height: 200px;
     margin-top: 50px;
    position: relative;
    text-align: center;
    align-content: center;
    display: inline-block;
  
}

#box1 {
    background: #00FFFF;

}

#box2 {
    background: #FF00FF;
}

#box3 {
    background: #FF8C00;
}


</style>
</head>
<body align = "center">

<div class="header">
  <h1>Welcome</h1>
</div>

<div >

<div class="col-3 menu">
<div id="box1"><a href="Abank/register1.php">Bank A</a></div>

<div  id="box2"><a href="Bbank/register1.php">Bank B</a></div>
<div  id="box3"><a href="Cbank/register1.php">Bank C</a></div>
    

</div>


</div>

</body>
</html>
