app.controller("Ctrl", function ($scope, $http) {

    $scope.users = [{
            fname: "s",
            lname: "v",
        }];

    $scope.remove = function (n) {
        $scope.name = "";
        $scope.users.splice(n, 1);
        console.log("Removed");
        $scope.name = "User Removed !!!";
    }
    $scope.add = function () {
        $scope.name = "";
        if (!$scope.user)
            return;
        $data = $scope.user;
        $scope.users.push($data);

        $scope.user = null;
        $scope.name = "User Added !!!";
    };
    $scope.submit = function () {
        var data;
        data = {"users": $scope.users};
        $http.post("index.php/user/add", data)
                .then(
                        function (response) {

                            $scope.msg = response.data;
                        },
                        function (response) {

                            $scope.msg = "ERROR";
                        }
                );
    };
});


