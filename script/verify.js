function verifyField(element) {
    if (element.value === "") return;
    let query = {}; query[element.name] = element.value;
    const request = new XMLHttpRequest();
    request.addEventListener("load", function() {
        const result = JSON.parse(this.responseText).result;
        element.style = 
            `border-bottom: ${result ? 'none' : '2px solid red'};
            color: ${result ? 'black' :'red'};`
    });
    request.open("GET", "../actions/verify.php?" + encodeForAjax(query), true);
    request.send();
}

document.querySelectorAll("input:not([type=button])") .forEach(element => {
    element.addEventListener("input", input => {
        const element = input.target;
        verifyField(element);
    })
});

document.querySelector("input[type=button]").addEventListener("click", () => {
    if (Array.from(document.querySelectorAll("input:not([type=button])")).every(input => input.style["border-bottom-color"] != "red" && input.value != "")) {
        document.forms[0].submit();
    }
});