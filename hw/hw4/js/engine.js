//alert('just testing')

var monkey_01;
var gameTimer;
var outputMiss;
var outputHit;
var numHits = 0;
var numMiss = 0;

function init(){
    $('#startGame').hide();
    $(".monkey").css({display: ""});
    // monkey_01 = document.getElementById('monkey_01');
    // outputHit = document.getElementById('outputHit');
    // outputMis = document.getElementById('outputMis');
    
    //Returning 0 since it is an object.
    monkey_01 = $('#monkey_01').get(0);
    outputHit = $('#outputHit').get(0);
    outputMis = $('#outputMis').get(0);
    
    gameTimer = setInterval(gameloop, 21);
    placeMonkey();
}

function gameloop(){
    var y =  parseInt(monkey_01.style.top) - 20;
    
    if(y < -100){
        placeMonkey();
        numMiss++;
        outputMis.innerHTML = ("Number of misses: " + numMiss);
    } else{ 
        monkey_01.style.top = y +"px";
    }
    
    if(numMiss == 5){
        alert("You lost!");
        clearInterval(gameTimer);
        $('#restartGame').attr("type", "button");
    }
}

function placeMonkey(){
    var x = Math.floor(Math.random() * 720); // 0 to 420.
    monkey_01.style.left = x + 'px';
    monkey_01.style.top = '520px';
}
function hitMonkey(){
    numHits++;
    outputHit.innerHTML = ("Number of hits: " + numHits);
    if(numHits == 10) {
        alert("You won!");
        clearInterval(gameTimer);
        $('#restartGame').attr("type", "button");
    }
    // output.innerHTML = "No animals harm in the playing of this game.";
    placeMonkey();
}

function restartGame(){
    location.reload();
}
