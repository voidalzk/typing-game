const RANDOM_QUOTE_API_URL = 'http://api.quotable.io/random';
const timerElement = document.getElementById('timer');
const containergame = document.querySelector('.containerJogo');
const button = document.getElementById('button');
const divButton = document.getElementById('divButton');
const game = document.getElementById('game');
const PgameResult = document.getElementById('matchResult');
const PhighScore = document.getElementById('highScore');
const DivResults = document.getElementById('divResults');
const ButtonRestart = document.getElementById('ButtonRestart')
let seconds = 0;
let timerInterval;
let quotepoints = 0;
var letterspoints = 0
let isGameStarted = false;
let quoteactual = 0;
let highScore = 0
const quoteDisplayElement = document.getElementById('quoteDisplay');
const quoteInputElement = document.getElementById('quoteInput');
const saveResultButton = document.getElementById('saveResultBtn');
let isResultSaved = false;

button.addEventListener('click', () => {
  divButton.innerHTML = '';
  containergame.style.display = "block";
  DivResults.style.display = "none";
  if (!isGameStarted) {
    startGame();
  }
});
ButtonRestart.addEventListener('click', () => {
  divButton.innerHTML = '';
  containergame.style.display = "block";
  DivResults.style.display = "none";
  if (!isGameStarted) {
    startGame();
  }
});

quoteInputElement.addEventListener('input', () => {
  const arrayQuote = quoteDisplayElement.querySelectorAll('span');
  const arrayValue = quoteInputElement.value.split('');


  arrayQuote.forEach((characterSpan, index) => {
    const character = arrayValue[index];
    if (character == null) {
      characterSpan.classList.remove('correct');
      characterSpan.classList.remove('incorrect');
    } else if (character === characterSpan.innerText) {
      characterSpan.classList.add('correct');
      characterSpan.classList.remove('incorrect');
    } else {
      characterSpan.classList.remove('correct');
      characterSpan.classList.add('incorrect');
    }
  });

  const isComplete = arrayValue.length === arrayQuote.length;
  quoteactual = arrayValue.length;
  if (isComplete) {
    letterspoints = letterspoints + arrayValue.length;
    quotepoints++;
    renderNewQuote();
  }
});

function getRandomQuote() {
  return fetch(RANDOM_QUOTE_API_URL)
    .then(response => response.json())
    .then(data => data.content);
}

async function renderNewQuote() {
  const quote = await getRandomQuote();
  quoteDisplayElement.innerHTML = '';
  quote.split('').forEach(character => {
    const characterSpan = document.createElement('span');
    characterSpan.innerText = character;
    quoteDisplayElement.appendChild(characterSpan);
  });
  quoteInputElement.value = '';
}

let startTime;

function startGame() {
  isGameStarted = true;
  seconds = 0;
  letterspoints = 0
  renderNewQuote();
  startTimer();
}

function startTimer() {
  timerElement.innerText = seconds;
  startTime = new Date();
  clearInterval(timerInterval);
  timerInterval = setInterval(() => {

    timer.innerText = getTimerTime();

    timerElement.style.color = 'white';

    if (seconds >= 50) {
      if (seconds % 2 === 0) {
        timerElement.style.color = 'red';
      } else {
        timerElement.style.color = 'white';
      }
    }
    if (seconds === 5) {
      clearInterval(timerInterval);
      containergame.style.display = 'none';
      timerElement.innerText = '';
      quoteDisplayElement.innerHTML = '';
      letterspoints = letterspoints + quoteactual
      if (letterspoints > highScore) {
        highScore = letterspoints;
      }
      DivResults.style.display = "block";
      PgameResult.innerHTML = `${letterspoints}`;
      $.ajax({
        type: "POST",
        url: "../views/jogo.php",
        data: {
          letterspoints: letterspoints
        },
        success: function (response) {

        }
      });
      isGameStarted = false;
    }
  }, 1000);
}

function getTimerTime() {
  seconds++;
  return Math.floor((new Date() - startTime) / 1000);
}
