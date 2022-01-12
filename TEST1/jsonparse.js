function submit_click() {
    
    let txtdata = document.getElementById('txt_input').value;
    let  txtjson = '';
    try {
        txtjson = convertToArray(txtdata);
        alert(print_r(txtjson));
    } catch (error) {
        alert(print_r(txtdata));
    }
    
}


function convertToArray(input){
    let obj = JSON.parse(input);
    let arr = new Array();
        for(var i in obj){
            arr.push(obj);
        }            
    return arr;
}

function print_r(arr,level) {
    let dumped_text = "";
    let level_padding = "";

    if(!level) level = 0;
  
    for(let j=0;j<level+1;j++) level_padding += "    ";
    
        if(typeof(arr) == 'object') {
            for(var item in arr) {
                var value = arr[item];
                if(typeof(value) == 'object') { 
                    dumped_text += level_padding + "'" + item + "' ...\n";
                    dumped_text += print_r(value,level+1);
                } else {
                    dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
                }
            }
        } else {
            dumped_text = "=== "+arr+" ===("+typeof(arr)+")";
        }

    return dumped_text;
}