
<html>

   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <title>Webslesson Tutorial | Search HTML Table Data by using JQuery</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	   <link rel="stylesheet" type="text/css" href="css/style.css"/>
	  
      <style>
         #result {
         position: absolute;
         width: 100%;
         max-width:870px;
         cursor: pointer;
         overflow-y: auto;
         max-height: 400px;
         box-sizing: border-box;
         z-index: 1001;
         }
         .link-class:hover{
         background-color:#f1f1f1;
         }
      </style>
   </head>
   <body onload="caricaScript()">
      
	  
<?php include ('menu.php');?>

	  
      <div class="container">
         <h2 align="center">Ricerca farmaco</h2>
         
         <br><br>
         <div align="center">
            <input type="text" name="search" id="search" placeholder="Inserisci nome farmaco" class="form-control">
            <ul class="list-group" id="result"></ul>
         </div>
         
		 <div align="center">
            <input type="text" name="search2" id="search2" placeholder="Inserisci nome farmaco" class="form-control">
            <ul class="list-group" id="result2"></ul>
         </div>
         <br>
		 <div id="risultato"> </div>
      </div>
	  
	  
	 </div>
      
      <script>
        function caricaScript() {
		$.ajaxSetup({
			cache: false
		});
		$('#search').keyup(function() {
			$('#state').val('');
			$('#result').html('');
			var searchField = $('#search').val();
			var expression = new RegExp(searchField, "i");
			$.getJSON('data.json', function(data) {
				$.each(data, function(key, value) {
					if (value.Name.search(expression) != -1 || value.IDNumber.search(expression) != -1) {
						$('#result').append('<li class="list-group-item link-class">' + value.Name + ' | <span class="text-muted">' + value.IDNumber + '</span></li>');
					}
				});
			});
		});

		$('#search2').keyup(function() {
			$('#result2').html('');
			var searchField = $('#search2').val();
			var expression = new RegExp(searchField, "i");
			$.getJSON('data.json', function(data) {
				$.each(data, function(key, value) {
					if (value.Name.search(expression) != -1 || value.IDNumber.search(expression) != -1) {
						$('#result2').append('<li class="list-group-item link-class">' + value.Name + ' | <span class="text-muted">' + value.IDNumber + '</span></li>');
					}
				});
			});
		});

		$('#result').on('click', 'li', function() {
			var click_text = $(this).text().split('|');
			$('#search').val($.trim(click_text[0]));
			$("#result").html('');
			confronto();
		});


		$('#result2').on('click', 'li', function() {
			var click_text = $(this).text().split('|');
			$('#search2').val($.trim(click_text[0]));
			$("#result2").html('');
			confronto();
		});
	}




	function confronto() {
		var url = 'confronto.json';
		var trovato = false;
		var farmaco1 = '';
		if (document.getElementById('search') != null)
			farmaco1 = document.getElementById('search').value;
		var farmaco2 = '';
		if (document.getElementById('search2') != null)
			farmaco2 = document.getElementById('search2').value;
		document.getElementById('risultato').innerHTML = "";

		$.getJSON(url, function(json) {

			var table = $('<table>');
			table.attr('border', '1');
			var tr = $('<tr style="font-weight: bold;">');
			td = $('<td>');
			td.html('Farmaci');
			tr.append(td);
			td = $('<td>');
			td.html('Controindicazione');
			tr.append(td);
			table.append(tr);

			for (var i = 0; i < json.length; i++) {
				if(farmaco1 == farmaco2)
					continue;
				if ((json[i].Farmaco1 == farmaco1 && json[i].Farmaco2 == farmaco2) || (json[i].Farmaco1 == farmaco2 && json[i].Farmaco2 == farmaco1)){
					trovato = true;
					var tr = $('<tr>');
					var td = $('<td>');
					td = $('<td>');
					td.html(json[i].Farmaco1 + ' + ' + json[i].Farmaco2);
					tr.append(td);
					td = $('<td>');
					td.html(json[i].Controindicazioni);
					tr.append(td);
					table.append(tr);
				}
			}
			if (trovato)
				$('#risultato').append(table);
		});
	}

	function mostraDati(nome) {
		var url = 'data.json';
		document.getElementById('risultato').innerHTML = "";
		$.getJSON(url, function(json) {
			var table = $('<table>');
			table.attr('border', '1');
			var tr = $('<tr style="font-weight: bold;">');
			td = $('<td>');
			td.html('Name');
			tr.append(td);
			td = $('<td>');
			td.html('IDNumber');
			tr.append(td);
			table.append(tr);
			for (var i = 0; i < json.length; i++) {
				if (json[i].Name != nome)
					continue;
				var tr = $('<tr>');
				var td = $('<td>');
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