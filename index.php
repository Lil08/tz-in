<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Тестовое задание ИНЛАЙН</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $(".search_button").click(function () {
                var searchString = $("#search_box").val();
                var data = 'search=' + searchString;

                if (searchString) {
                    $.ajax({
                        type: "POST",
                        url: "search.php",
                        data: data,
                        beforeSend: function (html) {
                            $("#results").html('');
                            $("#search_results").show();
                            $(".word").html(searchString);
                        },
                        success: function (html) {
                            $("#results").show();
                            $("#results").append(html);
                        }
                    });
                }
                return false;
            });
        });
    </script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Поиск</h3>
            <form method="post" action="search.php" id="search">
                <div class="form-row">
                    <div class="form-group col-md-10">
                        <input type="text" name="search" id="search_box" class='search_box form-control'>
                    </div>
                    <div class="form-group col-md-2">
                        <button type="submit" class="search_button btn btn-primary btn-block">Найти</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<div id="search_results">Результат поиска по записям, которые в комменатариях содержат "<span class="word"></span>"
</div>
<ul id="results"></ul>
<div>
</body>
</html>