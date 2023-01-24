function formhash(form, password) {
    // Crea un elemento di input che verrà usato come campo di output per la password criptata.
    var p = document.createElement("input");
    // Aggiungi un nuovo elemento al tuo form.
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden"
    p.value = hex_sha512(password.value);
    // Assicurati che la password non venga inviata in chiaro.
    password.value = "";
    // Come ultimo passaggio, esegui il 'submit' del form.
    form.submit();
}

function toggleSearchTab() {
    search = document.getElementById('search-tab');
    if (search.style.display == 'block') {
        search.style.display = 'none';
    } else {
        search.style.display = 'block';
    }
}

function uploadPost($post_image,$description){
    //Use ajax to follow/unfollow
    $.ajax({
        type: "POST",
        url: "post-upload.php",
        data: {post_image: $post_image, description: $description},
        success: function(data){
            $dataArray=JSON.parse(data);
            //If follow is successful, change follow-button button text
            if($dataArray["response"]){
                $("#upload-message").text($dataArray["message"]);
                $("#upload-message").style.display("block");
            } else {
                postOverlayOff();
            }
        }
    });
}

function postOverlayOn() {
    document.getElementById("overlay").style.display = "block";
}

function postOverlayOff() {
    document.getElementById("overlay").style.display = "none";
}

function profileEditSuccess(message) {
    var x = document.getElementById("profile-edit");
    x.style.backgroundColor = "lightgreen";
    document.getElementById("profile-edit-message").innerText = message;
    if (x.style.display === "none") {
        x.style.display = "block";
    }
}

function profileEditFailure(message) {
    var x = document.getElementById("profile-edit");
    x.style.backgroundColor = "lightred";
    document.getElementById("profile-edit-message").innerText = message;
    if (x.style.display === "none") {
        x.style.display = "block";
    }
}

function followersOverlayOn() {
    document.getElementById("floating-followers").style.display = "block";
}

function followersOverlayOff() {
    document.getElementById("floating-followers").style.display = "none";
}

function followingOverlayOn() {
    document.getElementById("floating-following").style.display = "block";
}

function followingOverlayOff() {
    document.getElementById("floating-following").style.display = "none";
}

function closeComments(){
    document.getElementById("comments-container").innerHTML="";
    document.getElementById("floating-comments").style.display="none";
}
