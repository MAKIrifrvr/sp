<html>


<head>

</head>

<body class="yui-skin-sam">
	
	<div> <input type="date" value="2017-04-13" /> </div>
	<div> <input type="week" value="2017-W15" /> </div>
	<div> <input type="month" value="2017-04" /> </div>
	<div> <input type="number" min="1980" max="2099" step="1" value="2017" /> </div>
	<div> 	
			<select required>
				<option selected disabled value >  </option>
				<option value="1st quarter" > 1st Quarter </option>
				<option value="1st quarter" > 2nd Quarter </option>
				<option value="1st quarter" > 3rd Quarter </option>
				<option value="1st quarter" > 4th Quarter </option>
			</select>
			<input type="number" min="1980" max="2099" step="1" value="2017" /> 
	</div>
	



	


	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.9.0/build/calendar/assets/skins/sam/calendar.css">
	 
	<!-- Dependencies -->
	<script src="http://yui.yahooapis.com/2.9.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
	 
	<!-- Source file -->
	<script src="http://yui.yahooapis.com/2.9.0/build/calendar/calendar-min.js"></script>
	<script type="text/javascript">
		var cal1 = new YAHOO.widget.Calendar("cal1Container");
		cal1.cfg.setProperty("navigator",true);
		cal1.render();
		
		YAHOO.namespace("example.calendar"); 
 
	        YAHOO.example.calendar.init = function() { 
	            YAHOO.example.calendar.cal1 = 
	                new YAHOO.widget.Calendar("cal1","cal1Container", { MULTI_SELECT: true } ); 
	 
	            YAHOO.example.calendar.cal1.render(); 
	        } 
	 
	        YAHOO.util.Event.onDOMReady(YAHOO.example.calendar.init); 
	
	</script>
</body>
</html>