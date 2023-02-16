@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center vh-100 align-items-center">
            <div class="col-xl-5 col-lg-7 col-md-9 col-sm-12">
                <div>
                    <h1 class="text-center mb-4">Create a new question!</h1>
                </div>
                <form action="{{ route('main.questions.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="quizTitleInput">Question text</label>
                        <input type="text" class="form-control mb-2" id="quizTitleInput" name="title" placeholder="Question text">
                    </div>

                    <div class="input-group">
                        <div class="w-75" id="myDIV">
                            <input type="text" class="form-control mb-2" id="myInput">
                        </div>
                        <div class="input-group-append">
                            <button onclick="newElement()" class="btn btn-outline-secondary" type="button">Add answer variant</button>
                        </div>
                    </div>

                    <ul id="myUL" class="list-group">

                    </ul>

                    <button type="submit" class="btn btn-primary mt-2">Next step</button>
                </form>
            </div>
        </div>
    </div>
@endsection
<script>
    // Создайте кнопку "Закрыть" и добавьте ее к каждому элементу списка
    // var myNodelist = document.getElementsByTagName("li");
    // var i;
    // for (i = 0; i < myNodelist.length; i++) {
    //     var span = document.createElement("SPAN");
    //     var txt = document.createTextNode("\u00D7");
    //     span.className = "close";
    //     span.appendChild(txt);
    //     myNodelist[i].appendChild(span);
    // }

    // Нажмите на кнопку "Закрыть", чтобы скрыть текущий элемент списка
    // var close = document.getElementsByClassName("close");
    // var i;
    // for (i = 0; i < close.length; i++) {
    //     close[i].onclick = function() {
    //         var div = this.parentElement;
    //         div.style.display = "none";
    //     }
    // }

    // Добавить "checked" символ при нажатии на элемент списка
    // const list = document.querySelector('ul');
    // list.addEventListener('click', function(ev) {
    //     if (ev.target.tagName === 'li') {
    //         ev.target.classList.toggle('checked');
    //     }
    // }, false);

    // Создайте новый элемент списка при нажатии на кнопку "Добавить"
    function newElement() {
        const li = document.createElement("li");
        li.className = "list-group-item d-flex justify-content-between align-items-center";
        const inputValue = document.getElementById("myInput").value;
        const checkBox = document.createElement("input");
        checkBox.className  = "form-check-input answer-variant";
        checkBox.setAttribute('type', 'checkbox');
        const t = document.createTextNode(inputValue);
        li.appendChild(checkBox);
        li.appendChild(t);
        if (inputValue === '') {
            alert("You haven't entered a question!");
        } else {
            document.getElementById("myUL").appendChild(li);
        }
        document.getElementById("myInput").value = "";

        const btn = document.createElement("button");
        btn.className  = "btn btn-outline-danger m-1 close";
        const trash = document.createElement("i");
        trash.className = "bi bi-trash";
        btn.appendChild(trash);
        li.appendChild(btn);

        const close = document.getElementsByClassName("close");

        for (i = 0; i < close.length; i++) {
            close[i].onclick = function(e) {
                e.preventDefault();
                const div = this.parentElement;
                div.remove();
            }
        }

        const allCheckboxes = document.getElementsByClassName("answer-variant");

        for (i = 0; i < allCheckboxes.length; i++) {
            allCheckboxes[i].setAttribute("name", "checkbox-" + i);
        }

    }
</script>
