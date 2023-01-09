let tiles = document.querySelectorAll(".tile");
let reset = document.querySelector("#reset_button");
let endGameMessage = document.querySelector("#end_game_message");
let gameModeSelector = document.querySelector("#mode_selection");
let score1Area = document.querySelector("#score1");
let score2Area = document.querySelector("#score2");
let player1Area = document.querySelector("#player1");
let player2Area = document.querySelector("#player2");
let playable = true;
let gameMode = "PvP";

function computerTurn() {
    let index = alphabeta_nextmove(board);
    board[index] = turn();
    tiles[index].innerHTML = board[index] === 1 ? "X" : "O"; 

    moves += 1;
}

function resetGame() {
    const utility = calculateUtility(board); 
    if (utility === 0) {
        first = !first;
    }
    else {
        first = utility === 1 ? false : true;
    }

    tiles.forEach((tile, i) => {
        tile.innerHTML = "";
        board[i] = 0;
    })
    
    if (gameModeSelector.value !== gameMode) {
        score1 = 0;
        score2 = 0;
        score1Area.innerHTML = score1;
        score2Area.innerHTML = score2;
    }

    if (turn() === 1) {
        player1Area.style = "color: red;";
        player2Area.style = "color: black;";
    }
    else {
        player1Area.style = "color: black;";
        player2Area.style = "color: red;"; 
    }

    endGameMessage.innerHTML = "";
    moves = 0;
    playable = true;
    gameMode = gameModeSelector.value;

    if (gameMode === "PvC" && first === true) {
        computerTurn();
    }
}

tiles.forEach((element,i) => {
    element.addEventListener('click', (e) => {
        if (playable) {
            if (element.innerHTML === "") {
                board[i] = turn();
                if (board[i] === 0) {
                    element.innerHTML = ""; 
                }
                else {
                    element.innerHTML = board[i] === 1 ? "X" : "O"; 
                }
                moves += 1;

                if (gameMode === "PvC" && hasMoreTurns()) {
                    computerTurn();
                }
            }
        }

        if (turn() === 1) {
            player1Area.style = "color: red;";
            player2Area.style = "color: black;";
        }
        else {
            player1Area.style = "color: black;";
            player2Area.style = "color: red;"; 
        }

        let utility = calculateUtility(board);
        if (utility !== 0 || !hasMoreTurns()) {
            const result = utility == 0 ? "Draw!" : utility < 0 ? "O Wins!" : "X Wins!"
            if (utility === 1 && playable) {
                score1++;
            }
            if (utility === -1 && playable) {
                score2++;
            }
            playable = false;
            score1Area.innerHTML = score1;
            score2Area.innerHTML = score2;
            endGameMessage.innerHTML = result;
        }
    });
});

reset.addEventListener('mouseup', (e) => {
    resetGame();
});

if (turn() === 1) {
    player1Area.style = "color: red;";
    player2Area.style = "color: black;";
}
else {
    player1Area.style = "color: black;";
    player2Area.style = "color: red;"; 
}