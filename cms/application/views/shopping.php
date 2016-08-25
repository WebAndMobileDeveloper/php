<!DOCTYPE html>
<html>
<head>
	<title>Make Shopping List</title>
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>	
	<script src="http://localhost/libs/jquery/1.9.1/jquery.min.js"></script>	
	<style type="text/css">

	* {
	    -webkit-box-sizing: border-box;
	    -moz-box-sizing: border-box;
	    box-sizing: border-box;
	    margin: 0;
	    padding: 0;
	}
	html, body {
	    font-family: Verdana,sans-serif;
	    font-size: 15px;
	    line-height: 1.5;
	}
	h1, h2, h3, h4, h5, h6, .w3-slim, .w3-wide {
	    font-family: Arial, Helvetica, sans-serif;
	}
	h1, h2, h3, h4, h5, h6 {
	    font-weight: 400;
	    margin: 10px 0;
	}
	h2 {
	    font-size: 30px;
	}
	button, input, select, textarea {
	    font: inherit;
	    margin: 0;
	}
	.box{		
		box-shadow: 0px 2px 0px 0.5px #F1F1F1;
		border-top-left-radius: 2px;
		border-top-right-radius: 2px;
		width: 360px;
		margin: auto;

	}
	.heading{
		background-color: #F1F1F1;
		padding:1em 1em;
		border-top-left-radius: 2px;
		border-top-right-radius: 2px;
		text-align: center;
	}
	.error{
		color:#FC1212;
	}
	.footer{
		background-color: #F1F1F1;
		padding:1em 1em;
	}
	ul{
		list-style: none;
		padding: 0;
		margin: 0;
		display: block;
	}
	ul li{
		padding: 1em;
		border-bottom: 1px solid #F1F1F1;
	}
	ul li .close{
		float: right;
		cursor: pointer;
	}
		.a-input{
			padding: 8px;
		    display: block;
		    border: none;		    
		    width: 100%;
		}
		.a-btn, .a-btn:link, .a-btn:visited {
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

	</style>
	<!-- <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css"> -->
</head>
<body ng-app="myApp">
		<div class="box">			
			<div class="shoping-app" ng-controller="ctrl">
				<div class="heading">
					<h2>My Shopping List</h2>
				</div>
				<div class="body">
					<div  >								
							<ul style="max-height:200px;overflow-y:auto;height:auto;"  id="bottom" >
								<li ng-repeat="x in items">{{x}}<span class="close" ng-click="remove($index)">x</span></li>
							</ul>
					</div>
				</div>
				<div class="footer">
					<div class="error">{{error}}</div>
					<div class="control" style="display:table;width:100%">
						<div style="float:left;width:83%;">							
							<input type="text" placeholder="Add shopping items here" ng-model="item" class="a-input">
						</div>
						<div style="float:left;width:17%;">
							<input type="button" class="a-btn" value="Add" scroll-bottom="bottom" ng-click="add()" >
						</div>
						
					</div>
						<div style="margin-top:10px;width:100%;text-align:center">
							<input type="button" class="a-btn" value="submit to server" ng-click="submit()">
						</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
		
		var app=angular.module("myApp",[]);

		// app.directive("scrollBottom",function(){
		// 	return {
		// 		link:function(scope,element,attr){
		// 			var $id=$("#"+attr.scrollBottom);
		// 			$(element).on("click",function(){
		// 				$id.scrollTop($id[0].scrollHeight);

		// 			});
		// 		}
		// 	}
		// });

	app.directive("scrollBottom", function(){
		    return {
		        link: function(scope, element, attr){
		        	  var $id= $("#" + attr.scrollBottom);

			          $(element).on("click", function(){
			          		setTimeout(function() {
			                	$id.scrollTop($id[0].scrollHeight);			          			
			          		}, 1);
			           });
		        }
		    }
		});
		app.controller("ctrl",function($scope,$http){

			$http.get("php/index.php").then(
				function(response){
					$scope.items=response.data.records;
				},
				function(response){
					$scope.items=["No Items"];
				}
			);
			

			$scope.add=function(){		
				$scope.error="";
				if(!$scope.item){
					$scope.error="please enter item";
					return;
				} 
				if($scope.items.indexOf($scope.item)==-1)
					$scope.items.push($scope.item);
				else
					$scope.error="The item is already in your shopping list";
			};

			$scope.remove=function(x){
				$scope.error="";
				$scope.items.splice(x,1);
			};

			$scope.submit=function(){

				var dataa=$.param({
					fname:"Sam",
					lname:"V"
				});
				
				var config={
					headers:{
						'Contebt-Type':'application/x-www-form-urlencoded;charset=utf-8;'
					}
				}
				
				$http.post("php/save.php",dataa,config)
					.success(function(data,status,headers,config){
						console.log(data);
					})
					.error(function(data,status,headers,config){
						console.log(data);	
					});

			};
			

		});
		</script>
</body>
</html>