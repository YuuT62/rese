//フォームに入力した値を定義
const form_text = document.getElementById("form_text");

//HTMLを書き換えるクラスを定義
const changes = document.getElementsByClassName("change");

form_text.addEventListener("input", function () {
    for (let i = 0; i < changes.length; i++) {
        changes[i].textContent = form_text.value;
    }
});