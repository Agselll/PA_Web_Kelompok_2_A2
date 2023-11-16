const result = window.confirm("We will go to BoxSound website, do you want continue?");
if (result === true) {
    console.log("you can choose OK");
} else {
    console.log("Cancel or close the web");
}

window.addEventListener("load", () => {

    const colorItems = document.querySelectorAll('.color-item');
    colorItems.forEach( item => {
        item.addEventListener('click', function() {
            const idSelected = this.id;
            document.body.className = idSelected;
        });
    });

});

document.addEventListener("DOMContentLoaded", function () {
    const element = this.documentElementByid("h3");
    element.innerText += "boxsound";
});