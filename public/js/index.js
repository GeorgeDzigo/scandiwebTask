const errorDisplay = document.getElementById("errors");

function show(resetInputs = false) {
      errorDisplay.innerHTML = "";
      var d = document.querySelector(".sizes-option");
      
      var dis = d.options[d.selectedIndex].value;
      let el = document.querySelectorAll(".size-type");
      // Reset all inputs
      if(!resetInputs)
            el.forEach(v => {
                  if(v.id != dis) v.querySelectorAll(".int").forEach(x => x.value = "");
            });
    
      document.querySelectorAll('.size-type').forEach((v) => {
            v.style.display = 'none';
            v.classList.remove('selected');    
      });
      
      // Change display to block to selected size type
      document.querySelector('.' + dis).style.display = "block";
      document.querySelector('.' + dis).classList.add("selected");

      return dis;
}
function fetchInputs() {
      if (document.querySelector('.selected')) 
            return document.querySelector('.selected').querySelectorAll(".form-control");
      
      return false;
}
// This function checks blank inputs
function blankInputsCheck() {
      let errors = [];
      let defaultInputs = document.querySelectorAll(".default-input");

      let allInputs = Array.from(defaultInputs);
      let selected = fetchInputs();

      if (selected) 
            allInputs.concat(Array.from(selected));
      
      allInputs.forEach(input => {
            if (!input.value.length) {
                  errors.push(input.placeholder);
                  errorDisplay.innerHTML += "<li>Please submit " + input.placeholder + "</li>";
            }
      });

      return errors;
}

// This function checks selected type inputs
function selectedTypeInputsCheck() {
      let errors = [];
      let selectedTypeInputs = fetchInputs();

      if (!selectedTypeInputs) {
            errors.push("type");
            errorDisplay.innerHTML += "<li>Please select type</li>";

            return errors;
      }

      selectedTypeInputs.forEach(input => {
            if (parseInt(input.value) != input.value) {
                  errors.push(input.placeholder);
                  errorDisplay.innerHTML += "<li>Please provide valid " + input.placeholder + "</li>";
            }
      });

      return errors;
}

function priceInputCheck() {
      let priceInput = document.getElementById('price');
      let errors = []

      if (!priceInput.value.match(/^\d{0,8}(\.\d{1,2})?$/))
      {
            errorDisplay.innerHTML += "<li>Please Provide valid Price</li>";
            errors.push(priceInput.placeholder);
      }
      
      return errors;
}

// This function will submit data if there are no errors
function submitData() {
      errorDisplay.innerHTML = "";
      if (!blankInputsCheck().length && !priceInputCheck().length && !selectedTypeInputsCheck().length) document.getElementById('product_form').submit();
}
show(true);