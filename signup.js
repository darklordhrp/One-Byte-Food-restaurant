document.getElementById("signup-form").addEventListener("submit", function(event) {
    event.preventDefault(); 

    var username = document.getElementById("signup-username").value;
    var email = document.getElementById("signup-email").value;
    var phone = document.getElementById("signup-phone").value;
    var password = document.getElementById("signup-password").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "signup.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            
            console.log(xhr.responseText);
            
        }
    };
    xhr.send("username=" + username + "&email=" + email + "&phone=" + phone + "&password=" + password);
});
