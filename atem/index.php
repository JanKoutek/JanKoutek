<html>
    <head>
        <meta charset="UTF-8">
        <title>Střižna simulátor</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <style>
   .container {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    grid-template-rows: 1fr 1fr 1fr;
    gap: 0px 0px;
    grid-auto-flow: row;
    grid-template-areas:
        "preview mess out"
        "signal-1 signal-2 signal-3"
        "prev_controls general out_controls";
    }
 
    .signal-1 {
        grid-area: signal-1;
        z-index: 1;
    }
 
    .signal-2 {
        grid-area: signal-2;
        z-index: 1;
    }
 
    .signal-3 {
        grid-area: signal-3;
        z-index: 1;
    }
 
    .out {
        grid-area: out;
    }
    .out2{
        grid-area: out;
        width: 100%;
        height: 100%;
        background-color: black;
    }
    .preview {
        grid-area: preview;
    }
 
    .prev_controls {
        grid-area: prev_controls;
    }
 
    .out_controls {
        grid-area: out_controls;
    }
 
    .general {
        grid-area: general;
    }
 
    .mess {
        grid-area: mess;
    }
 
    .container { position:relative; }
.container video {
    position:relative;
    z-index:0;
}
#overlay1 {
    position:absolute;
  top:25%;
  right: 10%;
  z-index:10;
    color: white;
    background-color: black;
    padding-left: 1em;
    padding-right: 1em;
    font-family: Arial;
    opacity: 0.5;
    font-size: 24px;
}
#overlay2 {
    position:absolute;
  top:25%;
  left: 10%;
  z-index:10;
    color: white;
    background-color: black;
    padding-left: 1em;
    padding-right: 1em;
    font-family: Arial;
    opacity: 0.5;
    font-size: 24px;
}
#overlay3 {
    position:absolute;
  top:58%;
  left: 10%;
  z-index:10;
    color: white;
    background-color: black;
    padding-left: 1em;
    padding-right: 1em;
    font-family: Arial;
    opacity: 0.5;
    font-size: 24px;
}
#overlay4 {
    position:absolute;
  top:58%;
  right: 10%;
  z-index:10;
    color: white;
    background-color: black;
    padding-left: 1em;
    padding-right: 1em;
    font-family: Arial;
    opacity: 0.5;
    font-size: 24px;
}
#overlay5 {
    position:absolute;
  top:58%;
  left: 43%;
  z-index:10;
    color: white;
    background-color: black;
    padding-left: 1em;
    padding-right: 1em;
    font-family: Arial;
    opacity: 0.5;
    font-size: 24px;
}
#vystup{
    opacity: 1;
    background-color: #000000;
}
 
#vystup.pre, #bg_out.pre {
opacity:0;
}
 
#vystup.fade_05{
    opacity: 1;
    -webkit-transition: opacity 0.5s ease-in-out;
    -moz-transition: opacity 0.5s ease-in-out;    
    transition: opacity 0.5s ease-in-out;
}
#vystup.fade_10{
    opacity: 1;
    -webkit-transition: opacity 1s ease-in-out;
    -moz-transition: opacity 1s ease-in-out;    
    transition: opacity 1s ease-in-out;
}
#vystup.fade_15{
    opacity: 1;
    -webkit-transition: opacity 1.5s ease-in-out;
    -moz-transition: opacity 1.5s ease-in-out;    
    transition: opacity 1.5s ease-in-out;
}
#vystup.fade_20{
    opacity: 1;
    -webkit-transition: opacity 2s ease-in-out;
    -moz-transition: opacity 2s ease-in-out;    
    transition: opacity 2s ease-in-out;
}
#vystup.ftb1, #bg_out.ftb1{
    opacity: 0;
    -webkit-transition: opacity 2s;
    -moz-transition: opacity 2s;    
    transition: opacity 2s;
}
#vystup.ftb2, #bg_out.ftb2{
    opacity: 1;
    -webkit-transition: opacity 2s;
    -moz-transition: opacity 2s;    
    transition: opacity 2s;
}
body{
    background-color: #292929;
    color: white;
    font-family: Arial;
}
 
.sourceBtn {
    background-color:#ededed;
    color:black;
    font-size:15px;
    padding:20px 10px;
}
.outBtn {
    background-color:#ededed;
    color:black;
    font-size:15px;
    padding:20px 10px;
}
.sourceBtn:disabled{
    background-color:lightgreen;
}
 
.outBtn:disabled{
    background-color:red;
}
 
