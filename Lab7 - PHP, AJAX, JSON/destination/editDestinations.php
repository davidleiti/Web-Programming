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
            <legend>Destination fields:</legend>
            <table>
                <tr>
                    <th>Destination ID:</th>
                    <th><input type = "text" id = "DestinationID"></th>
                </tr>
                <tr>
                    <th>Country:</th>
                    <th><input type = "text" id = "Country"></th>
                </tr>
                <tr>
                    <th>City:</th>
                    <th><input type = "text" id = "City"></th>
                </tr>
                <tr>
                    <th>Description:</th>
                    <th><input type = "text" id = "Description"></th>
                </tr>
            </table>
            <table id = "operations">
                <tr>
                    <th>Show all desinations:</th>
                    <th><input class = "b" type = "button" id = "showAll" value = "Show"></th>
                </tr>
                <tr>
                    <th>Show destination with given ID:</th>
                    <th><input class = "b" type = "button" id = "showWithID" value = "Show"></th>
                </tr>
                <tr>
                    <th>Insert destination:</th>
                    <th><input class = "b" type = "button" id = "insert" value = "Insert"></th>
                </tr>
                <tr>
                    <th>Remove destination with given ID:</th>
                    <th><input class = "b" type = "button" id = "delete" value = "Remove"></th>
                </tr>
                <tr>
                    <th>Update destination:</th>
                    <th><input class = "b" type = "button" id = "update" value = "Update"></th>
                </tr>
            </table>
        </fieldset>   
    </form>
    <div id = "destinations">
    </div>

</body>