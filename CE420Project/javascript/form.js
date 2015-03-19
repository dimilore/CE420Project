/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//clear text on click
function clear_text(element){
    element.value='';
}

//restore default value if enter nothing
function clickrecall(element, defaulttext) {
        if (element.value =='') {
            element.value = defaulttext;
        }
}
