function verifyField(element) {
    if (element.value === "") return;
    let query = {}; query[element.name] = element.value;
    const request = new XMLHttpRequest();
    request.addEventListener("load", function() {
        const result = JSON.parse(this.responseText).result;
        const input = document.querySelector(`input[name=${element.name}]`);
        input.style = 
            `border-bottom: ${result ? 'none' : '2px solid red'};
            color: ${result ? 'black' :'red'};`
    });
    request.open("GET", "../actions/verify.php?" + encodeForAjax(query), true);
    request.send();
}