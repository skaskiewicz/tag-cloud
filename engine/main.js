//section for show/hide selected tags
function filter_tag(c) {
    let x, y, i, arr1, arr2;
    x = document.getElementsByClassName("filterTag");
    for (i = 0; i < x.length; i++) {
        arr1 = x[i].className.split(" ");
        if (arr1.indexOf(c) > -1 && arr1.indexOf("hideTag") == -1) {
            x[i].className += " hideTag";
        } else {
            x[i].classList.remove("hideTag");
        }
    }
}

//end of section for show/hide selected tags

//function for show/hide top navbar with tags
function show_hide() {
    let x = document.getElementById("cloud_tags");
    if (x.className === "w3-container w3-padding-small w3-light-gray sticky w3-hide") {
        x.className = "w3-container w3-padding-small w3-light-gray sticky w3-show";
    } else {
        x.className = "w3-container w3-padding-small w3-light-gray sticky w3-hide";
    }
}

//end of function for show/hide top navbar with tags

//function for show/hide all tags
function show_hide_tags(C) {
    let x, y, z, i, arr1;
    x = document.getElementsByClassName("filterTag");
    y = document.getElementsByClassName("w3-check");
    if (c == "show") {
        for (i = 0; i < x.length; i++) {
            arr1 = x[i].className.split(" ");
            if (arr1.indexOf("hideTag") > -1) {
                x[i].classList.remove("hideTag");
            }
            y[i].checked = true;
        }
    } else {
        for (i = 0; i < x.length; i++) {
            arr1 = x[i].className.split(" ");
            if (arr1.indexOf("hideTag") == -1) {
                x[i].className += " hideTag"
            }
            y[i].checked = false;
        }
    }
}
//end of function for show/hide all tags