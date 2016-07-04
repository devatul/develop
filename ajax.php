<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script type="text/javascript">
        $(function() {
            $("#datepicker").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });

        function ajaxcall() {
            $.getJSON("result.php",
                function(results) {

                    var rowdata = "<tbody>";
                    $.each(results, function(i, field) {
                        rowdata += "<tr>";
                        $.each(field, function(keys, data) {
                            rowdata += "<td>" + data + "</td>";
                        });
                        rowdata += "</tr>";
                    });
                    rowdata += "</tbody>";
                    if ($("#div1 > table").find("tbody").length > 0) {
                        $("#div1 > table").find("tbody").remove();
                        $("#div1 > table").append("<tr><th>Sr.No.</th><th>Name</th><th>Email</th><th>Message</th><th>Date</th></tr>");
                        $("#div1 > table").append(rowdata);
                    } else {
                        $("#div1 > table").append("<tr><th>Sr.No.</th><th>Name</th><th>Email</th><th>Message</th><th>Date</th></tr>");
                        $("#div1 > table").append(rowdata);
                    }
                    setTimeout(ajaxcall, 1000);
                });
        }
    </script>

    <style>
        table,
        td,
        th {
            border: 1px solid gray;
        }
    </style>
    <style>
        input[type=text],
        input[type=email],
        textarea {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            // display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        input[type=submit]:hover {
            background-color: #45a049;
        }
        
        #div2 {
            width: 50%;
            margin-top: 20px;
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }
        
        span {
            color: red;
        }
    </style>
</head>

<body>
    <div id="div1">
        <table></table>
    </div>

    <div id="div2">
        <center><span id="msg1" style="color:green"></span></center>
        <form id="sub">

            <label for="name">Name</label>
            <input type="text" id="name" name="name"></br>

            <label for="email">Email</label>
            <input type="email" id="email" name="email"></br>

            <label for="message">Message</label>
            <textarea id="message" name="message"></textarea></br>

            <label for="date">Date</label>
            <input type="text" name="date" id="datepicker"></br>

            <input id="submit" type="button" value="Submit">
            <span>All fields mandatory</span>
        </form>
    </div>
    <script type="text/javascript">
        //Name validation
        function valid_name() {
            var name = $("#name").val().trim(); //get the value of name input field
            if (name == "") { // checks if field is not empty
                $("#name").css("border-color", "red"); // Error message shown if field is empty
                return false;
            } else {
                $("#name").css("border-color", "#ccc");
                return true;
            }
        }


        //Message validation
        function message() {
            var msg = $("textarea#message").val().trim(); //get the value of name input field
            if (msg == "") { // checks if field is not empty
                $("#message").css("border-color", "red"); // Error message shown if field is empty
                return false;
            } else {
                $("#message").css("border-color", "#ccc");
                return true;
            }
        }
        // Email validation function 
        function valid_email() {
            var email = $("#email").val().trim(); //get the value of email input field
            if (email == "") { // checks if field is not empty
                $("#email").css("border-color", "red"); // Error message shown if field is empty
                return false;
            } else {
                var re = /^[a-zA-Z0-9._-]+[@]{1}[a-zA-Z0-9_]+[.]{1}[a-z]+$/; //Email pattern
                if (!re.test(email)) { //Checks the email pattern is correct
                    $("#email").css("border-color", "red"); // Error if pattern do not match and return false if it match, return true
                    return false;
                } else {
                    $("#email").css("border-color", "#ccc");
                    return true;
                }
            }
        }

        //Date validation
        function valid_date() {
            var tdate = $("#datepicker").val().trim(); //get the value of name input field
            if (tdate == "") { // checks if field is not empty
                $("#datepicker").css("border-color", "red"); // Error message shown if field is empty
                return false;
            } else {
                $("#datepicker").css("border-color", "#ccc");
                return true;
            }
        }

        $(document).ready(function() {
            ajaxcall();

            // form validation initiated here
            $("#submit").click(function() {
                var name = $("#name").val();
                var email = $("#email").val();
                var mesg = $("#message").val();
                var tdate = $("#datepicker").val();
                var err = 0;

                if (!valid_name()) {
                    err = 1;
                }
                if (!message()) {
                    err = 1;
                }
                if (!valid_date()) {
                    err = 1;
                }
                if (!valid_email()) {
                    err = 1;
                }
                if (err == 0) {
                    // AJAX form submit
                    $.ajax({
                        type: 'POST',
                        url: 'formsubmit.php',
                        data: {
                            name1: name,
                            email: email,
                            msg: mesg,
                            date1: tdate
                        },
                        success: function(data) {
                            $("#msg1").text(data);
                            $('form#sub').find("input[type=text],input[type=email], textarea").val("");
                            setTimeout(function() {
                            $( "#msg1" ).fadeOut( "slow" );
        			$("#msg1").text("");
   				 }, 5000);

                        }
                    });
                }

            });
        });
    </script>
</body>

</html>
