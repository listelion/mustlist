<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div>
        <p>업다운 게임</p>
        <input type="text" id="startValue">
        <input type="text" id="endValue">
        <input type="button" id="resultValue" value="등록" onclick="changeValue()">
    </div>
    <div>
        <p>생성된 수는 <span id="sValue"></span>~<span id="eValue"></span> 사이의 수입니다.</p>
    </div>
    <div>
        <input type="text" id="inputValue">
        <input type="button" id="resultValue" onclick="inputValue()" value="도전">
    </div>
    <div>
        <ul id="result"></ul>
    </div>
    <script>
        var sValue = 0;
        var eValue = 0;
        var rValue = 0;
        function changeValue() {
            sValue = document.getElementById("startValue").value * 1;
            eValue = document.getElementById("endValue").value * 1;
            document.getElementById("sValue").innerHTML = sValue;
            document.getElementById("eValue").innerHTML = eValue;
            rValue = Math.floor(Math.random() * (eValue - sValue)) + sValue;
            console.log(rValue);
        }
        function inputValue() {
            var inputValue = document.getElementById("inputValue").value * 1;
            var ul = document.getElementById("result");
            var li = document.createElement("li");
            if(inputValue > rValue){
                var temp = inputValue + "> X"
            } else if(inputValue == rValue){
                var temp = "정답입니다!" + inputValue
            } else {
                var temp = inputValue + "< X"
            }
            li.appendChild(document.createTextNode(temp));
            ul.appendChild(li);
        }

    </script>
</body>
</html>