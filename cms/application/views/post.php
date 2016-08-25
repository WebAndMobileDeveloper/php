<!DOCTYPE html>
<html>
    <head>
        <title>Angular JS POST</title>
        <style type="text/css">
            * {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                margin: 0;
                padding: 0;
                font-size: inherit;
            }
            html, body {
                font-family: Verdana,sans-serif;
                font-size: 15px;
                line-height: 1.5;
            }
            .box{
                display: table;
                width: 80%;
                margin: auto;
                padding:0px 15px;

            }
            .box .half{
                width: 50%;
                float: left;
                padding:0 8px;

            }
            .table{
                border-collapse: collapse;
                text-align: center;
                max-height: 200px;
                overflow: auto;
                width: 100%;
            }

            .delete{
                cursor: pointer;
                color:red;
            }
            tr{
                height: 25px;
            }
            input[type=text]{
                padding: 8px;
                display: block;		    		    
                width: 100%;		    
            }
            input[type=button]{
                color: #FFFFFF;
                box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);

                border: none;
                display: inline-block;
                outline: 0;		    
                padding: 8px 16px!important;
                vertical-align: middle;
                overflow: hidden;
                text-decoration: none!important;
                color: #fff;
                background-color: #3CBABA;
                text-align: center;
                cursor: pointer;
                white-space: nowrap;
            }
            .form-group{
                margin-bottom: 8px;
                display: table;
                width: 100%;
            }
        </style>
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
                    <table class="table" border="1" style="width:97.8%;">
                        <tr>
                            <th>NO</th>
                            <th>FNAME</th>
                            <th>LNAME</th>
                            <th>DETELE</th>
                        </tr>
                    </table>
                    <div style="display:block;height:100px;overflow-y:scroll;position:relative" id="scroll">	
                        <table class="table" border="1" style="position:absolute;top:-26px;">
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

    </body>
</html>