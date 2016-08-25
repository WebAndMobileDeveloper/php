var app = angular.module("myApp", []);

app.directive("scrollBottom", function () {
    return {
        link: function (scope, element, attr) {

            var $id = $(attr.scrollBottom);

            $(element).on("click", function () {
                setTimeout(function () {
                    $id.scrollTop($id[0].scrollHeight);
                }, 1);
            });
        }
    }
});
