//section for show/hide selected tags
function filter_tag(c) {
    let x, y, i, arr1, arr2;
    x = document.getElementsByClassName("filterTag");
    for (i = 0; i < x.length; i++) {
        arr1 = x[i].className.split(" ");
        if (arr1.indexOf(c) > -1 && arr1.indexOf("hideTag") === -1) {
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
function show_hide_tags(c) {
    let x, y, arr1;
    x = document.getElementsByClassName("w3-check-tag");
    y = document.getElementsByClassName("filterTag");
    if (c === "show") {
        for (i = 0; i < y.length; i++) {
            arr1 = y[i].className.split(" ");
            if (arr1.indexOf("hideTag") > -1) {
                y[i].classList.remove("hideTag");
            }
        }
        for (i = 0; i < x.length; i++) {
            x[i].checked = true;
        }
        document.getElementById("button_show_hide_tags").setAttribute("onclick", "show_hide_tags('hide')");
    }
    else if (c === "hide") {
        for (i = 0; i < y.length; i++) {
            arr1 = y[i].className.split(" ");
            if (arr1.indexOf("hideTag") === -1) {
                y[i].className += " hideTag";
            }
        }
        for (i = 0; i < x.length; i++) {
            x[i].checked = false;
        }
        document.getElementById("button_show_hide_tags").setAttribute("onclick", "show_hide_tags('show')");
    }
    else {
        console.log("error");
    }
}
//end of function for show/hide all tags