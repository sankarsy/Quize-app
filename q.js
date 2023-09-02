//https://opentdb.com/api.php?amount=10&difficulty=easy&type=multiple

const _question = document.getElementById("question");
const _options = document.querySelector(".quiz-options");
const _correctscore = document.getElementById('correct-score');
const _totalquestion = document.getElementById('total-question');
const _checkBtn =document.getElementById("check-answer");
const _playAgainBtn =document.getElementById("play-again");
const _result = document.getElementById("result");
const _currentquize = document.getElementById('current-quize');

const countdownElement = document.getElementById('countdown');
const progressBarFiller = document.getElementById('filler');




let correctAnswer = "", correctscore = askcount = 0 , totalquestion =10 ,currentquize =1,countdown = 10 ,countdownInterval;

function eventListeners(){
    _checkBtn.addEventListener('click', checkAnswer);
    _playAgainBtn.addEventListener('click', restartQuiz);
}


document.addEventListener('DOMContentLoaded', () =>{
    loadquestion();
    eventListeners();
    _totalquestion.textContent = totalquestion;
    _correctscore.textContent = correctscore;
    _currentquize.textContent = currentquize;

});


async function loadquestion(){
    const APIUrl = 'https://opentdb.com/api.php?amount=10&difficulty=easy&type=multiple';
    const result = await fetch(`${APIUrl}`)
    const data = await result.json();
    _result.innerHTML = "";
    showquestion(data.results[0]);
    startCountdown();
    progressBar()
    
}

function showquestion(data){
    _checkBtn.disabled = false;
    correctAnswer = data.correct_answer;
    let incorrectAnswer = data.incorrect_answers;
    let optionslist = incorrectAnswer;
    //inserting correct anwer in random position in the option list
    optionslist.splice(Math.floor(Math.random() * (incorrectAnswer.length + 1)), 0, correctAnswer);
    // console.log(optionslist);
    // console.log(correctAnswer);
    
    _question.innerHTML =`${data.question}<br><span class="category">${data.category}</span>`;
    _options.innerHTML =`${optionslist.map((option, index) =>`<li> ${index + 1}.<span> ${option} </span></li>`).join('')}`;

    selectOption();
}

function selectOption(){
    _options.querySelectorAll('li').forEach(function(option){
        option.addEventListener('click', function(){
            if(_options.querySelector('.selected')){
                const activeOption = _options.querySelector('.selected');
                activeOption.classList.remove('selected');
            }
            option.classList.add('selected');
        });
    });
    
    console.log(correctAnswer)
}



//countdown
function startCountdown() {
    countdown = 10;
    updateCountdownDisplay();

    countdownInterval = setInterval(() => {
        countdown--;
        updateCountdownDisplay();

        if (countdown <= 0) {
            clearInterval(countdownInterval);
            // loadquestion();
            checkcount()
            
            position();
        }
    }, 1000);
}

function updateCountdownDisplay() {
    countdownElement.textContent = countdown;
}




//answer checking
function checkAnswer(){
    _checkBtn.disabled = true;
    if(_options.querySelector('.selected')){
        let selectedAnswer = _options.querySelector('.selected span').textContent;
        if(selectedAnswer.trim() == HTMLDecode(correctAnswer)){
            correctscore++;
            progressBarFiller.style.width = `${(correctscore / 10) * 100}%`;
            _result.innerHTML = `<p style="color:green;"><i class = "fas fa-check" style="background-color:green;"></i>Correct Answer!</p>`;
        }else{
            _result.innerHTML = `<p style="color: red;"><i class = "fas fa-times" style="background-color:red;"></i>Incorrect Answer!</p> <small style="color: green;"><b>Correct Answer:</small><small> </b>${correctAnswer}</small>`;
        }
        checkcount();
        position();
        clearInterval(countdownInterval);
        }
        else {
        _result.innerHTML = `<p><i class = "fas fa-question" style="background-color:red;"></i>Please select an option!</p>`;
        _checkBtn.disabled = false;
        }
}

function HTMLDecode(textString) {
    let doc = new DOMParser().parseFromString(textString, "text/html");
    return doc.documentElement.textContent;
}





//function using for displying quize position.
function position(){
    if(askcount < totalquestion){
    currentquize++;
    _currentquize.innerHTML= `${currentquize}`;
    }else{
        _currentquize.innerHTML= `${totalquestion}`;
    }

}
function checkcount(){
    askcount++;
    setcount();

    if(askcount == totalquestion){
        _result.innerHTML += `<p>Your score is ${correctscore}.</p>`;
        _playAgainBtn.style.display = "block";
        _checkBtn.style.display = "none";
    }else{
        setTimeout(()=>{
            loadquestion();
        },300);
    }
}

function progressBar(){
    progressBarFiller.style.width = `${(correctscore / 10) * 100}%`;
}

function setcount(){
    _totalquestion.textContent = totalquestion;
    _currentquize.textContent = currentquize;
    _correctscore.textContent = correctscore;   
}



function restartQuiz(){
    correctscore = askcount = 0;
    currentquize = askcount = 1;
    _playAgainBtn.style.display = "none";
    _checkBtn.style.display = "block";
    _checkBtn.disabled = false;
    setcount();
    loadquestion();
    
}