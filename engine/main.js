//section for show/hide selected tags
function filter_tag(c, d) {
    let x, y, arr1;
    //get all rows from table
    x = document.getElementsByClassName("filterTag");
    //get all tags
    y = document.getElementsByClassName("w3-check-tag");
    if (d === "hide") {
        for (let i = 0; i < x.length; i++) {
            //separate tags in i row
            arr1 = x[i].className.split(" ");
            //check if tag is in row and hideTag is not true then hide row
            if (arr1.indexOf(c) > -1 && arr1.indexOf("hideTag") === -1) {
                x[i].className += " hideTag";
            }
        }
        //change action in selected checkbox
        document.getElementById(c).setAttribute("onclick", "filter_tag('" + c + "', 'show')");
    } else if (d === "show") {
        for (let i = 0; i < x.length; i++) {
            //separate tags in i row
            arr1 = x[i].className.split(" ");
            //check if tag is in row and hideTag is false then show row
            if (arr1.indexOf(c) > -1 && arr1.indexOf("hideTag") > -1) {
                x[i].classList.remove("hideTag");
            }
        }
        //change action in selected checkbox
        document.getElementById(c).setAttribute("onclick", "filter_tag('" + c + "', 'hide')");
    } else {
        console.log("error");
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
    //get all tags
    x = document.getElementsByClassName("w3-check-tag");
    //get all rows from table
    y = document.getElementsByClassName("filterTag");
    if (c === "show") {
        for (let i = 0; i < y.length; i++) {
            //separate tags in i row
            arr1 = y[i].className.split(" ");
            //check if hideTag is true then show row
            if (arr1.indexOf("hideTag") > -1) {
                y[i].classList.remove("hideTag");
            }
        }
        //change action in selected checkbox and check it
        for (let i = 0; i < x.length; i++) {
            x[i].checked = true;
            document.getElementById(x[i].id).setAttribute("onclick", "filter_tag('" + x[i].id + "', 'hide')");
        }
        //change action on button for show/hide all tags
        document.getElementById("button_show_hide_tags").setAttribute("onclick", "show_hide_tags('hide')");
    } else if (c === "hide") {
        for (let i = 0; i < y.length; i++) {
            //separate tags in i row
            arr1 = y[i].className.split(" ");
            //check if hideTag is false then hide row
            if (arr1.indexOf("hideTag") === -1) {
                y[i].className += " hideTag";
            }
        }
        //change action in selected checkbox and uncheck it
        for (let i = 0; i < x.length; i++) {
            x[i].checked = false;
            document.getElementById(x[i].id).setAttribute("onclick", "filter_tag('" + x[i].id + "', 'show')");
        }
        //change action on button for show/hide all tags
        document.getElementById("button_show_hide_tags").setAttribute("onclick", "show_hide_tags('show')");
    } else {
        console.log("error");
    }
}

//end of function for show/hide all tags