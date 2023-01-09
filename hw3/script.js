function ajax(url, settings){
    var xhr = new XMLHttpRequest();
    xhr.onload = function(){
      if (xhr.status == 200) {
        settings.success(xhr.responseText);
      } else {
        console.error(xhr.responseText);
      }
    };
    xhr.open(settings.method || 'GET', url, true);
    xhr.send(settings.data || null);
}

function passwordCharacterValidation(password) { //Нарочно без regex
    const hasLower = password.split("").filter((x) => x === x.toLowerCase()).length > 0;
    const hasUpper = password.split("").filter((x) => x === x.toUpperCase()).length > 0;
    const hasNumber = password.split("").filter((x) => Number(x)).length > 0;
    return hasLower && hasUpper && hasNumber;
}

const formToJSON = (elements) =>
  [].reduce.call(
    elements,
    (data, element) => {
      data[element.name] = element.value;
      return data;
    },
    {},
  );

const form = document.getElementById("form");

form.addEventListener("submit", (event) => {
    // document.getElementById("username_error").innerHTML = "";
    // document.getElementById("password_error").innerHTML = "";
    // document.getElementById("password_confirmation_error").innerHTML = "";

    const discipline = document.getElementById("discipline").value;
    const teacher = document.getElementById("teacher").value;
    const description = document.getElementById("description").value;
    const group = document.getElementById("group").value;
    const credits = document.getElementById("credits").value;

    // if (username < 3 || username.length > 10) {
    //     document.getElementById("username_error").innerHTML = "Username must be at least 3 characters long and less than 10 characters long.";
    // }
    // if (password.length < 6 || !passwordCharacterValidation(password)) {
    //     document.getElementById("password_error").innerHTML = "Password must be at least 6 characters long and has at least 1 uppercase, 1 lowercase character and 1 digit.";
    // }
    // if (password !== password_confirmation) {
    //     document.getElementById("password_confirmation_error").innerHTML = "Password does not match.";
    // }


    //  Задача 1
    // if (document.getElementById("password_confirmation").innerHTML !== ""
    // || document.getElementById("username").innerHTML !== ""
    // || document.getElementById("password").innerHTML !== "") {
    //     event.preventDefault();
    // }

    // Задача 2
    event.preventDefault();


    // if (document.getElementById("password_confirmation_error").innerHTML === ""
    //     && document.getElementById("username_error").innerHTML === ""
    //     && document.getElementById("password_error").innerHTML === "") {

    const callback = function (text) {
        console.log(text);
        // document.getElementById("result").innerHTML = text;
    };

    ajax("81985.php", 
    {method: "POST", 
        data: JSON.stringify(formToJSON(form)),
        // data: JSON.stringify({}),
        success: callback});
    // }
});