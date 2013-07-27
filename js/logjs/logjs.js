
if (typeof window.onerror != "undefined") {
    var windowOnError = window.onerror;
    window.onerror = function(errorMessage, file, lineNumber) {
        var url = "/logjs.php";
        new Ajax.Request(
            url, {
                parameters: {
                    errorMessage: errorMessage,
                    file: file,
                    lineNumber: lineNumber,
                    "url": window.location.href
                },
                method: "post"
            }
        );
        if (typeof windowOnError == "function") {
            windowOnError();
        }
    };
}
