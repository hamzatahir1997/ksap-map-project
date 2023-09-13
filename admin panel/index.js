window.onload = function(){

    // Ajax call when agency changes
    let selector = document.querySelector("#agency");
    selector.addEventListener('change',function(){
   
    //getting selected agency below
    let agency_name = $("#agency option:selected").text();
    
    //POST request to server to return the relevent schools
    $.post("agency_handler.php", {"agency_name":agency_name}, function(data) {
        console.log(data);
       let schools = JSON.parse(data);
       removeChilds(document.getElementById('school'));
       add_option("null","Select a School","school");
        for (const prop of schools){
            add_option(prop['id'],prop['sname'],'school');
           
        }
    
    })
      .fail(function() {
        console.log("error");
    });


    });


    // Ajax call for school selection (to show relevent floors)

    let school_selector = document.querySelector("#school");

    school_selector.addEventListener("change",function(){

        let school_id = school_selector.value;
        $.post("school_handler.php", {"school_id":school_id}, function(data) {
        console.log(data);
           let floors = JSON.parse(data);
           console.log(floors);
          
           removeChilds(document.getElementById('floor'));
            add_option("null","Select a Floor","floor");
            let c=1;
            for (const prop of floors){
            add_option(prop['id'],`Floor ${c}`,'floor');
            c++;
               console.log(prop)
            }
        
        }).fail(function(){
            console.log("ERROR")
        })
        

        
    });









    // HELPER FUNCTIONS BELOW
    function add_option(val,text,select_box){
        var sel = document.getElementById(select_box);
       
        // create new option element
       var opt = document.createElement('option');
       
       // create text node to add to option element (opt)
       opt.appendChild( document.createTextNode(text) );
       
       // set value property of opt
       opt.value = val;
       
        // add opt to end of select box (sel)
       sel.appendChild(opt);
       
    }
       
        var removeChilds = function (node) {
            var last;
           //Delete every lastChild of the City Selector------- Delete all children
            while (last = node.lastChild) node.removeChild(last);
    };
   
   
   
   }
   
   