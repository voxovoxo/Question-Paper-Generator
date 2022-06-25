
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Question paper Generator</title>
    <script src="https://kit.fontawesome.com/d7771001ec.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="static/css/style.css">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ajax-bootstrap-select/1.4.5/js/ajax-bootstrap-select.min.js" integrity="sha512-HExUHcDgB9r00YwaaDe5z9lTFmTChuW9lDkPEnz+6/I26/mGtwg58OHI324cfqcnejphCl48MHR3SFQzIGXmOA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
       
    <script type="text/javascript">
        $(document).ready(function () {
            $('#cour').selectpicker();
             $("#sem").selectpicker();
   
                function load_data(type, category_id) {
                    $.ajax({
                        url: "/generate",
                        method: "POST",
                        data: { type: type, category_id: category_id },
                        dataType: "json",
                        success: function (data) { //alert(category_id)
                            var html = "";
                            for (var count = 0; count < data.length; count++) {
                                html += '<option value="' + data[count].id + '">' + data[count].name + "</option>";
                            }
                            if (type == "selsem") {
                                $("#cour").html(html);
                                $("#cour").selectpicker("refresh");
                            } else {
                                $("#sem").html(html);
                                $("#sem").selectpicker("refresh");
                            }
                        },
                    });
                }
   
                $(document).on("change", "#cour", function () {
                    var category_id = $("#cour").val();
                    load_data("carModeldata", category_id);
                });
        });

        function callvalue(){

        var time = document.getElementById("time").value;
        localStorage.setItem("textvalue", time);
        var cour = document.getElementById("cour").value;
        localStorage.setItem("textvalue1", cour);
        var marks = document.getElementById("marks").value;
        localStorage.setItem("textvalue2", marks);
        var sem = document.getElementById("sem").value;
        localStorage.setItem("textvalue3", sem);
        var sub = document.getElementById("sub").value;
        localStorage.setItem("textvalue4", sub);
        var chap = document.getElementById("chap").value;
        localStorage.setItem("textvalue5", chap);
        
        return true;
        }
    </script>

    <style>
        body {
            background-image: url(static/assets/images/genbg.png);
        }


        #navbarSupportedContent > ul > li:nth-child(n) > a {
            color: #fff;
            font-size: 1.1rem;
            padding: 0 1.5rem;
        }

        h1 {
            padding-top: 100px;
            color: #fff;
            padding-left: 450px
        }


        h6 {
            font-family: sans-serif;
            margin-top: 2.5px;
        }
        .form-check-label{
            color: #fff;
        }
        .dropbtn {
            background-color: #2a687d;
            color: white;
            font-family: sans-serif;
            font-size: 16px;
            border: none;
        }

        .dropdown {
            position: relative;
            display: inline-block;
            padding: 0 1.5rem;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
         .btn {
            width: 30%;
            background: #fff;
            height: 60px;
            text-align: center;
            Line-height: 60px;
            text-transform: uppercase;
            color: #000;
            font-weight: bold;
            letter-spacing: 1px;
            cursor: pointer;
            margin-bottom: 30px;
            border-radius: 50px;
            
        }
            .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }

                .dropdown-content a:hover {
                    background-color: #ddd;
                }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #2a687d;
        }

        .user {
            margin-top: 150px;
            margin-left: 30px;
        }

        .form {
            margin-top: 150px;
        }

        .col-form-label {
            color: white;
            padding-left: 50px;
        }
        .form-control{
            color: black;
        }

        #cour{
            color: black;
        }

    </style>
</head>
<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="static/assets/images/qpg.png" align="left" width="60" height="60" />
                    <h4>
                        OUESTION PAPER<br />
                        GENERATOR
                    </h4>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="user.html"><h6>HOME</h6></a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <button class="dropbtn">MENU</button>
                                <div class="dropdown-content">
                                    <a href="courses.html">COURSES</a>
                                    <a href="gqp.html">GENERATE QUESTION PAPER</a>
                                    <a href="list.html">SHOW ALL QUESTION PAPERS</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.html"><h6>LOGOUT</h6></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <h1><img src="static/assets/images/slide3.png" width="150" height="150" />Generate Question Paper</h1>
  
    <form action="pdf.html" method="POST">
        <div class="form-group row">
            <label for="add" class="col-md-2 col-form-label"> Select Course: </label>
            <div class="col-md-4">
            <input type="text" class="form-control" id="cour" name="cour" placeholder="">
            
                <!--<select id="cour" name="cour" data-live-search="true" class="form-control" title="courses">
                {% for row in questions %}
                    <option value="{{row.courses}}" class="opt">{{row.courses}}</option>
                    {% endfor %}
                    </select>-->
            </div>
        </div><br />
        <div class="form-group row">
            <label for="add" class="col-md-2 col-form-label"> Select Semester: </label>
            <div class="col-md-4">
            <input type="text" class="form-control" id="sem" name="sem" placeholder="">
            
                         
          </div>
        </div><br />
        <div class="form-group row">
            <label for="add" class="col-md-2 col-form-label"> Select Subject: </label>
            <div class="col-md-4">
            <input type="text" class="form-control" id="sub" name="sub" placeholder="">
            
                <!--<select id="sub" name="sub" >
                    <option>Select</option>
                    {% for row in questions %}
                    <option value="{{row.sub}}">{{row.sub}}</option>
                    {% endfor %}
                </select>-->
            </div>
        </div><br />

        <div class="form-group row">
                <label for="add" class="col-md-2 col-form-label">Select Chapters:</label>
                <div class="col-md-4">
                <input type="text" class="form-control" id="chap" name="chap" placeholder="">
            
                <!--<select id="chap" name="chap">
                    <option>Select</option>
                    {% for row in questions %}
                    <option value="{{row.chap}}">{{row.chap}}</option>
                    {% endfor %}
                </select>-->
                    </div>
            </div>
            <br />
            <div class="form-group row">
                <label for="chap" class="col-md-2 col-form-label">Total Marks:</label>
                <div class="col-md-4">
                <input type="text" class="form-control" id="marks" name="marks" placeholder="">
            
</div>
 </div>
<br />
        <div class="form-group row">
            <label for="time" class="col-md-2 col-form-label"> Paper Duration:</label>
            <div class="col-md-4">
                <input type="text" class="form-control" id="time" name="time" placeholder="">
            </div>
        </div><br />
        <div class="form-group row">
                <div class="offset-md-2 col-md-10">
                <input type="submit" class="btn" value="GENERATE" onclick="callvalue();"/>
                  </div>
           </div>
    </form>
</body>
</html>