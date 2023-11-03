const RANDOM_QUOTE_API_URL = 'http://api.quotable.io/random';
const quoteDisplayElement = document.getElementById('quoteDisplay');
const quoteInputElement = document.getElementById('quoteInput');
const timerElement = document.getElementById('timer');
const containergame = document.getElementById('containerJogo');
const button = document.getElementById('button');
const divButton = document.getElementById('divButton');
let seconds = 0;
let timerInterval;
let quotepoints = 0;
let letterspoints = 0
let isGameStarted = false;

button.addEventListener('click', () => {
  divButton.innerHTML = '';
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
  points = 0;
  seconds = 0;
  renderNewQuote();
  startTimer();
}

function startTimer() {
  timerElement.innerText = seconds;
  startTime = new Date();
  clearInterval(timerInterval);
  timerInterval = setInterval(() => {
    timer.innerText = getTimerTime();
    if (seconds >= 50) {
      if (seconds % 2 === 0) {
        timerElement.style.color = 'red';
      } else {
        timerElement.style.color = 'white';
      }
    }
    if (seconds === 60) {
      clearInterval(timerInterval);
      timerElement.innerText = '';
      containergame.innerHTML = `acabou ${quotepoints} frases completas e ${letterspoints} letras feitas`;
    }
  }, 1000);
}

function getTimerTime() {
  seconds++;
  return Math.floor((new Date() - startTime) / 1000);
}
