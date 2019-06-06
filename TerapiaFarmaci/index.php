<!DOCTYPE html>
   <head>
      <meta charset="utf-8">
	  <link rel="stylesheet" type="text/css" href="css/style.css"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
      <title>Webslesson Tutorial | Search HTML Table Data by using JQuery</title>


	
	
   </head>
   <body onload="caricaScript()">
      
	
<!-- <div class="wrapper"> -->
 
 
 <?php include ('menu.php');?>
 
      <!--  <nav id="sidebar">
            
            <div class="sidebar-header">
                <h3>Collapsible Sideba
			</div>
           
 
            
            <ul class="list-unstyled components">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Pages</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li><a href="#">Page</a></li>
                        <li><a href="#">Page</a></li>
                        <li><a href="#">Page</a></li>
                    </ul>
                <li><a href="#">Portfolio</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>

        <div id="content">
            <button type="button" id="sidebarCollapse" class="navbar-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
			
       </div> -->
<div class="container">
         <h2 align="center">Ricerca farmaco</h2>
        
         <br><br>
         <div align="center">
            <input type="text" name="search" id="search" placeholder="Inserisci nome farmaco" class="form-control">
         </div>
         <ul class="list-group" id="result"></ul>
         <br>
		  <div id="risultato"> </div>
		  

	<p> Inserisci il nome di un farmaco e il suo valore per salvare </p>
    Nome farmaco:  <input type="Text" id="itemName"  size="15" /> 
    Valore: <input type="Text" id="itemValue" size="15" /> 
   
<br>
    <input type="button" value="Store item" id="storeItemButton" /> &nbsp;
    <input type="button" value="Count items" id="countItemsButton" /> &nbsp;
    <input type="button" value="Remove item" id="removeItemButton" /> &nbsp;
    <input type="button" value="Clear items" id="clearItemsButton" /> &nbsp;
    <input type="button" value="Display items" id="displayItemsButton" /> &nbsp;

    <br/><br/>
    <div id="messageArea" ></div>

		  
		  
  </div>
  
      </div>
	  
	 <script>
	

        function storeItem() {
            var itemName = document.getElementById("itemName").value;
            var itemValue = document.getElementById("itemValue").value;
    
            window.sessionStorage.setItem(itemName, itemValue);
            // window.sessionStorage[itemName] = itemValue;
    
            alert("Stored in local storage: key=" + itemName + " value=" + itemValue);
        }

        function countItems() {
            var count = window.sessionStorage.length;
            alert("There are " + count + " items in local storage");
        }

        function removeItem() {
            var itemName = document.getElementById("itemName").value;
            window.sessionStorage.removeItem(itemName);
            alert("Done");
        }

        function clearItems() {
            window.sessionStorage.clear();
            alert("Done");
        }

        function displayItems() {

            var count = window.sessionStorage.length;
            var result = "Local storage values:<br/><ul>";
    
            for (var i = 0; i < count; i++) {
                var key = window.sessionStorage.key(i);
                var val = window.sessionStorage.getItem(key);
                result += "<li>" + key + "=" + val + "</li>";
            }
            result += "</ul>";
            document.getElementById("messageArea").innerHTML = result;
        }

        function onLoad() {
           document.getElementById("storeItemButton").addEventListener("click", storeItem, true);
           document.getElementById("countItemsButton").addEventListener("click", countItems, true);
           document.getElementById("removeItemButton").addEventListener("click", removeItem, true);
           document.getElementById("clearItemsButton").addEventListener("click", clearItems, true);
           document.getElementById("displayItemsButton").addEventListener("click", displayItems, true);
   
        }

        window.addEventListener("load", onLoad, true);


   
 
      function caricaScript(){
       $.ajaxSetup({ cache: false });
       $('#search').keyup(function(){
       
        $('#result').html('');
        $('#state').val('');
        var searchField = $('#search').val();
        var expression = new RegExp(searchField, "i");
        $.getJSON('data.json', function(data) {
         $.each(data, function(key, value){
          if (value.Name.search(expression) != -1 || value.IDNumber.search(expression) != -1)
          {
           $('#result').append('<li class="list-group-item link-class" onclick="mostraDati(\''+value.Name+'\')">'+value.Name+' | <span class="text-muted">'+value.IDNumber+'</span></li>');
          }
         });   
        });
       });
       
       $('#result').on('click', 'li', function() {
        var click_text = $(this).text().split('|');
        $('#search').val($.trim(click_text[0]));
        $("#result").html('');
       });
       }
       
       function mostraDati(nome){
      			var url='data.json';
				document.getElementById('risultato').innerHTML="";
      			$.getJSON(url, function(json){
      				var table = $('<table>');
      				table.attr('border','1');
      				var tr = $('<tr style="font-weight: bold;">');
      				//var td = $('<td>');
      				//td.html("ID");
      				//tr.append(td);
      				td = $('<td>');
      				td.html('Name');
      				tr.append(td);
      				td = $('<td>');
      				td.html('IDNumber');
      				tr.append(td);
      				table.append(tr);
      				for( var i=0; i<json.length;i++){
      					if(json[i].Name != nome)
      						continue;
      					var tr = $('<tr>');
      					var td = $('<td>');
      					//td.html(json[i].ID);
      					//tr.append(td);
      					td = $('<td>');
      					td.html(json[i].Name);
      					tr.append(td);
      					td = $('<td>');
      					td.html(json[i].IDNumber);
      					tr.append(td);
      					table.append(tr);
      				}
      				$('#risultato').append(table);
      			});
      		}
			
			
			
			
			
   </script>
  
   </body>

  
   
</html>


