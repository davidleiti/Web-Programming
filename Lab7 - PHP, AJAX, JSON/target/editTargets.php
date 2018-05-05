<!DOCTYPE html>
<head>
    <title>Edit data</title>
    <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous">
    </script>
    <script src = "setupEditPage.js"></script>
    <link rel = "stylesheet" href = "../editPages.css">
</head>
<body>
    <form action = "../index.html">
        <input type = "submit" value = "<< Return">
    </form>
    <form method = "GET">
        <fieldset>
            <legend>Target fields:</legend>
            <table>
                <tr>
                    <th>Target ID:</th>
                    <th><input type = "text" id = "TargetID"></th>
                </tr>
                <tr>
                    <th>Name:</th>
                    <th><input type = "text" id = "Name"></th>
                </tr>
                <tr>
                    <th>Description:</th>
                    <th><input type = "text" id = "Description"></th>
                </tr>
                <tr>
                    <th>Destination ID:</th>
                    <th><input type = "text" id = "DestinationID"></th>
                </tr>
            </table>
            <table id = "operations">
                <tr>
                    <th>Show all targets:</th>
                    <th><input class = "b" type = "button" id = "showAll" value = "Show"></th>
                </tr>
                <tr>
                    <th>Show target with given ID:</th>
                    <th><input class = "b" type = "button" id = "showWithID" value = "Show"></th>
                </tr>
                <tr>
                    <th>Insert target:</th>
                    <th><input class = "b" type = "button" id = "insert" value = "Insert"></th>
                </tr>
                <tr>
                    <th>Remove target with given ID:</th>
                    <th><input class = "b" type = "button" id = "delete" value = "Remove"></th>
                </tr>
                <tr>
                    <th>Update target:</th>
                    <th><input class = "b" type = "button" id = "update" value = "Update"></th>
                </tr>
            </table>
        </fieldset>   
    </form>
    <div id = "targets">
    </div>

</body>