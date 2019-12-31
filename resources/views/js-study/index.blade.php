<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>업다운 게임</h1>
<div>
    <input type="text" id="frontV">
    <input type="text" id="endV">
    <input type="button" value="등록" onclick="changeValue()">
</div>
<div>
    <br>생성된 수는 <span id="sValue"></span> ~ <span id="eValue"></span> 사이의 수 입니다.<br><br>
</div>
<div>
    <input type="text" id="inputV">
    <input type="button" value="도전" onclick="inputValue()">
</div>
<ul id="list">
</ul>
<script>
var sValue =0;
var eValue =0;
var rValue =0;

function changeValue(){
    sValue = document.getElementById("frontV").value * 1;
    eValue = document.getElementById("endV").value * 1;
    rValue = Math.ceil(Math.random() * (eValue - sValue)) + sValue;
    document.getElementById("sValue").innerHTML = sValue;
    document.getElementById("eValue").innerHTML = eValue;
}
function inputValue() {
    var inputV = document.getElementById("inputV").value * 1;
    var ul = document.getElementById("list");
    var li = document.createElement("li");
    if(inputV > rValue){
        var temp = inputV + "는 x 보다 큽니다."
    } else if(inputV < rValue){
        var temp = inputV + "는 x 보다 작습니다."
    } else {
        var temp = inputV + "가 정답니다!"
    }
    li.appendChild(document.createTextNode(temp));
    ul.appendChild(li);
}
</script>
</body>
</html>