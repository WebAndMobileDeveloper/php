<!DOCTYPE html>
<html>
    <head>
        <title>Add Student</title>
        <?php queue_css($css);?>

    </head>
    <body ng-app="myApp">
        <div class="ctrl" ng-controller="Ctrl">			

            <div class="box">				
                <div class="half">					

                    <div class="form-group">
                        <div class="half">
                            <input type="text" ng-model="user.fname" placeholder="Enter First Name">
                        </div>
                        <div class="half">
                            <input type="text" ng-model="user.lname" placeholder="Enter Last Name">							
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="half">
                            <input type="button" ng-click="add()" value="ADD" scroll-bottom="#scroll">
                        </div>
                        <div class="half">
                            <div class="name">{{name}}</div>
                        </div>						
                    </div>
                </div>
                <div class="half">					
                    <table class="table" border="1" style="width:96.8%;">
                        <tr>
                            <th>NO</th>
                            <th>FNAME</th>
                            <th>LNAME</th>
                            <th>DETELE</th>
                        </tr>
                    </table>
                    <div style="display:block;height:115px;overflow-y:scroll;position:relative" id="scroll">	
                        <table class="table" border="1" style="position:absolute;top:-38px;">
                            <tr>
                                <th>NO</th>
                                <th>FNAME</th>
                                <th>LNAME</th>
                                <th>DETELE</th>
                            </tr>						
                            <tr ng-repeat="u in users">
                                <td>{{$index + 1}}</td>
                                <td>{{u.fname}}</td>
                                <td>{{u.lname}}</td>
                                <td><span ng-click="remove($index)" class="delete">x</span></td>
                            </tr>
                        </table>
                    </div>

                </div>				
            </div>

            <div class="box" style="text-align:center">

                <div class="half">
                    <div>{{msg}}</div>
                    <input type="button" ng-click="submit()" value="SUBMIT">
                </div>


            </div>				

        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.js"></script>	
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>	
        <script type="text/javascript">
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
                                var config = {
                                    headers: {
                                        // 'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                                    }
                                }
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



        </script>
        <?php queue_js($js);?>
    </body>
</html>