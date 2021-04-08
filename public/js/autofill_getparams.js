"use strict"

const textBox = document.getElementById("codePromptTextbox");

for (let p of window.location.search.substring(1).split('&')) {
    let k, v;
    [k, v] = p.split('=');

    if (k === "code") {
        textBox.value = v;
        console.log("ok")
    }
}