#bg_out{
z-index: 1;
width: 100%;
height: 100%;
background-color: 0000;
opacity: 0.5;
}
 
 
#output{
    z-index: 6;
}
#nadpis{
    color: white;
    text-align: center;
    font-family: Arial;
    padding-top: 2em;
}
        </style>
        <script>
            var out_src = 0;
            var prev_src = 0;
            var fade_delay = 500;
            var fade_ftb = false;
 
            let s1 = "https://atem.9e.cz/signal_1.MOV";
            let s2 = "https://atem.9e.cz/signal_2.MOV";
            let s3 = "https://www.panska.cz/wp-content/uploads/2021/06/Jakou-si-vybrat-stredni-skolu.-Treba-ti-napovime.mp4";

            function prev(x) {
                if(x == 1){
                    document.getElementById('preview').src=s1;
                    document.getElementById('preview').currentTime = document.getElementById('signal1').currentTime;
                }
                if(x == 2){
                    document.getElementById('preview').src=s2;
                    document.getElementById('preview').currentTime = document.getElementById('signal2').currentTime;
                }
                if(x == 3){
                    document.getElementById('preview').src=s3;
                    document.getElementById('preview').currentTime = document.getElementById('signal3').currentTime;
                }
                prev_src = x;
                check();
            }
             function out(x) {
                if(x == 1){
                    document.getElementById('output').src=s1;
                    document.getElementById('output').currentTime = document.getElementById('signal1').currentTime;
                }
                if(x == 2){
                    document.getElementById('output').src=s2;
                    document.getElementById('output').currentTime = document.getElementById('signal2').currentTime;
                }
                if(x == 3){
                    document.getElementById('output').src=s3;
                    document.getElementById('output').currentTime = document.getElementById('signal3').currentTime;
                }
                out_src = x;
            }
 
            
            function check(){
                var y = document.getElementById('preview').src;
                var z = document.getElementById('output').src;
                //console.log(y);
                if(y == s1){
                    document.getElementById('btn_prev1').disabled = true;
                    document.getElementById('btn_prev2').disabled = false;
                    document.getElementById('btn_prev3').disabled = false;
                }
                if(y == s2){
                    document.getElementById('btn_prev1').disabled = false;
                    document.getElementById('btn_prev2').disabled = true;
                    document.getElementById('btn_prev3').disabled = false;
                }
                if(y == s3){
                    document.getElementById('btn_prev1').disabled = false;
                    document.getElementById('btn_prev2').disabled = false;
                    document.getElementById('btn_prev3').disabled = true;
                }
 
                if(z == s1){
                    document.getElementById('btn_out1').disabled = true;
                    document.getElementById('btn_out2').disabled = false;
                    document.getElementById('btn_out3').disabled = false;
                }
                if(z == s2){
                    document.getElementById('btn_out1').disabled = false;
                    document.getElementById('btn_out2').disabled = true;
                    document.getElementById('btn_out3').disabled = false;
                }
                if(z == s3){
                    document.getElementById('btn_out1').disabled = false;
                    document.getElementById('btn_out2').disabled = false;
                    document.getElementById('btn_out3').disabled = true;
                }
            }
 
            function change_delay(d){
                fade_delay = d;
                console.log(fade_delay);
 
                if(fade_delay == 500){
                    document.getElementById('btn_delay1').disabled = true;
                    document.getElementById('btn_delay2').disabled = false;
                    document.getElementById('btn_delay3').disabled = false;
                    document.getElementById('btn_delay4').disabled = false;
                }
                if(fade_delay == 1000){
                    document.getElementById('btn_delay1').disabled = false;
                    document.getElementById('btn_delay2').disabled = true;
                    document.getElementById('btn_delay3').disabled = false;
                    document.getElementById('btn_delay4').disabled = false;
                }
                if(fade_delay == 1500){
                    document.getElementById('btn_delay1').disabled = false;
                    document.getElementById('btn_delay2').disabled = false;
                    document.getElementById('btn_delay3').disabled = true;
                    document.getElementById('btn_delay4').disabled = false;
                }
                if(fade_delay == 2000){
                    document.getElementById('btn_delay1').disabled = false;
                    document.getElementById('btn_delay2').disabled = false;
                    document.getElementById('btn_delay3').disabled = false;
                    document.getElementById('btn_delay4').disabled = true;
                }
            }
 
            function ftb(){
                if(fade_ftb == false){
                    document.getElementById('vystup').className = 'ftb1';
                    document.getElementById('bg_out').className = 'ftb1';
                    fade_ftb = true;
                }else if(fade_ftb == true){
                    document.getElementById('vystup').className = 'pre';
                    document.getElementById('bg_out').className = 'pre';
 
                    setTimeout(function(){
                    document.getElementById('vystup').className = 'ftb2';
                    document.getElementById('bg_out').className = 'ftb2';
                    }, 100);
                    fade_ftb = false;
                }
               
            }
            function prolinacka(){
                document.getElementById('vystup').className = 'pre';

                
                /*
                var delay = document.getElementById('delay_val').value;
                var newStyles = document.createElement('style');
                var tr = "#vystup {" +
                "opacity: 1;" + 
                " -webkit-transition: opacity "+delay+"s ease-in-out;" +
                "-moz-transition: opacity "+delay+"s ease-in-out;" +
                "transition: opacity "+delay+"s ease-in-out;" +
                "}";
                document.head.append(newStyles);
                newStyles.innerHTML = tr;
                console.log(tr);*/

                
                var d = "";
 
                if(fade_delay == 500){
                    d = "05";
                }
                if(fade_delay == 1000){
                    d = "10";
                }
                if(fade_delay == 1500){
                    d = "15";
                }
                if(fade_delay == 2000){
                    d = "20";
                }
                setTimeout(function(){
                    document.getElementById('vystup').className = 'fade_'+d;
                }, 100);
               
            }
            function strih(f){
                var b = document.getElementById('output').src;
                var a = document.getElementById('preview').src;
                var c = document.getElementById('preview').currentTime;
                var d = document.getElementById('output').currentTime;
                document.getElementById('bg_out').src = b;
                document.getElementById('output').src = a;
                document.getElementById('preview').src = b;
                document.getElementById('preview').currentTime = d;
                document.getElementById('output').currentTime = c;
                document.getElementById('bg_out').currentTime = c;

                var y = document.getElementById('preview').src;
                var z = document.getElementById('output').src;

                if(z == s1){
                    document.getElementById('output').currentTime = document.getElementById('signal1').currentTime;
                }
                if(z == s2){
                    document.getElementById('output').currentTime = document.getElementById('signal2').currentTime;
                }
                if(z == s3){
                    document.getElementById('output').currentTime = document.getElementById('signal3').currentTime;
                }

                if(y == s1){
                    document.getElementById('preview').currentTime = document.getElementById('signal1').currentTime;
                }
                if(y == s2){
                    document.getElementById('preview').currentTime = document.getElementById('signal2').currentTime;
                }
                if(y == s3){
                    document.getElementById('preview').currentTime = document.getElementById('signal3').currentTime;
                }

 
                if(f == 1){
                    check();
                    prolinacka();
                }else{
                    check();
                }
            }
           
        </script>
    </head>
    <body onload="prev(2); change_delay(500);">
    <div class="container">
        <div class="signal-1">
        <p id="overlay3">SIGNAL_01</p>
            <video id="signal1" src="signal_1.MOV" width="100%" height="100%" autoplay loop muted>SIGNAL OFF</video><br>
        </div>
        <div class="signal-2">
        <p id="overlay5">SIGNAL_02</p>
        <video id="signal2" src="signal_2.MOV" width="100%" height="100%" autoplay loop muted>SIGNAL OFF</video><br>
        </div>
        <div class="signal-3">
        <p id="overlay4">SIGNAL_03</p>
        <video id="signal3" src="https://www.panska.cz/wp-content/uploads/2021/06/Jakou-si-vybrat-stredni-skolu.-Treba-ti-napovime.mp4" width="100%" height="100%" autoplay loop muted>SIGNAL OFF</video><br>
        </div>
        <div class="preview">
        <p id="overlay2">PREVIEW</p>
            <video id="preview" src="" width="100%" height="100%" autoplay loop muted>SIGNAL OFF</video>
        </div>
        <p id="overlay1">OUTPUT</p>
        <div class="out"><div id="vystup"><video id="output" src="signal_1.MOV" width="100%" height="100%" autoplay loop muted>SIGNAL OFF</video></div></div>
        <div class="out2"><video id="bg_out" src="signal_2.MOV" width="33%" height="33%" autoplay loop muted>SIGNAL OFF</video></div>
        <div class="prev_controls">
            <br>
            <b>Preview</b><br>
            <button id="btn_prev1" onclick="prev(1)" class="sourceBtn">Signal 1</button>&nbsp;
            <button id="btn_prev2" onclick="prev(2)" class="sourceBtn">Signal 2</button>&nbsp;
            <button id="btn_prev3" onclick="prev(3)" class="sourceBtn">Signal 3</button>&nbsp;
            <br><br>
            <b>Output</b><br>
            <button id="btn_out1" onclick="out(1)" class="outBtn">Signal 1</button>&nbsp;
            <button id="btn_out2" onclick="out(2)" class="outBtn">Signal 2</button>&nbsp;
            <button id="btn_out3" onclick="out(3)" class="outBtn">Signal 3</button>&nbsp;
        </div>
        <div class="out_controls">
            <br>
            <button id="btn_delay1" onclick="change_delay(500)">0,5</button>&nbsp;
            <button id="btn_delay2" onclick="change_delay(1000)">1,0</button><br><br>
            <button id="btn_delay3" onclick="change_delay(1500)">1,5</button>&nbsp;
            <button id="btn_delay4" onclick="change_delay(2000)">2,0</button><br><br>
<<<<<<< Updated upstream
            <!--<input type="number" id="delay_val" value="1"> aaa-->
=======
            <!--<input type="number" id="delay_val" value="1">-->
>>>>>>> Stashed changes
        </div>
        <div class="general">
            <br>
            <button onclick="strih(0)" class="sourceBtn">Cut</button>&nbsp;
            <button onclick="strih(1)" class="sourceBtn">Auto</button>&nbsp;
            <button onclick="ftb()" class="sourceBtn">FTB</button>&nbsp;
        </div>
        <div class="mess" id="nadpis">
            <b>ATEM simulator</b><br>
            &copy; Jan Koutek 2021
        </div>
    </div>
    </body>
</html>
 
 
 
 

