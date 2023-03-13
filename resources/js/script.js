window.onload = function() // дожидаемся загрузки страницы
{
    initializeTimer(); // вызываем функцию инициализации таймера
}


function initializeTimer() {
    let seconds, minutes, hours;
    if (!isNaN(parseInt(localStorage.getItem('currentTime')))) {
        seconds = parseInt(localStorage.getItem('currentTime')); // определяем количество секунд до истечения таймера
    } else {
        seconds = 10; // определяем количество секунд до истечения таймера
    }
    minutes = seconds / 60; // определяем количество минут до истечения таймера
    hours = minutes / 60; // определяем количество часов до истечения таймера

    minutes = (hours - Math.floor(hours)) * 60; // подсчитываем кол-во оставшихся минут в текущем часе
    hours = Math.floor(hours); // целое количество часов до истечения таймера
    seconds = Math.floor((minutes - Math.floor(minutes)) * 60); // подсчитываем кол-во оставшихся секунд в текущей минуте
    minutes = Math.floor(minutes); // округляем до целого кол-во оставшихся минут в текущем часе

    setTimePage(hours, minutes, seconds); // выставляем начальные значения таймера

    function secOut() {
        if (seconds === 0) { // если секунды закончились то
            if (minutes === 0) { // если минуты закончились то
                if (hours === 0) { // если часы закончились то
                    showMessage(timerId); // выводим сообщение об окончании отсчета
                }
                else {
                    hours--; // уменьшаем кол-во часов
                    minutes = 59; // обновляем минуты
                    seconds = 59; // обновляем секунды
                }
            }
            else {
                minutes--; // уменьшаем кол-во минут
                seconds = 59; // обновляем секунды
            }
        }
        else {
            seconds--; // уменьшаем кол-во секунд
        }
        setTimePage(hours, minutes, seconds); // обновляем значения таймера на странице
        let currentTime = hours * 3600 + minutes * 60 + seconds;
        if (!(hours === 0 && minutes === 0 && seconds === 0)) {
            localStorage.setItem('currentTime', currentTime.toString());
        }
    }

    let timerId = setInterval(secOut, 1000) // устанавливаем вызов функции через каждую секунду
}

function setTimePage(h, m, s) { // функция выставления таймера на странице
    let element = document.getElementById("timer"); // находим элемент с id = timer
    element.innerHTML = `${m.toString().padStart(2, '0')} : ${s.toString().padStart(2, '0')}`; // выставляем новые значения таймеру на странице
}

function showMessage(timerId) { // функция, вызываемая по истечению времени
    clearInterval(timerId); // останавливаем вызов функции через каждую секунду
    let form = document.getElementById('question-form');
    resetTime();
    form.submit();
}

let form = document.getElementById('question-form');
form.addEventListener('click', function () {
    localStorage.removeItem('currentTime');
})
function resetTime() {
    localStorage.removeItem('currentTime');
}
