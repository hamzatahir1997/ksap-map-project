window.onload = function(){


    document.querySelector("form").onsubmit = function(e){
        var checkbox= document.querySelector('input[name="race[]"]:checked');
        if(!checkbox) {
            alert('Please select your ethnicity!');
            e.preventDefault()
            return false;
        }
    }

}