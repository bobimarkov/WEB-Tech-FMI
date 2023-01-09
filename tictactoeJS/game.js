let moves = 0;
let first = false; // false - X, true - O
let board = [0,0,0,0,0,0,0,0,0];

let score1 = 0, score2 = 0;

function printBoard (board1) {
    let result = "";
    for (let i = 0; i < 9; i++) {
        if (i % 3 === 0) result += "\n";
        result += ((board1[i] === 0 ? "-" : board1[i] === 1 ? "X" : "O") + " ");
    }

    console.log(result);
}

function turn() {
    return ((moves + first) % 2 === 0 ? 1 : -1); 
}

function hasMoreTurns()  {
    return (moves < 9);
}

function checkWinRows(board)  {
    let countX = 0, countY = 0;
    for(let i = 0; i < 3; i++) {
        for(let j = 0; j < 3; j++) {
            if(board[3 * i + j] === 1) {
                countX++;
            }
            if(board[3 * i + j] === -1) {
                countY++;
            }
        }
        if (countX === 3) {
            return 1;
        }
        if (countY === 3) {
            return -1;
        }
        countX = countY = 0;
    }    
    return 0;
}

function checkWinMainDiagonal(board)  {
    let countX = 0, countY = 0;
    for(let i = 0; i < 3; i++) {
        if(board[3 * i + i] === 1) {
            countX++;
        }
        if(board[3 * i + i] === -1) {
            countY++;
        }
    }    
    if (countX === 3) {
        return 1;
    }
    if (countY === 3) {
        return -1;
    }
    return 0;
}

function checkWinSecondDiagonal(board)  {
    let countX = 0, countY = 0;
    for(let i = 0, j = 2; i < 3; i++, j--) {
        if(board[3 * i + j] === 1) {
            countX++;
        }
        if(board[3 * i + j] === -1) {
            countY++;
        }
    }    
    if (countX === 3) {
        return 1;
    }
    if (countY === 3) {
        return -1;
    }
    return 0;
}

function checkWinColumns(board)  {
    let countX = 0, countY = 0;
    for(let i = 0; i < 3; i++) {
        for(let j = 0; j < 3; j++) {
            if(board[i + 3 * j] === 1) {
                countX++;
            }
            if(board[i + 3 * j] === -1) {
                countY++;
            }
        }
        if (countX === 3) {
            return 1;
        }
        if (countY === 3) {
            return -1;
        }
        countX = countY = 0;
    }    
    return 0;
}

function calculateUtility (board)  {
    let row = checkWinRows(board);
    let col = checkWinColumns(board);
    let main_diag = checkWinMainDiagonal(board);
    let sec_diag = checkWinSecondDiagonal(board);

    if (row + col + main_diag + sec_diag > 0) {
        return 1;
    }
    else if (row + col + main_diag + sec_diag < 0) {
        return -1;
    }
    else return 0;
}

function move(board, pos)  {
    let new_board = [];
    for (let i = 0; i < 9; i++) {
        new_board[i] = board[i];
    }

    if (new_board[pos] === 0) {
        new_board[pos] = turn();
    }

    return new_board;
}

function allPossibleMoves(board)  {
    let moves = [];
    for (let i = 0; i < 9; i++) {
        if(board[i] === 0) {
            moves.push(move(board, i));
        }
    }

    return moves;
}

function alphabeta(current, alpha, beta) {
    if (!hasMoreTurns() || calculateUtility(current) !== 0) {
        const utility = calculateUtility(current);
        return utility;
    }
    let val = turn() === 1 ? -1 : 1;
    let children = allPossibleMoves(current);
    let alpha1 = alpha, beta1 = beta;
    for(let i = 0; i < children.length; i++) {
        if (turn() === 1) {
            moves++;
            alpha1 = alphabeta(children[i], alpha1, beta1);
            moves--;
            if (alpha1 < val) {
                break;
            }
            val = alpha1;
        }
        else {
            moves++;
            beta1 = alphabeta(children[i], alpha1, beta1);
            moves--;
            if (beta1 > val) {
                break;
            }
            val = beta1;
        }
    }
    return val;
}

function alphabeta_nextmove(current) {
    let alpha = -1, beta = 1;
    let val = turn() === 1 ? -1 : 1;
    let next = 0;

    let children = allPossibleMoves(current);
    let alpha1 = alpha, beta1 = beta;
    for (let i = 0; i < children.length; i++) {
        if (turn() === 1) {
            moves++;
            alpha1 = alphabeta(children[i], alpha1, beta1);
            moves--;
            if (alpha1 < val) {
                break;
            }
            val = alpha1;
            next = i;
        }
        else {
            moves++;
            beta1 = alphabeta(children[i], alpha1, beta1);
            moves--;
            if (beta1 > val) {
                break;
            }
            val = beta1;
            next = i;
        }
    }

    let index = 0;
    for (let i = 0; i < current.length; i++) {
        if (current[i] !== children[next][i]) {
            index = i;
            break;
        }
    }

    return index;
}