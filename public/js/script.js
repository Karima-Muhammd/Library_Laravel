function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";

    }
}
function getIframeContent(frameId) {
    var frameObj =
        document.getElementById(frameId);

    var frameContent = frameObj.
        contentWindow.document.body.innerHTML;

    alert("frame content : " + frameContent);
}
