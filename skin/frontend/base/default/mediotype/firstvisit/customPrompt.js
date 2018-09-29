/**
 * Custom prompt code
 * @author Mediotype
 */

function customPrompt( id ) {
    overlay(id);
    var prompt = document.getElementById(id);
    prompt.className += " active";
}

function overlay(id){
    var overlay = document.createElement("div");
    overlay.setAttribute("id", "overlay");
    overlay.setAttribute("class", "overlay");
    overlay.onclick = function () {
        closeClick(id)
    };
    document.body.appendChild(overlay);
}

function closeClick(id) {
    var popup = document.getElementById(id);
    if (popup) {
        popup.className = popup.className.replace( /(?:^|\s)active(?!\S)/ , '' )
        removeOverlay();
    }
}


function removeOverlay() {
    var o = document.getElementById("overlay");
    if(o){
        document.body.removeChild(o);
    }
}
