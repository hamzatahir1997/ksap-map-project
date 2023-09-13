window.onload = function () {
  const ALERT_LANGUAGES = {
    English :{
      
      ALL_ROOMS: "You need to color all the rooms!",
      WARNING:"You are now submitting your map and will not be able to make any edits. Are you ready to continue?"
   
    },
    SPANISH : {
      ALL_ROOMS:  "Necesitas colorear todas las habitaciones!",
      WARNING:"Ahora está enviando su mapa y no podrá realizar ninguna edición. Estás lista para continuar?"
    }
  };
  const is_english = JSON.parse(document.querySelector("#is-lang-english").value);
  // Using Jquery here to ease some tasks
  // Start Jquery
  console.log("DATA SENDER LOADED")
  // This gives us the current active li element
  let activeLink = $("li.active");
  try {
    // href attribute of the next li element in navbar
  //  console.log($(activeLink).next().children()[0].getAttribute("data-href"))
    var nextLink = $(activeLink).next().children()[0].getAttribute("data-href");
  } catch (error) {
    // Jquery would throw TypeError if there's no prev() element and we search for its children
    if (error instanceof TypeError) {
      nextLink = null;
    }
  }
  //nextLink = nextLink.children()[0].href;
  // Jquery would throw TypeError if there's no prev() element and we search for its children
  try {
    // href attribute of the previous li element in navbar
    var prevLink = $(activeLink).prev().children()[0].getAttribute("data-href");
  } catch (error) {
    if (error instanceof TypeError) {
      prevLink = null;
    }
  }
  $("#prev_button").attr('href', prevLink)
  $("#next_button").attr("href", nextLink)
  if ((prevLink == null)) {
    $("#prev_button").hide();
  }
  if (nextLink == null) {
    $("#next_button").hide()
  }
  if (nextLink != null){
    $("#submit_button").hide()
  }
  var a = document.getElementById("alphasvg");
  var svgDoc = a.contentDocument;
  // End Jquery
  var dict = {};
  var btns = document.querySelectorAll(".data_submitter");
  for (btn of btns) {
    // Send data to backend by clicking any of the 3 buttons 'prev', 'submit', 'next'.
    btn.onclick = function (event) {
      event.preventDefault();
      var floor_id = document.getElementById("school_floor_level").value;
      var li = document.querySelector("li.active + li");
      var last = false;
      var btn_clicked = event.target;
      // li is the next element in the navbar, it is null if we are currently on the last element.
      if (li == null && btn_clicked.getAttribute("id") == "submit_button") {
        last = true;
      }
      var school_id = document.getElementById("school_id").value;
      var guid = document.getElementById("guid").value;
      //get the inner DOM of alpha.svg
      var paths = $(svgDoc).find('path').select();
      var elems = Array.from(paths)
      // Looping through all path elements to check if any of them is not colored.
      for (let elem of elems) {
        let colorFilled = elem.getAttribute('data-color');
        console.log(colorFilled)
        // The check of 'colorFilled == white' is for backward compatibility.
        // We had 'white' color when the color was null.
        if ((colorFilled == null || colorFilled == "null" || colorFilled == "white") && !(btn_clicked.getAttribute("id") == "prev_button")){
          console.log("You need to color all the spaces");
          console.log(elem);
        if (is_english){
          alert(ALERT_LANGUAGES.English.ALL_ROOMS);
        }
        else{
          alert(ALERT_LANGUAGES.SPANISH.ALL_ROOMS)
        }
          return false;
        }
        let roomName = elem.getAttribute("data-name");
        //Assigning the data-color value to the room name, it will look like this {'myroom':'green'}
        dict[roomName] = colorFilled
      }
      // Confirm before submitting data for the last time
      var r = ""
      if (last == true){
        if (is_english){
          r=confirm(ALERT_LANGUAGES.English.WARNING);
        }
        else{
          r=confirm(ALERT_LANGUAGES.SPANISH.WARNING)
        }        
       
        if (r == false){
          return false;
        }
      }
      $.post("validate.php", { "data": dict, "floor_id": floor_id, "school_id": school_id, "last": last, "guid": guid }, function (data) {
      })
        .fail(function () {
          console.log("error");
        })
        .always(function () {
          // location.reload();
          console.log("COMPLETED")
          document.getElementById("submit_button").style.display = "none";
          // Below : we are deciding which location to go to after submitting the data.
          var li = document.querySelector("li.active + li");
          if (li == null && btn_clicked.getAttribute("id") == "submit_button") {
            // If li is null, it means the user is on last page
            document.location.href = 'thankyou.php';
          }
          else {
            // If li is not null and he clicks 'submit', he will just be taken to the next page.
            if (btn_clicked.getAttribute("id") == "submit_button") {
              document.location.href = nextLink;
            }
            // Else, just take him to the link of the button he clicked.
            else {
              document.location.href = btn_clicked.getAttribute("href");
            }
          }
        });
    }
  }
  // Function to add an SVG text element to an element named 'p'  
  function addText(p) {
    var t = document.createElementNS("http://www.w3.org/2000/svg", "text");
    var b = p.getBBox();
    t.setAttribute("transform", "translate(" + (b.x + b.width / 2) + " " + (b.y + b.height / 2) + ")");
    t.textContent = "Fill this";
    t.setAttribute("fill", "black");
    t.setAttribute("class", "svg-text")
    t.setAttribute("font-size", "5");
    //p.parentNode.insertBefore(t, p.nextSibling);
    p.parentNode.append(t)
  }
}