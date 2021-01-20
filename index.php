<!DOCTYPE html>
<html>
    <body>
        <form id="form">
            <input type="file" id="cerditao" name="certidao">
            <input type="submit">
        </form>
        <script>
            (function() {
                const form = document.getElementById("form");
                form.onsubmit = function(e) {
                    console.log(e.target);
                    let formData = new FormData(e.target);
                    let req = new XMLHttpRequest();
                    req.open("POST", "doc-analyzer.php");
                    req.send(formData);
                    return false;
                }
            })();
        </script>
    </body>
</html>