//****************** VARIABLES ******************
var selectedWord = "";
var selectedHint = "";
var board = "";
var remainingGuesses = 6;
var rightWords = "";

var alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 
                'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 
                'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

var words = [{ word: "snake", hint: "It's a reptile" }, 
             { word: "monkey", hint: "It's a mammal" }, 
             { word: "beetle", hint: "It's an insect" }];


//****************** LISTENERS ******************

// Start the game when the HTML page is loaded.
window.onload = startGame();

// When the replay button is displayed 
$(".replayBtn").on("click", function() {
    // Reloading page from cache.
    //document.location.reload();
    $('#lost').hide();
    $('#won').hide();
    remainingGuesses = 6;
    updateMan();
    board = "";
    selectedWord = "";
    selectedHint = "";
    $("#letters").empty();
    $("#letters").show();
    enableButton($("#hint"));
    $("#hint").show();
    startGame();
});


/* Create listener for when the user clicks a letter button it checks if its
in the word and disables it (red)
*/
$("#letters").on("click", ".letter", function(){
    checkLetter($(this).attr("id"));
    disableButton($(this));
});

/* Create a listener for when the user clicks on Hint, 
it costs one guess count and the hint is displayed
*/
$("#hint").click(function() {
    $("#word").append("<span class='hint'>Hint: " + selectedHint + "</span>");
    disableButton($(this));
    remainingGuesses -= 1;
    updateMan();
});

//****************** FUNCTIONS ******************

// Kicks off the game
function startGame() {
    pickWord();
    createLetters();
    initBoard();
    updateBoard();
}

// Selects a random index
function pickWord() {
    let randInt = Math.floor(Math.random() * words.length);
    selectedWord = words[randInt].word.toUpperCase();
    selectedHint = words[randInt].hint;
}

// Creates the letters inside the letters div
function createLetters() {
    for (var letter of alphabet) {
        $("#letters").append("<button class='btn btn-success letter' id='" + letter + "'>" + letter + "</button>");
    }
}

// Create underscores for the selected word
function initBoard() {
    for (var letter in selectedWord) {
        board += '_';
    }
}

// Update the board 
function updateBoard() {
    $("#word").empty();
    
    for (var letter of board) {
        $("#word").append(letter);
        $("#word").append(' ');
    }
    
    $("#word").append("<br />");
}

// Update the word
function updateWord(positions, letter) {
    for (var pos of positions) {
        board = replaceAt(board, pos, letter)
    }
    updateBoard(board);
    if (!board.includes('_')) {
        endGame(true);
    }
}

// Checks to see if the selected letter exists in the selectedWord
function checkLetter(letter) {
    var positions = new Array();
    
    // Put all the positions the letter exists in an array
    for (var i = 0; i < selectedWord.length; i++) {
        if (letter == selectedWord[i]) {
            positions.push(i);
        }
    }
    
    // Update the game state
    if (positions.length > 0) {
        updateWord(positions, letter);
    } else {
        remainingGuesses -= 1;
        updateMan();
        
        // If user only has 1 more attempt, he can't use hint anymore.
        if(remainingGuesses == 1){
            disableButton($("#hint"));
        }
        if (remainingGuesses <= 0) {
            endGame(false);
        }
    }
}


// Calculates and updates the image for our stick man
function updateMan() {
    $("#hangImg").attr("src", "img/stick_" + (6 - remainingGuesses) + ".png");
}


// Ends the game by hiding game divs and displaying the win or loss divs
function endGame(win) {
    $('#letters').hide();
    $('#hint').hide();
    
    if (win) {
        $('#won').show();
        rightWords = selectedWord;
        displayCorrectWords();
    } else {
        $('#lost').show();
    }
}

// Displays the words that user has correct.
function displayCorrectWords(){
    $("#correctWord").append("<br>" + rightWords);
}

// Disabling a button that has been clicked by the user
function disableButton(btn) {
    btn.prop("disabled", true);
    btn.attr("class", "btn btn-danger")
}

// Enabling a button that has been clicked by the user
function enableButton(btn){
    btn.prop("disabled", false);
    btn.attr("class", "btn btn-success")
}

// Replacing indexes for string value
function replaceAt(str, index, value) {
    return str.substr(0, index) + value + str.substr(index + value.length);
}